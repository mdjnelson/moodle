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
 * This file returns an array of available public keys
 *
 * @package    mod_lti
 * @copyright  2018 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

$scope = required_param('scope', PARAM_TEXT);
$responsetype = required_param('response_type', PARAM_TEXT);
$clientid = required_param('client_id', PARAM_TEXT);
$redirecturi = required_param('redirect_uri', PARAM_TEXT);
$loginhint = required_param('login_hint', PARAM_TEXT);
$nonce = required_param('nonce', PARAM_TEXT);
$state = optional_param('state', '', PARAM_TEXT);
$responsemode = optional_param('response_mode', '', PARAM_TEXT);
$prompt = optional_param('prompt', '', PARAM_TEXT);

if (empty($SESSION->lti_message_hint)) {
    throw new moodle_exception('invalid_request');
}

if ($scope !== 'openid') {
    throw new moodle_exception('invalid_scope');
}

if ($responsetype !== 'id_token') {
    throw new moodle_exception('unsupported_response_type');
}

list($courseid, $typeid, $id, $titleb64, $textb64, $targeturib64) = explode(',', $SESSION->lti_message_hint, 6);
$config = lti_get_type_type_config($typeid);

if ($clientid !== $config->lti_clientid) {
    throw new moodle_exception('unauthorized_client');
}

if ($loginhint !== $USER->id) {
    throw new moodle_exception('access_denied');
}

$uris = array_map("trim", explode("\n", $config->lti_redirectionuris));

if (!in_array($redirecturi, $uris)) {
    throw new moodle_exception('invalid_request');
}

if (!empty($responsemode)) {
    if ($responsemode !== 'form_post') {
        throw new moodle_exception('invalid_request');
    }
} else {
    $responsemode = 'query';
}

if (!empty($prompt) && $prompt !== 'none') {
    throw new moodle_exception('invalid_request');
}

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
if ($id) {
    $cm = get_coursemodule_from_id('lti', $id, 0, false, MUST_EXIST);
    $context = context_module::instance($cm->id);

    require_login($course, true, $cm);
    require_capability('mod/lti:view', $context);

    $lti = $DB->get_record('lti', array('id' => $cm->instance), '*', MUST_EXIST);
    list($endpoint, $params) = lti_get_launch_data($lti, $nonce);
} else {
    require_login($course);

    $context = context_course::instance($courseid);
    require_capability('moodle/course:manageactivities', $context);
    require_capability('mod/lti:addcoursetool', $context);

    // Set the return URL. We send the launch container along to help us avoid frames-within-frames when the user returns.
    $returnurlparams = [
        'course' => $courseid,
        'id' => $typeid,
        'sesskey' => sesskey()
    ];

    $returnurl = new \moodle_url('/mod/lti/contentitem_return.php', $returnurlparams);

    // Prepare the request.
    $title = base64_decode($titleb64);
    $text = base64_decode($textb64);
    $targeturi = base64_decode($targeturib64);
    $request = lti_build_content_item_selection_request($typeid, $course, $returnurl, $title, $text, $targeturi, [], [], false, false, false, false, false, $nonce);
    $endpoint = $request->url;
    $params = $request->params;
}

if (!empty($state)) {
    $params['state'] = $state;
}

if ($responsemode !== 'query') {
    $r = "<form action='" . $redirecturi . "' name='ltiAuthForm' id='ltiAuthForm' " .
        " method=\"post\" enctype=\"application/x-www-form-urlencoded\">\n";
    if (!empty($params)) {
        foreach ($params as $key => $value) {
            $key = htmlspecialchars($key);
            $value = htmlspecialchars($value);
            $r .= "  <input type=\"hidden\" name=\"{$key}\" value=\"{$value}\"/>\n";
        }
    }
    $r .= "</form>\n";
    $r .= "<script type=\"text/javascript\">\n" .
        "//<![CDATA[\n" .
        "document.ltiAuthForm.submit();\n" .
        "//]]>\n" .
        "</script>\n";
    echo $r;
} else {
    $url = new \moodle_url($redirecturi, $params);
    redirect($url->out(false));
}
