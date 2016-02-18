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

namespace disguise_predefined;

defined('MOODLE_INTERNAL') || die();

/**
 * Disguise plugin for selection of user details from a predefined list.
 *
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {
    /**
     * Fetch the list of sets.
     *
     * @param   bool        $enabled    Just the enabled sets.
     * @param   string      $sort       The sort order of the results
     * @return  array
     */
    public static function get_sets($enabled = false, $sort = '') {
        global $DB;

        $enabledsql = '';
        if ($enabled) {
            $enabledsql = 'WHERE s.available = 1';
        }

        $orderbysql = '';
        if ($sort) {
            $orderbysql = "ORDER BY $sort";
        }

        $sql = <<<EOF
        SELECT s.*, COUNT(d.id) AS count
        FROM {disguise_predefined_sets} s
    LEFT JOIN {disguise_predefined_set_data} d ON d.setid = s.id
    $enabledsql
    GROUP BY s.id
    $orderbysql
EOF;

        return $DB->get_records_sql($sql);
    }

    /**
     * Get the list of names in the specified set.
     *
     * @param   int         $setid      The set id.
     * @param   string      $sort       The sort order of the results
     * @return  array
     */
    public static function get_set_names($setid, $sort = '') {
        global $DB;

        return $DB->get_records('disguise_predefined_set_data', [
                'setid'   => $setid,
            ], $sort);
    }

    /**
     * Get the specified set.
     *
     * @param   int         $setid      The set id.
     * @return  stdClass
     */
    public static function get_set($setid) {
        global $DB;

        return $DB->get_record('disguise_predefined_sets', [
                'id'    => $setid,
            ]);
    }

    /**
     * Add a new set.
     *
     * @param   string      $name       The name of the new set.
     * @param   string      $wrapper    The wrapper to use.
     * @param   bool        $available  Whether the set is available.
     * @param   array       $data       The names in the set.
     * @return  stdClass
     */
    public static function add_set($name, $wrapper, $available = true, $data = []) {
        global $DB;

        $set = (object) [
                'name'      => $name,
                'wrapper'   => self::check_wrapper_format($wrapper),
                'available' => $available,
            ];
        $set->id = $DB->insert_record('disguise_predefined_sets', $set);

        $names = [];
        foreach ($data as $name) {
            $names[] = (object) [
                    'setid'   => $set->id,
                    'name'  => $name,
                ];
        }
        $DB->insert_records('disguise_predefined_set_data', $names);

        return $set;
    }

    /**
     * Get the specified name.
     *
     * @param   int         $nameid     The name id.
     * @return  stdClass
     */
    public static function get_name($nameid) {
        global $DB;

        return $DB->get_record('disguise_predefined_set_data', [
                'id'    => $nameid,
            ]);
    }

    /**
     * Format an icon with a link.
     *
     * @return  string
     */
    public static function format_icon_link($url, $icon, $alt, $iconcomponent = null, $options = array()) {
        global $OUTPUT;

        if ($iconcomponent === null) {
            $iconcomponent = 'disguise_predefined';
        }

        return $OUTPUT->action_icon(
                $url,
                new \pix_icon($icon, $alt, $iconcomponent, [
                        'title' => $alt,
                    ]),
                null,
                $options
                );

    }

    /**
     * Check that the format of the wrapper includes the name.
     *
     * @param   string      $value      The wrapper value.
     * @return  string
     */
    public static function check_wrapper_format($value) {
        if (strpos($value, '{{name}}') === false) {
            $value .= '{{name}}';
        }

        return $value;
    }
}
