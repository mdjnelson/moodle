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
 * Class containing grading rule helper functions that handle the 'grading_rules' table read/writes.
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\grade\rule;

defined('MOODLE_INTERNAL') || die();

use core\plugininfo\graderule;

/**
 * Contains grading rule helper functions that handle the 'grading_rules' table read/writes.
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rule_helper {

    /**
     * Get all enabled rules.
     *
     * @return string[]
     */
    public static function get_enabled_rules(): array {
        return graderule::get_enabled_plugins();
    }

    /**
     * Load the rules for a grade item by ID.
     *
     * @param int $gradeitemid
     * @return rule_interface[]
     */
    public static function load_for_grade_item(int $gradeitemid): array {
        global $DB;

        if ($gradeitemid === 0) {
            return self::load_blank_instances();
        }

        $rawrules = $DB->get_records('grading_rules', ['gradeitemid' => $gradeitemid]);
        $rules = [];
        $alreadyloaded = [];

        if (!empty($rawrules)) {
            foreach ($rawrules as $rawrule) {
                // Only do this if the graderule plugin is installed.
                if (array_key_exists($rawrule->rulename, self::get_enabled_rules())) {
                    $rule = factory::create($rawrule->rulename, $rawrule->instanceid);

                    // Handle clean-up issues where we delete the plugin but it does not clear the gradingrules table.
                    if (!empty($rule)) {
                        $rules[] = $rule;
                        if ($rule->owned_by($gradeitemid)) {
                            $alreadyloaded[] = $rawrule->rulename;
                        }
                    }
                }
            }
        }

        $rules = array_merge($rules, self::load_blank_instances($alreadyloaded));
        self::sort_rules($rules);

        return $rules;
    }

    /**
     * Load rules for grade item by type.
     *
     * @param int $gradeitemid
     * @param string $rulename
     * @return rule_interface[]
     */
    public static function load_for_grade_item_by_type(int $gradeitemid, string $rulename): array {
        global $DB;

        $rules = [];
        $rawrules = $DB->get_records('grading_rules', ['gradeitemid' => $gradeitemid, 'rulename' => $rulename]);

        if (!empty($rawrules)) {
            foreach ($rawrules as $rawrule) {
                $rule = factory::create($rawrule->rulename, $rawrule->instanceid);
                if (!empty($rule)) {
                    $rules[] = $rule;
                }
            }
        }

        return $rules;
    }

    /**
     * Load blank rule.
     *
     * @param string[] $modulesloaded
     * @return rule_interface[]
     */
    private static function load_blank_instances(array $modulesloaded = []): array {
        $unloaded = array_diff(array_keys(self::get_enabled_rules()), $modulesloaded);

        $blankmodules = [];

        if (!empty($unloaded)) {
            foreach ($unloaded as $modulename) {
                $blankmodules[] = factory::create($modulename, -1);
            }
        }

        return $blankmodules;
    }

    /**
     * Save a rule association.
     *
     * @param int $gradeitemid
     * @param string $rulename
     * @param int $instanceid
     * @return void
     */
    public static function save_rule_association(int $gradeitemid, string $rulename, int $instanceid): void {
        global $DB;

        $ruleexists = $DB->record_exists(
            'grading_rules',
            ['gradeitemid' => $gradeitemid, 'rulename' => $rulename, 'instanceid' => $instanceid]
        );

        if (!$ruleexists) {
            $record = new \stdClass();
            $record->gradeitemid = $gradeitemid;
            $record->rulename = $rulename;
            $record->instanceid  = $instanceid;
            $DB->insert_record('grading_rules', $record);
        }
    }

    /**
     * Delete a rule association.
     *
     * @param string $rulename
     * @param int $instanceid
     * @return void
     */
    public static function delete_rule_association($rulename, $instanceid): void {
        global $DB;

        $DB->delete_records('grading_rules', ['rulename' => $rulename, 'instanceid' => $instanceid]);
    }

    /**
     * Sort the rule.
     *
     * @param rule_interface[] $rules
     * return void
     */
    private static function sort_rules(array &$rules): void {
        $order = self::get_enabled_rules();

        $comparator = function(rule_interface $a, rule_interface $b) use ($order) {
            $valuea = array_search($a->get_type(), array_keys($order));
            $valueb = array_search($b->get_type(), array_keys($order));

            if ($valuea < $valueb) {
                return -1;
            } else if ($valuea > $valueb) {
                return 1;
            } else {
                return 0;
            }
        };

        uasort($rules, $comparator);
    }
}
