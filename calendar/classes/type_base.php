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

namespace core_calendar;

/**
 * Defines functions used by calendar type plugins.
 *
 * This library provides a unified interface for calendar types.
 *
 * @package core_calendar
 * @author Shamim Rezaie <support@foodle.org>
 * @author Mark Nelson <markn@moodle.com>
 * @copyright 2008 onwards Foodle Group {@link http://foodle.org}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class type_base {

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
     * Returns a formatted string that represents a date in user time.
     *
     * Returns a formatted string that represents a date in user time
     * <b>WARNING: note that the format is for strftime(), not date().</b>
     * Because of a bug in most Windows time libraries, we can't use
     * the nicer %e, so we have to use %d which has leading zeroes.
     * A lot of the fuss in the function is just getting rid of these leading
     * zeroes as efficiently as possible.
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
    public abstract function userdate($date, $format, $timezone, $fixday, $fixhour);

    /**
     * Given a $time timestamp returns an array that represents the date in user time.
     *
     * @param int $time the timestamp
     * @return array an array that represents the date in user time
     */
    public abstract function unixtime_to_date_array($time);

    /**
     * Provided with a day, month, year, hour and minute in the specific
     * calendar type convert it into the equivalent Gregorian date.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @return array the converted day, month and year.
     */
    public abstract function convert_to_gregorian($year, $month, $day, $hour = 0, $minute = 0);

    /**
     * Provided with a day, month, year, hour and minute in a Gregorian date
     * convert it into the specific calendar type date.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @return array the converted day, month and year.
     */
    public abstract function convert_from_gregorian($year, $month, $day, $hour = 0, $minute = 0);

    /**
     * Convert a given year in the calendar type being used to the Gregorian year.
     *
     * @param int $year
     * @return int the gregorian year
     */
    public function convert_year_to_gregorian($year) {
        // Get a valid day and month for this calendar.
        $day = key($this->get_days());
        $month = key($this->get_months());

        $date = $this->convert_to_gregorian($year, $month, $day);

        return $date['year'];
    }

    /**
     * Convert a given Gregorian year to the calendar type being used.
     *
     * @param int $year
     * @return int the gregorian year
     */
    public function convert_year_from_gregorian($year) {
        $date = $this->convert_from_gregorian($year, 1, 1);

        return $date['year'];
    }
}
