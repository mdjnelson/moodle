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
 * Test classes for \core\disguise\disguise.
 *
 * @package core_disguise
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\tests\fixtures\disguise;

defined('MOODLE_INTERNAL') || die();

/**
 * Test classes for \core\disguise\disguise.
 *
 * @package core_disguise
 * @category test
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper extends \core\disguise\helper {

    /**
     * @inheritdoc
     * */
    public static function create(\context $context, $disguisetype) {
        return parent::create($context, $disguisetype);
    }

}
