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
 * LTI enrolment plugin locallib functions.
 *
 * @package enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/*
 * The value used when we want to enrol new members and unenrol old ones.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL', 1);

/*
 * The value used when we want to enrol new members only.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_NEW', 2);

/*
 * The value used when we want to unenrol missing users.
 */
define('ENROL_LTI_MEMBER_SYNC_UNENROL_MISSING', 3);

/**
 * Returns the LTI tools requested.
 *
 * @param array $params The list of SQL params (eg. array('columnname' => value, 'columnname2' => value)).
 * @return array of tools
 */
function enrol_lti_get_lti_tools($params = array()) {
    global $DB;

    $sql = "SELECT elt.*, e.name, e.courseid, e.status
              FROM {enrol_lti_tools} elt
              JOIN {enrol} e
                ON elt.enrolid = e.id";
    if ($params) {
        $where = "WHERE";
        foreach ($params as $colname => $value) {
            $sql .= " $where $colname = :$colname";
            $where = "AND";
        }
    }
    $sql .= " ORDER BY timecreated";

    return $DB->get_records_sql($sql, $params);
}
