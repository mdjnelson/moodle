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
 * Base class for graderule restore plugins.
 *
 * @package     core_backup
 * @category    backup
 * @copyright   2020 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Base class for graderule restore plugins.
 *
 * @package     core_backup
 * @category    backup
 * @copyright   2020 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class restore_graderule_plugin extends restore_plugin {

    /**
     * Adjust the grading_rules record to point to the just restored plugin information.
     *
     * @param int $id       The ID of the grading_rules records to adjust.
     * @param int $pluginid The ID of the just restored plugin information to point to.
     * @return void
     */
    protected function adjust_grading_rule_record($id, $pluginid) {
        global $DB;

        $DB->set_field('grading_rules', 'pluginid', $pluginid, ['id' => $id]);
    }
}
