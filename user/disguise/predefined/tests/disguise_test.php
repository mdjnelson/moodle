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
 * Test classes for disguise_predefined_disguise.
 *
 * @package disguise_predefined
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
 * Test classes for disguise_predefined_disguise.
 *
 * @package disguise_predefined
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguise_predefined_disguise_testcase extends advanced_testcase {
    /**
     * Ensure that the displayname appears as expected.
     */
    public function test_displayname() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        // Add a name to the disguise.
        $modcontext->disguise->add_name('Kevin');

        // Check the displayname.
        $this->assertEquals('Kevin', \core_user::displayname($user, $modcontext));
    }

    /**
     * Ensure that the displayname appears as expected when called multiple times.
     */
    public function test_displayname_multiple() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create a user in the course.
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, 'student');
        $this->getDataGenerator()->enrol_user($user2->id, $course->id, 'student');

        // Add a name to the disguise.
        $availablenames = [
                'Kevin',
                'Jo',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // Check the displayname.
        $this->assertContains(\core_user::displayname($user1, $modcontext), $availablenames);
        $this->assertContains(\core_user::displayname($user2, $modcontext), $availablenames);
        $this->assertNotEquals(\core_user::displayname($user1, $modcontext), \core_user::displayname($user2, $modcontext));
    }

    public function test_displayname_none_available() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        $this->setExpectedException('\\disguise_predefined\\disguise_not_available_exception');

        // Check the displayname.
        \core_user::displayname($user, $modcontext);

    }

    public function test_get_user_mapping_performance() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create users.
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, 'student');
        $this->getDataGenerator()->enrol_user($user2->id, $course->id, 'student');

        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // Make the get_user_mapping function accessible for testing.
        $rc = new \ReflectionClass('\\disguise_predefined\\disguise');
        $rcm = $rc->getMethod('get_user_mapping');
        $rcm->setAccessible(true);

        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();

        // The first get_user_mapping will have three reads, one write:
        // read 1) fetch all existing mappings
        // read 2) fetch all unused mappings
        // read 3) metadata fetch for insert
        // write 1) insert new mapping.
        $rcm->invoke($modcontext->disguise, $user1);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(3, $reads - $initialreads);
        $this->assertEquals(1, $writes - $initialwrites);

        // Subsequent get_user_mapping will have one read, one write:
        // read 1) fetch all unused mappings
        // write 1) insert new mapping.
        $initialreads = $reads;
        $initialwrites = $writes;
        $rcm->invoke($modcontext->disguise, $user2);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(1, $reads - $initialreads);
        $this->assertEquals(1, $writes - $initialwrites);
    }

    public function test_get_user_mapping_performance_previously_mapped() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create users.
        $user1 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, 'student');

        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // Make the get_user_mapping function accessible for testing.
        $rc = new \ReflectionClass('\\disguise_predefined\\disguise');
        $rcm = $rc->getMethod('get_user_mapping');
        $rcm->setAccessible(true);

        $rcma = $rc->getMethod('select_random_name');
        $rcma->setAccessible(true);

        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();

        // Assigning a user should only lead to a single read + write (+ metadata read)
        $rcma->invoke($modcontext->disguise, $user1);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(2, $reads - $initialreads);
        $this->assertEquals(1, $writes - $initialwrites);

        // Subsequent fetching of that user should lead to no new reads.
        $initialreads = $reads;
        $initialwrites = $writes;
        $rcm->invoke($modcontext->disguise, $user1);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(0, $reads - $initialreads);
        $this->assertEquals(0, $writes - $initialwrites);
    }

    public function test_get_user_mapping_performance_previously_mapped_multiple() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create users.
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, 'student');
        $this->getDataGenerator()->enrol_user($user2->id, $course->id, 'student');
        $this->getDataGenerator()->enrol_user($user3->id, $course->id, 'student');

        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // Make the get_user_mapping function accessible for testing.
        $rc = new \ReflectionClass('\\disguise_predefined\\disguise');
        $rcm = $rc->getMethod('get_user_mapping');
        $rcm->setAccessible(true);

        $rcma = $rc->getMethod('select_random_name');
        $rcma->setAccessible(true);

        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();

        // Assign multiple users.
        $rcma->invoke($modcontext->disguise, $user1);
        $rcma->invoke($modcontext->disguise, $user2);
        $rcma->invoke($modcontext->disguise, $user3);
        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();

        // Subsequent fetching of those users should lead to no new reads.
        $rcm->invoke($modcontext->disguise, $user1);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(0, $reads - $initialreads);
        $this->assertEquals(0, $writes - $initialwrites);
    }

    public function test_get_user_mapping_performance_previously_mapped_multiple_new_session() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create users.
        $user1 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, 'student');

        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // Make the get_user_mapping function accessible for testing.
        $rc = new \ReflectionClass('\\disguise_predefined\\disguise');
        $rcm = $rc->getMethod('get_user_mapping');
        $rcm->setAccessible(true);

        $rcma = $rc->getMethod('select_random_name');
        $rcma->setAccessible(true);

        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();

        // Assign multiple users.
        $rcma->invoke($modcontext->disguise, $user1);

        // Reset the context cache and re-fetch the context.
        \context_helper::reset_caches();
        $modcontext = context_module::instance($forum->cmid);

        // Subsequent fetching of those users should lead to a single read.
        // Note: Fetch the disguise here to prevent polluting results.
        $this->assertInstanceOf('\\disguise_predefined\\disguise', $modcontext->disguise);
        $initialreads = $DB->perf_get_reads();
        $initialwrites = $DB->perf_get_writes();
        $rcm->invoke($modcontext->disguise, $user1);
        $reads = $DB->perf_get_reads();
        $writes = $DB->perf_get_writes();
        $this->assertEquals(1, $reads - $initialreads);
        $this->assertEquals(0, $writes - $initialwrites);
    }

    public function test_is_configured_for_user() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create user.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        $availablenames = [
                'Marge',
            ];
        foreach ($availablenames as $name) {
            $modcontext->disguise->add_name($name);
        }

        // We should get a random mapping for the specified user.
        $this->assertTrue($modcontext->disguise->is_configured_for_user($user));

        // Ensure that we can check the mapping with the current user too.
        $this->setUser($user);
        $this->assertTrue($modcontext->disguise->is_configured_for_user());
    }

    public function test_is_configured_for_user_none_available() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create user.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');

        // When no mappings have been created, the user should not be configured.
        $this->assertFalse($modcontext->disguise->is_configured_for_user($user));
    }

    public function test_is_configured_for_user_none_available_allow_configuration() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'predefined');

        // Create user.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'manager');

        // When no mappings have been created, the user should not be redirected to the configuration page instead.
        $this->setExpectedException('moodle_exception', 'Unsupported redirect detected, script execution terminated');
        $modcontext->disguise->is_configured_for_user($user);
    }

    public function test_get_all_names() {
        $this->resetAfterTest();

        $course1 = $this->getDataGenerator()->create_course();
        $course1context = context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course();
        $course2context = context_course::instance($course2->id);

        // Creating new disguises.
        fixture\helper::create($course1context, 'predefined');
        fixture\helper::create($course2context, 'predefined');

        // Add some names to one of the contexts.
        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $course1context->disguise->add_name($name);
        }

        // All names should be returned from course1's disguise.
        $course1names = $course1context->disguise->get_all_names('name');
        $this->assertCount(count($availablenames), $course1names);
        foreach ($course1names as $name) {
            $this->assertContains($name->name, $availablenames);
            $this->assertEmpty($name->assigned);
            unset($availablenames[$name->name]);
        }

        // There should be no names against course2's disguise.
        $course2names = $course2context->disguise->get_all_names();
        $this->assertCount(0, $course2names);
    }

    public function test_get_name() {
        $this->resetAfterTest();

        $course1 = $this->getDataGenerator()->create_course();
        $course1context = context_course::instance($course1->id);
        fixture\helper::create($course1context, 'predefined');

        // Add some names to one of the contexts.
        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        foreach ($availablenames as $name) {
            $course1context->disguise->add_name($name);
        }

        foreach ($course1context->disguise->get_all_names() as $name) {
            $getname = $course1context->disguise->get_name($name->id);
            $this->assertEquals($name, $getname);
            $this->assertEmpty($getname->assigned);
        }
    }

    public function test_get_name_assigned() {
        $this->resetAfterTest();

        $course1 = $this->getDataGenerator()->create_course();
        $course1context = context_course::instance($course1->id);
        fixture\helper::create($course1context, 'predefined');

        // Add some names to one of the contexts.
        $availablenames = [
                'Marge',
            ];
        foreach ($availablenames as $name) {
            $course1context->disguise->add_name($name);
        }

        // Create a user with and assign the name.
        $user1 = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user1->id, $course1->id, 'student');
        \core_user::displayname($user1, $course1context);

        foreach ($course1context->disguise->get_all_names() as $name) {
            $getname = $course1context->disguise->get_name($name->id);
            $this->assertEquals($name, $getname);
            // Note. The assigned field does _not_ contain the userid, but the mapping it.
            $this->assertNotEmpty($getname->assigned);
        }
    }

    public function test_add_names() {
        $this->resetAfterTest();

        $course1 = $this->getDataGenerator()->create_course();
        $course1context = context_course::instance($course1->id);
        fixture\helper::create($course1context, 'predefined');

        $availablenames = [
                'Marge',
                'Homer',
                'Lisa',
                'Bart',
                'Maggie',
            ];
        $course1context->disguise->add_names($availablenames);

        foreach ($course1context->disguise->get_all_names() as $name) {
            $this->assertContains($name->name, $availablenames);
            unset($availablenames[$name->name]);
        }
    }

    public function test_add_disguise_navigation_without_capability() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        fixture\helper::create($coursecontext, 'predefined');

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
        fixture\helper::create($coursecontext, 'predefined');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($user->id, $course->id, 'manager');
        $this->setUser($user);

        $this->assertNotEmpty($coursecontext->disguise->add_disguise_navigation());
    }
}
