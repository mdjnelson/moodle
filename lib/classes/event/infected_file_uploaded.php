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
 * Infected file uploaded event.
 *
 * @package    core
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

class infected_file_uploaded extends base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['level'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventinfectedfileuploaded');
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        if (empty($this->other['oldfilepath'])) {
            $stroldfilepath = 'The infected file was caught on upload.';
        } else {
            $stroldfilepath = 'The original file path of the infected file was ' . $this->other['oldfilepath'] . '.';
        }

        if (empty($this->other['newfilepath'])) {
            $strnewfilepath = 'The file has been deleted.';
        } else {
            $strnewfilepath = 'The file has been moved to a quarantine directory and the new path is '
                . $this->other['newfilepath'] . '.';
        }

        return 'An infected file was uploaded by a user with the id ' . $this->userid . '. '
            . $stroldfilepath . ' ' . $strnewfilepath;
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = '';
        }

        return array(0, 'upload', 'infected', $referer, $this->other['oldfilepath'], 0, $this->userid);
    }
}
