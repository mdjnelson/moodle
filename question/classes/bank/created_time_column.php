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


namespace core_question\bank;

/**
 * A column type for the time created of the question.
 *
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class created_time_column extends column_base {

    public function get_name() {
        return 'createdtime';
    }

    protected function get_title() {
        return get_string('createdon', 'question');
    }

    protected function display_content($question, $rowclasses) {
        echo userdate($question->timecreated);
    }

    public function get_required_fields() {
        return array('q.timecreated');
    }

    public function is_sortable() {
        return array(
            'timecreated' => array('field' => 'q.timecreated', 'title' => get_string('date'))
        );
    }
}
