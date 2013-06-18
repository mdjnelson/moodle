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
 * Defines functions used by calendar system plugins.
 *
 * This library provides a unified interface for calendar stystems.
 *
 * @package core_calendar
 * @author Shamim Rezaie <support@foodle.org>
 * @author Mark Nelson <markn@moodle.com>
 * @copyright 2008 onwards Foodle Group {@link http://foodle.org}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class calendar_systems_plugin_base {

    /**
     * Returns a list of all the possible days for all months.
     *
     * This is used to generate the select box for the days
     * in the date selector elements. Some months contain more days
     * than others so this function should return all possible days as
     * we can not predict what month will be chosen (the user
     * may have JS turned off and we need to support this situation in
     * Moodle).
     *
     * @return array the days
     */
    public abstract function get_days();

    /**
     * Returns a list of all the names of the months.
     *
     * @return array the month names
     */
    public abstract function get_months();

    /**
     * Returns the minimum year of the calendar.
     *
     * @return int the minumum year
     */
    public abstract function get_min_year();

    /**
     * Returns the maximum year of the calendar.
     *
     * @return int the max year
     */
    public abstract function get_max_year();

    /**
     * Provided with a day, month, year, hour and minute in a specific
     * calendar system convert it into the equivalent Gregorian date.
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $hour
     * @param int $minute
     * @return array the converted day, month and year.
     */
    public abstract function convert_to_gregorian($day, $month, $year, $hour = 0, $minute = 0);
}

/**
 * Class calendar_systems_plugin_factory.
 *
 * Factory class producing required subclasses of {@link calendar_systems_plugin_base}.
 */
class calendar_systems_plugin_factory {

    /**
     * Returns an instance of the currently used calendar system.
     *
     * @return calendar_systems_plugin_* the created calendar_system class
     * @throws coding_exception if the calendar system file could not be loaded
     */
    static function factory() {
        global $CFG;

        $system = self::get_calendar_system();
        $file = 'calendar/systems/' . $system . '/lib.php';
        $fullpath = $CFG->dirroot . '/' . $file;
        if (is_readable($fullpath)) {
            require_once($fullpath);
            $class = "calendar_systems_plugin_$system";
            return new $class();
        } else {
            throw new coding_exception("The calendar system file $file could not be initialised, check that it exists
                and that the web server has permission to read it.");
        }
    }

    /**
     * Returns a list of calendar systems available for use.
     *
     * @return array the list of calendar systems
     */
    static function get_list_of_calendar_systems() {
        $calendars = array();
        $calendardirs = get_plugin_list('calendarsystem');

        foreach ($calendardirs as $name => $location) {
            $calendars[$name] = get_string('name', "calendarsystem_{$name}");
        }

        return $calendars;
    }

    /**
     * Returns the current calendar system in use.
     *
     * @return string the current calendar system being used
     */
    static function get_calendar_system() {
        global $CFG, $USER, $SESSION, $COURSE;

        if (!empty($COURSE->id) and $COURSE->id != SITEID and !empty($COURSE->calendarsystem)) { // Course calendarsystem can override all other settings for this page.
            $return = $COURSE->calendarsystem;
        } else if (!empty($SESSION->calendarsystem)) { // Session calendarsystem can override other settings.
            $return = $SESSION->calendarsystem;
        } else if (!empty($USER->calendarsystem)) {
            $return = $USER->calendarsystem;
        } else if (!empty($CFG->calendarsystem)) {
            $return = $CFG->calendarsystem;
        } else {
            $return = 'gregorian';
        }

        return $return;
    }
}

