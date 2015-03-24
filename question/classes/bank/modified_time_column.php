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
 * A column type for the time modified of the question.
 *
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class modified_time_column extends column_base {

    public function get_name() {
        return 'modifiedtime';
    }

    protected function get_title() {
        return get_string('lastmodifiedon', 'question');
    }

    protected function display_content($question, $rowclasses) {
        echo userdate($question->timemodified);
    }

    public function get_required_fields() {
        return array('q.timemodified');
    }

    public function is_sortable() {
        return array(
            'timemodified' => array('field' => 'q.timemodified', 'title' => get_string('date'))
        );
    }
}
