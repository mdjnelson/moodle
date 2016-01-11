<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

/**
 * The form for handling editing a course.
 */
class testedit_form extends moodleform {

    /**
     * Form definition.
     */
    function definition() {
        global $CFG, $PAGE;

        $mform = $this->_form;

        $summaryoptions = $this->_customdata['summaryoptions'];

        $mform->addElement('header', 'header1', 'This is the header of the form');


        $mform->addElement('text', 'title', 'Title');
        // $mform->addRule('title', get_string('required'), 'required');
        $mform->setType('title', PARAM_RAW);

        $mform->addElement('autocomplete', 'names', 'Names', array('David', 'Fred'));
        $mform->addElement('autocomplete', 'tags', 'Tags', array('working', 'awesome', 'great work'));
        $mform->addElement('editor', 'test_editor', "Test editor", null, $summaryoptions);

        $this->add_action_buttons();
        // $classarray = array('class' => 'form-submit');
        // $buttonarray[] = $mform->createElement('submit', 'save', 'Save');
        // $buttonarray[] = $mform->createElement('cancel');
        // $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        // $mform->closeHeaderBefore('buttonar');
    
    }



}
