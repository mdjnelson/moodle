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
 * Test the enrolment of users.
 *
 * @package enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/enrol/lti/locallib.php');

/**
 * Test the enrolment of users.
 *
 * @package enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_lti_enrol_user_testcase extends advanced_testcase {

    /**
     * @var stdClass $user1 A user.
     */
    public $user1;

    /**
     * @var stdClass $user2 A user.
     */
    public $user2;

    /**
     * Test set up.
     *
     * This is executed before running any test in this file.
     */
    public function setUp() {
        global $DB;

        $this->resetAfterTest();

        // Set this user as the admin.
        $this->setAdminUser();

        // Get some of the information we need.
        $this->user1 = self::getDataGenerator()->create_user();
        $this->user2 = self::getDataGenerator()->create_user();
    }

    /**
     * Test that we can not enrol past the maximum allowed.
     */
    public function test_enrol_user_max_enrolled() {
        global $DB;

        // Set up the LTI enrolment.
        $data = new stdClass();
        $data->maxenrolled = 1;
        $tool = $this->create_tool($data);

        // Enrol a user.
        $result = enrol_lti_enrol_user($tool, $this->user1);

        // Check that this user was enrolled.
        $this->assertEquals(true, $result);
        $this->assertEquals(1, $DB->count_records('user_enrolments', array('enrolid' => $tool->enrolid)));

        // This should not happen.
        $result = enrol_lti_enrol_user($tool, $this->user2);

        // Check that this user was not enrolled.
        $this->assertEquals(ENROL_LTI_MAX_ENROLLED, $result);
        $this->assertEquals(1, $DB->count_records('user_enrolments', array('enrolid' => $tool->enrolid)));
    }

    /**
     * Test that we can not enrol when the enrolment has not started.
     */
    public function test_enrol_user_enrolment_not_started() {
        global $DB;

        // Set up the LTI enrolment.
        $data = new stdClass();
        $data->enrolstartdate = time() + DAYSECS; // Make sure it is in the future.
        $tool = $this->create_tool($data);

        // Enrol a user.
        $result = enrol_lti_enrol_user($tool, $this->user1);

        // Check that this user was enrolled.
        $this->assertEquals(ENROL_LTI_ENROLMENT_NOT_STARTED, $result);
        $this->assertEquals(0, $DB->count_records('user_enrolments', array('enrolid' => $tool->enrolid)));
    }

    /**
     * Test that we can not enrol when the enrolment has not started.
     */
    public function test_enrol_user_enrolment_finished() {
        global $DB;

        // Set up the LTI enrolment.
        $data = new stdClass();
        $data->enrolenddate = time() - DAYSECS; // Make sure it is in the past.
        $tool = $this->create_tool($data);

        // Enrol a user.
        $result = enrol_lti_enrol_user($tool, $this->user1);

        // Check that this user was enrolled.
        $this->assertEquals(ENROL_LTI_ENROLMENT_FINISHED, $result);
        $this->assertEquals(0, $DB->count_records('user_enrolments', array('enrolid' => $tool->enrolid)));
    }

    /**
     * Helper function used to create a tool.
     *
     * @param stdClass $data
     * @return stdClass the tool
     */
    protected function create_tool($data) {
        global $DB;

        $studentrole = $DB->get_record('role', array('shortname' => 'student'));
        $teacherrole = $DB->get_record('role', array('shortname' => 'teacher'));

        // Create a course.
        $course = $this->getDataGenerator()->create_course();

        // Add some extra necessary fields to the data.
        $data->status = ENROL_INSTANCE_ENABLED;
        $data->name = 'Test LTI';
        $data->contextid = context_course::instance($course->id)->id;
        $data->roleinstructor = $studentrole->id;
        $data->rolelearner = $teacherrole->id;

        // Get the enrol LTI plugin.
        $enrolplugin = enrol_get_plugin('lti');
        $instanceid = $enrolplugin->add_instance($course, (array) $data);

        // Get the tool associated with this instance.
        return $DB->get_record('enrol_lti_tools', array('enrolid' => $instanceid));
    }
}
