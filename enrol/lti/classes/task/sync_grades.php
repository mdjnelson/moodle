<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Handles synchronising grades for the enrolment LTI.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_lti\task;

/**
 * Task for synchronising grades for the enrolment LTI.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_grades extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('tasksyncgrades', 'enrol_lti');
    }

    /**
     * Performs the synchronisation of grades.
     */
    public function execute() {
        global $DB, $CFG;

        require_once($CFG->dirroot . '/enrol/lti/locallib.php');
        require_once($CFG->dirroot . '/enrol/lti/ims-blti/OAuth.php');
        require_once($CFG->dirroot . '/enrol/lti/ims-blti/OAuthBody.php');
        require_once($CFG->dirroot . '/lib/completionlib.php');
        require_once($CFG->libdir . '/gradelib.php');
        require_once($CFG->dirroot . '/grade/querylib.php');

        $synctime = get_config('enrol_lti', 'gradesynctime');
        $syncmode = get_config('enrol_lti', 'gradesyncmode');
        $timenow = time();

        if ($tools = enrol_lti_get_lti_tools()) {
            foreach ($tools as $tool) {
                if ($tool->lastgradesynctime + $synctime < $timenow) {
                    mtrace("Starting - Grade sync for shared tool '$tool->id' for the course '$tool->courseid'.");

                    $usercount = 0;
                    $sendcount = 0;
                    $errorcount = 0;

                    $completion = new \completion_info(get_course($tool->courseid));

                    if ($users = $DB->get_records('enrol_lti_users', array('toolid' => $tool->id))) {
                        foreach ($users as $user) {
                            $mtracecontent = "for the user '$user->userid' in the tool '$tool->id' for the course " .
                                "'$tool->courseid'";

                            $usercount = $usercount + 1;
                            // This can happen is the sync process has an unexpected error.
                            if (strlen($user->serviceurl) < 1) {
                                mtrace("Skipping - Empty serviceurl $mtracecontent.");
                                continue;
                            }
                            if (strlen($user->sourceid) < 1) {
                                mtrace("Skipping - Empty sourceid $mtracecontent.");
                                continue;
                            }

                            $grade = false;
                            if ($context = \context::instance_by_id($tool->contextid)) {
                                if ($context->contextlevel == CONTEXT_COURSE) {
                                    // Check if the user did not completed the course when it was required.
                                    if ($tool->gradesynccompletion and !$completion->is_course_complete($user->userid)) {
                                        mtrace("Skipping - Course not completed $mtracecontent.");
                                        continue;
                                    }

                                    // Get the grade.
                                    if ($grade = grade_get_course_grade($user->userid, $tool->courseid)) {
                                        $grademax = floatval($grade->item->grademax);
                                        $grade = $grade->grade;
                                    }
                                } else if ($context->contextlevel == CONTEXT_MODULE) {
                                    $cm = get_coursemodule_from_id(false, $context->instanceid, 0, false, MUST_EXIST);

                                    if ($tool->gradesynccompletion) {
                                        $data = $completion->get_data($cm, false, $user->userid);
                                        if ($data->completionstate != COMPLETION_COMPLETE_PASS and
                                            $data->completionstate != COMPLETION_COMPLETE) {
                                            mtrace("Skipping - Activity not completed $mtracecontent.");
                                            continue;
                                        }
                                    }

                                    $grades = grade_get_grades($cm->course, 'mod', $cm->modname, $cm->instance, $user->userid);
                                    if (empty($grades->items[0]->grades)) {
                                        $grade = false;
                                    } else {
                                        $grade = reset($grades->items[0]->grades);
                                        if (!empty($grade->item)) {
                                            $grademax = floatval($grade->item->grademax);
                                        } else {
                                            $grademax = floatval($grades->items[0]->grademax);
                                        }
                                        $grade = $grade->grade;
                                    }
                                }

                                if ($grade === false || $grade === null || strlen($grade) < 1) {
                                    mtrace("Skipping - Invalid grade '$grade' $mtracecontent.");
                                    continue;
                                }

                                // No need to be dividing by zero.
                                if ($grademax == 0.0) {
                                    $grademax = 100.0;
                                }

                                $sendgrades = false;
                                if ($syncmode == ENROL_LTI_GRADE_SYNC_ALWAYS) {
                                    $sendgrades = true;
                                } else if ($syncmode == ENROL_LTI_GRADE_SYNC_DIFFERS) {
                                    if ($grade != $user->lastgrade) {
                                        $sendgrades = true;
                                    }
                                } else { // Must be set to ENROL_LTI_GRADE_SYNC_FIRST_TIME.
                                    if (empty($tool->lastgradesynctime)) {
                                        $sendgrades = true;
                                    }
                                }

                                // Sync with the external system.
                                if ($sendgrades) {
                                    $floatgrade = $grade / $grademax;
                                    $body = enrol_lti_create_service_body($user->sourceid, $floatgrade);

                                    try {
                                        $response = sendOAuthBodyPOST('POST', $user->serviceurl,
                                            $user->consumerkey, $user->consumersecret, 'application/xml', $body);
                                    } catch (\Exception $e) {
                                        mtrace($e->getMessage());
                                        $errorcount = $errorcount + 1;
                                        continue;
                                    }

                                    if (strpos(strtolower($response), 'success') !== false) {
                                        $DB->set_field('enrol_lti_users', 'lastgrade', intval($grade), array('id' => $user->id));

                                        mtrace("Success - The grade '$floatgrade' $mtracecontent was sent to the remote system.");
                                        $sendcount = $sendcount + 1;
                                    } else {
                                        mtrace("Failed - The grade '$floatgrade' $mtracecontent failed to send to the " .
                                            "remote system.");
                                        $errorcount = $errorcount + 1;
                                    }
                                } else {
                                    mtrace("Not sent - The grade $mtracecontent was not sent to the remote system due to " .
                                        "the 'Grade synchronisation mode' setting.");
                                    $errorcount = $errorcount + 1;
                                }
                            } else {
                                mtrace("Failed - Invalid contextid '$tool->contextid' for the tool '$tool->id'.");
                            }
                        }
                    }
                    $DB->set_field('enrol_lti_tools', 'lastgradesynctime', $timenow, array('id' => $tool->id));
                    mtrace("Completed - Synced grades for tool '$tool->id' in the course '$tool->courseid'. " .
                        "Processed $usercount users; sent $sendcount grades.");
                    mtrace("");
                } else {
                    $last = format_time((time() - $tool->lastgradesynctime));
                    mtrace("Skipping - Grade sync for shared tool '$tool->id' for the course '$tool->courseid' was " .
                        "synchronised $last ago.");
                    mtrace("");
                }
            }
        }
    }
}
