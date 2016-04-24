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
 * Basic Disguise.
 *
 * @package    disguise_predefined
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/moodle2/backup_disguise_plugin.class.php');

/**
 * Basic Disguise.
 *
 * @package    disguise_predefined
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_disguise_predefined_plugin extends backup_disguise_plugin {
    /**
     * Perform the disguise-plugin-specific backup.
     *
     * @param   \context    $context    The context being backed up.
     * @return  \backup_nested_element  The backup structure.
     */
    protected function define_disguise_backup(\context $context) {
        $pluginwrapper = parent::define_disguise_backup($context);

        // Define our elements.
        $namewrapper = new backup_nested_element('names');
        $pluginwrapper->add_child($namewrapper);

        $names = new backup_nested_element('name', null, [
            'name',
            'enabled',
            'userid',
        ]);

        // Build elements hierarchy.
        $namewrapper->add_child($names);
        //$names->set_source_table('disguise_predefined_names', ['disguiseid' => ['sqlparam' => $context->disguiseid]]);

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

        $names->set_source_sql($sql, ['disguiseid' => ['sqlparam' => $context->disguiseid]]);

        return $pluginwrapper;
    }
}
