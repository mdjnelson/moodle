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
 * @package   mnet
 * @category  test
 * @copyright 2013 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mnet/lib.php');

class mnet_events_testcase extends advanced_testcase {

    /**
     * Test set up.
     */
    public function setUp() {
        $this->resetAfterTest();
    }

    /**
     * Test the mnet access control created event.
     */
    public function test_mnet_access_control_created() {
        global $DB;

        // Add a mnet host.
        $mnethost = new stdClass();
        $mnethost->name = 'A mnet host';
        $mnethost->public_key = 'A random public key!';
        $mnethost->id = $DB->insert_record('mnet_host', $mnethost);

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        mnet_update_sso_access_control('username', $mnethost->id, 'enabled');
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\mnet_access_control_created', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(SITEID, 'admin/mnet', 'add', 'admin/mnet/access_control.php',
            'SSO ACL: enabled user \'username\' from ' . $mnethost->name);
        $this->assertEventLegacyLogData($expected, $event);
    }

    /**
     * Test the mnet access control updated event.
     */
    public function test_mnet_access_control_updated() {
        global $DB;

        // Add a mnet host.
        $mnethost = new stdClass();
        $mnethost->name = 'A mnet host';
        $mnethost->public_key = 'A random public key!';
        $mnethost->id = $DB->insert_record('mnet_host', $mnethost);

        // Create a mnet access control.
        $mnetaccesscontrol = new stdClass();
        $mnetaccesscontrol->username = 'username';
        $mnetaccesscontrol->mnet_host_id = $mnethost->id;
        $mnetaccesscontrol->accessctrl = 'enabled';
        $mnetaccesscontrol->id = $DB->insert_record('mnet_sso_access_control', $mnetaccesscontrol);

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        mnet_update_sso_access_control('username', $mnethost->id, 'enabled');
        $events = $sink->get_events();
        $event = reset($events);

        // Check that the event data is valid.
        $this->assertInstanceOf('\core\event\mnet_access_control_updated', $event);
        $this->assertEquals(context_system::instance(), $event->get_context());
        $expected = array(SITEID, 'admin/mnet', 'update', 'admin/mnet/access_control.php',
            'SSO ACL: enabled user \'username\' from ' . $mnethost->name);
        $this->assertEventLegacyLogData($expected, $event);
    }
}
