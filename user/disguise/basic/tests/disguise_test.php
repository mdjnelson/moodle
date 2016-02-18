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
        global $DB;
        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();
        $forum = $this->getDataGenerator()->create_module('forum', array('course' => $course->id));
        $modcontext = context_module::instance($forum->cmid);

        // Creating a new disguise.
        fixture\helper::create($modcontext, 'basic');

        // Create a user in the course.
        $user = $this->getDataGenerator()->create_user();
        $roleid = $DB->get_field('role', 'id', array('shortname' => 'student'), MUST_EXIST);
        $this->getDataGenerator()->enrol_user($user->id, $course->id, $roleid);

        // Check the displayname.
        $this->assertEquals(get_string('anonymous', 'disguise_basic'), \core_user::displayname($user, $modcontext));
    }
}
