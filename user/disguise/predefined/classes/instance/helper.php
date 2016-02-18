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

namespace disguise_predefined\instance;

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
     * Create the renderable for the name inplace editable.
     *
     * @param   context     $context    The context of the disguise
     * @param   stdClass    $name       The name record
     * @return  renderable              The rendered HTML of the inplace_editable
     */
    public static function render_name_inplace_editable(\context $context, $name) {
        return new \core\output\inplace_editable(
                'disguise_predefined',
                "instance/{$context->id}/name",
                $name->id,
                true,
                $context->disguise->format_name($name->name),
                $name->name
            );
    }

    /**
     * Update the name of the specified name record.
     *
     * @param   context     $context    The context of the disguise
     * @param   int         $itemid     The value being updated
     * @param   mixed       $newvalue   The new value
     * @return  renderable              The rendered HTML of the inplace_editable
     */
    public static function update_name(\context $context, $itemid, $newvalue) {
        global $DB, $PAGE;

        // Fetch the specified name.
        $record = $DB->get_record('disguise_predefined_names', array('id' => $itemid));

        // Sanity checks.
        $PAGE->set_context($context);
        \core\disguise\helper::require_configure_disguise($record->disguiseid, $context);

        // Update the name.
        $record->name = $newvalue;
        $DB->update_record('disguise_predefined_names', $record);

        return self::render_name_inplace_editable($context, $record);
    }

    /**
     * Create the renderable for the enabled inplace editable.
     *
     * @param   context     $context    The context of the disguise
     * @param  stdClass     $name   The enabled record
     * @return renderable           The rendered HTML of the inplace_editable
     */
    public static function render_enabled_inplace_editable($context, $name) {
        global $OUTPUT;

        if ($name->enabled) {
            $displayvalue = $OUTPUT->pix_icon('i/hide', get_string('disable'));
        } else {
            $displayvalue = $OUTPUT->pix_icon('i/show', get_string('enable'));
        }

        $editable = new \core\output\inplace_editable(
                'disguise_predefined',
                "instance/{$context->id}/enabled",
                $name->id,
                true,
                $displayvalue,
                (int) $name->enabled
            );
        $editable->set_type_toggle();

        return $editable;
    }

    /**
     * Update the enabled state of the specified name record.
     *
     * @param   context     $context    The context of the disguise
     * @param   int         $itemid     The value being updated
     * @param   mixed       $newvalue   The new value
     * @return  renderable              The rendered HTML of the inplace_editable
     */
    public static function set_name_enabled(\context $context, $itemid, $newvalue) {
        global $DB, $PAGE;

        $record = $DB->get_record('disguise_predefined_names', array('id' => $itemid));

        // Sanity checks.
        $PAGE->set_context($context);
        \core\disguise\helper::require_configure_disguise($record->disguiseid, $context);

        // Update the enabled flag.
        $record->enabled = $newvalue;
        $DB->update_record('disguise_predefined_names', $record);

        return self::render_enabled_inplace_editable($context, $record);
    }

}
