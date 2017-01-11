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
 * Contains the calendar events factory class.
 *
 * @package core_calendar
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar;

require_once($CFG->dirroot . '/calendar/lib.php');

/**
 * The calendar events factory class.
 *
 * @package core_calendar
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_factory {

    /**
     * Returns an instance of the event type.
     *
     * @param string $type the calendar event type to use, if none provided use logic to determine
     * @param \stdClass $data The data used to create this event.
     * @return \core_calendar\event
     * @throws \coding_exception if the calendar type does not exist
     */
    public static function get_event_instance($type, $data) {
        if ($type === CALENDAR_EVENT_TYPE_STANDARD) {
            $class = 'event';
        } else { // Must be an action event.
            $class = 'action_event';
        }

        $class = "\\core_calendar\\$class";

        if (!class_exists($class)) {
            throw new \coding_exception("The class '$class' does not exist.");
        }

        return new $class($data);
    }
}
