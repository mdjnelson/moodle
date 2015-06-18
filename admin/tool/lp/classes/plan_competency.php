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
 * Class for loading/storing plan_competencies from the DB.
 *
 * @package    tool_lp
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp;

use stdClass;

/**
 * Class for loading/storing plan_competencies from the DB.
 *
 * @copyright  2015 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plan_competency extends persistent {

    /** @var int $templateid The template id */
    private $templateid = 0;

    /** @var int $competencyid The competency id */
    private $competencyid = 0;

    /** @var int $sortorder A number used to influence sorting */
    private $sortorder = 0;

    /**
     * Method that provides the table name matching this class.
     *
     * @return string
     */
    public function get_table_name() {
        return 'tool_lp_plan_competency';
    }

    /**
     * Get the competency id
     *
     * @return int The competency id
     */
    public function get_competencyid() {
        return $this->competencyid;
    }

    /**
     * Set the competency id
     *
     * @param int $competencyid The competency id
     */
    public function set_competencyid($competencyid) {
        $this->competencyid = $competencyid;
    }

    /**
     * Get the sort order index.
     *
     * @return string The sort order index
     */
    public function get_sortorder() {
        return $this->sortorder;
    }

    /**
     * Set the sort order index.
     *
     * @param string $sortorder The sort order index
     */
    public function set_sortorder($sortorder) {
        $this->sortorder = $sortorder;
    }

    /**
     * Get the plan id.
     *
     * @return int The template id
     */
    public function get_planid() {
        return $this->templateid;
    }

    /**
     * Set the plan id.
     *
     * @param int $templateid The template id
     */
    public function set_planid($templateid) {
        $this->templateid = $templateid;
    }

    /**
     * Populate this class with data from a DB record.
     *
     * @param \stdClass $record A DB record.
     * @return template_competency
     */
    public function from_record($record) {
        if (isset($record->id)) {
            $this->set_id($record->id);
        }
        if (isset($record->planid)) {
            $this->set_planid($record->planid);
        }
        if (isset($record->competencyid)) {
            $this->set_competencyid($record->competencyid);
        }
        if (isset($record->sortorder)) {
            $this->set_sortorder($record->sortorder);
        }
        if (isset($record->timecreated)) {
            $this->set_timecreated($record->timecreated);
        }
        if (isset($record->timemodified)) {
            $this->set_timemodified($record->timemodified);
        }
        if (isset($record->usermodified)) {
            $this->set_usermodified($record->usermodified);
        }
        return $this;
    }

    /**
     * Create a DB record from this class.
     *
     * @return stdClass
     */
    public function to_record() {
        $record = new stdClass();
        $record->id = $this->get_id();
        $record->templateid = $this->get_templateid();
        $record->competencyid = $this->get_competencyid();
        $record->sortorder = $this->get_sortorder();
        $record->timecreated = $this->get_timecreated();
        $record->timemodified = $this->get_timemodified();
        $record->usermodified = $this->get_usermodified();

        return $record;
    }

    /**
     * List the competencies in this plan.
     *
     * @param int $planid The plan id
     * @param bool $onlyvisible If true, only count visible competencies in this plan.
     * @return array[competency]
     */
    public function list_competencies($planid, $onlyvisible) {
        global $DB;

        $competency = new competency();
        $sql = 'SELECT comp.*
                  FROM {' . $competency->get_table_name() . '} comp
                  JOIN {' . $this->get_table_name() . '} plancomp
                    ON plancomp.competencyid = comp.id
                 WHERE plancomp.planid = ?
              ORDER BY plancomp.sortorder ASC';
        $params = array($planid);

        if ($onlyvisible) {
            $sql .= ' AND comp.visible = ?';
            $params[] = 1;
        }

        $results = $DB->get_records_sql($sql, $params);

        $instances = array();
        foreach ($results as $result) {
            array_push($instances, new competency(0, $result));
        }

        return $instances;
    }
}