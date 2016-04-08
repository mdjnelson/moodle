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
 * General plugin functions.
 *
 * @package    enrol_lti
 * @copyright  2016 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/enrol/lti/locallib.php');

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_heading('enrol_lti_sync_settings',
        get_string('syncsettings', 'enrol_lti'), ''));

    $settings->add(new admin_setting_configduration('enrol_lti/gradesynctime',
        get_string('gradesynctime', 'enrol_lti'), get_string('gradesynctime_desc', 'enrol_lti'), 60 * 60));

    $options = array(ENROL_LTI_GRADE_SYNC_ALWAYS => get_string('always'),
                     ENROL_LTI_GRADE_SYNC_DIFFERS => get_string('gradesyncmodediffer', 'enrol_lti'),
                     ENROL_LTI_GRADE_SYNC_FIRST_TIME => get_string('gradesyncmodefirsttime', 'enrol_lti'));
    $settings->add(new admin_setting_configselect('enrol_lti/gradesyncmode',
        get_string('gradesyncmode', 'enrol_lti'), get_string('gradesyncmode_desc', 'enrol_lti'), ENROL_LTI_GRADE_SYNC_DIFFERS,
        $options));

    $settings->add(new admin_setting_configduration('enrol_lti/membersynctime',
        get_string('membersynctime', 'enrol_lti'), get_string('membersynctime_desc', 'enrol_lti'), 60 * 60));

    $options = array();
    $options[ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL] = get_string('enrolandunenrol', 'enrol_lti');
    $options[ENROL_LTI_MEMBER_SYNC_ENROL_NEW] = get_string('enrolnew', 'enrol_lti');
    $options[ENROL_LTI_MEMBER_SYNC_UNENROL_MISSING] = get_string('unenrolmissing', 'enrol_lti');
    $settings->add(new admin_setting_configselect('enrol_lti/membersyncmode',
        get_string('membersyncmode', 'enrol_lti'), get_string('membersyncmode_desc', 'enrol_lti'),
        ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL, $options));

    $settings->add(new admin_setting_heading('enrol_lti_user_default_values',
        get_string('userdefaultvalues', 'enrol_lti'), ''));

    $choices = array(0 => get_string('never'),
                     1 => get_string('always'));
    $settings->add(new admin_setting_configselect('enrol_lti/userprofileupdate', get_string('userprofileupdate', 'enrol_lti'),
        '', 1, $choices));

    $choices = array(0 => get_string('emaildisplayno'),
                     1 => get_string('emaildisplayyes'),
                     2 => get_string('emaildisplaycourse'));
    $settings->add(new admin_setting_configselect('enrol_lti/emaildisplay', get_string('emaildisplay'), '', '0',
        $choices));

    $city = '';
    if (!empty($CFG->defaultcity)) {
        $city = $CFG->defaultcity;
    }
    $settings->add(new admin_setting_configtext('enrol_lti/city', get_string('city'), '', $city));

    $country = '';
    if (!empty($CFG->country)) {
        $country = $CFG->country;
    }
    $countries = array('' => get_string('selectacountry') . '...') + get_string_manager()->get_list_of_countries();
    $settings->add(new admin_setting_configselect('enrol_lti/country', get_string('selectacountry'), '', $country,
        $countries));

    $settings->add(new admin_setting_configselect('enrol_lti/timezone', get_string('timezone'), '', 99,
        core_date::get_list_of_timezones(null, true)));

    $settings->add(new admin_setting_configselect('enrol_lti/lang', get_string('preferredlanguage'), '', $CFG->lang,
        get_string_manager()->get_list_of_translations()));

    $settings->add(new admin_setting_configtext('enrol_lti/institution', get_string('institution'), '', ''));
}
