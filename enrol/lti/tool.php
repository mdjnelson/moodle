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
 * The main entry point for the external system.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/enrol/lti/locallib.php');
require_once($CFG->dirroot . '/enrol/lti/ims-blti/blti.php');

$toolid = required_param('id', PARAM_INT);
$lticontextid = required_param('context_id', PARAM_RAW);

// Get the tool.
$tool = $DB->get_record('enrol_lti_tools', array('id' => $toolid), '*', MUST_EXIST);

// Do not set session, do not redirect.
$ltirequest = new BLTI($tool->secret, false, false);

// Correct launch request.
if ($ltirequest->valid) {
    // Check that we can perform enrolments.
    if (!enrol_is_enabled('lti')) {
        print_error('enrolisdisabled', 'enrol_lti');
        exit();
    }

    // Before we do anything check that the context is valid.
    $context = context::instance_by_id($tool->contextid);

    // Get the username.
    $username = enrol_lti_create_username($ltirequest->info['oauth_consumer_key'], $ltirequest->info['user_id']);

    // Get the user data from the LTI consumer.
    $user = enrol_lti_get_user_details($ltirequest, $tool);

    // If the email was stripped/not set then fill it with a default one. This
    // stops the user from being redirected to edit their profile page.
    if (empty($user->email)) {
        $user->email = $username .  "@ltiuser.com";
    }

    // Check if the user exists.
    if (!$dbuser = $DB->get_record('user', array('username' => $username, 'deleted' => 0))) {
        $user->username = $username;
        $user->auth = 'lti';

        $user->id = user_create_user($user);

        // Get the updated user record.
        $user = $DB->get_record('user', array('id' => $user->id));
    } else {
        if (enrol_lti_user_match($user, $dbuser) || !$tool->userprofileupdate) {
            $user = $dbuser;
        } else {
            $user->id = $dbuser->id;
            user_update_user($user);

            // Get the updated user record.
            $user = $DB->get_record('user', array('id' => $user->id));
        }
    }

    // Update user image.
    if (!empty($ltirequest->info['user_image'])) {
        enrol_lti_update_user_profile_image($user->id, $ltirequest->info['user_image']);
    } else if (!empty($ltirequest->info['custom_user_image'])) {
        enrol_lti_update_user_profile_image($user->id, $ltirequest->info['custom_user_image']);
    }

    // Check if we are an instructor.
    $isinstructor = $ltirequest->isInstructor();

    if ($context->contextlevel == CONTEXT_COURSE) {
        $courseid = $context->instanceid;
        $urltogo = new moodle_url('/course/view.php', array('id' => $courseid));

        // May still be set from previous session, so unset it.
        unset($SESSION->forcepagelayout);
    } else if ($context->contextlevel == CONTEXT_MODULE) {
        $cmid = $context->instanceid;
        $cm = get_coursemodule_from_id(false, $context->instanceid, 0, false, MUST_EXIST);
        $urltogo = new moodle_url('/mod/' . $cm->modname . '/view.php', array('id' => $cm->id));

        // If we are a student in the course module context we do not want to display blocks.
        if (!$isinstructor) {
            // Force the page layout.
            $SESSION->forcepagelayout = 'embedded';
        } else {
            // May still be set from previous session, so unset it.
            unset($SESSION->forcepagelayout);
        }
    } else {
        print_error('invalidcontext');
        exit();
    }

    // Enrol the user in the course with no role.
    $result = enrol_lti_enrol_user($tool, $user);

    // Only true is a valid result, else there was a problem.
    if ($result !== true) {
        echo get_string($result, 'enrol_lti');
        exit();
    }

    // Give the user the role in the given context.
    $roleid = $isinstructor ? $tool->roleinstructor : $tool->rolelearner;
    role_assign($roleid, $user->id, $tool->contextid);

    // Login user.
    $sourceid = (!empty($ltirequest->info['lis_result_sourcedid'])) ? $ltirequest->info['lis_result_sourcedid'] : '';
    $serviceurl = (!empty($ltirequest->info['lis_outcome_service_url'])) ? $ltirequest->info['lis_outcome_service_url'] : '';

    if ($userlog = $DB->get_record('enrol_lti_users', array('toolid' => $tool->id, 'userid' => $user->id))) {
        if ($userlog->sourceid != $sourceid) {
            $userlog->sourceid = $sourceid;
        }
        if ($userlog->serviceurl != $serviceurl) {
            $userlog->serviceurl = $serviceurl;
        }
        $userlog->lastaccess = time();
        $DB->update_record('enrol_lti_users', $userlog);
    } else {
        // This data is needed for sending backup outcomes (aka grades).
        $userlog = new stdClass();
        $userlog->userid = $user->id;
        $userlog->toolid = $tool->id;
        $userlog->serviceurl = $serviceurl;
        $userlog->sourceid = $sourceid;
        $userlog->consumerkey = $ltirequest->info['oauth_consumer_key'];
        $userlog->consumersecret = $tool->secret;
        $userlog->lastgrade = 0;
        $userlog->lastaccess = time();
        $userlog->timecreated = time();

        if (!empty($ltirequest->info['ext_ims_lis_memberships_url'])) {
            $userlog->membershipsurl = $ltirequest->info['ext_ims_lis_memberships_url'];
        } else {
            $userlog->membershipsurl = '';
        }

        if (!empty($ltirequest->info['ext_ims_lis_memberships_id'])) {
            $userlog->membershipsid = $ltirequest->info['ext_ims_lis_memberships_id'];
        } else {
            $userlog->membershipsid = '';
        }
        $DB->insert_record('enrol_lti_users', $userlog);
    }

    // Finalise the user log in.
    complete_user_login($user);

    // All done, redirect the user to where they want to go.
    redirect($urltogo);
} else {
    echo $ltirequest->message;
}
