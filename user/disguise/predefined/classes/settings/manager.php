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
namespace disguise_predefined\settings;

defined('MOODLE_INTERNAL') || die();

require($CFG->libdir . '/adminlib.php');

/**
 * Predefined set manager.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager {

    /**
     * @var     string  $settingsbase   The path to the settings base page.
     */
    protected static $settingsbase = '/user/disguise/predefined/settings.php';

    /**
     * @const ACTION_LISTSETS      The action to get the list of sets.
     */
    const ACTION_LISTSETS = 'listsets';

    /**
     * @const ACTION_EXPORTSET     The action to export the set.
     */
    const ACTION_EXPORTSET = 'exportset';

    /**
     * @const ACTION_IMPORTSET     The action to import the set.
     */
    const ACTION_IMPORTSET = 'importset';

    /**
     * @const ACTION_DELETESET     The action to delete the set.
     */
    const ACTION_DELETESET = 'deleteset';

    /**
     * @const ACTION_VIEWSET       The action to view the set.
     */
    const ACTION_VIEWSET = 'viewset';

    /**
     * @const ACTION_DELETENAME The action to delete a name.
     */
    const ACTION_DELETENAME = 'deletename';

    /**
     * @const ACTION_VIEWNAME The action to view a name.
     */
    const ACTION_VIEWNAME = 'viewname';

    /**
     * @const ACTION_HIDESET The action to hide a set.
     */
    const ACTION_HIDESET = 'hideset';

    /**
     * @const ACTION_SHOWSET The action to show a set.
     */
    const ACTION_SHOWSET = 'showset';

    /**
     * This is the entry point for this controller class.
     */
    public function execute($action) {
        admin_externalpage_setup('disguise_predefined');

        // Add the main content.
        switch($action) {
            case self::ACTION_EXPORTSET:
                $this->export_set(required_param('id', PARAM_INT));
                break;

            case self::ACTION_IMPORTSET:
                $this->import_set();
                break;

            case self::ACTION_VIEWSET:
                $this->view_set(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_HIDESET:
                $this->hide_set(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_SHOWSET:
                $this->show_set(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_DELETESET:
                $this->delete_set(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_DELETENAME:
                $this->delete_name(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_LISTSETS:
            default:
                $this->print_set_list();
                break;
        }
    }

    /**
     * Print out the page header.
     *
     * @return void
     */
    protected function header($title = null) {
        global $OUTPUT;

        // Print the page heading.
        echo $OUTPUT->header();
        if ($title === null) {
            $title = get_string('sets', 'disguise_predefined');
        }
        echo $OUTPUT->heading($title);
    }

    /**
     * Print out the page footer.
     *
     * @return void
     */
    protected function footer() {
        global $OUTPUT, $PAGE;

        $PAGE->requires->js_call_amd('disguise_predefined/settings', 'init');
        $PAGE->requires->strings_for_js([
            'yes',
            'no',
        ], 'moodle');
        $PAGE->requires->strings_for_js([
            'dialogue_delete_set_title',
            'dialogue_delete_set_question',
            'dialogue_delete_set_data_title',
            'dialogue_delete_set_data_question',
        ], 'disguise_predefined');
        echo $OUTPUT->footer();
    }

    /**
     * Print the the list of sets.
     */
    protected function print_set_list() {
        $addsetform = new addset_form(self::get_index_link());
        $this->process_add_set_form($addsetform);

        $importsetform = new import_set_form(self::get_index_link());
        $this->process_import_set_form($importsetform);

        $this->header();
        $table = new sets_table();
        $sets = helper::get_sets(false, $table->get_sql_sort());
        foreach ($sets as $set) {
            $table->add_data_keyed($table->format_row($set));
        }

        $table->finish_output();
        $addsetform->display();
        $importsetform->display();
        $this->footer();
    }

    /**
     * Process the add set form.
     *
     * @param   mform   $mform
     */
    protected function process_add_set_form($form) {
        global $DB;

        if ($data = $form->get_data()) {
            $set = (object) [
                    'name'      => $data->name,
                    'wrapper'   => $data->wrapper,
                ];
            $set->id = $DB->insert_record('disguise_predefined_sets', $set);

            $successmessage = get_string('message_created_set', 'disguise_predefined', (object) [
                    'name'  => $set->name,
                ]);
            redirect(self::get_view_set_link($set->id), $successmessage, 0, \core\notification::SUCCESS);
        }
    }

    /**
     * Process the import set form.
     *
     * @param   mform   $mform
     */
    protected function process_import_set_form($form) {
        if ($form->get_data()) {
            $setconfigraw = $form->get_file_content('setconfig');
            $setconfig = json_decode($setconfigraw);

            $set = helper::add_set($setconfig->name, $setconfig->wrapper, $setconfig->available, $setconfig->names);

            $successmessage = get_string('message_imported_set', 'disguise_predefined', (object) [
                    'name'  => $set->name,
                    'count' => count($setconfig->names),
                ]);
            redirect(self::get_view_set_link($set->id), $successmessage, 0, \core\notification::SUCCESS);
        }
    }

    /**
     * Print the view set page.
     *
     * @param   int         $setid     The ID of the set to display.
     */
    protected function view_set($setid) {
        global $PAGE;

        $set = helper::get_set($setid);
        $form = new addname_form(self::get_view_set_link($setid), $set);

        $this->process_add_names_form($form, $set);

        $PAGE->navbar->add($set->name, self::get_view_set_link($setid));
        $this->header(get_string('setnamed', 'disguise_predefined', $set));

        $table = new set_names_table($set);
        foreach (helper::get_set_names($setid, $table->get_sql_sort()) as $name) {
            $table->add_data_keyed($table->format_row($name));
        }

        $table->finish_output();

        $form->display();

        $this->footer();
    }

    /**
     * Process the add names to set form.
     *
     * @param   mform       $mform
     * @param   stdClass    $set        The set to add the names to
     */
    protected function process_add_names_form($form, $set) {
        global $DB;

        if ($data = $form->get_data()) {
            $names = explode("\n", $data->names);
            $inserts = [];
            foreach ($names as $name) {
                $name = clean_param($name, PARAM_TEXT);
                $name = trim($name);
                $insert = (object) [
                        'setid'   => $set->id,
                        'name'  => $name,
                    ];
                $inserts[] = $insert;
            }

            $

            $DB->insert_records('disguise_predefined_set_data', $inserts);
            $successmessage = get_string('message_addedxnamestoset', 'disguise_predefined', (object) [
                    'count' => count($inserts),
                    'name'  => $set->name,
                ]);

            redirect(self::get_view_set_link($set->id), $successmessage, 0, \core\notification::SUCCESS);
        }
    }

    /**
     * Print the export set page.
     *
     * @param   int         $setid     The ID of the set to display.
     */
    protected function export_set($setid) {
        $export = helper::get_set($setid);
        unset($export->id);

        $export->version = get_config('disguise_predefined', 'version');

        $export->names = [];
        foreach (helper::get_set_names($setid) as $record) {
            unset($record->id);
            unset($record->set);

            $export->names[] = $record;
        }

        $exportstring = json_encode($export);

        $filename = 'disguise_export_' . $setid . '_' . time() . '.json';

        // Force download.
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
		header('Cache-Control: private, must-revalidate, pre-check=0, post-check=0, max-age=0');
		header('Expires: ' . gmdate('D, d M Y H:i:s', 0) . 'GMT');
		header('Pragma: no-cache');
		header('Accept-Ranges: none');
		header('Content-disposition: attachment; filename=' . $filename);
		header('Content-length: ' . strlen($exportstring));
		header('Content-type: text/calendar; charset=utf-8');

        echo $exportstring;
        die;
    }

    /**
     * Remove the specified set.
     *
     * @param   int         $setid     The ID of the set to remove.
     */
    protected function delete_set($setid) {
        global $DB;

        $set = helper::get_set($setid);

        // Delete all of the names in the set.
        $DB->delete_records('disguise_predefined_set_data', ['setid' => $set->id]);

        // Now delete the set.
        $DB->delete_records('disguise_predefined_sets', ['id' => $set->id]);

        $successmessage = get_string('message_set_removed', 'disguise_predefined', (object) [
                'name' => $set->name,
            ]);
        redirect(self::get_index_link(), $successmessage, 0, \core\notification::SUCCESS);
    }

    /**
     * Remove the specified set.
     *
     * @param   int         $nameid     The ID of the name to remove.
     */
    protected function delete_name($nameid) {
        global $DB;

        $name = helper::get_name($nameid);
        $set = helper::get_set($name->set);

        // Delete the name.
        $DB->delete_records('disguise_predefined_set_data', ['id' => $name->id]);

        $successmessage = get_string('message_name_removed', 'disguise_predefined', (object) [
                'name' => $name->name,
                'setname' => $set->name,
            ]);
        redirect(self::get_view_set_link($set->id), $successmessage, 0, \core\notification::SUCCESS);
    }

    /**
     * Get the link to the settings index.
     *
     * @return  moodle_url
     */
    public static function get_index_link() {
        return new \moodle_url(self::$settingsbase);
    }

    /**
     * Get the link to edit a set.
     *
     * @param   int     $setid      The id of the set to view.
     * @return  moodle_url
     */
    public static function get_view_set_link($setid) {
        return new \moodle_url(self::$settingsbase, [
                'action'    => self::ACTION_VIEWSET,
                'id'        => $setid,
            ]);
    }

    /**
     * Get the link to export a set.
     *
     * @param   int     $setid      The id of the set to export.
     * @return  moodle_url
     */
    public static function get_export_set_link($setid) {
        return new \moodle_url(self::$settingsbase, [
                'action'    => self::ACTION_EXPORTSET,
                'id'        => $setid,
            ]);
    }

    /**
     * Get the link to delete a set.
     *
     * @param   int     $setid     The id of the set to delete.
     * @param   boolean $sesskey    Include the sesskey to format this link as an action.
     * @return  moodle_url
     */
    public static function get_delete_set_link($setid, $sesskey = false) {
        $link = new \moodle_url(self::$settingsbase, [
                'action'    => self::ACTION_DELETESET,
                'id'        => $setid,
            ]);

        if ($sesskey) {
            $link->param('sesskey', sesskey());
        }

        return $link;
    }

    /**
     * Get the link to delete a name from a set.
     *
     * @param   int     $nameid     The id of the name to delete.
     * @param   boolean $sesskey    Include the sesskey to format this link as an action.
     * @return  moodle_url
     */
    public static function get_delete_name_link($nameid, $sesskey = false) {
        $link = new \moodle_url(self::$settingsbase, [
                'action'    => self::ACTION_DELETENAME,
                'id'        => $nameid,
            ]);

        if ($sesskey) {
            $link->param('sesskey', sesskey());
        }

        return $link;
    }
}
