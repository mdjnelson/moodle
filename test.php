<?php
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/lib/formslib.php');

$COUNT = (int)ini_get('max_input_vars') - 100;

class horrid_test_form extends moodleform {
    public function definition() {
        global $CFG, $PAGE;

        $mform =& $this->_form;

        $mform->addElement('header', 'general', '');

        global $COUNT;
        for ($i = 0; $i < $COUNT; $i++) {
            $mform->addElement('advcheckbox', 'cb' . $i, 'Checkbox ' . $i);
        }
        $mform->addElement('submit', 'submitbutton', 'Submit here!');
    }

    public function validation($data, $files) {
        $errors['submitbutton'] = 'This form never validates';
        return $errors;
    }
}

require_login();

$context = context_system::instance();

// Set up the page details.
$PAGE->set_url(new moodle_url('/test.php'));
$PAGE->set_context($context);

$mform = new horrid_test_form();
$data = array();
for ($i = 50; $i < $COUNT - 50; $i++) {
    $data['cb' . $i] = 1;
}
$mform->set_data($data);

print $OUTPUT->header();

print html_writer::tag('p',
        'This form contains ' . $COUNT . ' advanced checkboxes. We have ' .
        'pre-checked all except the first and last 50. If you try ticking the ' .
        'first and last one, then hit save, assuming MDL-52226 has not been fixed, ' .
        'you will find that the first checkbox is saved correctly but the last one ' .
        'is not - this is the dataloss bug.');

$mform->display();

print $OUTPUT->footer();
