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
 * A scheduled task.
 *
 * @package    core
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * Simple task to delete old messaging records.
 */
class messaging_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskmessagingcleanup', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG, $DB;

        $timenow = time();

        // Cleanup messaging.
        if (!empty($CFG->messagingdeletereadnotificationsdelay)) {
            $notificationdeletetime = $timenow - $CFG->messagingdeletereadnotificationsdelay;
            $params = array('notificationdeletetime' => $notificationdeletetime);
            $DB->delete_records_select('message_read', 'notification=1 AND timeread<:notificationdeletetime', $params);
        }

        // Remove any messages that were deleted by both users over a certain amount of time.
        if (!empty($CFG->messagingdeletedelay)) {
            $deletetime = $timenow - $CFG->messagingdeletedelay;
            $params = array('deletetime' => $deletetime, 'deletetime2' => $deletetime);

            // Note - there really shouldn't be any entries in the 'message' table as if there is a value
            // greater than 0 for 'useridtodeleted' then it has been read. However, to be safe we will remove
            // any entries from here that may exist as well.
            $sql = "((useridfromdeleted > 0 AND useridfromdeleted < :deletetime) AND
                     (useridtodeleted > 0 AND useridtodeleted < :deletetime2))";
            $DB->delete_records_select('message', $sql, $params);
            $DB->delete_records_select('message_read', $sql, $params);
        }
    }
}
