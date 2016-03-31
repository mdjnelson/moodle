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
 * LTI enrolment plugin locallib functions.
 *
 * @package enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/*
 * The value used when we always want to send grades.
 */
define('ENROL_LTI_GRADE_SYNC_ALWAYS', 1);

/*
 * The value used when we want to send grades when they differ.
 */
define('ENROL_LTI_GRADE_SYNC_DIFFERS', 2);

/*
 * The value used when we want to send grades the first time only.
 */
define('ENROL_LTI_GRADE_SYNC_FIRST_TIME', 3);

/*
 * The value used when we want to enrol new members and unenrol old ones.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL', 1);

/*
 * The value used when we want to enrol new members only.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_NEW', 2);

/*
 * The value used when we want to unenrol missing users.
 */
define('ENROL_LTI_MEMBER_SYNC_UNENROL_MISSING', 3);

/**
 * Error code for enrolment when max enrolled exists.
 */
define('ENROL_LTI_MAX_ENROLLED', 'maxenrolledreached');

/**
 * Error code for enrolment when max enrolled exists.
 */
define('ENROL_LTI_ENROLMENT_NOT_STARTED', 'enrolmentnotstarted');

/**
 * Error code for enrolment when max enrolled exists.
 */
define('ENROL_LTI_ENROLMENT_FINISHED', 'enrolmentfinished');

/**
 * Creates a unique username.
 *
 * @param string $consumerkey Consumer key
 * @param string $ltiuserid External tool user id
 * @return string The new username
 */
function enrol_lti_create_username($consumerkey, $ltiuserid) {

    if (strlen($ltiuserid) > 0 and strlen($consumerkey) > 0) {
        $userkey = $consumerkey . ':' . $ltiuserid;
    } else {
        $userkey = false;
    }

    return 'enrol_lti' . md5($consumerkey . '::' . $userkey);
}

/**
 * Populates a standard user record.
 *
 * @param \BLTI $ltirequest The LTI request
 * @param stdClass $tool The tool object
 * @return stdClass the user record
 */
function enrol_lti_get_user_details($ltirequest, $tool) {
    global $CFG;

    $user = new stdClass();

    if (isset($ltirequest->info['lis_person_name_given'])) {
        $user->firstname = $ltirequest->info['lis_person_name_given'];
    } else {
        $user->firstname = $ltirequest->info['user_id'];
    }

    if (isset($ltirequest->info['lis_person_name_family'])) {
        $user->lastname = $ltirequest->info['lis_person_name_family'];
    } else {
        $user->lastname = $ltirequest->info['context_id'];
    }

    $user->email = clean_param($ltirequest->getUserEmail(), PARAM_EMAIL);
    $user->city = (!empty($tool->city)) ? $tool->city : "";
    $user->country = (!empty($tool->country)) ? $tool->country : "";
    $user->institution = (!empty($tool->institution)) ? $tool->institution : "";
    $user->timezone = (!empty($tool->timezone)) ? $tool->timezone : "";
    $user->maildisplay = (!empty($tool->maildisplay)) ? $tool->maildisplay : "";
    $user->mnethostid = $CFG->mnet_localhost_id;
    $user->confirmed = 1;
    $user->timecreated = time();
    $user->timemodified = $user->timecreated;

    $user->lang = $tool->lang;
    if (!$user->lang and isset($_POST['launch_presentation_locale'])) {
        $user->lang = optional_param('launch_presentation_locale', '', PARAM_LANG);
    }
    if (!$user->lang) {
        $user->lang = current_language();
    }

    return $user;
}

/**
 * Compares two users.
 *
 * @param stdClass $newuser The new user
 * @param stdClass $olduser The old user
 * @return bool True if both users are the same
 */
function enrol_lti_user_match($newuser, $olduser) {
    if ($newuser->firstname != $olduser->firstname) {
        return false;
    }
    if ($newuser->lastname != $olduser->lastname) {
        return false;
    }
    if ($newuser->email != $olduser->email) {
        return false;
    }
    if ($newuser->city != $olduser->city) {
        return false;
    }
    if ($newuser->country != $olduser->country) {
        return false;
    }
    if ($newuser->institution != $olduser->institution) {
        return false;
    }
    if ($newuser->timezone != $olduser->timezone) {
        return false;
    }
    if ($newuser->maildisplay != $olduser->maildisplay) {
        return false;
    }
    if ($newuser->mnethostid != $olduser->mnethostid) {
        return false;
    }
    if ($newuser->confirmed != $olduser->confirmed) {
        return false;
    }
    if ($newuser->lang != $olduser->lang) {
        return false;
    }

    return true;
}

/**
 * Updates the users profile image.
 *
 * @param int $userid the id of the user
 * @param string $url the url of the image
 * @return bool|string true if successful, else a string explaining why it failed
 */
function enrol_lti_update_user_profile_image($userid, $url) {
    global $CFG, $DB;

    require_once("$CFG->libdir/filelib.php");
    require_once("$CFG->libdir/gdlib.php");

    $fs = get_file_storage();
    try {
        $context = context_user::instance($userid, MUST_EXIST);
        $fs->delete_area_files($context->id, 'user', 'newicon');

        $filerecord = array('contextid' => $context->id, 'component' => 'user', 'filearea' => 'newicon',
            'itemid' => 0, 'filepath' => '/');
        if (!$iconfiles = $fs->create_file_from_url($filerecord, $url, array('calctimeout' => false,
            'timeout' => 5,
            'skipcertverify' => true,
            'connecttimeout' => 5))) {
            return "Error downloading profile image from $url";
        }

        if ($iconfiles = $fs->get_area_files($context->id, 'user', 'newicon')) {
            // Get file which was uploaded in draft area.
            foreach ($iconfiles as $file) {
                if (!$file->is_directory()) {
                    break;
                }
            }
            // Copy file to temporary location and the send it for processing icon.
            if ($iconfile = $file->copy_content_to_temp()) {
                // There is a new image that has been uploaded.
                // Process the new image and set the user to make use of it.
                $newpicture = (int)process_new_icon($context, 'user', 'icon', 0, $iconfile);
                // Delete temporary file.
                @unlink($iconfile);
                // Remove uploaded file.
                $fs->delete_area_files($context->id, 'user', 'newicon');
                $DB->set_field('user', 'picture', $newpicture, array('id' => $userid));
                return true;
            } else {
                // Something went wrong while creating temp file.
                // Remove uploaded file.
                $fs->delete_area_files($context->id, 'user', 'newicon');
                return "Error creating the downloaded profile image from $url";
            }
        } else {
            return "Error converting downloaded profile image from $url";
        }
    } catch (Exception $e) {
        return "Error downloading profile image from $url";
    }
}

/**
 * Enrol a user in a course.
 *
 * @param stdclass $tool The tool object
 * @param stdclass $user The user object
 * @return bool|string returns true if successful, else an error code
 */
function enrol_lti_enrol_user($tool, $user) {
    global $DB;

    $ltienrolinstance = $DB->get_record('enrol', array('id' => $tool->enrolid), '*', MUST_EXIST);

    // Check if the user enrolment exists.
    if (!$ue = $DB->get_record('user_enrolments', array('enrolid' => $tool->enrolid, 'userid' => $user->id))) {
        // This means a new enrolment, so we have to check enroment starts and end limits and also max occupation.
        // First we check if there is a max enrolled limit.
        if ($tool->maxenrolled) {
            if ($DB->count_records('user_enrolments', array('enrolid' => $tool->enrolid)) >= $tool->maxenrolled) {
                return ENROL_LTI_MAX_ENROLLED;
            }
        }
        if ($ltienrolinstance->enrolstartdate && time() < $ltienrolinstance->enrolstartdate) {
            return ENROL_LTI_ENROLMENT_NOT_STARTED;
        }
        if ($ltienrolinstance->enrolenddate && time() > $ltienrolinstance->enrolenddate) {
            return ENROL_LTI_ENROLMENT_FINISHED;
        }

        $timeend = 0;
        if ($ltienrolinstance->enrolperiod) {
            $timeend = time() + $tool->enrolperiod;
        }

        $ltienrol = enrol_get_plugin('lti');
        $ltienrol->enrol_user($ltienrolinstance, $user->id, null, time(), $timeend);
    }

    return true;
}
