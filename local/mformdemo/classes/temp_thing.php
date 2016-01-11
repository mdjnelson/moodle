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
 * This file contains the definition for the class assignment
 *
 * This class provides all the functionality for the new assign module.
 *
 * @package   local_mformdemo
 * @copyright 2015 Adrian
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/local/mformdemo/testedit_form.php');

class local_mformdemo_temp_thing {

    public function __construct() {
        // Nothing yet.
    }

    public function create_thing_form() {
        global $PAGE, $CFG;

        $PAGE->set_requirements_to_ajax();

        // $sitecontext = context_system::instance();

        // $summaryoptions = array('maxfiles'=> 99, 'maxbytes'=>$CFG->maxbytes, 'trusttext'=>true, 'context'=>$sitecontext);
        //         'subdirs'=>file_area_contains_subdirs($sitecontext, 'blog', 'post', 2));
        // $attachmentoptions = array('subdirs'=>false, 'maxfiles'=> 99, 'maxbytes'=>$CFG->maxbytes);
        // $data = new stdClass();
        // $data->description = '';
        // $entry = file_prepare_standard_editor($data, 'description', $summaryoptions);

        $testform = new testedit_form();
        // $testform->set_data($entry);
        $renderer = $PAGE->get_renderer('local_mformdemo');

        if ($data = $testform->get_data()) {
            print_object($data);
            return;
        } else {
            $mformoutput = $renderer->demo_form($testform);
        }

        return $mformoutput;
    }
}