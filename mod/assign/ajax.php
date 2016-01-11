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
 * Process ajax requests
 *
 * @package mod_assign
 * @copyright  2015 Adrian Greeve <adrian@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

require('../../config.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');

$action = optional_param('action', '', PARAM_ALPHANUM);
$assignid = optional_param('id', '', PARAM_ALPHANUM); // Definitely need this.
$rownum = optional_param('rownum', '', PARAM_ALPHANUM);
$userid = optional_param('userid', 0, PARAM_INT);

list ($course, $cm) = get_course_and_cm_from_cmid($assignid, 'assign');
$context = context_module::instance($cm->id);
$assign = new assign($context, $cm, $course);
if ($userid == 0) {
    $userid = null;
}

if ($action == 'getmform') {

    $mform = $assign->do_that_stuff('', $rownum, $userid);
    $jsfooter = $PAGE->requires->get_end_code();
    $output = array($mform, $jsfooter);

    echo json_encode($output);
}
die();
