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
 * @package   report_questioninstances
 * @category  test
 * @copyright 2013 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class report_questioninstances_events_testcase extends advanced_testcase {

    /**
     * Test set up.
     *
     * This is executed before running any test in this file.
     */
    public function setUp() {
        $this->resetAfterTest();
    }

    /**
     * Test the report viewed event.
     *
     * There is no external API for viewing the report, so the unit test will simply
     * create and trigger the event and ensure the legacy log data is returned as expected.
     */
    public function test_report_viewed() {
        // Create the event.
        $params = array(
            'courseid' => SITEID,
            'context' => context_system::instance(),
            'other' => array('requestedqtype' => 'multichoice')
        );
        $event = \report_questioninstances\event\report_viewed::create($params);

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\report_questioninstances\event\report_viewed', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(SITEID, 'admin', 'report questioninstances', 'report/questioninstances/index.php?qtype=multichoice',
            'multichoice');
        $this->assertEventLegacyLogData($expected, $event);
    }
}
