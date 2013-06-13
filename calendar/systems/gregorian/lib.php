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
 * Handles calendar functions for the gregorian calendar.
 *
 * @package calendar_systems_plugin_gregorian
 * @author Shamim Rezaie <support@foodle.org>
 * @author Mark Nelson <markn@moodle.com>
 * @copyright 2008 onwards Foodle Group {@link http://foodle.org}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class calendar_systems_plugin_gregorian extends calendar_systems_plugin_base {

    /**
     * Returns the number of days in a given month for a specified year.
     *
     * @param int $m the month
     * @param int $y the year
     * @return int the number of days in that particular month
     */
    public function calendar_days_in_month($m, $y) {
        return intval(date('t', mktime(0, 0, 0, $m, 1, $y)));
    }

    /**
     * Given a $time timestamp in GMT (seconds since epoch),
     * returns an array that represents the date in user time
     *
     * @param int $time Timestamp in GMT
     * @param float|int|string $timezone offset's time with timezone, if float and not 99, then no
     *        dst offset is applied {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @return array an array that represents the date in user time
     */
    public function usergetdate($time, $timezone = 99) {
        return usergetdate_old($time, $timezone);
    }

    /**
     * Validates a given date.
     *
     * @param int $m the month
     * @param int $d the day
     * @param int $y the year
     * @return bool returns true if valid, false otherwise
     */
    public function checkdate($m, $d, $y) {
        return checkdate($m, $d, $y);
    }

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
    public function make_timestamp($year, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $timezone = 99, $applydst = true) {
        return make_timestamp_old($year, $month, $day, $hour, $minute, $second, $timezone, $applydst);
    }

    /**
     * Returns a formatted string that represents a date in user time
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
    public function userdate($date, $format = '', $timezone = 99, $fixday = true, $fixhour = true) {
        static $amstring = null, $pmstring = null, $AMstring = null, $PMstring = null;

        if (!$amstring) {
            $amstring = get_string('am', 'calendarsystem_gregorian');
            $pmstring = get_string('pm', 'calendarsystem_gregorian');
            $AMstring = strtoupper(get_string('am', 'calendarsystem_gregorian'));
            $PMstring = strtoupper(get_string('pm', 'calendarsystem_gregorian'));
        }

        $format = str_replace( array(
                                    "%p",
                                    "%P"
                                    ),
                               array(
                                    ($date["hours"] < 12 ? $AMstring : $PMstring),
                                    ($date["hours"] < 12 ? $amstring : $pmstring)
                                    ),
                              $format);

        return userdate_old($date, $format, $timezone, $fixday, $fixhour);
    }

    /**
     * Returns a list of all the names of the months.
     *
     * @return array the month names
     */
    public function get_month_names() {
        $months = array();

        for ($i=1; $i<=12; $i++) {
            $months[$i] = userdate(gmmktime(12, 0, 0, $i, 15, 2000), '%B');
        }

        return $months;
    }

    /**
     * Returns the minimum year of the calendar.
     *
     * @return int the minumum year
     */
    public function get_min_year() {
        return 1970;
    }

    /**
     * Returns the maximum year of the calendar.
     *
     * @return int the max yearte
     */
    public function get_max_year() {
        return 2020;
    }

    /**
     * Get unix timestamp for a GMT date.
     *
     * @param int|null $hour the hour
     * @param int|null $minute the minute
     * @param int|null $second the second
     * @param int|null $month the month
     * @param int|null $day the day
     * @param int|null $year the year
     * @return int an integer unix timestamp.
     */
    public function gmmktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null) {
        return gmmktime($hour, $minute, $second, $month, $day, $year);
    }

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
    public function mktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null) {
        return mktime($hour, $minute, $second, $month, $day, $year);
    }

    /**
     * Calculate the position in the week of a specific calendar day.
     *
     * @param int $day the day of the date whose position in the week is sought
     * @param int $month the month of the date whose position in the week is sought
     * @param int $year the year of the date whose position in the week is sought
     * @return int
     */
    public function dayofweek($day, $month, $year) {
        return intval(date('w', mktime(12, 0, 0, $month, $day, $year)));
    }
}
