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
 * Basic Disguise administration page.
 *
 * @package    disguise_basic
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');

$contextid = required_param('context', PARAM_INT);
$context = context::instance_by_id($contextid, MUST_EXIST);

if ($context instanceof \context_module) {
    list ($course, $cm) = get_course_and_cm_from_cmid($context->instanceid);
    $PAGE->set_cm($cm);
    $PAGE->set_heading($cm->name);

    $title = get_string('setup_title', 'disguise_basic', $cm->name);
    $PAGE->set_title($title);
}

require_login($course, false);
require_capability('moodle/disguise:configure', $context);

$PAGE->set_disguise_configuration_page();
$PAGE->set_url('/user/disguise/basic/setup.php', array('context' => $contextid));
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');

// Setup the form.
$setupform = new \disguise_basic\setup_form($PAGE->url);

// Attempt to get a link to the parent breadcrumb.
$breadcrumbs = $PAGE->navbar->get_items();
array_pop($breadcrumbs);
do {
    $parent = array_pop($breadcrumbs);
} while (count($breadcrumbs) && is_null($parent->action));

if (is_null($parent->action)) {
    $parent->action = $PAGE->url;
}

// Fetch the current configuration.
$pluginconfig = $context->disguise->get_config();

if ($setupform->is_cancelled()) {
    redirect($parent->action);
} else if ($data = $setupform->get_data()) {
    $context->disguise->set_config('disguiseuseras', $data->disguiseuseras);
    $record = $context->disguise->to_record();
    $DB->update_record('disguises', $record);

    redirect($parent->action, get_string('settingsupdated', 'disguise_basic', $pluginconfig));
}

echo $OUTPUT->header();
echo $OUTPUT->heading($title);
$pluginconfig->context = $contextid;
$setupform->set_data($pluginconfig);
$setupform->display();
echo $OUTPUT->footer();
