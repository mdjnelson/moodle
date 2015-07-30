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
 * Provides an overview of installed disguise plugins.
 *
 * @package    admin
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');

admin_externalpage_setup('managedisguiseplugins');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('disguiseplugins'));

// Print the table of all installed disguise plugins.
$table = new flexible_table('disguiseplugins_administration_table');
$table->define_columns([
        'name',
        'instances',
        'version',
        'uninstall',
        'settings',
    ]);
$table->define_headers([
        get_string('plugin'),
        get_string('disguiseinstances', 'core_admin'),
        get_string('version'),
        get_string('uninstallplugin', 'core_admin'),
        get_string('settings'),
    ]);
$table->define_baseurl($PAGE->url);
$table->set_attribute('id', 'disguiseplugins');
$table->set_attribute('class', 'admintable generaltable');
$table->setup();

$plugins = [];
foreach (core_component::get_plugin_list('disguise') as $plugin => $plugindir) {
    $plugins[$plugin] = get_string('pluginname', 'disguise_' . $plugin);
}
core_collator::asort($plugins);

foreach ($plugins as $plugin => $name) {
    $instancecount = $DB->count_records('disguises', ['type' => $plugin]);

    $pluginconfig = get_config('disguise_' . $plugin);
    if (!empty($pluginconfig->version)) {
        $version = $pluginconfig->version;
    } else {
        $version = '?';
    }

    $uninstall = '';
    if ($uninstallurl = core_plugin_manager::instance()->get_uninstall_url('disguise_' . $plugin, 'manage')) {
        $uninstall = html_writer::link($uninstallurl, get_string('uninstallplugin', 'core_admin'));
    }

    $settings = '';
    $settingsfile = $CFG->dirroot . "/user/disguise/$plugin/settings.php";
    if (file_exists($settingsfile)) {
        $settings = html_writer::link(
                new moodle_url("/user/disguise/$plugin/settings.php"),
                get_string('settings')
            );
    }

    $table->add_data([
            $name,
            $instancecount,
            $version,
            $uninstall,
            $settings,
        ]);
}

$table->print_html();

echo $OUTPUT->footer();
