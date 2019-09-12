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
 * Factory class for grading rules
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\grade\rule;

/**
 * Factory class for grading rules
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class factory implements factory_interface {

    /**
     * Create a new rule_interface.
     *
     * @param string $plugin
     * @param int    $instanceid
     *
     * @return rule_interface
     */
    public static function create($plugin, $instanceid) {
        $class = "\\graderule_$plugin\\factory";

        // Check to see if class exists.
        if (!class_exists($class)) {
            throw new \coding_exception('The factory class does not exist');
        }

        // TODO: Fix the check to see if the class is a factory_interface.
        $method = new \ReflectionMethod($class, "create");

        return $method->invokeArgs(null, [$plugin, $instanceid]);
    }
}
