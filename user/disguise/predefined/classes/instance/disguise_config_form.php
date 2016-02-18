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

require_once($CFG->libdir . '/formslib.php');

/**
 * Form for setting the wrapper of a disguise.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguise_config_form extends \moodleform {
    /**
     * Form definition.
     */
    public function definition() {
        $this->_form->addElement('header', 'disguiseconfig', get_string('header_disguise_config', 'disguise_predefined'));

        $this->_form->addElement('text', 'wrapper', get_string('form_config_wrapperformat', 'disguise_predefined'));
        $this->_form->setType('wrapper', PARAM_TEXT);
        $this->_form->addHelpButton('wrapper', 'form_config_wrapperformat', 'disguise_predefined');
        $this->_form->setDefault('wrapper', '{{name}}');

        $this->_form->addElement('submit', 'submitbutton', get_string('savechanges'));
    }
}
