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
     * Retrieves a list of enabled plugins
     *
     * @return array
     */
    public static function get_enabled_plugins() {

        $pluginmanager = core_plugin_manager::instance();
        $plugins = $pluginmanager->get_installed_plugins('graderule');
        $enabled = [];

        foreach ($plugins as $plugin => $version) {

            $plugininfo = $pluginmanager->get_plugin_info('graderule_' . $plugin);

            if (!empty($plugininfo)) {

                $status = $plugininfo->get_status();

                if ($status !== core_plugin_manager::PLUGIN_STATUS_MISSING) {

                    $enabled[$plugin] = $version;
                }
            }
        }

        return $enabled;
    }

    /**
     * Grade rule plugins can be uninstalled.
     *
     * @return bool
     */
    public function is_uninstall_allowed() {
        return true;
    }
}
