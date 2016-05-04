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
 * Predefined disguise backup.
 *
 * @package    disguise_predefined
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/moodle2/backup_disguise_plugin.class.php');

/**
 * Predefined disguise backup class.
 *
 * @package    disguise_predefined
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_disguise_predefined_plugin extends backup_disguise_plugin {

    /**
     * Perform the predefined disguise type specific backup.
     *
     * @return  \backup_nested_element  The backup structure.
     */
    protected function define_backup() {
        // Define our elements.
        $names = new backup_nested_element('names');
        $name = new backup_nested_element('name', null, [
            'name',
            'enabled',
            'userid',
        ]);
        $names->add_child($name);

        $contextid = $this->task->get_contextid();
        $context = \context::instance_by_id($contextid);

        if ($this->get_setting_value('users')) {
            $sql = '
                    SELECT n.name, n.enabled, m.userid
                    FROM {disguise_predefined_names} n
            LEFT JOIN {disguise_predefined_mappings} m ON m.nameid = n.id
                    WHERE n.disguiseid = ?
                ';
        } else {
            $sql = '
                    SELECT n.name, n.enabled, null AS userid
                    FROM {disguise_predefined_names} n
                    WHERE n.disguiseid = ?
                ';
        }
        $name->set_source_sql($sql, ['disguiseid' => ['sqlparam' => $context->disguiseid]]);

        return $names;
    }
}
