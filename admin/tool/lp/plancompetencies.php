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
 * This page lets users to manage plan competencies.
 *
 * @package    tool_lp
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

$planid = required_param('id', PARAM_INT);

require_login(null, false);
if (isguestuser()) {
    throw new require_login_exception('Guests are not allowed here.');
}

$plan = \tool_lp\api::read_plan($planid);

$iscurrentuser = $plan->get_userid() == $USER->id;
$context = context_user::instance($plan->get_userid());

// Check that the user is a valid user.
$user = core_user::get_user($plan->get_userid());
if (!$user || !core_user::is_real_user($plan->get_userid())) {
    throw new moodle_exception('invaliduser', 'error');
}

if (!has_capability('tool/lp:planviewall', $context)) {
    if ($iscurrentuser) {
        require_capability('tool/lp:planviewown', $context);
    } else {
        throw new required_capability_exception($context, 'tool/lp:planviewall', 'nopermissions', '');
    }
}

// Set up the page.
$url = new moodle_url('/admin/tool/lp/plancompetencies.php', array('id' => $plan->get_id()));

$title = get_string('plancompetencies', 'tool_lp');
$PAGE->set_context($context);
$planname = format_text($plan->get_name());
$PAGE->set_url($url);
$PAGE->navbar->add($planname, $url);
$PAGE->set_title($title);
$PAGE->set_heading($planname);

// Display the page.
$output = $PAGE->get_renderer('tool_lp');
echo $output->header();
echo $output->heading($title);
$page = new \tool_lp\output\plan_competencies_page($plan->get_id());
echo $output->render($page);
echo $output->footer();
