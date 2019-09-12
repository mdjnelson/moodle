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
 * Interface for grading rules
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\grade\rule;

defined('MOODLE_INTERNAL') || die();

use MoodleQuickForm;

/**
 * Interface for grading rules
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface rule_interface {

    /**
     * Whether or not this rule is enabled.
     */
    public function enabled();

    /**
     * Modify final grade.
     *
     * @param \grade_item  $item
     * @param int          $userid
     * @param float        $currentvalue
     *
     * @return float
     */
    public function final_grade_modifier(&$item, $userid, $currentvalue);

    /**
     * Modify symbol.
     *
     * @param \grade_item  $item
     * @param float        $value
     * @param int          $userid
     * @param string       $currentsymbol
     *
     * @return string
     */
    public function symbol_modifier(&$item, $value, $userid, $currentsymbol);

    /**
     * Get the status message.
     *
     * @param \grade_item $item
     * @param int         $userid
     *
     * @return string
     */
    public function get_status_message(&$item, $userid);

    /**
     * Edit the grade item edit form.
     *
     * @param MoodleQuickForm $mform
     */
    public function edit_form_hook(&$mform);

    /**
     * Process the form.
     *
     * @param \stdClass $data
     */
    public function process_form(&$data);

    /**
     * Save the grade item.
     *
     * @param \grade_item $gradeitem
     *
     * @return mixed
     */
    public function save(&$gradeitem);

    /**
     * Delete the grade item.
     *
     * @param \grade_item $gradeitem
     */
    public function delete(&$gradeitem);

    /**
     * Process the grade item recursively.
     *
     * @param \grade_item $currentgradeitem
     */
    public function recurse(&$currentgradeitem);

    /**
     * Get the type.
     *
     * @return string
     */
    public function get_type();

    /**
     * Get the ID
     *
     * @return int
     */
    public function get_id();

    /**
     * Is the grading rule owned by grade item.
     *
     * @param int $itemid
     *
     * @return boolean
     */
    public function owned_by($itemid);

    /**
     * Whether or not grade item needs updating.
     *
     * @return boolean
     */
    public function needs_update();
}
