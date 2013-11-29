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
 * Mnet access control created event class.
 *
 * @package    core_event
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\event;

defined('MOODLE_INTERNAL') || die();

class mnet_access_control_created extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'mnet_sso_access_control';
        $this->data['crud'] = 'c';
        $this->data['level'] = self::LEVEL_OTHER;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return 'Access control created for the user with the username \'' . $this->other['username'] . '\' belonging
            to the mnet host \'' . $this->other['mnethostname'] . '\'';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventaccesscontrolcreated', 'mnet');
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('admin/mnet/access_control.php');
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, 'admin/mnet', 'add', 'admin/mnet/access_control.php', 'SSO ACL: ' . $this->other['accessctrl']
            . ' user \'' . $this->other['username'] . '\' from ' . $this->other['mnethostname']);
    }
}
