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
 * Unit tests for the messaging cleanup task.
 *
 * @package    core_message
 * @category   test
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * Class used to test the tool_monitor clean events task.
 */
class messaging_cleanup_task_testcase extends advanced_testcase {

    /**
     * Test set up.
     */
    public function setUp() {
        $this->resetAfterTest(true);
    }

    /**
     * Tests the cleaning up of messages.
     */
    public function test_messaging_cleanup_task() {
        global $DB;

        // Set the time we want to delete messages to a day.
        set_config('messagingdeletedelay', DAYSECS);

        $user1 = self::getDataGenerator()->create_user();
        $user2 = self::getDataGenerator()->create_user();

        // Add a message that has not been deleted by either user.
        $message = new stdClass();
        $message->useridfrom = $user1->id;
        $message->useridfromdeleted = 0;
        $message->useridto = $user2->id;
        $message->useridtodeleted = 0;
        $message->subject = 'Yo, whattup!?';
        $message->fullmessage = 'Keen for a shred tomorrow?';
        $message->timecreated = time();
        $message1 = $DB->insert_record('message_read', $message);

        // Add a message that has been deleted by both, but won't be deleted as it doesn't meet the time constraint.
        $message->useridfromdeleted = time();
        $message->useridtodeleted = time();
        $message2 = $DB->insert_record('message_read', $message);

        // Add a message that has been deleted by both users - so will be cleaned up by the task.
        $message->useridfromdeleted = time() - DAYSECS - 1;
        $message->useridtodeleted = time() - DAYSECS - 1;
        $message3 = $DB->insert_record('message_read', $message);

        // Call the task.
        $task = new \core\task\messaging_cleanup_task();
        $task->execute();

        // Get all the messages that exist.
        $messagesread = $DB->get_records('message_read');

        // There should only be two messages.
        $this->assertEquals(2, count($messagesread));
        $this->assertArrayHasKey($message1, $messagesread);
        $this->assertArrayHasKey($message2, $messagesread);
    }
}
