<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or courseify
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
 * Test classes for disguisebasic_disguise.
 *
 * @package disguise_basic
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->libdir . '/tests/fixtures/disguise/helper.php');

use \core\tests\fixtures\disguise as fixture;
use \core\disguise\helper as helper;

/**
 * Test classes for disguisebasic_disguise.
 *
 * @package disguise_basic
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguisebasic_disguise_testcase extends advanced_testcase {
    /**
     * Ensure that the displayname appears as expected.
     */
    public function test_displayname() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = \context_course::instance($course->id);

        // Creating a new disguise.
        fixture\helper::create($coursecontext, 'basic');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        // Check the displayname.
        $this->assertEquals(get_string('anonymous', 'disguise_basic'), \core_user::displayname($user, $coursecontext));
    }

    public function test_requires_user_configuration() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = \context_course::instance($course->id);

        // Creating a new disguise.
        fixture\helper::create($coursecontext, 'basic');

        $rc = new \ReflectionClass('\\disguise_basic\\disguise');
        $rcm = $rc->getMethod('requires_user_configuration');
        $rcm->setAccessible(true);

        $this->assertFalse($rcm->invoke($coursecontext->disguise));
    }

    public function test_add_disguise_navigation_without_capability() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        fixture\helper::create($coursecontext, 'basic');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        $this->setUser($user);

        $this->assertEmpty($coursecontext->disguise->add_disguise_navigation());
    }

    public function test_add_disguise_navigation_with_capability() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        fixture\helper::create($coursecontext, 'basic');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'manager');
        $this->setUser($user);

        $this->assertNotEmpty($coursecontext->disguise->add_disguise_navigation());
    }
}
