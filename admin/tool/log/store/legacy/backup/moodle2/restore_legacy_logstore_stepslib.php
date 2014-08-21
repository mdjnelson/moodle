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
 * Defines the required functions to backup the logs.
 *
 * @package   logstore_legacy
 * @copyright 2014 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_legacy_logstore_structure_step extends restore_structure_step {

    protected function execute_condition() {
        // Check it is included in the backup
        $fullpath = $this->task->get_taskbasepath();
        $fullpath = rtrim($fullpath, '/') . '/' . $this->filename;
        if (!file_exists($fullpath)) {
            // Not found, can't restore course logs
            return false;
        }

        return true;
    }

    protected function define_structure() {
        $paths = array();

        // Simple, one plain level of information contains them
        $paths[] = new restore_path_element('log', '/logs/log');

        return $paths;
    }

    /**
     * Handles restoring given data and inserting it back into the
     *
     * @param $data
     */
    protected function process_log($data) {
        global $DB;

        $data = (object)($data);

        $data->time = $this->apply_date_offset($data->time);
        $data->userid = $this->get_mappingid('user', $data->userid);
        $data->course = $this->get_courseid();
        if (!is_null($this->get_task()->get_moduleid())) {
            $data->cmid = $this->get_task()->get_moduleid();
        } else {
            $data->cmid = 0;
        }

        // User wasn't remapped, stop processing.
        if (empty($data->userid)) {
            return;
        }

        // Set some fixed values to save DB requests.
        if (!is_null($this->get_task()->get_moduleid())) {
            // The logs are the last things we restore, so the course module id should be mapped.
            if (!$newmoduleid = $this->get_mappingid('course_module', $this->task->get_moduleid())) {
                // Can't map to the new module, do nothing.
                return;
            }
            // Get the new module details.
            if (!$newmodule = $DB->get_record('course_modules', array('id' => $newmoduleid))) {
                // The record does not exist in the DB, do nothing.
                return;
            }
            $values = array(
                'course' => $this->get_courseid(),
                'course_module' => $newmodule->id,
                $newmodule->name => $newmodule->instance);
        } else {
            $values = array(
                'course' => $this->get_courseid());
        }

        // Get instance and process log record.
        $data = restore_logs_processor::get_instance($this->task, $values)->process_log_record($data);

        // If we have data, insert it, else something went wrong in the restore_logs_processor
        if ($data) {
            if (empty($data->url)) {
                $data->url = '';
            }
            if (empty($data->info)) {
                $data->info = '';
            }
            // Store the data in the legacy log table.
            $manager = get_log_manager();
            if (method_exists($manager, 'legacy_add_to_log')) {
                $manager->legacy_add_to_log($data->course, $data->module, $data->action, $data->url,
                    $data->info, $data->cmid, $data->userid);
            }
        }
    }
}
