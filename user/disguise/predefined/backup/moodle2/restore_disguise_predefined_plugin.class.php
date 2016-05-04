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
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/moodle2/backup_disguise_plugin.class.php');

/**
 * Predefined disguise backup class.
 *
 * @package    disguise_predefined
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_disguise_predefined_plugin extends restore_disguise_plugin {

    /**
     * Returns the paths to be handled by the plugin.
     */
    protected function define_restore() {
        $paths = array();
        $paths[] = new restore_path_element('name', $this->get_pathfor('/names/name'));

        return $paths;
    }

    /**
     * Process the name element.
     *
     * @param array|object $data disguise object.
     */
    public function process_name($data) {
        global $DB;

        $data = (object) $data;

        $name = new stdClass();
        $name->name = $data->name;
        $name->enabled = $data->enabled;
        $name->disguiseid = $this->disguiseid;
        $nameid = $DB->insert_record('disguise_predefined_names', $name);

        // Now assign the users.
        if (!is_null($data->userid)) {
            $mapping = new stdClass();
            $mapping->userid = $this->get_mappingid('user', $data->userid);
            $mapping->nameid = $nameid;

            $DB->insert_record('disguise_predefined_mappings', $mapping);
        }
    }
}
