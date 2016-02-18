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
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Process updates from the inplace editables on the setup page.
 *
 * @param string    $itemtype   The type of update
 * @param int       $itemid     The value being updated
 * @param mixed     $newvalue   The new value
 * @return renderable           The rendered HTML of the inplace_editable
 */
function disguise_predefined_inplace_editable($itemtype, $itemid, $newvalue) {
    require_login();

    if (strpos($itemtype, 'settings/') === 0) {
        if ($itemtype === 'settings/sets_name') {
            return \disguise_predefined\settings\helper::update_sets_name($itemid, $newvalue);
        } else if ($itemtype === 'settings/sets_format') {
            return \disguise_predefined\settings\helper::update_sets_format($itemid, $newvalue);
        } else if ($itemtype === 'settings/name') {
            return \disguise_predefined\settings\helper::update_name($itemid, $newvalue);
        } else if ($itemtype === 'settings/available') {
            return \disguise_predefined\settings\helper::update_availability($itemid, $newvalue);
        }
    } else if (strpos($itemtype, 'instance/') === 0) {
        list (, $contextid, $type) = explode('/', $itemtype);
        $context = \context::instance_by_id($contextid);

        if ($type === 'name') {
            return \disguise_predefined\instance\helper::update_name($context, $itemid, $newvalue);
        } else if ($type === 'enabled') {
            return \disguise_predefined\instance\helper::set_name_enabled($context, $itemid, $newvalue);
        }
    }
}
