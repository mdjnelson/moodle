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
class backup_legacy_logstore_structure_step extends backup_structure_step {

    /**
     * Define the structure for the legacy log store.
     *
     * @return array the logs.
     */
    protected function define_structure() {
        // Define each element separately.
        $logs = new \backup_nested_element('logs');
        $log = new \backup_nested_element('log', array('id'), array('time', 'userid', 'ip', 'module',
            'action', 'url', 'info'));
        // Build the tree.
        $logs->add_child($log);
        if ($this->get_name() == 'course_logs') {
            // Define sources (all the records belonging to the course - cmid equal to 0).
            $log->set_source_table('log', array('course' => \backup::VAR_COURSEID, 'cmid' => \backup_helper::is_sqlparam(0)));
        } else { // Must be an activity.
            // Define sources.
            $log->set_source_table('log', array('cmid' => \backup::VAR_MODID));
        }

        return $logs;
    }
}
