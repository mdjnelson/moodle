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
namespace disguise_predefined\instance;

defined('MOODLE_INTERNAL') || die();

/**
 * Predefined set manager for instances of the disguise.
 *
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager {

    /**
     * @var     string  $settingsbase   The path to the settings base page.
     */
    protected static $settingsbase = '/user/disguise/predefined/setup.php';

    /**
     * @var     contect $context        The context of this disguise instance.
     */
    protected $context;

    /**
     * @const ACTION_LISTNAMES          The action to get the list of sets.
     */
    const ACTION_LISTNAMES = 'listnames';

    /**
     * @const ACTION_CREATE_FROM_SET    The action to get the list of sets.
     */
    const ACTION_CREATE_FROM_SET = 'createfromset';

    /**
     * This is the entry point for this controller class.
     */
    public function execute(\context $context, $action) {
        global $PAGE;

        $this->context = $context;

        $PAGE->set_disguise_configuration_page();
        if ($context instanceof \context_module) {
            list ($course, $cm) = get_course_and_cm_from_cmid($context->instanceid);
            $PAGE->set_cm($cm);
            require_login($course, false);
        } else if ($context instanceof \context_course) {
            $course = get_course($context->instanceid);
            require_login($course, false);
        } else if ($context instanceof \context_block) {
            $course = get_course($context->get_course_and_cm_from_cmid()->instanceid);
            require_login($course, false);
        } else {
            require_login(SITEID, false);
        }

        require_capability('moodle/disguise:configure', $context);
        $PAGE->set_pagelayout('admin');

        // Add the main content.
        switch($action) {
            case self::ACTION_CREATE_FROM_SET:
                $PAGE->set_url(self::get_import_from_set_link($context));
                $this->import_from_set(optional_param('id', null, PARAM_INT));
                break;

            case self::ACTION_LISTNAMES:
            default:
                $PAGE->set_url(self::get_index_link($context));
                $this->print_name_list();
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
            $title = get_string('header_instance_names', 'disguise_predefined');
        }
        echo $OUTPUT->heading($title);
    }

    /**
     * Print out the page footer.
     *
     * @return void
     */
    protected function footer() {
        global $OUTPUT;

        echo $OUTPUT->footer();
    }

    /**
     * Print the the list of names.
     */
    protected function print_name_list() {
        global $OUTPUT;

        $addform = new add_name_form(self::get_index_link($this->context));
        $this->process_add_names_form($addform);

        $configform = new disguise_config_form(self::get_index_link($this->context));
        $this->process_disguise_config_form($configform);
        $configform->set_data($this->context->disguise->get_config());

        $this->header();

        $table = new name_table($this->context);

        $names = $this->context->disguise->get_all_names($table->get_sql_sort());

        if (count($names)) {
            foreach ($names as $name) {
                $table->add_data_keyed($table->format_row($name));
            }
            $table->finish_output();
        } else {
            $sets = [];
            foreach (helper::get_sets(true) as $set) {
                $sets[$set->id] = $set->name;
            }
            if (count($sets)) {
                echo $OUTPUT->box(get_string('no_names_select_existing_set', 'disguise_predefined'), 'generalbox boxaligncenter');
                $singleselect = new \single_select(
                        self::get_import_from_set_link($this->context),
                        'id',
                        $sets
                    );
                echo $OUTPUT->render($singleselect);
            }
        }

        $configform->display();
        $addform->display();

        $this->footer();
    }

    /**
     * Process the disguise configuration form.
     *
     * @param   mform   $mform
     */
    protected function process_disguise_config_form($form) {
        if ($data = $form->get_data()) {

            $wrapper = helper::check_wrapper_format($data->wrapper);
            $this->context->disguise->set_config('wrapper', $wrapper);
            $this->context->disguise->save();

            $successmessage = get_string('message_updated_disguise_config', 'disguise_predefined', (object) [
                ]);

            redirect(self::get_index_link($this->context), $successmessage, 0, \core\notification::SUCCESS);
        }
    }

    /**
     * Process the add names to disguise form.
     *
     * @param   mform   $mform
     */
    protected function process_add_names_form($form) {
        if ($data = $form->get_data()) {
            $names = explode("\n", $data->names);
            $inserts = [];
            foreach ($names as $name) {
                $name = clean_param($name, PARAM_TEXT);
                $name = trim($name);
                $inserts[] = $name;
            }

            $this->context->disguise->add_names($inserts);

            $successmessage = get_string('message_added_x_names_to_disguise', 'disguise_predefined', (object) [
                    'count' => count($inserts),
                ]);

            redirect(self::get_index_link($this->context), $successmessage, 0, \core\notification::SUCCESS);
        }
    }

    /**
     * Import from the specified set.
     *
     * @param   int     $setid          The set to import from
     */
    protected function import_from_set($setid) {
        $set = helper::get_set($setid);
        $setnames = helper::get_set_names($setid);

        $names = [];
        foreach ($setnames as $name) {
            $names[] = $name->name;
        }

        $this->context->disguise
            ->set_config('wrapper', $set->wrapper)
            ->save()
            ->add_names($names);

        $successmessage = get_string('message_set_imported', 'disguise_predefined', (object) [
                'name'  => $set->name,
                'count' => count($names),
            ]);
        redirect(self::get_index_link($this->context), $successmessage, 0, \core\notification::SUCCESS);
    }

    /**
     * Get the link to delete a name from a set.
     *
     * @param   context     $context    The context that the disguise is applied to.
     * @return  moodle_url
     */
    public static function get_index_link(\context $context) {
        $link = new \moodle_url(self::$settingsbase, [
                'context'   => $context->id,
            ]);

        return $link;

    }

    /**
     * Get the link to import from a set.
     *
     * @param   context     $context    The context that the disguise is applied to.
     * @return  moodle_url
     */
    public static function get_import_from_set_link(\context $context) {
        $link = new \moodle_url(self::$settingsbase, [
                'action'    => self::ACTION_CREATE_FROM_SET,
                'context'   => $context->id,
            ]);

        return $link;

    }
}
