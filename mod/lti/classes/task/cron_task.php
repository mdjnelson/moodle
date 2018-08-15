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
 * A scheduled task for gradebookservices.
 *
 * @package    mod_lti
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_lti\task;

use core\task\scheduled_task;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing the scheduled task for lti module.
 *
 * @package    mod_lti
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('crontask', 'mod_lti');
    }

    /**
     * Run forum cron.
     */
    public function execute() {
        global $DB;

        $DB->delete_records_select('lti_access_tokens', 'validuntil < ' . time());
    }

}
