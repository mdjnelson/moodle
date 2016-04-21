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
 * Upgrade code for mnetservice enrol
 *
 * @package   mnetservice_enrol
 * @copyright 2016 Ben Kelada (ben.kelada@open.edu.au)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for mnetservice enrol
 *
 * This function is automatically called when version number in version.php changes
 *
 * @param int $oldversion New old version number
 * @return boolean
 */
function xmldb_mnetservice_enrol_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

    if ($oldversion < 2017121300) {

        // Changing precision of field fullname, shortname and idnumber on table mnetservice_enrol_courses to (255).
        $table = new xmldb_table('mnetservice_enrol_courses');
        $columns = $DB->get_columns('mnetservice_enrol_courses');
        if ($columns['fullname']->max_length < 255) {
            $field = new xmldb_field('fullname', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'sortorder');
            // Launch change of precision for field fullname.
            $dbman->change_field_precision($table, $field);
        }
        if ($columns['shortname']->max_length < 255) {
            $field = new xmldb_field('shortname', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'fullname');
            // Launch change of precision for field shortname.
            $dbman->change_field_precision($table, $field);
        }
        if ($columns['idnumber']->max_length < 255) {
            $field = new xmldb_field('idnumber', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'shortname');
            // Launch change of precision for field idnumber.
            $dbman->change_field_precision($table, $field);
        }

        // The mnetservice savepoint reached.
        upgrade_mod_savepoint(true, 2017121300, 'mnetservice_enrol');
    }

    return true;
}
