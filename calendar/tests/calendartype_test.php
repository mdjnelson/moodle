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

global $CFG;

// The test calendar type.
require_once($CFG->dirroot . '/calendar/tests/calendartype_test_example.php');

// Used to test the dateselector elements.
require_once($CFG->libdir . '/form/dateselector.php');
require_once($CFG->libdir . '/form/datetimeselector.php');

// Used to test the user datetime profile field.
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/user/profile/definelib.php');
require_once($CFG->dirroot . '/user/profile/index_field_form.php');

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
        // The user we are going to test this on.
        $this->user = self::getDataGenerator()->create_user();
        self::setUser($this->user);
    }

    /**
     * Test that setting the calendar type works.
     */
    public function test_calendar_type_set() {
        // We want to reset the test data after this run.
        $this->resetAfterTest(true);

        // Test setting it as the 'Test' calendar type.
        $this->set_calendar_type('test');
        $this->assertEquals('test', \core_calendar\type_factory::get_calendar_type());

        // Test setting it as the 'Gregorian' calendar type.
        $this->set_calendar_type('gregorian');
        $this->assertEquals('gregorian', \core_calendar\type_factory::get_calendar_type());
    }

    /**
     * Test that calling core Moodle functions responsible for displaying the date
     * have the same results as directly calling the same function in the calendar type.
     */
    public function test_calendar_type_core_functions() {
        // We want to reset the test data after this run.
        $this->resetAfterTest(true);

        $this->set_calendar_type('gregorian');

        $i = 0;
        while ($i <= 1000) {
            $i++;
            $time = rand(0, time());
            // Only make it the server time once every so often.
            if (rand(0, 0)) {
                $timezone = 99;
            } else {
                $timezone = rand(1, 12);
            }
            // echo "\n";
            // echo $time . "\n";
            // echo $timezone . "\n";
            // $time = 1233101085;
            // $timezone = 10;
            $oldusergetdate = $this->old_usergetdate($time, $timezone);
            $newusergetdate = usergetdate($time, $timezone);
            // The old usergetdate function does not always use getdate, so will not always return
            // the seconds since the Unix Epoch as the key '0'.
            unset($oldusergetdate[0]);
            unset($newusergetdate[0]);
            $this->assertEquals($oldusergetdate, $newusergetdate);
            //print_object($oldusergetdate);
        }
        //print_object($newusergetdate);
    }

    /**
     * Test that dates selected using the date selector elements are being saved as unixtime, and that the
     * unixtime is being converted back to a valid date to display in the date selector elements for
     * different calendar types.
     */
    public function test_calendar_type_dateselector_elements() {
        // We want to reset the test data after this run.
        $this->resetAfterTest(true);

        // Check converting dates to Gregorian when submitting a date selector element works. Note: the test
        // calendar is 2 years, 2 months, 2 days, 2 hours and 2 minutes ahead of the Gregorian calendar.
        $date1 = array();
        $date1['day'] = 4;
        $date1['month'] = 7;
        $date1['year'] = 2013;
        $date1['hour'] = 0;
        $date1['minute'] = 0;
        $date1['timestamp'] = 1372896000;
        $this->convert_dateselector_to_unixtime_test('dateselector', 'gregorian', $date1);

        $date2 = array();
        $date2['day'] = 7;
        $date2['month'] = 9;
        $date2['year'] = 2015;
        $date2['hour'] = 0; // The dateselector element does not have hours.
        $date2['minute'] = 0; // The dateselector element does not have minutes.
        $date2['timestamp'] = 1372896000;
        $this->convert_dateselector_to_unixtime_test('dateselector', 'test', $date2);

        $date3 = array();
        $date3['day'] = 4;
        $date3['month'] = 7;
        $date3['year'] = 2013;
        $date3['hour'] = 23;
        $date3['minute'] = 15;
        $date3['timestamp'] = 1372979700;
        $this->convert_dateselector_to_unixtime_test('datetimeselector', 'gregorian', $date3);

        $date4 = array();
        $date4['day'] = 7;
        $date4['month'] = 9;
        $date4['year'] = 2015;
        $date4['hour'] = 1;
        $date4['minute'] = 17;
        $date4['timestamp'] = 1372979700;
        $this->convert_dateselector_to_unixtime_test('datetimeselector', 'test', $date4);

        // The date selector element values are set by using the function usergetdate, here we want to check that
        // the unixtime passed is being successfully converted to the correct values for the calendar type.
        // $this->convert_unixtime_to_dateselector_test('gregorian', $date3);
        // $this->convert_unixtime_to_dateselector_test('test', $date4);
    }

    /**
     * Test that the user profile field datetime minimum and maximum year settings are saved as the
     * equivalent Gregorian years.
     */
    public function test_calendar_type_datetime_field_submission() {
        // We want to reset the test data after this run.
        $this->resetAfterTest(true);

        // Create an array with the input values and expected values once submitted.
        $date = array();
        $date['inputminyear'] = '1970';
        $date['inputmaxyear'] = '2013';
        $date['expectedminyear'] = '1970';
        $date['expectedmaxyear'] = '2013';
        $this->datetime_field_submission_test('gregorian', $date);

        // The test calendar is 2 years in the future, so when these values are submitted they should
        // be converted into the Gregorian minimum and maximum year.
        $date['expectedminyear'] = '1968';
        $date['expectedmaxyear'] = '2011';
        $this->datetime_field_submission_test('test', $date);
    }

    /**
     * Simulates submitting a form with a date selector element and tests that the chosen dates
     * are converted into unixtime before being saved in DB.
     *
     * @param string $element the form element we are testing
     * @param string $type the calendar type we want to test
     * @param array $date the date variables
     */
    private function convert_dateselector_to_unixtime_test($element, $type, $date) {
        $this->set_calendar_type($type);

        if ($element == 'dateselector') {
            $el = new MoodleQuickForm_date_selector('dateselector', null, array('timezone' => 0.0, 'step' => 1));
        } else {
            $el = new MoodleQuickForm_date_time_selector('dateselector', null, array('timezone' => 0.0, 'step' => 1));
        }
        $el->_createElements();
        $submitvalues = array('dateselector' => $date);

        $this->assertSame($el->exportValue($submitvalues), array('dateselector' => $date['timestamp']));
    }

    /**
     * Test converting dates from unixtime to a date for the calendar type specified.
     *
     * @param string $type the calendar type we want to test
     * @param array $date the date variables
     */
    private function convert_unixtime_to_dateselector_test($type, $date) {
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
     * Test saving the minimum and max year settings for the user datetime field.
     *
     * @param string $type the calendar type we want to test
     * @param array $date the date variables
     */
    private function datetime_field_submission_test($type, $date) {
        $this->set_calendar_type($type);

        // Get the data we are submitting for the form.
        $formdata = array();
        $formdata['shortname'] = 'Shortname';
        $formdata['name'] = 'Name';
        $formdata['param1'] = $date['inputminyear'];
        $formdata['param2'] = $date['inputmaxyear'];

        // Mock submitting this.
        field_form::mock_submit($formdata);

        // Create the user datetime form.
        $form = new field_form(null, 'datetime');

        // Get the data from the submission.
        $submissiondata = $form->get_data();
        // On the user profile field page after get_data, the function define_save is called
        // in the field base class, which then calls the field's function define_save_preprocess.
        $field = new profile_define_datetime();
        $submissiondata = $field->define_save_preprocess($submissiondata);

        // Create an array we want to compare with the date passed.
        $comparedate = $date;
        $comparedate['expectedminyear'] = $submissiondata->param1;
        $comparedate['expectedmaxyear'] = $submissiondata->param2;

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

    /**
     * Given a $time timestamp in GMT (seconds since epoch),
     * returns an array that represents the date in user time
     *
     * @package core
     * @category time
     * @uses HOURSECS
     * @param int $time Timestamp in GMT
     * @param float|int|string $timezone offset's time with timezone, if float and not 99, then no
     * dst offset is applyed {@link http://docs.moodle.org/dev/Time_API#Timezone}
     * @return array An array that represents the date in user time
     */
    private function old_usergetdate($time, $timezone = 99) {
        // Save input timezone, required for dst offset check.
        $passedtimezone = $timezone;

        $timezone = get_user_timezone_offset($timezone);

        if (abs($timezone) > 13) { // Server time.
            return getdate($time);
        }

        // Add daylight saving offset for string timezones only, as we can't get dst for
        // float values. if timezone is 99 (user default timezone), then try update dst.
        if ($passedtimezone == 99 || !is_numeric($passedtimezone)) {
            $time += dst_offset_on($time, $passedtimezone);
        }

        $time += intval((float) $timezone * HOURSECS);

        $datestring = gmstrftime('%B_%A_%j_%Y_%m_%w_%d_%H_%M_%S', $time);

        // Be careful to ensure the returned array matches that produced by getdate() above.
        list(
            $getdate['month'],
            $getdate['weekday'],
            $getdate['yday'],
            $getdate['year'],
            $getdate['mon'],
            $getdate['wday'],
            $getdate['mday'],
            $getdate['hours'],
            $getdate['minutes'],
            $getdate['seconds']
            ) = explode('_', $datestring);

        // Set correct datatype to match with getdate().
        $getdate['seconds'] = (int)$getdate['seconds'];
        $getdate['yday'] = (int)$getdate['yday'] - 1; // Returns 0 through 365.
        $getdate['year'] = (int)$getdate['year'];
        $getdate['mon'] = (int)$getdate['mon'];
        $getdate['wday'] = (int)$getdate['wday'];
        $getdate['mday'] = (int)$getdate['mday'];
        $getdate['hours'] = (int)$getdate['hours'];
        $getdate['minutes'] = (int)$getdate['minutes'];

        return $getdate;
    }
}
