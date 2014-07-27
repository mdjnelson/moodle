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
 * Standard log reader/writer.
 *
 * @package    logstore_standard
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_standard\log;

defined('MOODLE_INTERNAL') || die();

class store implements \tool_log\log\writer, \core\log\sql_internal_reader, \core\log\backup {
    use \tool_log\helper\store,
        \tool_log\helper\buffered_writer,
        \tool_log\helper\reader,
        \tool_log\helper\backup;

    /** @var string $logguests true if logging guest access */
    protected $logguests;

    public function __construct(\tool_log\log\manager $manager) {
        $this->helper_setup($manager);
        // Log everything before setting is saved for the first time.
        $this->logguests = $this->get_config('logguests', 1);
    }

    /**
     * Should the event be ignored (== not logged)?
     * @param \core\event\base $event
     * @return bool
     */
    protected function is_event_ignored(\core\event\base $event) {
        if ((!CLI_SCRIPT or PHPUNIT_TEST) and !$this->logguests) {
            // Always log inside CLI scripts because we do not login there.
            if (!isloggedin() or isguestuser()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Finally store the events into the database.
     *
     * @param array $evententries raw event data
     */
    protected function insert_event_entries($evententries) {
        global $DB;

        $DB->insert_records('logstore_standard_log', $evententries);
    }

    public function get_events_select($selectwhere, array $params, $sort, $limitfrom, $limitnum) {
        global $DB;

        $sort = self::tweak_sort_by_id($sort);

        $events = array();
        $records = $DB->get_records_select('logstore_standard_log', $selectwhere, $params, $sort, '*', $limitfrom, $limitnum);

        foreach ($records as $data) {
            $extra = array('origin' => $data->origin, 'ip' => $data->ip, 'realuserid' => $data->realuserid);
            $data = (array)$data;
            $id = $data['id'];
            $data['other'] = unserialize($data['other']);
            if ($data['other'] === false) {
                $data['other'] = array();
            }
            unset($data['origin']);
            unset($data['ip']);
            unset($data['realuserid']);
            unset($data['id']);

            $event = \core\event\base::restore($data, $extra);
            // Add event to list if it's valid.
            if ($event) {
                $events[$id] = $event;
            }
        }

        return $events;
    }

    public function get_events_select_count($selectwhere, array $params) {
        global $DB;
        return $DB->count_records_select('logstore_standard_log', $selectwhere, $params);
    }

    public function get_internal_log_table_name() {
        return 'logstore_standard_log';
    }

    /**
     * Are the new events appearing in the reader?
     *
     * @return bool true means new log events are being added, false means no new data will be added
     */
    public function is_logging() {
        // Only enabled stores are queried, this means we can return true here unless store has some extra switch.
        return true;
    }

    /**
     * Returns the structure to be processed by the \backup_step.
     *
     * The function behaves the same as define_structure() defined by the backup process in core.
     *
     * @see \backup_structure_step::define_structure
     * @return \backup_nested_element
     * @throws \backup_step_exception
     */
    public function backup_define_structure() {
        // Check that we are indeed backing up something.
        if (empty($this->itembackup)) {
            throw new \backup_step_exception('no_item_backup_in_progress');
        }

        // Define each element separately.
        $logs = new \backup_nested_element($this->component . '_logs');

        $log = new \backup_nested_element('log', array('id'), array(
            'eventname', 'component', 'action', 'target', 'objecttable', 'objectid',
            'crud', 'edulevel', 'contextid', 'contextlevel', 'contextinstanceid',
            'userid', 'courseid', 'relateduserid', 'anonymous', 'other', 'timecreated',
            'origin', 'ip', 'realuserid'));

        // Build the tree.
        $logs->add_child($log);

        if ($this->itembackup == LOG_STORE_COURSE_LOGS) {
            // Define sources (all the records belonging to the course).
            $log->set_source_table($this->get_internal_log_table_name(), array('courseid' => \backup::VAR_COURSEID));
        } else { // Must be an activity.
            // Define sources.
            $log->set_source_table($this->get_internal_log_table_name(), array('contextinstanceid' => \backup::VAR_MODID));
        }

        return $logs;
    }

    /**
     * Handles restoring a log element from the backup.
     *
     * The function behaves the same as the function process_* defined by the restore process in core.
     *
     * @param array $data the data from the backup
     * @param \restore_logs_structure_step $step
     * @see \restore_logs_structure_step::process_log
     */
    public function restore_log($data, $step) {
        global $DB;

        $data = (object) ($data);

        // Get the userid.
        $data->userid = $step->get_mappingid('user', $data->userid);

        // The user was not re-mapped, stop processing.
        if (empty($data->userid)) {
            return;
        }

        // Update the data we are going to use and insert into the log table.
        if (!empty($data->objecttable) && !empty($data->objectid)) {
            $data->objectid = $step->get_mappingid($data->objecttable, $data->objectid);
        }
        if (!empty($data->courseid)) {
            $data->courseid = $step->get_task()->get_courseid();
        }
        $data->contextid = $step->get_mappingid('context', $data->contextid);
        // Now we need to map the contextinstanceid.
        if ($data->contextlevel == CONTEXT_COURSE) {
            // If the contextlevel is equal to CONTEXT_COURSE then the contextinstanceid is equal to the course id.
            $data->contextinstanceid = $step->get_task()->get_courseid();
        } else if ($data->contextlevel == CONTEXT_MODULE) {
            // If the contextlevel is equal to CONTEXT_MODULE then the contextinstanceid is equal to the course module id.
            $data->contextinstanceid = $step->get_mappingid('course_module', $data->contextinstanceid);
        }
        if (!empty($data->relateduserid)) {
            $data->relateduserid = $step->get_mappingid('user', $data->relateduserid);
        }
        if (!empty($data->realuserid)) {
            $data->realuserid = $step->get_mappingid('user', $data->realuserid);
        }

        $DB->insert_record($this->get_internal_log_table_name(), $data);
    }
}
