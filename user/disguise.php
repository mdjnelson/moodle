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
 * Disguise identity reveal toggler.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');

$contextid  = required_param('context',  PARAM_INT);
$returnto   = required_param('returnto', PARAM_LOCALURL);
$action     = required_param('action',   PARAM_ALPHA);

require_login();
require_sesskey();

$context = context::instance_by_id($contextid);

if ($action === 'reveal') {
    $targetstate = required_param('tostate', PARAM_BOOL);
    if ($context->has_disguise()) {
        $context->disguise->set_show_real_identity_state($targetstate);
    }
}

redirect(new moodle_url($returnto));
