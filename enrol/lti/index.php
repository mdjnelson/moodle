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
 * List the tool provided in a course
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot.'/enrol/lti/locallib.php');
require_once($CFG->dirroot.'/enrol/lti/lib.php');

$courseid = required_param('courseid', PARAM_INT);
$action = optional_param('action', '', PARAM_ALPHA);
if ($action) {
    $instanceid = required_param('instanceid', PARAM_INT);
    $instance = $DB->get_record('enrol', array('id' => $instanceid), '*', MUST_EXIST);
}
$confirm = optional_param('confirm', 0, PARAM_INT);

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

$context = context_course::instance($course->id);

require_login($course);
require_capability('moodle/course:enrolreview', $context);

$ltiplugin = enrol_get_plugin('lti');
$ltienabled = enrol_is_enabled('lti');

$canconfig = has_capability('moodle/course:enrolconfig', $context);

$PAGE->set_url('/enrol/lti/index.php', array('courseid' => $courseid));
$PAGE->set_title(get_string('course') . ': ' . $course->fullname);
$PAGE->set_pagelayout('admin');

// Check if we want to perform any actions.
if ($action) {
    if ($action === 'delete') {
        if ($ltiplugin->can_delete_instance($instance)) {
            if ($confirm) {
                $ltiplugin->delete_instance($instance);
                redirect($PAGE->url);
            }

            $yesurl = new moodle_url('/enrol/lti/index.php',
                array('courseid' => $course->id,
                    'action' => 'delete',
                    'instanceid' => $instance->id,
                    'confirm' => 1,
                    'sesskey' => sesskey())
                );
            $displayname = $ltiplugin->get_instance_name($instance);
            $users = $DB->count_records('user_enrolments', array('enrolid' => $instance->id));
            if ($users) {
                $message = markdown_to_html(get_string('deleteinstanceconfirm', 'enrol',
                    array('name' => $displayname,
                          'users' => $users)));
            } else {
                $message = markdown_to_html(get_string('deleteinstancenousersconfirm', 'enrol',
                    array('name' => $displayname)));
            }
            echo $OUTPUT->header();
            echo $OUTPUT->confirm($message, $yesurl, $PAGE->url);
            echo $OUTPUT->footer();
            die();
        }
    } else if ($action === 'disable') {
        if ($ltiplugin->can_hide_show_instance($instance)) {
            if ($instance->status != ENROL_INSTANCE_DISABLED) {
                $ltiplugin->update_status($instance, ENROL_INSTANCE_DISABLED);
                redirect($PAGE->url);
            }
        }
    } else if ($action === 'enable') {
        if ($ltiplugin->can_hide_show_instance($instance)) {
            if ($instance->status != ENROL_INSTANCE_ENABLED) {
                $ltiplugin->update_status($instance, ENROL_INSTANCE_ENABLED);
                redirect($PAGE->url);
            }
        }
    }
}

if ($tools = enrol_lti_get_lti_tools(array('courseid' => $course->id))) {
    // Strings that are used.
    $strup = get_string('up');
    $strdown = get_string('down');
    $strdelete = get_string('delete');
    $strenable = get_string('enable');
    $strdisable = get_string('disable');
    $strmanage = get_string('manageinstance', 'enrol');

    $data = array();
    $url = new moodle_url('/enrol/lti/index.php', array('sesskey' => sesskey(), 'courseid' => $course->id));
    foreach ($tools as $tool) {
        $instance = new stdClass();
        $instance->id = $tool->enrolid;
        $instance->courseid = $course->id;
        $instance->enrol = 'lti';
        $instance->status = $tool->status;

        // Set the values we will be adding to this row.
        if (empty($tool->name)) {
            $toolcontext = context::instance_by_id($tool->contextid);
            $name = $toolcontext->get_context_name();
        } else {
            $name = $tool->name;
        }
        $toolurl = new moodle_url('/enrol/lti/tool.php', array('id' => $tool->id));
        $secret = $tool->secret;

        // Start creating the row.
        $line = array();
        if ($canconfig) {
            $buttons = array();

            if ($ltiplugin->can_delete_instance($instance)) {
                $aurl = new moodle_url($url, array('action' => 'delete', 'instanceid' => $instance->id));
                $buttons[] = $OUTPUT->action_icon($aurl, new pix_icon('t/delete', $strdelete, 'core',
                    array('class' => 'iconsmall')));
            }

            if ($ltienabled && $ltiplugin->can_hide_show_instance($instance)) {
                if ($instance->status == ENROL_INSTANCE_ENABLED) {
                    $aurl = new moodle_url($url, array('action' => 'disable', 'instanceid' => $instance->id));
                    $buttons[] = $OUTPUT->action_icon($aurl, new pix_icon('t/hide', $strdisable, 'core',
                        array('class' => 'iconsmall')));
                } else if ($instance->status == ENROL_INSTANCE_DISABLED) {
                    $aurl = new moodle_url($url, array('action' => 'enable', 'instanceid' => $instance->id));
                    $buttons[] = $OUTPUT->action_icon($aurl, new pix_icon('t/show', $strenable, 'core',
                        array('class' => 'iconsmall')));
                }
            }

            if ($ltienabled && $canconfig) {
                $linkparams = array(
                    'courseid' => $instance->courseid,
                    'id' => $instance->id, 'type' => $instance->enrol,
                    'returnurl' => new moodle_url('/enrol/lti/index.php', array('courseid' => $course->id))
                );
                $editlink = new moodle_url("/enrol/editinstance.php", $linkparams);
                $buttons[] = $OUTPUT->action_icon($editlink, new pix_icon('t/edit', get_string('edit'), 'core',
                    array('class' => 'iconsmall')));
            }

            // We want to dim the following items if they are not enabled.
            if ($instance->status != ENROL_INSTANCE_ENABLED) {
                $line[] = html_writer::tag('span', $name, array('class' => 'dimmed_text'));
                $line[] = html_writer::tag('span', $toolurl, array('class' => 'dimmed_text'));
                $line[] = html_writer::tag('span', $secret, array('class' => 'dimmed_text'));
            } else {
                $line[] = $name;
                $line[] = $toolurl;
                $line[] = $secret;
            }
            $line[] = implode(' ', $buttons);
        } else {
            $line[] = '';
        }
        $data[] = $line;
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('toolsprovided', 'enrol_lti'));

if (!empty($data)) {
    $table = new html_table();
    $table->head = array(
        get_string('name'),
        get_string('url'),
        get_string('secret', 'enrol_lti'),
        get_string('edit'));
    $table->size = array('20%', '20%', '50%', '10%');
    $table->align = array('left', 'left', 'left', 'center');
    $table->data = $data;
    echo html_writer::table($table);
} else {
    $notify = new \core\output\notification(get_string('notoolsprovided', 'enrol_lti'),
        \core\output\notification::NOTIFY_WARNING);
    echo $OUTPUT->render($notify);
}

if ($ltiplugin->can_add_instance($course->id)) {
    echo $OUTPUT->single_button(new moodle_url('/enrol/editinstance.php',
        array(
            'type' => 'lti',
            'courseid' => $course->id,
            'returnurl' => new moodle_url('/enrol/lti/index.php', array('courseid' => $course->id)))
        ),
        get_string('add'));
}

echo $OUTPUT->footer();
