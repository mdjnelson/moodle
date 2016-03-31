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
 * LTI Authentication plugin.
 *
 * @package auth_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * LTI Authentication plugin.
 *
 * @package auth_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_plugin_lti extends auth_plugin_base {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'lti';
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function auth_plugin_lti() {
        debugging('Use of class name as constructor is deprecated', DEBUG_DEVELOPER);
        self::__construct();
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist. (Non-mnet accounts only!)
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    function user_login($username, $password) {
        global $CFG, $DB, $USER;
        if (!$user = $DB->get_record('user', array('username'=>$username, 'mnethostid'=>$CFG->mnet_localhost_id))) {
            return false;
        }
        if (!validate_internal_user_password($user, $password)) {
            return false;
        }
        if ($password === 'changeme') {
            // force the change - this is deprecated and it makes sense only for lti auth,
            // because most other plugins can not change password easily or
            // passwords are always specified by users
            set_user_preference('auth_forcepasswordchange', true, $user->id);
        }
        return true;
    }

    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return true;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return true;
    }

    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return moodle_url
     */
    function change_password_url() {
        return null;
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return true;
    }

    /**
     * Returns true if plugin can be manually set.
     *
     * @return bool
     */
    function can_be_manually_set() {
        return true;
    }
}
