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
 * Test classes for \core\disguise\disguise.
 *
 * @package core_disguise
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_disguise_testcase extends advanced_testcase {
    /**
     * Provider for can_enable_disguiselock.
     *
     * @return  array
     */
    public function can_enable_disguiselock_provider() {
        return [
            'Disguise is locked' => [
                'locked'        => true,
                'expectation'   => false,
            ],
            'Disguise is unlocked' => [
                'locked'        => false,
                'expectation'   => true,
            ],
        ];
    }

    /**
     * Test disguise can_enable_disguiselock.
     *
     * @dataProvider can_enable_disguiselock_provider
     */
    public function test_can_enable_disguiselock($locked, $expectation) {
        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');
        $rcp = $rc->getProperty('lockdisguise');
        $rcp->setAccessible(true);
        $rcp->setValue($mock, $locked);

        $this->assertEquals($expectation, $mock->can_enable_disguiselock());
    }

    /**
     * Provider for can_disable_disguiselock.
     *
     * @return  array
     */
    public function can_disable_disguiselock_provider() {
        return [
            'User has capability' => [
                'capability'    => true,
                'expectation'   => true,
            ],
            'User does not have capability' => [
                'capability'    => false,
                'expectation'   => false,
            ],
        ];
    }

    /**
     * Test disguise can_disable_disguiselock.
     *
     * @dataProvider can_disable_disguiselock_provider
     */
    public function test_can_disable_disguiselock($hascapability, $expectation) {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $disguise = fixture\helper::create($coursecontext, 'basic');

        if ($hascapability) {
            assign_capability('moodle/disguise:disablelock', CAP_ALLOW, $roleid, $coursecontext->id);
        }

        $this->setUser($user);

        $this->assertEquals($expectation, $disguise->can_disable_disguiselock());
    }

    /**
     * Data provider for should_show_real_identity.
     *
     * @return  array
     */
    public function should_show_real_identity_provider() {
        return [
            'Identity always shown' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_SHOWN,
                'disabledisguisefrom'   => null,
                'cantoggle'             => null,
                'istoggled'             => null,
                'expectation'           => true,
            ],
            'Identity shown after time in past (previously hidden)' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'disabledisguisefrom'   => time() - DAYSECS,
                'cantoggle'             => null,
                'istoggled'             => null,
                'expectation'           => true,
            ],
            'Identity shown after time in past (previously restricted)' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_RESTRICTED,
                'disabledisguisefrom'   => time() - DAYSECS,
                'cantoggle'             => null,
                'istoggled'             => null,
                'expectation'           => true,
            ],
            'Identity is currently revealed' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'disabledisguisefrom'   => 0,
                'cantoggle'             => true,
                'istoggled'             => true,
                'expectation'           => true,
            ],
            'Identity is not currently revealed' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'disabledisguisefrom'   => 0,
                'cantoggle'             => true,
                'istoggled'             => false,
                'expectation'           => false,
            ],
            'Identity is not revealable' => [
                'showrealidentity'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'disabledisguisefrom'   => 0,
                'cantoggle'             => false,
                'istoggled'             => false,
                'expectation'           => false,
            ],
        ];
    }

    /**
     * Test the situations when the user identity should be revealed.
     *
     * @dataProvider should_show_real_identity_provider
     */
    public function test_should_show_real_identity($showrealidentity, $disabledisguisefrom, $cantoggle, $istoggled, $expectation) {
        global $SESSION, $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);

        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        $rcps->setValue($mock, $showrealidentity);

        $rcpd = $rc->getProperty('disabledisguisefrom');
        $rcpd->setAccessible(true);
        $rcpd->setValue($mock, $disabledisguisefrom);

        if ($cantoggle) {
            assign_capability('moodle/disguise:revealidentity', CAP_ALLOW, $roleid, $modcontext->id);
            $SESSION->disguiserevealed = $istoggled;
        }

        $this->assertEquals($expectation, $mock->should_show_real_identity());
    }

    /**
     * Data provider for can_toggle_real_identity.
     *
     * @return  array
     */
    public function can_toggle_real_identity_provider() {
        return [
            'Hidden: Always hidden' => [
                'revealcap'     => false,
                'showreal'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'showcap'       => false,
                'expectation'   => false,
            ],
            'Hidden: Always hidden even with show cap' => [
                'revealcap'     => false,
                'showreal'      => \core\disguise\helper::IDENTITY_HIDDEN,
                'showcap'       => true,
                'expectation'   => false,
            ],
            'Hidden: Restricted but no cap' => [
                'revealcap'     => false,
                'showreal'      => \core\disguise\helper::IDENTITY_RESTRICTED,
                'showcap'       => false,
                'expectation'   => false,
            ],
            'Visible: Restricted with cap' => [
                'revealcap'     => false,
                'showreal'      => \core\disguise\helper::IDENTITY_RESTRICTED,
                'showcap'       => true,
                'expectation'   => true,
            ],
            'Visible: Restricted with reveal cap' => [
                'revealcap'     => true,
                'showreal'      => \core\disguise\helper::IDENTITY_RESTRICTED,
                'showcap'       => false,
                'expectation'   => true,
            ],
        ];
    }

    /**
     * Test the situations when the user can toggle identity reveal
     *
     * @dataProvider can_toggle_real_identity_provider
     */
    public function test_can_toggle_real_identity($hasrevealcap, $showrealidentity, $hasshowcap, $expectation) {
        global $SESSION, $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        $rcps->setValue($mock, $showrealidentity);

        if ($hasrevealcap) {
            assign_capability('moodle/disguise:revealidentity', CAP_ALLOW, $roleid, $modcontext->id);
        }

        if ($hasshowcap) {
            assign_capability('moodle/disguise:showidentity', CAP_ALLOW, $roleid, $modcontext->id);
        }

        $this->assertEquals($expectation, $mock->can_toggle_real_identity());
    }

    /**
     * Test the situations when the user can toggle identity reveal
     *
     * @dataProvider can_toggle_real_identity_provider
     */
    public function test_require_toggle_real_identity($hasrevealcap, $showrealidentity, $hasshowcap, $expectation) {
        global $SESSION, $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        $rcps->setValue($mock, $showrealidentity);

        if ($hasrevealcap) {
            assign_capability('moodle/disguise:revealidentity', CAP_ALLOW, $roleid, $modcontext->id);
        }

        if ($hasshowcap) {
            assign_capability('moodle/disguise:showidentity', CAP_ALLOW, $roleid, $modcontext->id);
        }

        if ($expectation) {
            $this->assertTrue($expectation, $mock->require_toggle_real_identity());
        } else {
            $this->setExpectedException('required_capability_exception');
            $mock->require_toggle_real_identity();
        }
    }

    /**
     * Data provider for should_use_disguise.
     *
     * @return  array
     */
    public function should_use_disguise_provider() {
        return [
            'No: Disabled and no options' => [
                'mode'          => \core\disguise\helper::DISGUISE_DISABLED,
                'options'       => [],
                'expectation'   => false,
            ],
            'No: Disabled and not forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_DISABLED,
                'options'       => ['forcedisguise' => false],
                'expectation'   => false,
            ],
            'No: Disabled and forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_DISABLED,
                'options'       => ['forcedisguise' => true],
                'expectation'   => false,
            ],
            'No: Optional and no options' => [
                'mode'          => \core\disguise\helper::DISGUISE_OPTIONAL,
                'options'       => [],
                'expectation'   => false,
            ],
            'No: Optional and not forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_OPTIONAL,
                'options'       => ['forcedisguise' => false],
                'expectation'   => false,
            ],
            'Yes: Optional and forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_OPTIONAL,
                'options'       => ['forcedisguise' => true],
                'expectation'   => true,
            ],
            'Yes: Forced and no options' => [
                'mode'          => \core\disguise\helper::DISGUISE_FORCED,
                'options'       => [],
                'expectation'   => true,
            ],
            'Yes: Forced and not forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_FORCED,
                'options'       => ['forcedisguise' => false],
                'expectation'   => true,
            ],
            'Yes: Forced and forced by option' => [
                'mode'          => \core\disguise\helper::DISGUISE_FORCED,
                'options'       => ['forcedisguise' => true],
                'expectation'   => true,
            ],
        ];
    }

    /**
     * Test the should_use_disguise function.
     *
     * @dataProvider should_use_disguise_provider
     */
    public function test_should_use_disguise($mode, $options, $expectation) {
        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        // Set the mode.
        $rcpm = $rc->getProperty('mode');
        $rcpm->setAccessible(true);
        $rcpm->setValue($mock, $mode);

        // The should_use_disguise function is protected - alter it with some reflection.
        $rcm = $rc->getMethod('should_use_disguise');
        $rcm->setAccessible(true);
        $this->assertEquals($expectation, $rcm->invoke($mock, $options));
    }

    /**
     * Data provider for displayname.
     *
     * @return  array
     */
    public function displayname_provider() {
        return [
            'No disguise in use' => [
                'usedisguise'                   => false,
                'showreal'                      => false,
                'expectdisguiseddisplaycall'    => false,
                'expectcoredisplayname'         => true,
            ],

            'Disguise with real name' => [
                'usedisguise'                   => true,
                'showreal'                      => true,
                'expectdisguiseddisplaycall'    => true,
                'expectcoredisplayname'         => true,
            ],

            'Disguise without real name' => [
                'usedisguise'                   => true,
                'showreal'                      => false,
                'expectdisguiseddisplaycall'    => true,
                'expectcoredisplayname'         => false,
            ],
        ];
    }

    /**
     * Test the displayname function.
     *
     * @dataProvider displayname_provider
     */
    public function test_displayname($usedisguise, $showrealidentity, $expectdisguiseddisplaycall, $expectcoredisplayname) {
        global $DB;
        $this->resetAfterTest();

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        // Set the mode based on whether to use the disguise.
        $rcpm = $rc->getProperty('mode');
        $rcpm->setAccessible(true);
        if ($usedisguise) {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_FORCED);
        } else {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_DISABLED);
        }

        // Set the showrealidentity based on whether to show it.
        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        if ($showrealidentity) {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_SHOWN);
        } else {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_HIDDEN);
        }

        if ($expectdisguiseddisplaycall) {
            $count = $this->once();
        } else {
            $count = $this->never();
        }

        $disguisevalue = 'Example disguise name';
        $mock
            ->expects($count)
            ->method('disguise_displayname')
            ->willReturn($disguisevalue);

        // The should_use_disguise function is protected - alter it with some reflection.
        if ($expectcoredisplayname) {
            if ($expectdisguiseddisplaycall) {
                $this->assertEquals(
                    get_string('disguisewithreal', 'moodle', (object) [
                            'disguise'  => $disguisevalue,
                            'fullname'  => \core_user::_displayname($user, $modcontext, []),
                        ]),
                    $mock->displayname($user, [])
                );
            } else {
                $this->assertEquals(\core_user::_displayname($user, $modcontext, []), $mock->displayname($user, []));
            }
        } else {
            $this->assertEquals($disguisevalue, $mock->displayname($user, []));
        }
    }

    /**
     * Data provider for allow_* functions.
     *
     * @return  array
     */
    public function allow_provider() {
        return [
            'No disguise in use' => [
                'usedisguise'       => false,
                'showreal'          => false,
                'expectation'       => true,
            ],

            'Disguise with real name' => [
                'usedisguise'       => true,
                'showreal'          => true,
                'expectation'       => true,
            ],

            'Disguise without real name' => [
                'usedisguise'       => true,
                'showreal'          => false,
                'expectation'       => false,
            ],
        ];
    }

    /**
     * Test the displayname function.
     *
     * @dataProvider allow_provider
     */
    public function test_allow_profile_links($usedisguise, $showrealidentity, $expectation) {
        global $DB;
        $this->resetAfterTest();

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        // Set the mode based on whether to use the disguise.
        $rcpm = $rc->getProperty('mode');
        $rcpm->setAccessible(true);
        if ($usedisguise) {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_FORCED);
        } else {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_DISABLED);
        }

        // Set the showrealidentity based on whether to show it.
        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        if ($showrealidentity) {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_SHOWN);
        } else {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_HIDDEN);
        }

        // The should_use_disguise function is protected - alter it with some reflection.
        $this->assertEquals($expectation, $mock->allow_profile_links($user, []));
    }

    /**
     * Test the displayname function.
     *
     * @dataProvider allow_provider
     */
    public function test_allow_messaging($usedisguise, $showrealidentity, $expectation) {
        global $DB;
        $this->resetAfterTest();

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        $this->setUser($user);

        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        // Set the mode based on whether to use the disguise.
        $rcpm = $rc->getProperty('mode');
        $rcpm->setAccessible(true);
        if ($usedisguise) {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_FORCED);
        } else {
            $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_DISABLED);
        }

        // Set the showrealidentity based on whether to show it.
        $rcps = $rc->getProperty('showrealidentity');
        $rcps->setAccessible(true);
        if ($showrealidentity) {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_SHOWN);
        } else {
            $rcps->setValue($mock, \core\disguise\helper::IDENTITY_HIDDEN);
        }

        // The should_use_disguise function is protected - alter it with some reflection.
        $this->assertEquals($expectation, $mock->allow_messaging($user, []));
    }

    /**
     * Data provider for is_configured_for_user_provider function.
     *
     * @return  array
     */
    public function is_configured_for_user_provider() {
        return [
            'Configuration not required (current user)' => [
                'requireconfig'     => false,
                'specifyuser'       => false,
                'expectation'       => true,
            ],

            'Configuration not required (specified user)' => [
                'requireconfig'     => false,
                'specifyuser'       => true,
                'expectation'       => true,
            ],

            'Configuration required (current user)' => [
                'requireconfig'     => true,
                'specifyuser'       => false,
                'expectation'       => false,
            ],

            'Configuration required (specified user)' => [
                'requireconfig'     => true,
                'specifyuser'       => true,
                'expectation'       => false,
            ],
        ];
    }

    /**
     * @dataProvider is_configured_for_user_provider
     */
    public function test_is_configured_for_user($requireconfig, $specifyuser, $expectation) {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, $roleid);
        $this->getDataGenerator()->enrol_user($user2->id, $course->id, $roleid);

        $this->setUser($user1);

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $mock->expects($this->once())
            ->method('requires_user_configuration')
            ->will($this->returnValue($requireconfig));

        $rc = new \ReflectionClass('\\core\\disguise\\disguise');
        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        if ($specifyuser) {
            $this->assertEquals($expectation, $mock->is_configured_for_user($user2));
        } else {
            $this->assertEquals($expectation, $mock->is_configured_for_user());
        }

    }

    /**
     * @dataProvider is_configured_for_user_provider
     */
    public function test_ensure_configured_for_user($requireconfig, $specifyuser, $expectation) {
        global $DB;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user1->id, $course->id, $roleid);
        $this->getDataGenerator()->enrol_user($user2->id, $course->id, $roleid);

        $this->setUser($user1);

        $mock = $this->getMockForAbstractClass('\\core\\disguise\\disguise', [], '', false);
        $mock->expects($this->once())
            ->method('requires_user_configuration')
            ->will($this->returnValue($requireconfig));

        $rc = new \ReflectionClass('\\core\\disguise\\disguise');
        $rcpc = $rc->getProperty('context');
        $rcpc->setAccessible(true);
        $rcpc->setValue($mock, $modcontext);

        if (!$expectation) {
            $this->setExpectedException('moodle_exception', 'Unsupported redirect detected, script execution terminated');
        }

        $result = $mock->ensure_configured_for_user($user2);

        if ($expectation) {
            $this->assertTrue($result);
        }
    }

    public function test_ensure_configured_for_user_optional() {
        $mock = $this->getMockForAbstractClass(
                '\\core\\disguise\\disguise',
                [],
                '',
                false,
                true,
                true,
                ['is_configured_for_user']
            );

        $mock->expects($this->once())
            ->method('is_configured_for_user')
            ->will($this->returnValue(false));

        // Set the mode.
        $rc = new \ReflectionClass('\\core\\disguise\\disguise');
        $rcpm = $rc->getProperty('mode');
        $rcpm->setAccessible(true);
        $rcpm->setValue($mock, \core\disguise\helper::DISGUISE_OPTIONAL);

        // When the disguise is optional, ensure_configured_for_user will return true, regardless of whether the
        // disguise is configured.
        $this->assertTrue($mock->ensure_configured_for_user((object) []));
    }

    public function test_get_config() {
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        fixture\helper::create($coursecontext, 'basic');

        // The get_config function with no args returns an object.
        $config = $coursecontext->disguise->get_config();
        $this->assertInternalType('object', $config);

        // Fetching a config key will also return empty.
        $config = $coursecontext->disguise->get_config('madeupkey');
        $this->assertNull($config);

        // After setting a key, it will be returned.
        $coursecontext->disguise->set_config('madeupkey', 'madeupvalue');
        $config = $coursecontext->disguise->get_config();
        $this->assertEquals('madeupvalue', $config->madeupkey);

        $config = $coursecontext->disguise->get_config('madeupkey');
        $this->assertEquals('madeupvalue', $config);
    }

    public function set_show_real_identity_state_provider() {
        return [
            'No capability, attempt false'  => [
                'targetstate'   => false,
                'privileged'    => false,
                'expectation'   => false,
            ],
            'No capability, attempt true'   => [
                'targetstate'   => true,
                'privileged'    => false,
                'expectation'   => false,
            ],
            'Has capability, attempt false'  => [
                'targetstate'   => false,
                'privileged'    => true,
                'expectation'   => false,
            ],
            'Has capability, attempt true'  => [
                'targetstate'   => true,
                'privileged'    => true,
                'expectation'   => true,
            ],
        ];
    }

    /**
     * @dataProvider set_show_real_identity_state_provider
     */
    public function test_set_show_real_identity_state($targetstate, $privileged, $expectation) {
        global $SESSION;

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $coursecontext = context_course::instance($course->id);
        fixture\helper::create($coursecontext, 'basic');

        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);

        if ($privileged) {
            $this->getDataGenerator()->enrol_user($user->id, $course->id, 'manager');
        } else {
            $this->getDataGenerator()->enrol_user($user->id, $course->id, 'student');
            $this->setExpectedException(
                    'required_capability_exception',
                    'Sorry, but you do not currently have permissions to do that (Reveal identities at any time)'
                );
        }

        $coursecontext->disguise->set_show_real_identity_state($targetstate);
        $this->assertEquals($expectation, $SESSION->disguiserevealed);
    }
}
