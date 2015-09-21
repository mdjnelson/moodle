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
 * Restore implementation for the (tool_log) logstore_database subplugin.
 *
 * @package    logstore_database
 * @category   backup
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class restore_logstore_database_subplugin extends restore_tool_log_logstore_subplugin {

    /**
     * @var moodle_database the external database.
     */
    private $extdb = null;

    /**
     * @var string the external database table name.
     */
    private $extdbtablename = null;

    /**
     * The constructor for this logstore.
     *
     * @param string $subplugintype the subplugin type.
     * @param string $subpluginname the subplugin name.
     * @param restore_structure_step $step.
     */
    public function __construct($subplugintype, $subpluginname, $step) {
        // Check that the logstore is enabled before setting variables.
        $enabledlogstores = explode(',', get_config('tool_log', 'enabled_stores'));
        if (in_array('logstore_database', $enabledlogstores)) {
            $manager = new \tool_log\log\manager();
            $store = new \logstore_database\log\store($manager);
            $this->extdb = $store->get_extdb();
            $this->extdbtablename = $store->get_config_value('dbtable');
        }

        parent::__construct($subplugintype, $subpluginname, $step);
    }

    /**
     * Returns the subplugin structure to attach to the 'logstore' XML element.
     *
     * @return restore_path_element[] array of elements to be processed on restore.
     */
    protected function define_logstore_subplugin_structure() {
        // If the logstore is not enabled we don't add structures for it.
        $enabledlogstores = explode(',', get_config('tool_log', 'enabled_stores'));
        if (!in_array('logstore_database', $enabledlogstores)) {
            return array(); // The logstore is not enabled, nothing to restore.
        }

        $paths = array();

        $elename = $this->get_namefor('log');
        $elepath = $this->get_pathfor('/logstore_database_log');
        $paths[] = new restore_path_element($elename, $elepath);

        return $paths;
    }

    /**
     * Process logstore_database_log entries.
     *
     * This method proceeds to read, complete, remap and, finally,
     * discard or save every log entry.
     *
     * @param array() $data log entry.
     * @return null if we are not restoring the log.
     */
    public function process_logstore_database_log($data) {
        $data = (object)$data;

        // Do not bother processing if we can not add it to a database.
        if (!$this->extdb || !$this->extdbtablename) {
            return;
        }

        // Complete the information that does not come from backup.
        if (!$data->contextid = $this->get_mappingid('context', $data->contextid)) {
            // Something went really wrong, cannot find the context this log belongs to.
            return;
        }
        $context = context::instance_by_id($data->contextid, MUST_EXIST);
        $data->contextlevel = $context->contextlevel;
        $data->contextinstanceid = $context->instanceid;
        $data->courseid = $this->task->get_courseid();

        // Remap users.
        if (!$data->userid = $this->get_mappingid('user', $data->userid)) {
            // Something went really wrong, cannot find the user this log belongs to.
            return;
        }
        if (!empty($data->relateduserid)) { // This is optional.
            if (!$data->relateduserid = $this->get_mappingid('user', $data->relateduserid)) {
                // Something went really wrong, cannot find the relateduserid this log is about.
                return;
            }
        }
        if (!empty($data->realuserid)) { // This is optional.
            if (!$data->realuserid = $this->get_mappingid('user', $data->realuserid)) {
                // Something went really wrong, cannot find the realuserid this log is logged in as.
                return;
            }
        }

        // Roll dates.
        $data->timecreated = $this->apply_date_offset($data->timecreated);

        // Revert other to its original php way.
        $data->other = unserialize(base64_decode($data->other));

        // Arrived here, we have both 'objectid' and 'other' to be converted. This is the tricky part.
        // Both are pointing to other records id, but the sources are not identified in the
        // same way restore mappings work. So we need to delegate them to some resolver that
        // will give us the correct restore mapping to be used.
        if (!empty($data->objectid)) {
            // Check if there is a mapping function for this event.
            $eventclass = $data->eventname;
            if (class_exists($eventclass)) {
                $data->objectid = $eventclass::get_objectid_mapping($this, $data->objectid);
            } else {
                return; // No such class, can not restore.
            }
        }
        if (!empty($data->other)) {
            // TODO: Call to the resolver.
            return;
        }

        // Arrived here, everything is now ready to be added to database, let's proceed.
        $this->extdb->insert_record($this->extdbtablename, $data);
    }
}
