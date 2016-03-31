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
 * Test classes for \core\disguise\disguise.
 *
 * @package core_disguise
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
 * Test classes for \core\disguise\helper.
 *
 * @package core_disguise
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_disguise_helper_testcase extends advanced_testcase {

    /**
     * Test successful creation workflow.
     */
    public function test_creation() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        $this->assertEquals(0, $DB->count_records('disguises'));
        $disguise = fixture\helper::create($modcontext, 'basic');

        // We should now have a disguise record.
        $this->assertEquals(1, $DB->count_records('disguises'));
        $this->assertInstanceOf('\\core\\disguise\\disguise', $disguise);
        $this->assertInstanceOf('\\disguise_basic\\disguise', $disguise);

        // The disguise should now be present on the context.
        $this->assertEquals($disguise, $modcontext->disguise);
    }

    /**
     * Ensure that attempting to create a duplicate disguise leads to an exception.
     */
    public function test_creation_of_duplicate() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'basic');

        $this->setExpectedException('\\moodle_exception', 'Disguise is aready set for this context');
        fixture\helper::create($modcontext, 'basic');
    }

    /**
     * Ensure that attempting to create a disguise for an unknown type leads to an exception.
     */
    public function test_creation_of_unknown_type() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        $this->setExpectedException('\\coding_exception', 'Unknown disguise type');
        fixture\helper::create($modcontext, '_invalid_type_');
    }

    /**
     * Ensure that ::instance() returns the correct disguise.
     */
    public function test_instance() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Create a new disguise.
        $disguise = fixture\helper::create($modcontext, 'basic');

        // The disguise should now be present on the context.
        $this->assertEquals($disguise, helper::instance($modcontext));
    }

    /**
     * Ensure that ::instance() excepts when no disguise was found.
     */
    public function test_instance_exception() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Modify the context's disguiseid.
        $rc = new \ReflectionClass('\\context_module');
        $rcp = $rc->getProperty('_disguiseid');
        $rcp->setAccessible(true);
        $rcp->setValue($modcontext, -1);

        $this->setExpectedException('\\coding_exception', 'Disguise not found');
        helper::instance($modcontext);
    }

    /**
     * Ensure that ::instance() returns no disuise when a disguise type has been set.
     */
    public function test_instance_unset() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);

        // Create a new disguise.
        $disguise = fixture\helper::create($coursecontext, 'basic');
        $data = $disguise->to_record();
        $data->type = '';
        $DB->update_record('disguises', $data);

        $this->assertNull(helper::instance($coursecontext));
    }

    /**
     * Ensure that ::instance() excepts when an unknown disguise is set.
     */
    public function test_instance_unknown() {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);

        // Create a new disguise.
        $disguise = fixture\helper::create($coursecontext, 'basic');
        $data = $disguise->to_record();
        $data->type = 'unknown';
        $DB->update_record('disguises', $data);

        $this->setExpectedException('\\coding_exception', 'Disguise not found');
        helper::instance($coursecontext);
    }

    /**
     * Ensure that disguises are inheritted from their parent contexts.
     */
    public function test_instance_inheritance() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Create a new disguise.
        $disguise = fixture\helper::create($coursecontext, 'basic');

        // The disguise should now be present on the course.
        $this->assertEquals($disguise, helper::instance($coursecontext));

        // The same disguise will be present on the modcontext, but will have a different context property so cannot be
        // compared exactly.
        $moddisguise = helper::instance($modcontext);
        $this->assertEquals($disguise->get_id(), $moddisguise->get_id());
    }

    /**
     * Test one disguise in multiple contexts.
     */
    public function test_multiple_contexts() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum1 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod1context = context_module::instance($forum1->cmid);
        $forum2 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod2context = context_module::instance($forum2->cmid);

        // Create a new disguise on forum1.
        $disguise = fixture\helper::create($mod1context, 'basic');

        // Set the same disguise against forum2.
        $mod2context->set_disguise($disguise);

        // The same disguise will now be present in both places.
        $mod1disguise = helper::instance($mod1context);
        $mod2disguise = helper::instance($mod2context);
        $this->assertEquals($disguise->get_id(), $mod1disguise->get_id());
        $this->assertEquals($disguise->get_id(), $mod2disguise->get_id());

        // Both will be listed in fetch_applicable_contexts().
        $contexts = helper::fetch_applicable_contexts($disguise->get_id());
        $this->assertCount(2, $contexts);
        $contextids = [
                $mod1context->id,
                $mod2context->id,
            ];
        foreach ($contexts as $context) {
            $this->assertContains($context->id, $contextids);
        }
    }

    /**
     * Test one disguise in multiple contexts where the user can configure the disguise in at least one of those instances.
     */
    public function test_can_configure_disguise_in_multiple_contexts_mixed() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum1 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod1context = context_module::instance($forum1->cmid);

        $forum2 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod2context = context_module::instance($forum2->cmid);
        assign_capability('moodle/disguise:configure', CAP_ALLOW, $roleid, $mod2context->id);

        // Create a new disguise on forum1.
        $disguise = fixture\helper::create($mod1context, 'basic');

        // Set the same disguise against forum2.
        $mod2context->set_disguise($disguise);

        // The user should be able to configure the disguise because they have configure rights against mod2context.
        $this->setUser($user);
        $this->assertTrue(helper::can_configure_disguise($disguise->get_id()));
        $this->assertTrue(helper::require_configure_disguise($disguise->get_id()));
    }

    /**
     * Test one disguise in multiple contexts where the user cannot configure the disguise.
     */
    public function test_can_configure_disguise_in_multiple_contexts_no_access() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum1 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod1context = context_module::instance($forum1->cmid);

        $forum2 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod2context = context_module::instance($forum2->cmid);

        // Create a new disguise on forum1.
        $disguise = fixture\helper::create($mod1context, 'basic');

        // Set the same disguise against forum2.
        $mod2context->set_disguise($disguise);

        // The user should not be able to configure the disguise.
        $this->setUser($user);
        $this->assertFalse(helper::can_configure_disguise($disguise->get_id()));

        $this->setExpectedException('\\required_capability_exception');
        helper::require_configure_disguise($disguise->get_id());
    }

    /**
     * Test fetching of the preferred disguise is always returned if only * one is set.
     */
    public function test_get_preferred_context_single_context() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        assign_capability('moodle/disguise:configure', CAP_ALLOW, $roleid, $modcontext->id);
        $disguise = fixture\helper::create($modcontext, 'basic');

        // The user should be able to configure the disguise because they have configure rights against mod2context.
        $this->setUser($user);
        $this->assertEquals($modcontext, helper::get_preferred_context($disguise->get_id()));
    }

    /**
     * Test fetching of the preferred disguise is always returned if only * one is set.
     */
    public function test_get_preferred_context_single_context_without_capability() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        assign_capability('moodle/disguise:configure', CAP_PROHIBIT, $roleid, $modcontext->id);
        $disguise = fixture\helper::create($modcontext, 'basic');

        // The user should be able to configure the disguise because they have configure rights against mod2context.
        $this->setUser($user);
        $this->assertEquals($modcontext, helper::get_preferred_context($disguise->get_id()));
    }

    /**
     * Test fetching of the preferred disguise is always the first one with configure capability.
     */
    public function test_get_preferred_context_multiple_contexts_with_capability() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum1 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod1context = context_module::instance($forum1->cmid);
        $disguise = fixture\helper::create($mod1context, 'basic');

        $forum2 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod2context = context_module::instance($forum2->cmid);
        $mod2context->set_disguise($disguise);
        assign_capability('moodle/disguise:configure', CAP_ALLOW, $roleid, $mod2context->id);

        $forum3 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod3context = context_module::instance($forum3->cmid);
        $mod3context->set_disguise($disguise);

        $forum4 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod4context = context_module::instance($forum4->cmid);
        $mod4context->set_disguise($disguise);

        // The user should be able to configure the disguise because they have configure rights against mod2context.
        $this->setUser($user);
        $this->assertEquals($mod2context, helper::get_preferred_context($disguise->get_id()));
    }

    /**
     * Test fetching of the preferred disguise is always the first one without configure capability.
     */
    public function test_get_preferred_context_multiple_contexts_without_capability() {
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $forum1 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod1context = context_module::instance($forum1->cmid);
        $disguise = fixture\helper::create($mod1context, 'basic');

        $forum2 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod2context = context_module::instance($forum2->cmid);
        $mod2context->set_disguise($disguise);

        $forum3 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod3context = context_module::instance($forum3->cmid);
        $mod3context->set_disguise($disguise);

        $forum4 = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $mod4context = context_module::instance($forum4->cmid);
        $mod4context->set_disguise($disguise);

        // The oldest context should be returned.
        $this->setUser($user);
        $this->assertEquals($mod1context, helper::get_preferred_context($disguise->get_id()));
    }

    /**
     * Test that users are configured in contexts without a disguise.
     */
    public function test_is_configured_for_user_in_context_without_disguise() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user = $this->getDataGenerator()->create_user();

        $this->assertTrue(helper::is_configured_for_user_in_context($coursecontext, $user));
    }

    /**
     * Test that contexts with a disguise check the disguise's is_configured_for_user function.
     */
    public function test_is_configured_for_user_in_context_with_disguise() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user = $this->getDataGenerator()->create_user();

        // Mock the disguise.
        $stub = $this->getMockBuilder('\\core\\disguise\\disguise')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->expects($this->once())
            ->method('is_configured_for_user')
            ->with($this->equalTo($user))
            ;

        // Attach the mock to the context.
        $rc = new \ReflectionClass('\\context_course');
        $rcp = $rc->getProperty('_disguise');
        $rcp->setAccessible(true);
        $rcp->setValue($coursecontext, $stub);

        helper::is_configured_for_user_in_context($coursecontext, $user);
    }

    /**
     * Test that users are configured in contexts without a disguise.
     */
    public function test_ensure_configured_for_user_in_context_without_disguise() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user = $this->getDataGenerator()->create_user();

        $this->assertTrue(helper::ensure_configured_for_user_in_context($coursecontext, $user));
    }

    /**
     * Test that contexts with a disguise check the disguise's ensure_configured_for_user function.
     */
    public function test_ensure_configured_for_user_in_context_with_disguise() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        // Mock the disguise.
        $stub = $this->getMockBuilder('\\core\\disguise\\disguise')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->expects($this->once())
            ->method('is_configured_for_user')
            ->with($this->equalTo($user2))
            ->willReturn(true)
            ;

        $this->setUser($user1);

        // Attach the mock to the context.
        $rc = new \ReflectionClass('\\context_course');
        $rcp = $rc->getProperty('_disguise');
        $rcp->setAccessible(true);
        $rcp->setValue($coursecontext, $stub);

        $this->assertTrue(helper::ensure_configured_for_user_in_context($coursecontext, $user2));
    }

    /**
     * Test that contexts with a disguise check the disguise's ensure_configured_for_user function.
     */
    public function test_ensure_configured_for_user_in_context_with_disguise_current_user() {
        global $USER;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user1 = $this->getDataGenerator()->create_user();

        $this->setUser($user1);

        // Mock the disguise.
        $stub = $this->getMockBuilder('\\core\\disguise\\disguise')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->expects($this->once())
            ->method('is_configured_for_user')
            ->with($this->equalTo($USER))
            ->willReturn(true)
            ;

        // Attach the mock to the context.
        $rc = new \ReflectionClass('\\context_course');
        $rcp = $rc->getProperty('_disguise');
        $rcp->setAccessible(true);
        $rcp->setValue($coursecontext, $stub);

        $this->assertTrue(helper::ensure_configured_for_user_in_context($coursecontext));
    }

}
