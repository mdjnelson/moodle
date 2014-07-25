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
 * Backup/restore helper trait.
 *
 * @package    tool_log
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_log\helper;

defined('MOODLE_INTERNAL') || die();

/**
 * Backup/restore helper trait.
 *
 * The \tool_log\log\store and \core\log\backup must be included before using this trait.
 *
 * @package    tool_log
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @property string $component Frankenstyle plugin name initialised in store trait.
 */
trait backup {

    /**
     * @var string $itembackup defines the type of logs we are backing up (or restoring) (if any) (eg. activity, course).
     */
    private $itembackup;

    public function backup_course_logs($step) {
        if (!$step instanceof \backup_logs_structure_step) {
            throw new \backup_step_exception('incorrect_step_type_passed_to_store');
        }

        // Set what we are backing up.
        $this->itembackup = LOG_STORE_COURSE_LOGS;
        $return = $step->execute_common_behaviour();
        $this->itembackup = null;

        return $return;
    }

    public function backup_activity_logs($step) {
        if (!$step instanceof \backup_logs_structure_step) {
            throw new \backup_step_exception('incorrect_step_type_passed_to_store');
        }

        // Set what we are backing up.
        $this->itembackup = LOG_STORE_ACTIVITY_LOGS;
        $return = $step->execute_common_behaviour();
        $this->itembackup = null;

        return $return;
    }

    public function restore_course_logs($step) {
        if (!$step instanceof \restore_logs_structure_step) {
            throw new \restore_step_exception('incorrect_step_type_passed_to_store');
        }

        // Set what we are restoring.
        $this->itembackup = LOG_STORE_COURSE_LOGS;
        $return = $step->execute_common_behaviour();
        $this->itembackup = null;

        return $return;
    }

    public function restore_activity_logs($step) {
        if (!$step instanceof \restore_logs_structure_step) {
            throw new \restore_step_exception('incorrect_step_type_passed_to_store');
        }

        // Set what we are restoring.
        $this->itembackup = LOG_STORE_ACTIVITY_LOGS;
        $return = $step->execute_common_behaviour();
        $this->itembackup = null;

        return $return;
    }

    /**
     * Checks to see if this restore step should be executed.
     *
     * The function behaves the same as execute_condition() defined by the restore process in core.
     *
     * @see \restore_structure_step::execute_condition()
     * @param \restore_logs_structure_step $step
     * @return bool returns true if safe to execute, otherwise false
     */
    public function restore_execute_condition($step) {
        // Check it is included in the backup.
        $fullpath = $step->get_task()->get_taskbasepath();
        $fullpath = rtrim($fullpath, '/') . '/' . $step->get_filename();
        if (!file_exists($fullpath)) {
            // Not found, can't restore course logs.
            return false;
        }

        return true;
    }

    /**
     * Returns the structure to be processed by the \restore_step.
     *
     * The function behaves the same as define_structure() defined by the restore process in core.
     *
     * @see \restore_structure_step::define_structure
     * @return \restore_path_element[] list of restore path elements
     */
    public function restore_define_structure() {
        $paths = array();

        // Simple, one plain level of information contains them.
        $paths[] = new \restore_path_element('log', '/' . $this->component . '_logs/log');

        return $paths;
    }
}
