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
 * @package    core_grades
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
     * Test the grade_* events.
     */
    public function test_grade_xxx_events() {
        // Create a course.
        $course = $this->getDataGenerator()->create_course();

        // Create a user.
        $user = $this->getDataGenerator()->create_user();

        // Enrol the user into the course.
        $this->getDataGenerator()->enrol_user($user->id, $course->id);

        // Create a quiz in the course.
        $quiz = $this->getDataGenerator()->create_module('quiz', array('course' => $course->id));

        // Now mark the quiz using grade_update as this is the function that modules use.
        $grade = array();
        $grade['userid'] = $user->id;
        $grade['rawgrade'] = 50;
        grade_update('mod/quiz', $course->id, 'mod', 'quiz', $quiz->id, 0, $grade);

        $sink = $this->redirectEvents();
        grade_cron();
        $events = $sink->get_events();
        $event = reset($events);
        $sink->close();

        // Ensure we have a grade created event.
        $this->assertInstanceOf('\core\event\grade_created', $event);

        // Now we want to update the submission.
        $grade['rawgrade'] = 70;
        grade_update('mod/quiz', $course->id, 'mod', 'quiz', $quiz->id, 0, $grade);

        $sink = $this->redirectEvents();
        grade_cron();
        $events = $sink->get_events();
        $event = reset($events);
        $sink->close();

        // Ensure we have a grade updated event.
        $this->assertInstanceOf('\core\event\grade_updated', $event);

        // Now we want to remove the grade.
        $grade['rawgrade'] = null;
        grade_update('mod/quiz', $course->id, 'mod', 'quiz', $quiz->id, 0, $grade);

        $sink = $this->redirectEvents();
        grade_cron();
        $events = $sink->get_events();
        $event = reset($events);
        $sink->close();

        // Ensure we have a grade deleted event.
        $this->assertInstanceOf('\core\event\grade_deleted', $event);
    }
}
