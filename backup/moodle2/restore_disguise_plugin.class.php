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
 * Defines restore_disguise_plugin class
 *
 * @package    core_backup
 * @subpackage moodle2
 * @category   backup
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class extending standard backup_plugin in order to implement some helper methods related with the disguise plugins.
 */
abstract class restore_disguise_plugin extends restore_plugin {

    /**
     * The id of the restored disguise.
     */
    protected $disguiseid = '';

    /**
     * Perform a restore of a module.
     *
     * @return  \backup_nested_element  The backup structure.
     */
    public function define_module_plugin_structure() {
        // Check whether the plugin is enabled.
        $enabledplugins = \core\plugininfo\disguise::get_enabled_plugins();
        if (!array_key_exists($this->pluginname, $enabledplugins)) {
            return;
        }

        $paths = array();
        $paths[] = new restore_path_element('disguise', $this->get_pathfor('/disguise'));

        return array_merge($paths, $this->define_restore());
    }

    /**
     * Perform the restore.
     *
     * This defines the 'disguise' restore path. It is up to the diguise types
     * to define any other paths they might have.
     *
     * @return  \restore_path_element[]  The restore structure.
     */
    abstract protected function define_restore();

    /**
     * Process the disguise element.
     *
     * @param array|object $data disguise object.
     */
    public function process_disguise($data) {
        $contextid = $this->task->get_contextid();
        $context = \context::instance_by_id($contextid);
        $disguise = \core\disguise\helper::create($context, $data);

        // Set the disguise variable.
        $this->disguiseid = $disguise->get_id();
    }
}
