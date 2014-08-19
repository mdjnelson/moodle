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

require_once($CFG->dirroot . '/backup/moodle2/backup_log_task.class.php');
require_once($CFG->dirroot . '/admin/tool/log/store/legacy/backup/moodle2/backup_legacy_logstore_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the legacy logs.
 */
class backup_legacy_logstore_task extends backup_log_task {

    /**
     * Create all the steps that will be part of this task.
     */
    public function define_my_steps() {
        $this->add_step(new backup_legacy_logstore_structure_step($this->get_name(), 'logs.xml'));
    }
}
