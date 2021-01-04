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
 * Define the plugin info for grading rules.
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

use core_plugin_manager;

/**
 * Define the plugin info for grading rules.
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class graderule extends base {

    /**
     * Gathers and returns the information about all plugins of the given type
     *
     * @param string $type the name of the plugintype, eg. mod, auth or workshopform
     * @param string $typerootdir full path to the location of the plugin dir
     * @param string $typeclass the name of the actually called class
     * @param core_plugin_manager $pluginman the plugin manager calling this method
     *
     * @return array of plugintype classes, indexed by the plugin name
     */
    public static function get_plugins($type, $typerootdir, $typeclass, $pluginman) {
        global $CFG;

        $contents = parent::get_plugins($type, $typerootdir, $typeclass, $pluginman);

        if (!empty($CFG->graderule_plugins_sortorder)) {
            $order = explode(',', $CFG->graderule_plugins_sortorder);
            $order = array_merge(array_intersect($order, array_keys($contents)),
                array_diff(array_keys($contents), $order));
        } else {
            $order = array_keys($contents);
        }

        $sortedcontents = [];
        foreach ($order as $contentname) {
            $sortedcontents[$contentname] = $contents[$contentname];
        }
        return $sortedcontents;
    }

    /**
     * Retrieves a list of enabled plugins
     *
     * @return array
     */
    public static function get_enabled_plugins() {
        global $CFG;

        $pluginmanager = core_plugin_manager::instance();
        $plugins = $pluginmanager->get_installed_plugins('graderule');

        if (!$plugins) {
            return  [];
        }

        $plugins = array_keys($plugins);
        // Order the plugins.
        if (!empty($CFG->graderule_plugins_sortorder)) {
            $order = explode(',', $CFG->graderule_plugins_sortorder);
            $order = array_merge(array_intersect($order, $plugins),
                array_diff($plugins, $order));
        } else {
            $order = $plugins;
        }

        // Filter to return only enabled plugins.
        $enabled = [];
        foreach ($order as $plugin) {
            $disabled = get_config('graderule_' . $plugin, 'disabled');

            if (empty($disabled)) {
                $enabled[$plugin] = $plugin;
            }
        }

        return $enabled;
    }

    /**
     * Get the name for the settings section.
     *
     * @return string
     */
    public function get_settings_section_name() {
        return 'graderulesetting' . $this->name;
    }

    /**
     * Grade rule plugins can be uninstalled.
     *
     * @return bool
     */
    public function is_uninstall_allowed() {
        return true;
    }

    /**
     * Return URL used for management of plugins of this type.
     * @return \moodle_url
     */
    public static function get_manage_url() {
        return new \moodle_url('/admin/settings.php', array('section' => 'managegraderules'));
    }

    /**
     * Load the global settings for a particular plugin (if there are any)
     *
     * @param \part_of_admin_tree $adminroot
     * @param string $parentnodename
     * @param bool $hassiteconfig
     */
    public function load_settings(\part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig) {
        global $CFG, $USER, $DB, $OUTPUT, $PAGE; // In case settings.php wants to refer to them.

        $ADMIN = $adminroot; // May be used in settings.php.
        $plugininfo = $this; // Also can be used inside settings.php.
        $rule = $this; // Also to be used inside settings.php.

        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (!$hassiteconfig) {
            return;
        }

        $section = $this->get_settings_section_name();

        $settings = null;
        if (file_exists($this->full_path('settings.php'))) {
            $settings = new \admin_settingpage($section, $this->displayname, 'moodle/site:config', $this->is_enabled() === false);
            include($this->full_path('settings.php')); // This may also set $settings to null.
        }
        if ($settings) {
            $ADMIN->add($parentnodename, $settings);
        }
    }
}
