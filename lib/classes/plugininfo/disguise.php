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
 * Defines classes used for plugin info.
 *
 * @package    core
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\plugininfo;

use moodle_url, part_of_admin_tree, admin_settingpage, admin_externalpage;

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin information for the disguise plugintype.
 *
 * @package    core
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguise extends base {
    /**
     * Finds all enabled plugins, the result may include missing plugins.
     *
     * @return array|null of enabled plugins $pluginname=>$pluginname, null means unknown
     */
    public static function get_enabled_plugins() {
        global $DB;

        // Get all available plugins.
        $plugins = \core_plugin_manager::instance()->get_installed_plugins('disguise');
        if (!$plugins) {
            return array();
        }

        // Check they are enabled using get_config (which is cached and hopefully fast).
        $enabled = array();
        foreach ($plugins as $plugin => $version) {
            $disabled = get_config('disguise_' . $plugin, 'disabled');
            if (empty($disabled)) {
                $enabled[$plugin] = $plugin;
            }
        }

        return $enabled;
    }

    /**
     * Whether the current plugin is allowed to be uninstalled.
     *
     * @return bool
     */
    public function is_uninstall_allowed() {
        global $DB;

        return !$DB->record_exists('disguises', ['type' => $this->name]);
    }

    /**
     * Loads plugin settings to the settings tree.
     *
     * This function usually includes settings.php file in plugins folder.
     * Alternatively it can create a link to some settings page (instance of admin_externalpage)
     *
     * @param \part_of_admin_tree $adminroot
     * @param string $parentnodename
     * @param bool $hassiteconfig whether the current user has moodle/site:config capability
     */
    public function load_settings(part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig) {
        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (!$hassiteconfig) {
            return;
        }

        if (file_exists($this->full_path('settings.php'))) {
            $settings = new admin_externalpage(
                    'disguise_' . $this->name,
                    get_string('pluginname', 'disguise_' . $this->name),
                    new moodle_url("/user/disguise/{$this->name}/settings.php"),
                    'moodle/site:config'
                );
            $adminroot->add($parentnodename, $settings);
        }
    }
}
