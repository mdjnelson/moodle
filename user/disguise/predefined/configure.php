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
 * User configuration page for disguise_predefined.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');

$contextid = required_param('id', PARAM_INT);
$context = context::instance_by_id($contextid, MUST_EXIST);

$PAGE->set_disguise_configuration_page();
$PAGE->set_url('/user/disguise/basic/configure.php', array('id' => $contextid));
$PAGE->set_context($context);
if ($context instanceof \context_module) {
    list ($course, $cm) = get_course_and_cm_from_cmid($context->instanceid);
    $PAGE->set_cm($cm);
    $PAGE->set_heading($cm->name);
}

if (has_capability('moodle/disguise:configure', $context)) {
    redirect(instance\manager::get_index_link($context), get_string('nonamesavailable', 'disguise_predefined'));
}

$PAGE->set_title(get_string('header_configure_incomplete', 'disguise_predefined'));

$notification = new \core\output\notification(
        get_string('error_not_configured_by_admin', 'disguise_predefined'),
        \core\output\notification::NOTIFY_ERROR
    );

echo $OUTPUT->header();
echo $OUTPUT->render($notification);
echo $OUTPUT->footer();
