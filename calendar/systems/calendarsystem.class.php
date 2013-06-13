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
     * Returns the number of days in a given month for a specified year.
     *
     * @param int $m the month
     * @param int $y the year
     * @return int the number of days in that particular month
     */
    public abstract function calendar_days_in_month($m, $y);

    /**
     * Given a $time timestamp in GMT (seconds since epoch)
     * returns an array that represents the date in user time.
     *
     * @param int $time Timestamp in GMT
     * @param float|int|string $timezone offset's time with timezone, if float and not 99, then no
     *        dst offset is applied {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @return array an array that represents the date in user time
     */
    public abstract function usergetdate($time, $timezone = 99);

    /**
     * Validates a given date.
     *
     * @param int $m the month
     * @param int $d the day
     * @param int $y the year
     * @return bool returns true if valid, false otherwise
     */
    public abstract function checkdate($m, $d, $y);

    /**
     * Given date parts in user time produce a GMT timestamp.
     *
     * @param int $year the year part to create timestamp of
     * @param int $month the month part to create timestamp of
     * @param int $day the day part to create timestamp of
     * @param int $hour the hour part to create timestamp of
     * @param int $minute the minute part to create timestamp of
     * @param int $second the second part to create timestamp of
     * @param int|float|string $timezone timezone modifier, used to calculate GMT time offset.
     *             if 99 then default user's timezone is used {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @param bool $applydst toggle Daylight Saving Time, default true, will be
     *             applied only if timezone is 99 or string.
     * @return int GMT timestamp
     */
    public abstract function make_timestamp($year, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $timezone = 99, $applydst = true);

    /**
     * Returns a formatted string that represents a date in user time.
     *
     * @param int $date the timestamp.
     * @param string $format strftime format. You should probably get this using
     *        get_string('strftime...', 'langconfig');
     * @param int|float|string  $timezone by default uses the user's time zone. if numeric and
     *        not 99 then daylight saving will not be added.
     *        {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @param bool $fixday If true (default) then the leading zero from %d is removed.
     *        If false then the leading zero is maintained.
     * @param bool $fixhour If true (default) then the leading zero from %I is removed.
     * @return string the formatted date/time.
     */
    public abstract function userdate($date, $format = '', $timezone = 99, $fixday = true, $fixhour = true);

    /**
     * Returns a list of all the names of the months.
     *
     * @return array the month names
     */
    public abstract function get_month_names();

    /**
     * Returns the minimum year of the calendar.
     *
     * @return int the minumum year
     */
    public abstract function get_min_year();

    /**
     * Returns the maximum year of the calendar.
     *
     * @return int the max yearte
     */
    public abstract function get_max_year();

    /**
     * Get unix timestamp for a GMT date.
     *
     * @param int|null $hour the hour
     * @param int|null $minute the minute
     * @param int|null $second the second
     * @param int|null $month the month
     * @param int|null $day the day
     * @param int|null $year the year
     * @return int an integer unix timestamp
     */
    public abstract function gmmktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null);

    /**
     * Get unix timestamp for a date in the server time.
     *
     * @param int|null $hour the hour
     * @param int|null $minute the minute
     * @param int|null $second the second
     * @param int|null $month the month
     * @param int|null $day the day
     * @param int|null $year the year
     * @return int an integer unix timestamp
     */
    public abstract function mktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null);

    /**
     * Calculate the position in the week of a specific calendar day.
     *
     * @param int $day the day of the date whose position in the week is sought
     * @param int $month the month of the date whose position in the week is sought
     * @param int $year the year of the date whose position in the week is sought
     * @return int
     */
    public abstract function dayofweek($day, $month, $year);
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
        } else {
            $return = $CFG->calendarsystem;
        }

        return $return;
    }
}

