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
 * Produces a sample page using JQuery.
 *
 * @package    core
 * @copyright  20014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(dirname(__FILE__) . '/../../config.php');
// require_once($CFG->dirroot . '/local/mformdemo/templib.php');

require_login();
$context = context_system::instance();
require_capability('moodle/site:config', $context);

$PAGE->set_url('/test.php');
$PAGE->set_context($context);
$PAGE->set_title('ajax test page');
$PAGE->set_heading('Ajax test page');


echo $OUTPUT->header();

// $grapes = new local_mformdemo_temp_thing();
// echo $grapes->create_thing_form();

// $mform = $grapes->create_thing_form();
// $renderer = $PAGE->get_renderer('local_mformdemo');

// echo $renderer->demo_form($mform);

$PAGE->requires->js_call_amd('local_mformdemo/test', 'init', array());


echo $OUTPUT->footer();