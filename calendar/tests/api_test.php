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
 * Contains the class containing unit tests for the calendar API.
 *
 * @package    core_calendar
 * @copyright  2017 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/helpers.php');

use \core_calendar\api;

/**
 * Class contaning unit tests for the calendar API.
 *
 * @package    core_calendar
 * @copyright  2017 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_calendar_api_testcase extends advanced_testcase {

    /**
     * Tests set up
     */
    protected function setUp() {
        $this->resetAfterTest();
    }

    public function test_get_course_cached() {
        // Setup some test courses.
        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();

        // Load courses into cache.
        $coursecache = null;
        \core_calendar\api::get_course_cached($coursecache, $course1->id);
        \core_calendar\api::get_course_cached($coursecache, $course2->id);
        \core_calendar\api::get_course_cached($coursecache, $course3->id);

        // Verify the cache.
        $this->assertArrayHasKey($course1->id, $coursecache);
        $cachedcourse1 = $coursecache[$course1->id];
        $this->assertEquals($course1->id, $cachedcourse1->id);
        $this->assertEquals($course1->shortname, $cachedcourse1->shortname);
        $this->assertEquals($course1->fullname, $cachedcourse1->fullname);

        $this->assertArrayHasKey($course2->id, $coursecache);
        $cachedcourse2 = $coursecache[$course2->id];
        $this->assertEquals($course2->id, $cachedcourse2->id);
        $this->assertEquals($course2->shortname, $cachedcourse2->shortname);
        $this->assertEquals($course2->fullname, $cachedcourse2->fullname);

        $this->assertArrayHasKey($course3->id, $coursecache);
        $cachedcourse3 = $coursecache[$course3->id];
        $this->assertEquals($course3->id, $cachedcourse3->id);
        $this->assertEquals($course3->shortname, $cachedcourse3->shortname);
        $this->assertEquals($course3->fullname, $cachedcourse3->fullname);
    }

    /**
     * Test that the get_events() function only returns activity events that are enabled.
     */
    public function test_get_events_with_disabled_module() {
        global $DB;

        $course = $this->getDataGenerator()->create_course();
        $events = [[
            'name' => 'Start of assignment',
            'description' => '',
            'format' => 1,
            'courseid' => $course->id,
            'groupid' => 0,
            'userid' => 2,
            'modulename' => 'assign',
            'instance' => 1,
            'eventtype' => 'due',
            'timestart' => time(),
            'timeduration' => 86400,
            'visible' => 1
        ], [
            'name' => 'Start of lesson',
            'description' => '',
            'format' => 1,
            'courseid' => $course->id,
            'groupid' => 0,
            'userid' => 2,
            'modulename' => 'lesson',
            'instance' => 1,
            'eventtype' => 'end',
            'timestart' => time(),
            'timeduration' => 86400,
            'visible' => 1
        ]
        ];

        foreach ($events as $event) {
            \core_calendar\event::create($event, false);
        }

        $timestart = time() - 60;
        $timeend = time() + 60;

        // Get all events.
        $events = \core_calendar\api::get_events($timestart, $timeend, true, 0, true);
        $this->assertCount(2, $events);

        // Disable the lesson module.
        $modulerecord = $DB->get_record('modules', ['name' => 'lesson']);
        $modulerecord->visible = 0;
        $DB->update_record('modules', $modulerecord);

        // Check that we only return the assign event.
        $events = \core_calendar\api::get_events($timestart, $timeend, true, 0, true);
        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertEquals('assign', $event->modulename);
    }

    /**
     * Test the update_subscription() function.
     */
    public function test_update_subscription() {
        $this->resetAfterTest(true);

        $subscription = new stdClass();
        $subscription->eventtype = 'site';
        $subscription->name = 'test';
        $id = \core_calendar\api::add_subscription($subscription);

        $subscription = \core_calendar\api::get_subscription($id);
        $subscription->name = 'awesome';
        \core_calendar\api::update_subscription($subscription);
        $sub = \core_calendar\api::get_subscription($id);
        $this->assertEquals($subscription->name, $sub->name);

        $subscription = \core_calendar\api::get_subscription($id);
        $subscription->name = 'awesome2';
        $subscription->pollinterval = 604800;
        \core_calendar\api::update_subscription($subscription);
        $sub = \core_calendar\api::get_subscription($id);
        $this->assertEquals($subscription->name, $sub->name);
        $this->assertEquals($subscription->pollinterval, $sub->pollinterval);

        $subscription = new stdClass();
        $subscription->name = 'awesome4';
        $this->expectException('coding_exception');
        \core_calendar\api::update_subscription($subscription);
    }

    public function test_add_subscription() {
        global $DB, $CFG;

        require_once($CFG->dirroot . '/lib/bennu/bennu.inc.php');

        $this->resetAfterTest(true);

        // Test for Microsoft Outlook 2010.
        $subscription = new stdClass();
        $subscription->name = 'Microsoft Outlook 2010';
        $subscription->importfrom = CALENDAR_IMPORT_FROM_FILE;
        $subscription->eventtype = 'site';
        $id = \core_calendar\api::add_subscription($subscription);

        $calendar = file_get_contents($CFG->dirroot . '/lib/tests/fixtures/ms_outlook_2010.ics');
        $ical = new iCalendar();
        $ical->unserialize($calendar);
        $this->assertEquals($ical->parser_errors, array());

        $sub = \core_calendar\api::get_subscription($id);
        \core_calendar\api::import_icalendar_events($ical, $sub->courseid, $sub->id);
        $count = $DB->count_records('event', array('subscriptionid' => $sub->id));
        $this->assertEquals($count, 1);

        // Test for OSX Yosemite.
        $subscription = new stdClass();
        $subscription->name = 'OSX Yosemite';
        $subscription->importfrom = CALENDAR_IMPORT_FROM_FILE;
        $subscription->eventtype = 'site';
        $id = \core_calendar\api::add_subscription($subscription);

        $calendar = file_get_contents($CFG->dirroot . '/lib/tests/fixtures/osx_yosemite.ics');
        $ical = new iCalendar();
        $ical->unserialize($calendar);
        $this->assertEquals($ical->parser_errors, array());

        $sub = \core_calendar\api::get_subscription($id);
        \core_calendar\api::import_icalendar_events($ical, $sub->courseid, $sub->id);
        $count = $DB->count_records('event', array('subscriptionid' => $sub->id));
        $this->assertEquals($count, 1);

        // Test for Google Gmail.
        $subscription = new stdClass();
        $subscription->name = 'Google Gmail';
        $subscription->importfrom = CALENDAR_IMPORT_FROM_FILE;
        $subscription->eventtype = 'site';
        $id = \core_calendar\api::add_subscription($subscription);

        $calendar = file_get_contents($CFG->dirroot . '/lib/tests/fixtures/google_gmail.ics');
        $ical = new iCalendar();
        $ical->unserialize($calendar);
        $this->assertEquals($ical->parser_errors, array());

        $sub = \core_calendar\api::get_subscription($id);
        \core_calendar\api::import_icalendar_events($ical, $sub->courseid, $sub->id);
        $count = $DB->count_records('event', array('subscriptionid' => $sub->id));
        $this->assertEquals($count, 1);
    }

    /**
     * Requesting calendar events from a given time should return all events with a sort
     * time at or after the requested time. All events prior to that time should not
     * be return.
     *
     * If there are no events on or after the given time then an empty result set should
     * be returned.
     */
    function test_get_calendar_action_events_by_timesort_after_time() {
        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();
        $generator = $this->getDataGenerator()->get_plugin_generator('mod_assign');
        $moduleinstance = $generator->create_instance(['course' => $course->id]);

        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        $this->resetAfterTest(true);
        $this->setUser($user);

        $params = [
            'type' => CALENDAR_EVENT_TYPE_ACTION,
            'modulename' => 'assign',
            'instance' => $moduleinstance->id,
            'userid' => $user->id,
            'eventtype' => 'user',
            'repeats' => 0,
            'timestart' => 1,
        ];

        $event1 = create_event(array_merge($params, ['name' => 'Event 1', 'timesort' => 1]));
        $event2 = create_event(array_merge($params, ['name' => 'Event 2', 'timesort' => 2]));
        $event3 = create_event(array_merge($params, ['name' => 'Event 3', 'timesort' => 3]));
        $event4 = create_event(array_merge($params, ['name' => 'Event 4', 'timesort' => 4]));
        $event5 = create_event(array_merge($params, ['name' => 'Event 5', 'timesort' => 5]));
        $event6 = create_event(array_merge($params, ['name' => 'Event 6', 'timesort' => 6]));
        $event7 = create_event(array_merge($params, ['name' => 'Event 7', 'timesort' => 7]));
        $event8 = create_event(array_merge($params, ['name' => 'Event 8', 'timesort' => 8]));

        $result = api::get_action_events_by_timesort(5);

        $this->assertCount(4, $result);
        $this->assertEquals('Event 5', $result[0]->name);
        $this->assertEquals('Event 6', $result[1]->name);
        $this->assertEquals('Event 7', $result[2]->name);
        $this->assertEquals('Event 8', $result[3]->name);

        $result = api::get_action_events_by_timesort(9);

        $this->assertEmpty($result);
    }

    /**
     * Requesting calendar events before a given time should return all events with a sort
     * time at or before the requested time (inclusive). All events after that time
     * should not be returned.
     *
     * If there are no events before the given time then an empty result set should be
     * returned.
     */
    function test_get_calendar_action_events_by_timesort_before_time() {
        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();
        $generator = $this->getDataGenerator()->get_plugin_generator('mod_assign');
        $moduleinstance = $generator->create_instance(['course' => $course->id]);

        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        $this->resetAfterTest(true);
        $this->setUser($user);

        $params = [
            'type' => CALENDAR_EVENT_TYPE_ACTION,
            'modulename' => 'assign',
            'instance' => $moduleinstance->id,
            'userid' => $user->id,
            'eventtype' => 'user',
            'repeats' => 0,
            'timestart' => 1,
        ];

        $event1 = create_event(array_merge($params, ['name' => 'Event 1', 'timesort' => 2]));
        $event2 = create_event(array_merge($params, ['name' => 'Event 2', 'timesort' => 3]));
        $event3 = create_event(array_merge($params, ['name' => 'Event 3', 'timesort' => 4]));
        $event4 = create_event(array_merge($params, ['name' => 'Event 4', 'timesort' => 5]));
        $event5 = create_event(array_merge($params, ['name' => 'Event 5', 'timesort' => 6]));
        $event6 = create_event(array_merge($params, ['name' => 'Event 6', 'timesort' => 7]));
        $event7 = create_event(array_merge($params, ['name' => 'Event 7', 'timesort' => 8]));
        $event8 = create_event(array_merge($params, ['name' => 'Event 8', 'timesort' => 9]));

        $result = api::get_action_events_by_timesort(null, 5);

        $this->assertCount(4, $result);
        $this->assertEquals('Event 1', $result[0]->name);
        $this->assertEquals('Event 2', $result[1]->name);
        $this->assertEquals('Event 3', $result[2]->name);
        $this->assertEquals('Event 4', $result[3]->name);

        $result = api::get_action_events_by_timesort(null, 1);

        $this->assertEmpty($result);
    }

    /**
     * Requesting calendar events within a given time range should return all events with
     * a sort time between the lower and upper time bound (inclusive).
     *
     * If there are no events in the given time range then an empty result set should be
     * returned.
     */
    function test_get_calendar_action_events_by_timesort_time_range() {
        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();
        $generator = $this->getDataGenerator()->get_plugin_generator('mod_assign');
        $moduleinstance = $generator->create_instance(['course' => $course->id]);

        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        $this->resetAfterTest(true);
        $this->setUser($user);

        $params = [
            'type' => CALENDAR_EVENT_TYPE_ACTION,
            'modulename' => 'assign',
            'instance' => $moduleinstance->id,
            'userid' => $user->id,
            'eventtype' => 'user',
            'repeats' => 0,
            'timestart' => 1,
        ];

        $event1 = create_event(array_merge($params, ['name' => 'Event 1', 'timesort' => 1]));
        $event2 = create_event(array_merge($params, ['name' => 'Event 2', 'timesort' => 2]));
        $event3 = create_event(array_merge($params, ['name' => 'Event 3', 'timesort' => 3]));
        $event4 = create_event(array_merge($params, ['name' => 'Event 4', 'timesort' => 4]));
        $event5 = create_event(array_merge($params, ['name' => 'Event 5', 'timesort' => 5]));
        $event6 = create_event(array_merge($params, ['name' => 'Event 6', 'timesort' => 6]));
        $event7 = create_event(array_merge($params, ['name' => 'Event 7', 'timesort' => 7]));
        $event8 = create_event(array_merge($params, ['name' => 'Event 8', 'timesort' => 8]));

        $result = api::get_action_events_by_timesort(3, 6);

        $this->assertCount(4, $result);
        $this->assertEquals('Event 3', $result[0]->name);
        $this->assertEquals('Event 4', $result[1]->name);
        $this->assertEquals('Event 5', $result[2]->name);
        $this->assertEquals('Event 6', $result[3]->name);

        $result = api::get_action_events_by_timesort(10, 15);

        $this->assertEmpty($result);
    }

    /**
     * Requesting calendar events within a given time range and a limit and offset should return
     * the number of events up to the given limit value that have a sort time between the lower
     * and uppper time bound (inclusive) where the result set is shifted by the offset value.
     *
     * If there are no events in the given time range then an empty result set should be
     * returned.
     */
    function test_get_calendar_action_events_by_timesort_time_limit_offset() {
        $user = $this->getDataGenerator()->create_user();
        $course = $this->getDataGenerator()->create_course();
        $generator = $this->getDataGenerator()->get_plugin_generator('mod_assign');
        $moduleinstance = $generator->create_instance(['course' => $course->id]);

        $this->getDataGenerator()->enrol_user($user->id, $course->id);
        $this->resetAfterTest(true);
        $this->setUser($user);

        $params = [
            'type' => CALENDAR_EVENT_TYPE_ACTION,
            'modulename' => 'assign',
            'instance' => $moduleinstance->id,
            'userid' => $user->id,
            'eventtype' => 'user',
            'repeats' => 0,
            'timestart' => 1,
        ];

        $event1 = create_event(array_merge($params, ['name' => 'Event 1', 'timesort' => 1]));
        $event2 = create_event(array_merge($params, ['name' => 'Event 2', 'timesort' => 2]));
        $event3 = create_event(array_merge($params, ['name' => 'Event 3', 'timesort' => 3]));
        $event4 = create_event(array_merge($params, ['name' => 'Event 4', 'timesort' => 4]));
        $event5 = create_event(array_merge($params, ['name' => 'Event 5', 'timesort' => 5]));
        $event6 = create_event(array_merge($params, ['name' => 'Event 6', 'timesort' => 6]));
        $event7 = create_event(array_merge($params, ['name' => 'Event 7', 'timesort' => 7]));
        $event8 = create_event(array_merge($params, ['name' => 'Event 8', 'timesort' => 8]));

        $result = api::get_action_events_by_timesort(2, 7, $event3->id, 2);

        $this->assertCount(2, $result);
        $this->assertEquals('Event 4', $result[0]->name);
        $this->assertEquals('Event 5', $result[1]->name);

        $result = api::get_action_events_by_timesort(2, 7, $event5->id, 2);

        $this->assertCount(2, $result);
        $this->assertEquals('Event 6', $result[0]->name);
        $this->assertEquals('Event 7', $result[1]->name);

        $result = api::get_action_events_by_timesort(2, 7, $event7->id, 2);

        $this->assertEmpty($result);
    }
}
