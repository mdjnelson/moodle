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

namespace calendartype_test;
use core_calendar\type_base;

/**
 * Handles calendar functions for the test calendar.
 *
 * @package core_calendar
 * @copyright Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class structure extends type_base {

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
    public function get_days() {
        $days = array();

        for ($i = 1; $i <= 31; $i++) {
            $days[$i] = "Ankit - $i";
        }

        return $days;
    }

    /**
     * Returns a list of all the names of the months.
     *
     * @return array the month names
     */
    public function get_months() {
        $months = array();

        for ($i=1; $i<=12; $i++) {
            $months[$i] = "Rajey boy - $i";
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
     * @return int the max year
     */
    public function get_max_year() {
        return 2050;
    }

    /**
     * Returns a formatted string that represents a date in user time.
     *
     * If parameter fixday = true (default), then take off leading
     * zero from %d, else maintain it.
     *
     * @param int $date the timestamp in UTC, as obtained from the database.
     * @param string $format strftime format. You should probably get this using
     *        get_string('strftime...', 'langconfig');
     * @param int|float|string  $timezone by default, uses the user's time zone. if numeric and
     *        not 99 then daylight saving will not be added.
     *        {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @param bool $fixday if true (default) then the leading zero from %d is removed.
     *        If false then the leading zero is maintained.
     * @param bool $fixhour if true (default) then the leading zero from %I is removed.
     * @return string the formatted date/time.
     */
    public function userdate($date, $format, $timezone, $fixday, $fixhour) {
        return "";
    }

    /**
     * Given a $time timestamp in GMT (seconds since epoch), returns an array that
     * represents the date in user time.
     *
     * @param int $time Timestamp in GMT
     * @param float|int|string $timezone offset's time with timezone, if float and not 99, then no
     *        dst offset is applyed {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @return array An array that represents the date in user time
     */
    public function usergetdate($time, $timezone) {
        $date = parent::usergetdate($time, $timezone);
        $newdate = $this->convert_from_gregorian($date["mday"], $date["mon"], $date["year"],
            $date['hours'], $date['minutes']);

        $date["year"] = $newdate['year'];
        $date["mon"] = $newdate['month'];
        $date["mday"] = $newdate['day'];
        $date['hours'] = $newdate['hour'];
        $date['minutes']  = $newdate['minute'];

        return $date;
    }

    /**
     * Provided with a day, month, year, hour and minute
     * convert it into the equivalent Gregorian date.
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $hour
     * @param int $minute
     * @return array the converted day, month, year, hour and minute.
     */
    public function convert_to_gregorian($day, $month, $year, $hour = 0, $minute = 0) {
        $jd = juliantojd($month, $day, $year);
        $gregorian = jdtogregorian($jd);

        list($month, $day, $year) = explode('/', $gregorian);

        return array('year' => $year,
                     'month' => $month,
                     'day' => $day,
                     'hour' => $hour,
                     'minute' => $minute);

    }

    /**
     * Provided with a day, month, year, hour and minute in a Gregorian date
     * convert it into the specific calendar type date.
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $hour
     * @param int $minute
     * @return array the converted day, month, year, hour and minute.
     */
    public function convert_from_gregorian($day, $month, $year, $hour = 0, $minute = 0) {
        $jd = gregoriantojd($month, $day, $year);
        $julian = jdtojulian($jd);

        list($month, $day, $year) = explode('/', $julian);

        return array('year' => $year,
                     'month' => $month,
                     'day' => $day,
                     'hour' => $hour,
                     'minute' => $minute);
    }
}
