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
 * This file contains the moodle hooks for the legacy log store.
 *
 * @package   logstore_legacy
 * @copyright 2014 Mark Nelson <markn@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Returns whether this log store can support a given feature.
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed return true if the log store supports a feature, null otherwise
 */
function logstore_legacy_supports($feature) {
    switch($feature) {
        case FEATURE_BACKUP_MOODLE2 :
            return true;
        default :
            return null;
    }
}
