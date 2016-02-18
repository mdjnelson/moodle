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
 * Basic Disguise.
 *
 * @package    disguise_basic
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace disguise_basic;

defined('MOODLE_INTERNAL') || die();

/**
 * Basic Disguise.
 *
 * @package    disguise_basic
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class disguise extends \core\disguise\disguise {

    /**
     * @inheritdoc
     */
    protected function disguise_displayname(\stdClass $user, $options) {
        return $this->get_config()->disguiseuseras;
    }

    /**
     * @inheritdoc
     */
    protected function requires_user_configuration() {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function add_disguise_navigation() {
        $nodes = array();
        if (has_capability('moodle/disguise:configure', $this->context)) {
            // Note, use of can_make_changes() here is not relevant as the settings on this page do not reveal the true identity.
            // It may be necessary to configure the display name, whilst the plugin is locked.
            $nodes[] = \navigation_node::create(
                    get_string('disguiseconfig', 'disguise_basic'),
                    new \moodle_url('/user/disguise/basic/setup.php',  array('context' => $this->context->id)),
                    \navigation_node::TYPE_SETTING,
                    null,
                    'contextdisguise'
                );
        }

        return $nodes;
    }

    /**
     * @inheritdoc
     */
    protected function get_config_defaults() {
        return [
            'disguiseuseras' => get_string('anonymous', 'disguise_basic'),
        ];
    }

}
