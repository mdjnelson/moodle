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
 * Defines backup_legacy_logstore_task class
 *
 * @package     logstore_legacy
 * @category    backup
 * @copyright   2014 Mark Nelson <markn@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/moodle2/restore_log_task.class.php');
require_once($CFG->dirroot . '/admin/tool/log/store/legacy/backup/moodle2/restore_legacy_logstore_stepslib.php');

/**
 * Provides the steps to perform one complete restore of the legacy logs.
 */
class restore_legacy_logstore_task extends restore_log_task {

    /**
     * Create all the steps that will be part of this task.
     */
    public function define_my_steps() {
        $this->add_step(new restore_legacy_logstore_structure_step($this->get_name(), 'logs.xml'));
    }

    /**
     * Define the restore log rules that will be applied by the {@link restore_logs_processor} when restoring
     * course logs.
     *
     * @return restore_log_rule[] the list of rules.
     */
    static public function define_restore_log_rules() {
        $rules = array();

        // Module 'course' rules
        $rules[] = new restore_log_rule('course', 'view', 'view.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'guest', 'view.php?id={course}', null);
        $rules[] = new restore_log_rule('course', 'user report', 'user.php?id={course}&user={user}&mode=[mode]', null);
        $rules[] = new restore_log_rule('course', 'add mod', '../mod/[modname]/view.php?id={course_module}', '[modname] {[modname]}');
        $rules[] = new restore_log_rule('course', 'update mod', '../mod/[modname]/view.php?id={course_module}', '[modname] {[modname]}');
        $rules[] = new restore_log_rule('course', 'delete mod', 'view.php?id={course}', null);
        $rules[] = new restore_log_rule('course', 'update', 'view.php?id={course}', '');
        $rules[] = new restore_log_rule('course', 'enrol', 'view.php?id={course}', '{user}');
        $rules[] = new restore_log_rule('course', 'unenrol', 'view.php?id={course}', '{user}');
        $rules[] = new restore_log_rule('course', 'editsection', 'editsection.php?id={course_section}', null);
        $rules[] = new restore_log_rule('course', 'new', 'view.php?id={course}', '');
        $rules[] = new restore_log_rule('course', 'recent', 'recent.php?id={course}', '');
        $rules[] = new restore_log_rule('course', 'report log', 'report/log/index.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'report live', 'report/live/index.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'report outline', 'report/outline/index.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'report participation', 'report/participation/index.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'report stats', 'report/stats/index.php?id={course}', '{course}');
        $rules[] = new restore_log_rule('course', 'view section', 'view.php?id={course}&sectionid={course_section}', '{course_section}');

        // Module 'grade' rules.
        $rules[] = new restore_log_rule('grade', 'update', 'report/grader/index.php?id={course}', null);

        // Module 'user' rules.
        $rules[] = new restore_log_rule('user', 'view', 'view.php?id={user}&course={course}', '{user}');
        $rules[] = new restore_log_rule('user', 'change password', 'view.php?id={user}&course={course}', '{user}');
        $rules[] = new restore_log_rule('user', 'login', 'view.php?id={user}&course={course}', '{user}');
        $rules[] = new restore_log_rule('user', 'logout', 'view.php?id={user}&course={course}', '{user}');
        $rules[] = new restore_log_rule('user', 'view all', 'index.php?id={course}', '');
        $rules[] = new restore_log_rule('user', 'update', 'view.php?id={user}&course={course}', '');

        // Rules from other tasks (activities) not belonging to one module instance (cmid = 0), so are restored here.
        $rules = array_merge($rules, restore_logs_processor::register_log_rules_for_course());

        // Calendar rules.
        $rules[] = new restore_log_rule('calendar', 'add', 'event.php?action=edit&id={event}', '[name]');
        $rules[] = new restore_log_rule('calendar', 'edit', 'event.php?action=edit&id={event}', '[name]');
        $rules[] = new restore_log_rule('calendar', 'edit all', 'event.php?action=edit&id={event}', '[name]');

        return $rules;
    }
}
