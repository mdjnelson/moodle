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
 * Log backup/restore interface.
 *
 * @package    core
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\log;

defined('MOODLE_INTERNAL') || die();

define('LOG_STORE_COURSE_LOGS', 'course');
define('LOG_STORE_ACTIVITY_LOGS', 'activity');

interface backup {

    /**
     * Execute a backup of the course logs.
     *
     * @param \backup_course_logs_structure_step $step
     * @return array the results
     */
    public function backup_course_logs($step);

    /**
     * Execute a backup of the activity logs.
     *
     * @param \backup_activity_logs_structure_step $step
     * @return array the results
     */
    public function backup_activity_logs($step);

    /**
     * Execute a restore of the course logs.
     *
     * @param \restore_course_logs_structure_step $step
     * @return array the results
     */
    public function restore_course_logs($step);

    /**
     * Execute a restore of the activity logs.
     *
     * @param \restore_activity_logs_structure_step $step
     * @return array the results
     */
    public function restore_activity_logs($step);
}
