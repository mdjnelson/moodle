<?php
// This file is part of the customcert module for Moodle - http://moodle.org/
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
 * Form for filtering the task logs.
 *
 * @package    core
 * @copyright  2020 Mark Nelson <mdjnelson@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_admin\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Form for filtering the task logs.
 *
 * @package    core
 * @copyright  2020 Mark Nelson <mdjnelson@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class task_log extends \moodleform {

    /**
     * Form definition.
     */
    public function definition() {
        global $CFG;

        $mform = $this->_form;

        $mform->addElement('text', 'text', get_string('filter'));
        $mform->setType('text', PARAM_ALPHANUM);

        $statusoptions = [
            -1 => get_string('all'),
            0 => get_string('success'),
            1 => get_string('task_result:failed', 'admin')
        ];
        $mform->addElement('select', 'status', get_string('status'), $statusoptions);
        $mform->setType('status', PARAM_INT);

        $mform->addElement('duration', 'minduration', get_string('task_filter:minduration', 'admin'),
            ['optional' => true, 'defaultunit' => 1]);

        $mform->addElement('submit', 'filterbtn', get_string('filter'));
    }
}
