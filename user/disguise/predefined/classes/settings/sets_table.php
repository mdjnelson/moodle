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

require_once($CFG->libdir . '/tablelib.php');

/**
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sets_table extends \flexible_table {

    public function __construct() {
        parent::__construct('disguise_predefined_sets');

        $this->define_baseurl(manager::get_index_link());

        // Column definition.
        $this->define_columns([
            'name',
            'wrapper',
            'count',
            'actions',
        ]);

        $this->define_headers([
            get_string('header_set_name', 'disguise_predefined'),
            get_string('header_wrapper_format', 'disguise_predefined'),
            get_string('header_namecount', 'disguise_predefined'),
            ''
        ]);

        $this->set_attribute('class', 'admintable generaltable settable');
        $this->sortable(true, 'name');
        $this->no_sorting('count');
        $this->no_sorting('actions');
        $this->setup();
    }

    /**
     * Formatter for the name column.
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_name($row) {
        global $OUTPUT;
        return $OUTPUT->render(helper::render_sets_name_inplace_editable($row));
    }

    /**
     * Formatter for the name format column.
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_wrapper($row) {
        global $OUTPUT;
        return $OUTPUT->render(helper::render_sets_format_inplace_editable($row));
    }

    /**
     * Formatter for the name count column.
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_count($row) {
        return $row->count;
    }

    /**
     * Formatter for the actions column.
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_actions($row) {
        global $OUTPUT;

        $actions = [
                helper::format_icon_link(
                        manager::get_delete_set_link($row->id, true),
                        't/delete',
                        get_string('deleteset', 'disguise_predefined', $row),
                        null,
                        [
                            'data-type'     => 'sets',
                            'data-action'   => 'delete',
                            'data-name'     => $row->name,
                        ]
                    ),
                helper::format_icon_link(
                        manager::get_export_set_link($row->id),
                        't/export',
                        get_string('exportset', 'disguise_predefined', $row)
                    ),
                $OUTPUT->render(helper::render_available_inplace_editable($row)),
            ];
        return implode('&nbsp;', $actions);
    }
}
