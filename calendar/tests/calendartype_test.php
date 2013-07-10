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
 * Calendar type system unit tests.
 *
 * @package core_calendar
 * @copyright 2013 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Unit tests for the calendar type system.
 *
 * @package core_calendar
 * @copyright 2013 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since Moodle 2.6
 */
class core_calendar_type_testcase extends advanced_testcase {

    /**
     * The test user.
     */
    private $user;

    /**
     * Test set up.
     */
    protected function setUp() {
        global $CFG;

        require_once($CFG->dirroot . '/calendar/tests/calendartype_test_example.php');
        require_once($CFG->libdir . '/form/dateselector.php');
        require_once($CFG->libdir . '/form/datetimeselector.php');

        // The user we are going to test this on.
        $this->user = self::getDataGenerator()->create_user();
        self::setUser($this->user);
    }

    /**
     * Test that setting the calendar type works.
     */
    public function test_calendar_set_type() {
        // We want to reset the test data after this run.
        $this->resetAfterTest();

        // Test setting it as the 'Test' calendar type.
        $this->set_calendar_type('test');
        $this->assertEquals('test', core_calendar\type_factory::get_calendar_type());

        // Test setting it as the 'Gregorian' calendar type.
        $this->set_calendar_type('gregorian');
        $this->assertEquals('gregorian', core_calendar\type_factory::get_calendar_type());

    }
    /**
     * Test the calendar type system.
     */
    public function test_calendar_type() {
        // We want to reset the test data after this run.
        $this->resetAfterTest();

        // Test that the core functions reproduce the same results as the Gregorian calendar.
        $this->core_functions_test('gregorian');

        // Test that the core functions reproduce the same results as the test calendar.
        $this->core_functions_test('test');

        // Check converting dates to Gregorian when submitting a date selector element works. Note: the Gregorian
        // date 07/04/2013 is equivalent to the Julian date 21/06/2013 - which is what the test calendar is based on.
        $date1 = array();
        $date1['day'] = 4;
        $date1['month'] = 7;
        $date1['year'] = 2013;
        $date1['hour'] = 0;
        $date1['minute'] = 0;
        $date1['timestamp'] = 1372896000;
        $this->convert_date_to_unixtime_test('dateselector', 'gregorian', $date1);

        $date2 = array();
        $date2['day'] = 21;
        $date2['month'] = 6;
        $date2['year'] = 2013;
        $date2['hour'] = 0;
        $date2['minute'] = 0;
        $date2['timestamp'] = 1372896000;
        $this->convert_date_to_unixtime_test('dateselector', 'test', $date2);

        $date3 = array();
        $date3['day'] = 4;
        $date3['month'] = 7;
        $date3['year'] = 2013;
        $date3['hour'] = 23;
        $date3['minute'] = 15;
        $date3['timestamp'] = 1372979700;
        $this->convert_date_to_unixtime_test('datetimeselector', 'gregorian', $date3);

        $date4 = array();
        $date4['day'] = 21;
        $date4['month'] = 6;
        $date4['year'] = 2013;
        $date4['hour'] = 23;
        $date4['minute'] = 15;
        $date4['timestamp'] = 1372979700;
        $this->convert_date_to_unixtime_test('datetimeselector', 'test', $date4);

        // The date selector element values are set by using the function usergetdate, here we want to check that
        // the unixtime passed is being successfully converted to the correct values for the calendar type.
        $this->convert_unixtime_to_date_test('gregorian', $date1);
        $this->convert_unixtime_to_date_test('test', $date2);

        // Test that the user profile field datetime minimum year and maximum year settings are saved as
        // the equivalent Gregorian years.

        // Now check that when we display the miniumum and maximum year on the settings page for the user profile field
        // datetime that it converts the Gregorian years to the equivalent calendar type.
    }

    /**
     * Test all the core functions that use the calendar type system.
     *
     * @param string $type the calendar type we want to test
     */
    private function core_functions_test($type) {
        $this->set_calendar_type($type);

        $class = "\\calendartype_$type\\structure";
        $calendar = new $class();

        // Test the userdate function.
        $this->assertEquals($calendar->userdate($this->user->timecreated, '', 99, true, true), userdate($this->user->timecreated));

        // Test the usergetdate function.
        $this->assertEquals($calendar->usergetdate($this->user->timecreated, '', 99, true, true), usergetdate($this->user->timecreated));
    }

    /**
     * Simulates submitting a form with a date selector element and tests that the chosen dates
     * are converted into Gregorian and then into unixtime before being saved in DB.
     *
     * @param string $element the form element we are testing
     * @param string $type the calendar type we want to test
     * @param array $date the date variables
     */
    private function convert_date_to_unixtime_test($element, $type, $date) {
        $this->set_calendar_type($type);

        if ($element == 'dateselector') {
            $el = new MoodleQuickForm_date_selector('dateselector', null, array('timezone' => 0.0));
        } else {
            $el = new MoodleQuickForm_date_time_selector('dateselector', null, array('timezone' => 0.0));
        }
        $el->_createElements();
        $submitvalues = array('dateselector' => $date);

        $this->assertSame($el->exportValue($submitvalues), array('dateselector' => $date['timestamp']));
    }

    /**
     * Test converting dates from unixtime .
     *
     * @param string $type the calendar type we want to test
     * @param array $date the date variables
     */
    private function convert_unixtime_to_date_test($type, $date) {
        $this->set_calendar_type($type);

        $usergetdate = usergetdate($date['timestamp'], 0.0);
        $comparedate = array(
            'minute' => $usergetdate['minutes'],
            'hour' => $usergetdate['hours'],
            'day' => $usergetdate['mday'],
            'month' => $usergetdate['mon'],
            'year' => $usergetdate['year'],
            'timestamp' => $date['timestamp']
        );

        $this->assertEquals($comparedate, $date);
    }

    /**
     * Set the calendar type for this user.
     *
     * @param string $type the calendar type we want to set
     */
    private function set_calendar_type($type) {
        $this->user->calendartype = $type;
        session_set_user($this->user);
    }
}
