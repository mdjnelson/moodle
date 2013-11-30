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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Events tests.
 *
 * @package   core
 * @category  test
 * @copyright 2013 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class core_events_testcase extends advanced_testcase {

    /**
     * Test set up.
     *
     * This is executed before running any test in this file.
     */
    public function setUp() {
        $this->resetAfterTest();
    }

    /**
     * Test the file uploaded event.
     */
    public function test_file_uploaded() {
        global $CFG;

        require_once($CFG->libdir . '/uploadlib.php');

        $sink = $this->redirectEvents();
        clam_log_upload('the/file/path');
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\file_uploaded', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(0, 'upload', 'upload', '', $CFG->dataroot . '/the/file/path');
        $this->assertEventLegacyLogData($expected, $event);
    }

    /**
     * Test the infected file uploaded event.
     */
    public function test_infected_file_uploaded() {
        global $CFG, $USER;

        require_once($CFG->libdir . '/uploadlib.php');

        $sink = $this->redirectEvents();
        clam_log_infected('the/old/file/path', 'the/new/file/path');
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\infected_file_uploaded', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(0, 'upload', 'infected', '', 'the/old/file/path', 0, $USER->id);
        $this->assertEventLegacyLogData($expected, $event);
    }
}
