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

namespace disguise_predefined\settings;

defined('MOODLE_INTERNAL') || die();

/**
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper extends \disguise_predefined\helper {

    /**
     * Update the name of the specified set.
     *
     * @param int           $itemid     The value being updated
     * @param mixed         $newvalue   The new value
     * @return renderable               The rendered HTML of the inplace_editable
     */
    public static function update_sets_name($itemid, $newvalue) {
        global $DB, $PAGE;

        $record = $DB->get_record('disguise_predefined_sets', array('id' => $itemid));

        $context = \context_system::instance();
        $PAGE->set_context($context);
        require_capability('moodle/site:config', $context);

        $record->name = $newvalue;
        $DB->update_record('disguise_predefined_sets', $record);

        return self::render_sets_name_inplace_editable($record);
    }

    /**
     * Render the inplace editable used to edit the set name.
     *
     * @param   int         $setid      The set id.
     * @return  string
     */
    public static function render_sets_name_inplace_editable(\stdClass $set) {
        return new \core\output\inplace_editable(
                'disguise_predefined',
                'settings/sets_name',
                $set->id,
                true,
                \html_writer::link(
                    manager::get_view_set_link($set->id),
                    $set->name
                ),
                $set->name
            );
    }

    /**
     * Update the format of the specified set.
     *
     * @param int           $itemid     The value being updated
     * @param mixed         $newvalue   The new value
     * @return renderable               The rendered HTML of the inplace_editable
     */
    public static function update_sets_format($itemid, $newvalue) {
        global $DB, $PAGE;

        $record = $DB->get_record('disguise_predefined_sets', array('id' => $itemid));

        $context = \context_system::instance();
        $PAGE->set_context($context);
        require_capability('moodle/site:config', $context);

        if (strpos($newvalue, '{{name}}') === false) {
            $newvalue .= '{{name}}';
        }

        $record->wrapper = $newvalue;
        $DB->update_record('disguise_predefined_sets', $record);

        return self::render_sets_format_inplace_editable($record);
    }

    /**
     * Render the inplace editable used to edit the set format.
     *
     * @param   int         $setid      The set id.
     * @return  string
     */
    public static function render_sets_format_inplace_editable(\stdClass $set) {
        return new \core\output\inplace_editable(
                'disguise_predefined',
                'settings/sets_format',
                $set->id,
                true,
                $set->wrapper,
                $set->wrapper
            );
    }

    /**
     * Update the value of the specified name.
     *
     * @param int           $itemid     The value being updated
     * @param mixed         $newvalue   The new value
     * @return renderable               The rendered HTML of the inplace_editable
     */
    public static function update_name($itemid, $newvalue) {
        global $DB, $PAGE;

        $context = \context_system::instance();
        $PAGE->set_context($context);
        require_capability('moodle/site:config', $context);

        $record = $DB->get_record('disguise_predefined_set_data', array('id' => $itemid));
        $record->name = $newvalue;
        $DB->update_record('disguise_predefined_set_data', $record);

        return self::render_name_inplace_editable($record);
    }

    /**
     * Render the inplace editable used to edit the set name.
     *
     * @param   int         $setid      The set id.
     * @return  string
     */
    public static function render_name_inplace_editable(\stdClass $name) {
        return new \core\output\inplace_editable(
                'disguise_predefined',
                'settings/name',
                $name->id,
                true,
                $name->name,
                $name->name
            );
    }

    /**
     * Update the value of the specified set's availability.
     *
     * @param int           $itemid     The value being updated
     * @param mixed         $newvalue   The new value
     * @return renderable               The rendered HTML of the inplace_editable
     */
    public static function update_availability($itemid, $newvalue) {
        global $DB, $PAGE;

        $context = \context_system::instance();
        $PAGE->set_context($context);
        require_capability('moodle/site:config', $context);

        $record = $DB->get_record('disguise_predefined_sets', array('id' => $itemid));
        $record->available = (int) $newvalue;
        $DB->update_record('disguise_predefined_sets', $record);

        return self::render_available_inplace_editable($record);
    }

    /**
     * Render the inplace editable used to edit the set available.
     *
     * @param   int         $setid      The set id.
     * @return  string
     */
    public static function render_available_inplace_editable(\stdClass $set) {
        global $OUTPUT;

        if ($set->available) {
            $displayvalue = $OUTPUT->pix_icon('i/hide', get_string('disable'));
        } else {
            $displayvalue = $OUTPUT->pix_icon('i/show', get_string('enable'));
        }

        $editable = new \core\output\inplace_editable(
                'disguise_predefined',
                'settings/available',
                $set->id,
                true,
                $displayvalue,
                (int) $set->available
            );

        $editable->set_type_toggle();

        return $editable;
    }
}
