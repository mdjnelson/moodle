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
 * Handles synchronising members using the enrolment LTI.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_lti\task;

/**
 * Task for synchronising members using the enrolment LTI.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_members extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('tasksyncmembers', 'enrol_lti');
    }

    /**
     * Performs the synchronisation of members.
     */
    public function execute() {
        global $CFG, $DB;

        require_once($CFG->dirroot . '/enrol/lti/locallib.php');
        require_once($CFG->dirroot . '/enrol/lti/ims-blti/OAuth.php');
        require_once($CFG->dirroot . '/enrol/lti/ims-blti/OAuthBody.php');

        $synctime = get_config('enrol_lti', 'membersynctime');
        $syncmode = get_config('enrol_lti', 'membersyncmode');

        $timenow = time();

        if ($tools = enrol_lti_get_lti_tools()) {
            $ltiplugin = enrol_get_plugin('lti');
            $consumers = array();
            $currentusers = array();
            $userphotos = array();
            foreach ($tools as $tool) {
                if ($tool->lastmembersynctime + $synctime < $timenow) {
                    mtrace("Starting - Member sync for shared tool '$tool->id' for the course '$tool->courseid'.");
                    // We check for all the users - users can access the same tool from different consumers.
                    if ($ltiusers = $DB->get_records('enrol_lti_users', array('toolid' => $tool->id), 'lastaccess DESC')) {
                        foreach ($ltiusers as $user) {
                            $mtracecontent = "for the user '$user->userid' in the tool '$tool->id' for the course " .
                                "'$tool->courseid'";
                            if (!$user->membershipsurl) {
                                mtrace("Skipping - Empty membershipsurl $mtracecontent.");
                                continue;
                            }

                            if (!$user->membershipsid) {
                                mtrace("Skipping - Empty membershipsid $mtracecontent.");
                                continue;
                            }

                            $consumer = md5($user->membershipsurl . ':' . $user->membershipsid . ':' .
                                $user->consumerkey . ':' . $user->consumersecret);
                            if (in_array($consumer, $consumers)) {
                                // We have already synchronised with this consumer.
                                continue;
                            }

                            $consumers[] = $consumer;

                            $params = array(
                                'lti_message_type' => 'basic-lis-readmembershipsforcontext',
                                'id' => $user->membershipsid,
                                'lti_version' => 'LTI-1p0'
                            );

                            mtrace("Calling memberships url '$user->membershipsurl' with body '" .
                                json_encode($params) . "'");

                            try {
                                $response = sendOAuthParamsPOST('POST', $user->membershipsurl, $user->consumerkey,
                                    $user->consumersecret, 'application/x-www-form-urlencoded', $params);
                            } catch (\Exception $e) {
                                mtrace("Exception: " . $e->getMessage());
                                $response = false;
                            }

                            // Check the response from the consumer.
                            if ($response) {
                                $data = new \SimpleXMLElement($response);
                                if (!empty($data->statusinfo)) {
                                    if (strpos(strtolower($data->statusinfo->codemajor), 'success') !== false) {
                                        $members = $data->memberships->member;
                                        mtrace(count($members) . ' members received.');
                                        foreach ($members as $member) {
                                            $username = enrol_lti_create_username($user->consumerkey, $member->user_id);
                                            $userobj = $DB->get_record('user', array('username' => $username));
                                            if ($userobj) {
                                                $userobj->firstname = clean_param($member->person_name_given, PARAM_TEXT);
                                                $userobj->lastname = clean_param($member->person_name_family, PARAM_TEXT);
                                                $userobj->email = clean_param($member->person_contact_email_primary, PARAM_EMAIL);
                                                // If the email was stripped/not set then unset it.
                                                if (empty($user->email)) {
                                                    unset($user->email);
                                                }
                                                $userobj->timemodified = time();

                                                user_update_user($userobj);

                                                // Add the information to the necessary arrays.
                                                $currentusers[] = $userobj->id;
                                                $userphotos[$userobj->id] = $member->user_image;
                                            } else { // Must be a new member.
                                                if ($syncmode == ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL ||
                                                    $syncmode == ENROL_LTI_MEMBER_SYNC_ENROL_NEW) {
                                                    // We have to enrol new members so we have to create it.
                                                    $username = enrol_lti_create_username($user->consumerkey, $member->user_id);
                                                    $userobj = new \stdClass();
                                                    $userobj->auth = 'lti';
                                                    $userobj->username = $username;
                                                    $userobj->password = md5(uniqid(rand(), 1));
                                                    $userobj->firstname = clean_param($member->person_name_given, PARAM_TEXT);
                                                    $userobj->lastname = clean_param($member->person_name_family, PARAM_TEXT);
                                                    $userobj->email = clean_param($member->person_contact_email_primary,
                                                        PARAM_EMAIL);
                                                    $userobj->city = $tool->city;
                                                    $userobj->country = $tool->country;
                                                    $userobj->institution = $tool->institution;
                                                    $userobj->timezone = $tool->timezone;
                                                    $userobj->maildisplay = $tool->maildisplay;
                                                    $userobj->mnethostid = $CFG->mnet_localhost_id;
                                                    $userobj->confirmed = 1;
                                                    $userobj->lang = $tool->lang;
                                                    $userobj->timecreated = time();
                                                    if (!$userobj->lang) {
                                                        $userobj->lang = current_language();
                                                    }

                                                    $userobj->id = user_create_user($user);

                                                    // Reload full user.
                                                    $userobj = $DB->get_record('user', array('id' => $userobj->id));

                                                    // Add the information to the necessary arrays.
                                                    $currentusers[] = $userobj->id;
                                                    $userphotos[$userobj->id] = $member->user_image;
                                                }
                                            }
                                            if ($syncmode == ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL ||
                                                $syncmode == ENROL_LTI_MEMBER_SYNC_ENROL_NEW) {
                                                // Enrol the user in the course.
                                                enrol_lti_enrol_user($tool, $userobj);
                                            }
                                        }
                                    } else {
                                        mtrace('Error received from the remote system: ' . $data->statusinfo->codemajor
                                            . ' ' . $data->statusinfo->severity . ' ' . $data->statusinfo->codeminor);
                                    }
                                } else {
                                    mtrace('Error parsing the XML received \'' . substr($response, 0, 125) .
                                        '\' ... (Displaying only 125 chars)');
                                }
                            } else {
                                mtrace('No response received from \'' . $user->membershipsurl . '\'');
                            }
                        }
                        // Now we check if we have to unenrol users who were not listed.
                        if ($syncmode == ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL ||
                            $syncmode == ENROL_LTI_MEMBER_SYNC_UNENROL_MISSING) {
                            // Go through the users and check if any were never listed, if so, remove them.
                            foreach ($ltiusers as $user) {
                                if (!in_array($user->userid, $currentusers)) {
                                    $instance = new \stdClass();
                                    $instance->id = $tool->enrolid;
                                    $instance->courseid = $tool->courseid;
                                    $instance->enrol = 'lti';
                                    $ltiplugin->unenrol_user($instance, $user->id);
                                }
                            }
                        }
                    }
                    $DB->set_field('enrol_lti_tools', 'lastmembersynctime', $timenow, array('id' => $tool->id));
                    mtrace("Completed - Synced members for tool '$tool->id' in the course '$tool->courseid'.");
                    mtrace("");
                } else {
                    $last = format_time((time() - $tool->lastmembersynctime));
                    mtrace("Skipping - Member sync for shared tool '$tool->id' for the course '$tool->courseid' was " .
                        "synchronised $last ago.");
                    mtrace("");
                }
            }

            // Sync the user profile photos.
            mtrace("Syncing user profile images.");
            $counter = 0;
            if (!empty($userphotos)) {
                foreach ($userphotos as $userid => $url) {
                    if ($url) {
                        $result = enrol_lti_update_user_profile_image($userid, $url);
                        if ($result === true) {
                            $counter++;
                            mtrace("Profile image succesfully downloaded and created for user '$userid' from $url.");
                        } else {
                            mtrace($result);
                        }
                    }
                }
            }
        }

        mtrace("Completed - Synced $counter profile images.");
    }
}
