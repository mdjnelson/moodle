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

require_once($CFG->libdir . '/tablelib.php');

/**
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class name_table extends \flexible_table {
    /**
     * @var     context $context
     */
    protected $context;

    /**
     * Constructor for the list of names in the disguise.
     *
     * @param   context $context
     */
    public function __construct(\context $context) {
        parent::__construct('disguise_predefined_names');

        $this->context = $context;

        $this->define_baseurl(manager::get_index_link($context));

        // Column definition.
        $this->define_columns([
                'name',
                'enabled',
                'assigned',
            ]);

        $this->define_headers([
                get_string('header_name',       'disguise_predefined'),
                get_string('header_enabled',    'disguise_predefined'),
                get_string('header_assigned',   'disguise_predefined'),
        ]);

        $this->set_attribute('class', 'admintable generaltable set_names_table');
        $this->sortable(true, 'name');
        $this->setup();
    }

    /**
     * Formatter for the assigned column
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_assigned($row) {
        if (empty($row->assigned)) {
            return get_string('no');
        } else {
            return get_string('yes');
        }
    }

    /**
     * Formatter for the enabled column
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_enabled($row) {
        global $OUTPUT;
        return $OUTPUT->render(helper::render_enabled_inplace_editable($this->context, $row));
    }

    /**
     * Formatter for the name column
     *
     * @param   stdClass    $row    Database row for formatting
     * @return  string              The formatted row
     */
    public function col_name($row) {
        global $OUTPUT;
        return $OUTPUT->render(helper::render_name_inplace_editable($this->context, $row));
    }
}
