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
 * Definition of a class to represent a deleted grade item
 *
 * @package   core_grades
 * @copyright 2014 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class representing a deleted grade item.
 *
 * @package   core_grades
 * @copyright 2014 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class grade_item_history extends grade_item {

    /**
     * DB Table (used by grade_object).
     *
     * @var string $table
     */
    public $table = 'grade_items_history';

    /**
     * Constructor.
     *
     * @param array $params An array with required parameters for this grade object.
     * @param bool $fetch Whether to fetch corresponding row from the database or not,
     *        optional fields might not be defined if false used
     */
    public function __construct($params = null, $fetch = true) {
        // Add the 'oldid' and the 'action' column to the list of required fields.
        $this->required_fields[] = 'oldid';
        $this->required_fields[] = 'action';

        parent::__construct($params, $fetch);
    }

    /**
     * Finds and returns a grade_item instance based on params.
     *
     * @static
     * @param array $params associative arrays varname => value
     * @return grade_item|bool Returns a grade_item instance or false if none found
     */
    public static function fetch($params) {
        return grade_object::fetch_helper('grade_items_history', 'grade_item_history', $params);
    }

    /**
     * Finds and returns all grade_item instances based on params.
     *
     * @static
     * @param array $params associative arrays varname => value
     * @return array array of grade_item instances or false if none found.
     */
    public static function fetch_all($params) {
        return grade_object::fetch_all_helper('grade_items_history', 'grade_item_history', $params);
    }
}