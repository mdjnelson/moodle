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
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace disguise_predefined;

defined('MOODLE_INTERNAL') || die();

/**
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguise extends \core\disguise\disguise {

    /**
     * @var array $usermappings A cache of the current mappings in this context.
     */
    protected $usermappings = array();

    /**
     * Get the user mapping for the specified user
     *
     * @param   \stdClass   $user   As provided by {@link $USER}
     * @return  \stdClass           Containing the id, name, and enabled flag.
     */
    protected function get_user_mapping(\stdClass $user) {
        if (isset($this->usermappings[$user->id])) {
            return $this->usermappings[$user->id];
        }

        if (empty($this->usermappings)) {
            $this->fetch_user_mappings();
        }

        if (isset($this->usermappings[$user->id])) {
            $mapping = $this->usermappings[$user->id];
        } else {
            $mapping = $this->select_random_name($user);
        }

        return $mapping;
    }

    /**
     * Fetch all user mappings for this context.
     */
    protected function fetch_user_mappings() {
        global $DB;

        $sql = <<<EOF
            SELECT m.userid, n.*
              FROM {disguise_predefined_mappings} m
              JOIN {disguise_predefined_names} n ON n.id = m.nameid
             WHERE n.disguiseid = ?
EOF;

        $this->usermappings = $DB->get_records_sql($sql, array('disguiseid' => $this->get_id()));
    }

    /**
     * Create a new mapping from an unused name.
     *
     * @param \stdClass $user As provided by {@link $USER}
     * @return \stdClass Containing the id, name, and enabled flag.
     * @throws disguise_not_available_exception If no free disguises are available
     */
    protected function select_random_name(\stdClass $user) {
        global $DB;

        $sql = <<<EOF
            SELECT n.*
                FROM {disguise_predefined_names} n
                LEFT JOIN {disguise_predefined_mappings} m ON m.nameid = n.id
               WHERE n.disguiseid = :disguiseid
                 AND m.id IS NULL
              AND n.enabled = 1
EOF;

        $freemapping = $DB->get_records_sql($sql, array(
            'disguiseid'    => $this->get_id(),
        ));

        if (!$freemapping) {
            throw new disguise_not_available_exception();
        }
        $key = array_rand($freemapping);

        $record = (object) array(
                'disguiseid'    => $this->get_id(),
                'nameid'        => $key,
                'userid'        => $user->id,
            );

        $record->id = $DB->insert_record('disguise_predefined_mappings', $record);

        $this->usermappings[$user->id] = $freemapping[$key];

        return $this->usermappings[$user->id];
    }

    /**
     * Fetch all names, complete with assignment state.
     *
     * @return array
     */
    public function get_all_names($sort = null) {
        global $DB;

        $sql = <<<EOF
            SELECT n.*, m.id as assigned
              FROM {disguise_predefined_names} n
         LEFT JOIN {disguise_predefined_mappings} m ON n.id = m.nameid
             WHERE n.disguiseid = ?
EOF;

        if ($sort) {
            $sql .= ' ORDER BY ' . $sort;
        }

        return $DB->get_records_sql($sql, array('disguiseid' => $this->get_id()));
    }

    /**
     * Fetch a single name, complete with assignment state.
     *
     * @param int $nameid
     * @return stdClass
     */
    public function get_name($nameid) {
        global $DB;

        $sql = <<<EOF
            SELECT n.*, m.id as assigned
              FROM {disguise_predefined_names} n
         LEFT JOIN {disguise_predefined_mappings} m ON n.id = m.nameid AND n.disguiseid  = ?
             WHERE n.id = ?
EOF;

        return $DB->get_record_sql($sql, array(
                $this->get_id(),
                $nameid,
            ));
    }

    /**
     * Add a new name.
     *
     * @param string $name
     * @param bool $enabled
     * @return stdClass
     */
    public function add_name($name, $enabled = true) {
        global $DB;

        $nameid = $DB->insert_record('disguise_predefined_names', (object) array(
                'name'          => $name,
                'disguiseid'    => $this->get_id(),
                'enabled'       => $enabled,
            ));

        return $nameid;
    }

    /**
     * Add a new name.
     *
     * @param string $name
     * @param bool $enabled
     * @return stdClass
     */
    public function add_names($names, $enabled = true) {
        $records = array();
        while ($name = array_shift($names)) {
            $records[] = array(
                    'name'          => $name,
                    'disguiseid'    => $this->get_id(),
                    'enabled'       => $enabled,
                );
        }

        return $this->add_names_from_records($records);
    }

    /**
     * Add new names from a set.
     *
     * @param string $name
     * @return stdClass
     */
    public function add_names_from_records(array $names) {
        global $DB;
        return $DB->insert_records('disguise_predefined_names', $names);
    }

    /**
     * @inheritdoc
     */
    protected function disguise_displayname(\stdClass $user, $options) {
        $mapping = $this->get_user_mapping($user);

        return $this->format_name($mapping->name);
    }

    /**
     * @inheritdoc
     */
    protected function requires_user_configuration() {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function is_configured_for_user(\stdClass $user = null) {
        global $USER;

        parent::is_configured_for_user($user);

        if (null === $user) {
            $user = $USER;
        }

        try {
            $this->get_user_mapping($user);
            return true;
        } catch (disguise_not_available_exception $e) {
            if (has_capability('moodle/disguise:configure', $this->context, $user)) {
                redirect(instance\manager::get_index_link($this->context), get_string('nonamesavailable', 'disguise_predefined'));
            }

            // No mappings available.
            // Need to improve this.
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function add_disguise_navigation() {
        $nodes = array();
        if (has_capability('moodle/disguise:configure', $this->context)) {
            // Note, use of can_make_changes() here is not relevant as the settings on this page do not reveal the true identity.
            // It may be necessary to configure the display name, whilst the plugin is locked.
            $nodes[] = \navigation_node::create(
                    get_string('disguiseconfig', 'disguise_predefined'),
                    instance\manager::get_index_link($this->context),
                    \navigation_node::TYPE_SETTING,
                    null,
                    'contextdisguise'
                );
        }

        return $nodes;
    }

    /**
     * @inheritdoc
     */
    protected function get_config_defaults() {
        return [
                'wrapper'   => '{{name}}',
            ];
    }

    /**
     * Format the specified name using the disguise wrapper.
     *
     * @param   string      $name       The name to format
     * @return  string                  The formatted name
     */
    public function format_name($name) {
        $formatter = $this->get_config('wrapper');
        return str_replace('{{name}}', $name, $formatter);
    }
}
