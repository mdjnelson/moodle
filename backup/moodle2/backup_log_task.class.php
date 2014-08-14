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
 * The backup_log_task abstract class.
 *
 * @package     core_backup
 * @copyright   2014 Mark Nelson <markn@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Handles the basic functionality for log stores that support backup.
 */
abstract class backup_log_task extends backup_task {

    /**
     * @var int|null $moduleid The course module id if we are backing up an activity, null otherwise.
     */
    protected $moduleid = null;

    /**
     * @var string $taskpath The task base path - location that the tasks writes it's files.
     */
    protected $taskpath;

    /**
     * Constructor - instantiates one object of this class
     *
     * @param string $name the task identifier
     * @param int|null $moduleid the course module id if we are backing up the logs
     *  for an activity, null otherwise
     * @param backup_plan|null $plan the backup plan instance this task is part of
     * @throws backup_task_exception
     */
    public function __construct($name, $moduleid = null, $plan = null) {
        // If we are passed a moduleid, check that it exists.
        if (!is_null($moduleid)) {
            if (!$coursemodule = get_coursemodule_from_id(false, $moduleid)) {
                throw new backup_task_exception('activity_task_coursemodule_not_found', $moduleid);
            }
            $this->moduleid = $moduleid;
            $this->taskpath = '/activities/' . $coursemodule->modname . '_' . $moduleid;
        } else { // Must be backing up a course.
            $this->taskpath = '/course';
        }

        parent::__construct($name, $plan);
    }

    /**
     * Returns the location that this task writes it's files.
     *
     * @return string full path to the directory where this task writes its files
     */
    public function get_taskbasepath() {
        return $this->get_basepath() . $this->taskpath;
    }

    /**
     * Create all the steps that will be part of this task.
     */
    public function build() {
        // If we are not including logs in the backup then there is nothing to do.
        if (!$this->get_setting_value('logs')) {
            $this->built = true;
            return;
        }

        if (!is_null($this->moduleid)) {
            $this->add_setting(new backup_generic_setting(backup::VAR_MODID, base_setting::IS_INTEGER, $this->moduleid));
        }
        $this->add_setting(new backup_generic_setting(backup::VAR_COURSEID, base_setting::IS_INTEGER, $this->get_courseid()));

        // Here we add all the steps for the log store.
        $this->define_my_steps();

        // At the end, mark it as built.
        $this->built = true;
    }

    /**
     * Defines activity specific steps for this task
     *
     * This method is called from {@link self::build()}. Activities are supposed
     * to call {self::add_step()} in it to include their specific steps in the
     * backup plan.
     */
    abstract protected function define_my_steps();

    /**
     * Defines the common backup settings for log stores - override if needed.
     */
    protected function define_settings() {
        // No settings needed.
    }
}
