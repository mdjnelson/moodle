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
 * Defines backup_disguise_plugin class
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
abstract class backup_disguise_plugin extends backup_plugin {
    /**
     * Perform a backup of a module.
     *
     * @return  \backup_nested_element  The backup structure.
     */
    public function define_module_plugin_structure() {
        // Check whether the plugin is enabled.
        $enabledplugins = \core\plugininfo\disguise::get_enabled_plugins();
        if (!array_key_exists($this->pluginname, $enabledplugins)) {
            return;
        }

        $contextid = $this->task->get_contextid();
        $context = \context::instance_by_id($contextid);

        if (!$context->disguise) {
            // No disguise at this context.
            return;
        }

        return $this->backup_disguise($context);
    }

    /**
     * Produce the backup structure for the disguise at the specified context.
     *
     * @param   \context    $context    The context being backed up.
     * @return  \backup_nested_element  The backup structure.
     */
    protected function backup_disguise(\context $context) {
        $plugin = $this->get_plugin_element();

        // Connect our visible container to the parent.
        $plugin->add_child($this->define_disguise_backup($context));

        return $plugin;
    }

    /**
     * Perform the disguise-plugin-specific backup.
     *
     * @param   \context    $context    The context being backed up.
     * @return  \backup_nested_element  The backup structure.
     */
    protected function define_disguise_backup(\context $context) {
        // Create a visible container for our data.
        $pluginwrapper = new backup_nested_element('disguise');

        // Define our elements.
        $disguise = new backup_nested_element('configuration', null, [
            'type',
            'lockdisguise',
            'showrealidentity',
            'disabledisguisefrom',
            'loganonymously',
            'usegradebook',
            'mode',
            'configdata',
        ]);

        // Build elements hierarchy.
        $pluginwrapper->add_child($disguise);

        $disguise->set_source_table('disguises', ['id' => ['sqlparam' => $context->disguiseid]]);

        return $pluginwrapper;
    }
}
