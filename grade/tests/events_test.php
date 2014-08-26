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
 * Events tests.
 *
 * @package    core_grade
 * @category   test
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class core_grade_events_testcase extends advanced_testcase {

    /**
     * Tests set up.
     */
    public function setUp() {
        $this->resetAfterTest();
    }

    /**
     * Test the grade created event.
     */
    public function test_grade_created() {
        // Create a course, student and assignment module.
        $course = $this->getDataGenerator()->create_course();
        $student = $this->getDataGenerator()->create_user();
        $assign = $this->getDataGenerator()->create_module('assign', array('course' => $course->id));

        // Create a grade item.
        $gi = grade_item::fetch(array('itemtype' => 'mod', 'itemmodule' => 'assign', 'iteminstance' => $assign->id,
            'courseid' => $course->id));
        $grade = new grade_grade();
        $grade->itemid = $gi->id;
        $grade->userid = $student->id;
        $grade->rawgrade = 50;
        $grade->finalgrade = 50;
        $grade->rawgrademax = 100;
        $grade->rawgrademin = 0;
        $grade->timecreated = time();
        $grade->timemodified = time();

        // Capture the grade created event.
        $sink = $this->redirectEvents();
        $gradeid = $grade->insert();
        $result = $sink->get_events();
        $event = reset($result);

        // Make sure the event data is valid.
        $this->assertInstanceOf('\core\event\grade_created', $event);
        $this->assertEquals(context_course::instance($course->id), $event->get_context());
        $this->assertEquals($gradeid, $event->objectid);
        $this->assertEquals($student->id, $event->relateduserid);
    }


    /**
     * Test the grade updated event.
     */
    public function test_grade_updated() {
        // Create a course, student and assignment module.
        $course = $this->getDataGenerator()->create_course();
        $student = $this->getDataGenerator()->create_user();
        $assign = $this->getDataGenerator()->create_module('assign', array('course' => $course->id));

        // Create a grade item.
        $gi = grade_item::fetch(array('itemtype' => 'mod', 'itemmodule' => 'assign', 'iteminstance' => $assign->id,
            'courseid' => $course->id));
        $grade = new grade_grade();
        $grade->itemid = $gi->id;
        $grade->userid = $student->id;
        $grade->rawgrade = 50;
        $grade->finalgrade = 50;
        $grade->rawgrademax = 100;
        $grade->rawgrademin = 0;
        $grade->timecreated = time();
        $grade->timemodified = time();

        // Insert the grade item.
        $gradeid = $grade->insert();

        // Capture the grade updated event.
        $sink = $this->redirectEvents();
        $grade->update();
        $result = $sink->get_events();
        $event = reset($result);

        // Make sure the event data is valid.
        $this->assertInstanceOf('\core\event\grade_updated', $event);
        $this->assertEquals(context_course::instance($course->id), $event->get_context());
        $this->assertEquals($gradeid, $event->objectid);
        $this->assertEquals($student->id, $event->relateduserid);
    }
}
