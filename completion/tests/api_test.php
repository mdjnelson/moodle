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
 * Test completion API.
 *
 * @package core_completion
 * @category test
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test completion API.
 *
 * @package core_completion
 * @category test
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_completion_api_testcase extends advanced_testcase {

    /**
     * Test setup.
     */
    public function setUp() {
        global $CFG;

        $CFG->enablecompletion = true;
        $this->resetAfterTest();
    }

    public function test_create_expected_completion_date_event() {
        global $DB;

        $this->setAdminUser();

        // Create a course.
        $course = $this->getDataGenerator()->create_course(array('enablecompletion' => 1));

        // Create a scorm activity.
        $time = time();
        $assign = $this->getDataGenerator()->create_module('assign', array('course' => $course->id),
            array(
                'completion' => 1,
                'completionexpected' => $time + DAYSECS
            )
        );

        // Check that there is now an event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(1, $events);

        // Get the event.
        $event = reset($events);

        // Confirm the event is correct.
        $this->assertEquals('assign', $event->modulename);
        $this->assertEquals($assign->id, $event->instance);
        $this->assertEquals(CALENDAR_EVENT_TYPE_ACTION, $event->type);
        $this->assertEquals(\core_completion\api::COMPLETION_EVENT_TYPE_DATE_COMPLETION_EXPECTED, $event->eventtype);
        $this->assertEquals($time + DAYSECS, $event->timestart);
        $this->assertEquals($time + DAYSECS, $event->timesort);
    }

    public function test_create_expected_completion_date_event_update() {
        global $DB;

        $this->setAdminUser();

        // Create a course.
        $course = $this->getDataGenerator()->create_course(array('enablecompletion' => 1));

        // Create a scorm activity.
        $time = time();
        $assign = $this->getDataGenerator()->create_module('assign', array('course' => $course->id),
            array(
                'completion' => 1,
                'completionexpected' => $time + DAYSECS
            )
        );

        // Check that there is now an event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(1, $events);

        // Update the module - add the necessary data before calling update_module().
        $assign->coursemodule = $assign->cmid;
        $assign->cmidnumber = $assign->cmid;
        $assign->visible = true;
        $assign->visibleoncoursepage = true;
        $assign->introeditor = array('text' => 'This is a module', 'format' => FORMAT_HTML, 'itemid' => 0);
        $assign->completionexpected = $time + DAYSECS + DAYSECS;

        // Update the module.
        update_module($assign);

        // Check that there is now an event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(1, $events);

        // Get the event.
        $event = reset($events);

        // Confirm the event has been updated.
        $this->assertEquals('assign', $event->modulename);
        $this->assertEquals($assign->id, $event->instance);
        $this->assertEquals(CALENDAR_EVENT_TYPE_ACTION, $event->type);
        $this->assertEquals(\core_completion\api::COMPLETION_EVENT_TYPE_DATE_COMPLETION_EXPECTED, $event->eventtype);
        $this->assertEquals($time + DAYSECS + DAYSECS, $event->timestart);
        $this->assertEquals($time + DAYSECS + DAYSECS, $event->timesort);
    }

    public function test_create_expected_completion_date_event_delete() {
        global $DB;

        $this->setAdminUser();

        // Create a course.
        $course = $this->getDataGenerator()->create_course(array('enablecompletion' => 1));

        // Create a scorm activity.
        $time = time();
        $assign = $this->getDataGenerator()->create_module('assign', array('course' => $course->id),
            array(
                'completion' => 1,
                'completionexpected' => $time + DAYSECS
            )
        );

        // Check that there is now an event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(1, $events);

        // Update the module - add the necessary data before calling update_module().
        $assign->coursemodule = $assign->cmid;
        $assign->cmidnumber = $assign->cmid;
        $assign->visible = true;
        $assign->visibleoncoursepage = true;
        $assign->introeditor = array('text' => 'This is a module', 'format' => FORMAT_HTML, 'itemid' => 0);
        $assign->completionexpected = 0;

        // Update the module.
        update_module($assign);

        // Check that there is no event in the database.
        $events = $DB->get_records('event');
        $this->assertCount(0, $events);
    }
}
