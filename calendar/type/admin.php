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
 * Handles displaying and managing calendar types.
 *
 * @package core_calendar
 * @copyright 2008 onwards Foodle Group {@link http://foodle.org}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');

admin_externalpage_setup('managecalendartypes');

$delete  = optional_param('delete', '', PARAM_PLUGIN);
$confirm = optional_param('confirm', '', PARAM_BOOL);

/// If data submitted, then process and store.
if (!empty($delete) and confirm_sesskey()) {
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('type_calendartype_plural', 'plugin'));

    // Provide a confirmation message before deleting the plugin.
    if (!$confirm) {
        if (get_string_manager()->string_exists('pluginname', 'calendartype_' . $delete)) {
            $strpluginname = get_string('pluginname', 'calendartype_' . $delete);
        } else {
            $strpluginname = $delete;
        }
        echo $OUTPUT->confirm(get_string('calendartypedeleteconfirm', 'calendar', $strpluginname),
                              new moodle_url($PAGE->url, array('delete' => $delete, 'confirm' => 1)),
                              $PAGE->url);
        echo $OUTPUT->footer();
        exit();
    } else { // They have confirmed they want to delete the plugin.
        uninstall_plugin('calendartype', $delete);
        $a = new stdclass();
        $a->name = $delete;
        $pluginlocation = get_plugin_types();
        $a->directory = $pluginlocation['calendartype'] . '/' . $delete;
        echo $OUTPUT->notification(get_string('plugindeletefiles', '', $a), 'notifysuccess');
        echo $OUTPUT->continue_button($PAGE->url);
        echo $OUTPUT->footer();
        exit();
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('type_calendartype_plural', 'plugin'));

// Print the table of all installed local plugins.
$table = new flexible_table('calendartypes_administration_table');
$table->define_columns(array('name', 'version', 'delete'));
$table->define_headers(array(get_string('plugin'), get_string('version'), get_string('delete')));
$table->define_baseurl($PAGE->url);
$table->set_attribute('id', 'calendartypes');
$table->set_attribute('class', 'generaltable generalbox boxaligncenter boxwidthwide');
$table->setup();

$plugins = array();
foreach (get_plugin_list('calendartype') as $plugin => $plugindir) {
    if (get_string_manager()->string_exists('pluginname', 'calendartype_' . $plugin)) {
        $strpluginname = get_string('pluginname', 'calendartype_' . $plugin);
    } else {
        $strpluginname = $plugin;
    }
    $plugins[$plugin] = $strpluginname;
}
collatorlib::asort($plugins);

foreach ($plugins as $plugin => $name) {
    $delete = new moodle_url($PAGE->url, array('delete' => $plugin, 'sesskey' => sesskey()));
    $delete = html_writer::link($delete, get_string('delete'));

    $version = get_config('calendartype_' . $plugin);
    if (!empty($version->version)) {
        $version = $version->version;
    } else {
        $version = '?';
    }

    $table->add_data(array($name, $version, $delete));
}

$table->print_html();
echo $OUTPUT->footer();
