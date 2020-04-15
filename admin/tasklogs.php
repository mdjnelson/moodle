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
 * Task log.
 *
 * @package    admin
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_admin\form\task_log;

require_once(__DIR__ . '/../config.php');
require_once("{$CFG->libdir}/adminlib.php");
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->libdir}/filelib.php");

$pageurl = new \moodle_url('/admin/tasklogs.php');

$PAGE->set_url($pageurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('tasklogs', 'tool_task');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

admin_externalpage_setup('tasklogs');

$logid = optional_param('logid', null, PARAM_INT);
$download = optional_param('download', false, PARAM_BOOL);

if (null !== $logid) {
    // Raise memory limit in case the log is large.
    raise_memory_limit(MEMORY_HUGE);
    $log = $DB->get_record('task_log', ['id' => $logid], '*', MUST_EXIST);

    if ($download) {
        $filename = str_replace('\\', '_', $log->classname) . "-{$log->id}.log";
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
    }

    readstring_accel($log->output, 'text/plain');
    exit;
}

$renderer = $PAGE->get_renderer('tool_task');

$form = new task_log();

$filter = '';
$filterstatus = null;
$filterminduration = null;

if ($data = $form->get_data()) {
    $filter = $data->text;
    $filterstatus = $data->status;
    $filterminduration = $data->minduration ?: null;
}

echo $OUTPUT->header();

// Output the search form.
$form->display();

// Output any matching logs.
$table = new \core_admin\task_log_table($filter, $filterstatus, $filterminduration);
$table->baseurl = $pageurl;
$table->out(100, false);

echo $OUTPUT->footer();
