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
 * Question instances report viewed event class.
 *
 * @package    report_questioninstances
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace report_questioninstances\event;

defined('MOODLE_INTERNAL') || die();

class report_viewed extends \core\event\report_viewed {

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('report/questioninstances/index.php', array('qtype' => $this->other['requestedqtype']));
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, 'admin', 'report questioninstances', 'report/questioninstances/index.php?qtype=' .
            $this->other['requestedqtype'], $this->other['requestedqtype']);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     */
    protected function validate_data() {
        if (!isset($this->other['requestedqtype'])) {
            throw new \coding_exception('The requested question type needs to be set in $other');
        }
    }
}
