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
 */
trait backup {

    /**
     * @var string $itembackup defines the type of logs we are backing up (if any) (eg. activity, course).
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

    }

    public function restore_activity_logs($step) {

    }
}
