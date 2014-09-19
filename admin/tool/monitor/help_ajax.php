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
 * Displays help via AJAX call
 *
 * @copyright 2013 onwards Andrew Nicols
 * @package   core
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);
define('AJAX_SCRIPT', true);

require_once('../../../config.php');

$type = required_param('type', PARAM_ALPHA);
$id = required_param('id', PARAM_INT);
$lang = optional_param('lang', 'en', PARAM_LANG);

// We don't actually modify the session here as we have NO_MOODLE_COOKIES set.
$SESSION->lang = $lang;
$PAGE->set_url('/admin/tool/monitor/help_ajax.php');
$PAGE->set_context(context_system::instance());

// Get the help text.
if ($type == 'rule') {
    $rule = $DB->get_record('tool_monitor_rules', array('id' => $id), '*', MUST_EXIST);
    $data = get_formatted_help_string('rulehelp', 'tool_monitor', true, $rule);
} else { // Must be a subscription.
    $subscription = $DB->get_record('tool_monitor_subscriptions', array('id' => $id), '*', MUST_EXIST);
    $data = get_formatted_help_string('subhelp', 'tool_monitor', true, $subscription);
}

echo json_encode($data);
