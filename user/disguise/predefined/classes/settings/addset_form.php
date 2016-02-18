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

require_once($CFG->libdir . '/formslib.php');

/**
 * Form for adding names.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class addset_form extends \moodleform {
    /**
     * Form definition.
     */
    public function definition() {
        $this->_form->addElement('header', 'newset', get_string('header_addnewset', 'disguise_predefined'));
        $this->_form->setExpanded('newset', false);

        $this->_form->addElement('text', 'name', get_string('form_set_name', 'disguise_predefined'));
        $this->_form->setType('name', PARAM_TEXT);

        $this->_form->addElement('text', 'wrapper', get_string('form_set_wrapper', 'disguise_predefined'));
        $this->_form->setType('wrapper', PARAM_TEXT);
        $this->_form->setDefault('wrapper', '{{name}}');

        $this->_form->addElement('submit', 'submitbutton', get_string('button_add_set', 'disguise_predefined'));
    }
}
