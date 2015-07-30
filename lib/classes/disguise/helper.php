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
 * User disguises
 *
 * @package    core
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\disguise;

defined('MOODLE_INTERNAL') || die();

/**
 * Disguise Helper.
 *
 * @package    core
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {

    /**
     * const DISGUISE_DISABLED The disguise is currently disabled.
     */
    const DISGUISE_DISABLED = 0;

    /**
     * const DISGUISE_FORCED The disguise is currently forced.
     */
    const DISGUISE_FORCED = 1;

    /**
     * const DISGUISE_OPTIONAL The disguise is currently optional. It is up to the developer to determine how this flag is handled.
     */
    const DISGUISE_OPTIONAL = 2;

    /**
     * const IDENTITY_HIDDEN The disguise is not shown alongside the real identity.
     */
    const IDENTITY_HIDDEN = 0;

    /**
     * const IDENTITY_SHOWN The disguise is shown alongside the real identity.
     */
    const IDENTITY_SHOWN = 1;

    /**
     * const IDENTITY_RESTRICTED The disguise is shown alongside the real identity for users with the showidentity capability.
     */
    const IDENTITY_RESTRICTED = 2;

    /**
     * Instantiate an instance of the disguise.
     *
     * @param \context $context
     * @return An instance of the core\disguise
     * @throws \coding_exception
     */
    public static function instance(\context $context) {
        global $DB;

        if ($record = $DB->get_record('disguises', array('id' => $context->inheritteddisguiseid))) {
            if (empty($record->type)) {
                // There was a disguise, but it has been unset.
                return null;
            }

            $classname = '\\disguise_' . $record->type . '\\disguise';
            if (class_exists($classname)) {
                return new $classname($record, $context);
            }
        }

        throw new \coding_exception('Disguise not found.');
    }

    /**
     * Create a new disguise instance against the specified context.
     *
     * @param context $context
     * @param string $disguisetype
     */
    protected static function create(\context $context, $disguisetype) {
        global $DB;

        if ($context->has_disguise()) {
            throw new \moodle_exception('Disguise is aready set for this context');
        }

        $classname = '\\disguise_' . $disguisetype . '\\disguise';
        if (!class_exists($classname)) {
            throw new \coding_exception('Unknown disguise type');
        }

        $record = new \stdClass();
        $record->type = $disguisetype;
        $record->id = $DB->insert_record('disguises', $record);

        $record = $DB->get_record('disguises', array('id' => $record->id));

        $disguise = new $classname($record, $context);
        $context->set_disguise($disguise);

        return $disguise;
    }

    /**
     * Whether the disguise configured for the specified user in the the specified context.
     *
     * @param \context $context The context to check.
     * @param \stdClass $user The user to check.
     * @return bool
     */
    public static function is_configured_for_user_in_context(\context $context, \stdClass $user) {
        global $USER;

        if (!$context->disguise) {
            return true;
        }

        return $context->disguise->is_configured_for_user($user);
    }

    /**
     * Ensure that the the user has configured their disguise within the specified context.
     *
     * @param \context $context The context to check.
     * @param \stdClass $user The user to check.
     * @return bool
     */
    public static function ensure_configured_for_user_in_context(\context $context, \stdClass $user = null) {
        global $USER;

        if (!$context->disguise) {
            return true;
        }

        if (null === $user) {
            $user = $USER;
        }

        return $context->disguise->ensure_configured_for_user($user);
    }

    /**
     * Add the standard disguise form fields.
     *
     * @param \MoodleQuickForm  $mform      The moodleform to hook into.
     * @param \stdClass         $features   The features available to this module.
     * @param \context          $context    The context to add the form to
     */
    public static function add_to_form(\MoodleQuickForm $mform, \stdClass $features, $cm = null) {
        global $DB;

        $mform->addElement('header', 'userdisguises', get_string('disguisemodformtitle', 'moodle'));

        $cm = \cm_info::create($cm);
        $context = null;
        if (!empty($cm)) {
            $context = \context_module::instance($cm->id);
        }

        $options = array();
        foreach (\core\plugininfo\disguise::get_enabled_plugins() as $disguise) {
            $options[$disguise] = get_string('pluginname', 'disguise_' . $disguise);
        }

        $options = array(null => get_string('none')) + $options;
        $mform->addElement('select', 'disguise_type', get_string('disguise_type', 'moodle'), $options);
        if ($context && $context->has_own_disguise()) {
            $mform->hardFreeze('disguise_type');
        }

        // Enabled/Disable the disguise.
        $options = array(
            self::DISGUISE_DISABLED => get_string('disguise_disabled', 'moodle'),
            self::DISGUISE_FORCED => get_string('disguise_forced', 'moodle'),
        );

        if ($features->disguisesoptional) {
            // It is up to the module to support optional disguises at this stage.
            $options[self::DISGUISE_OPTIONAL] = get_string('disguise_optional', 'moodle');
        }

        $mform->addElement('select', 'disguise_mode', get_string('disguise_mode', 'moodle'), $options);
        $mform->setDefault('disguise_mode', self::DISGUISE_FORCED);
        $mform->disabledIf('disguise_mode', 'disguise_type', 'eq', null);

        // Show real identity always.
        $options = array(
            self::IDENTITY_HIDDEN => get_string('disguise_identity_hidden', 'moodle'),
            self::IDENTITY_SHOWN => get_string('disguise_identity_shown', 'moodle'),
            self::IDENTITY_RESTRICTED => get_string('disguise_identity_restricted', 'moodle'),
        );
        $mform->addElement('select', 'disguise_showrealidentity', get_string('disguise_showrealidentity', 'moodle'), $options);
        $mform->setDefault('disguise_showrealidentity', self::IDENTITY_HIDDEN);
        $mform->disabledIf('disguise_showrealidentity', 'disguise_type', 'eq', null);

        // Always show real identity from.
        $mform->addElement(
                'date_time_selector',
                'disguise_disabledisguisefrom',
                get_string('disguise_disabledisguisefrom', 'moodle'),
                array('optional' => true)
            );
        $mform->disabledIf('disguise_disabledisguisefrom', 'disguise_type', 'eq', null);

        // Allow logging.
        $mform->addElement('checkbox', 'disguise_loganonymously', get_string('disguise_loganonymously', 'moodle'));
        $mform->setDefault('disguise_loganonymously', true);
        $mform->disabledIf('disguise_loganonymously', 'disguise_type', 'eq', null);

        if ($context && $context->disguise) {
            if ($context->disguise->can_make_changes()) {
                if ($context->disguise->can_enable_disguiselock()) {
                    $mform->addElement('checkbox', 'disguise_lockdisguise', get_string('disguise_lockdisguise', 'moodle'));
                    $mform->setDefault('disguise_lockdisguise', false);
                }
            } else {
                // Lock disguise (with warning if user is not able to disable the lock).
                $type = $mform->getElement('disguise_type');
                $type->setValue($context->disguise->get_type());
                $type->freeze();

                $mform->getElement('disguise_mode')->freeze();
                $mform->getElement('disguise_showrealidentity')->freeze();
                $mform->getElement('disguise_disabledisguisefrom')->freeze();
                $mform->getElement('disguise_loganonymously')->freeze();

                if ($context->disguise->can_disable_disguiselock()) {
                    $mform->addElement('checkbox', 'disguise_lockdisguise', get_string('disguise_lockdisguise', 'moodle'));
                    $mform->setDefault('disguise_lockdisguise', true);
                }
            }

        }
    }

    /**
     * Handle disguise creation and update following submission of a form
     * which includes a disguise.
     *
     * @param \context $context The context to add the form to
     * @param \stdClass $data The submitted form data
     */
    public static function handle_form_submission(\context $context, \stdClass $data) {
        if ($context->has_own_disguise()) {
            // This context has it's own disguise.
            if ($context->disguise->can_disable_disguiselock() || $context->disguise->can_make_changes()) {
                // Update settings.
                self::update_from_form($context, $data);
            }
        } else if (!$context->has_disguise() && !empty($data->disguise_type)) {
            // There is currently no disguise at this context, or any of it's parent contexts, and a disguise type was specified.

            // Create a new instance of this type of disguise.
            self::create($context, $data->disguise_type);

            // Update settings.
            self::update_from_form($context, $data);
        }
    }

    /**
     * Get the disguise data to add to a form.
     *
     * @param context   $context    The context to add data for
     * @param stdClass  $formdata   The form data.
     */
    public static function add_form_values(\context $context, &$data) {
        if (!$context->has_own_disguise()) {
            return $data;
        }

        // Note: We need the raw values here, not the resultant values after other values have been considered.
        $disguisedata = $context->disguise->to_record();
        unset($disguisedata->id);

        foreach ($disguisedata as $key => $value) {
            // We prefix all keys with disguise_ to namespace them within the form.
            $key = 'disguise_' . $key;
            $data->$key = $value;
        }
    }

    /**
     * Update the disguise with the data from the submitted form.
     *
     * @param context   $context    The context to add data for
     * @param stdClass  $formdata   The submitted form data.
     * @return bool                 Whether changes were made
     */
    protected static function update_from_form(\context $context, \stdClass $form) {
        global $DB;
        if (!$context->has_own_disguise()) {
            return false;
        }

        $disguisedata = $context->disguise->to_record();
        unset($disguisedata->id);

        $record = new \stdClass();
        $update = false;
        if ($form->disguise_type != $disguisedata) {
            $record->type = $form->disguise_type;
            $update = true;
        }

        if ($form->disguise_mode != $disguisedata->mode) {
            $record->mode = $form->disguise_mode;
            $update = true;
        }
        if ($form->disguise_showrealidentity != $disguisedata->showrealidentity) {
            $record->showrealidentity = $form->disguise_showrealidentity;
            $update = true;
        }
        if ($form->disguise_disabledisguisefrom != $disguisedata->disabledisguisefrom) {
            $record->disabledisguisefrom = $form->disguise_disabledisguisefrom;
            $update = true;
        }
        if (!empty($form->disguise_loganonymously) != (bool) $disguisedata->loganonymously) {
            $record->loganonymously = !empty($form->disguise_loganonymously);
            $update = true;
        }

        if ($context->disguise->can_enable_disguiselock() && !empty($form->disguise_lockdisguise)) {
            $record->lockdisguise = true;
            $update = true;
        } else if ($context->disguise->can_disable_disguiselock() && empty($form->disguise_lockdisguise)) {
            $record->lockdisguise = false;
            $update = true;
        }

        if ($update) {
            $record->id = $context->disguiseid;
            return $DB->update_record('disguises', $record);
        }

        return false;
    }

    /**
     * Fetch all contexts which the specified disguise applies to.
     *
     * @param int $disguiseid
     * @return \context[] An array of contexts
     */
    public static function fetch_applicable_contexts($disguiseid) {
        global $DB;

        $fields = \context_helper::get_preload_record_columns_sql('ctx');
        $sql = "SELECT {$fields} FROM {context} ctx WHERE ctx.disguiseid = ? ORDER BY ctx.id ASC";
        $contextrecords = $DB->get_records_sql($sql, array($disguiseid));

        $contexts = array();
        foreach ($contextrecords as $contextid => $contextrecord) {
            \context_helper::preload_from_record($contextrecord);
            $contexts[] = \context::instance_by_id($contextid);
        }

        return $contexts;
    }

    /**
     * Determine whether the current user can configure the disguise in any
     * of its contexts.
     *
     * @param int $disguiseid
     * @return bool
     */
    public static function can_configure_disguise($disguiseid) {
        $contexts = self::fetch_applicable_contexts($disguiseid);
        $hascapability = false;
        foreach ($contexts as $context) {
            if (has_capability('moodle/disguise:configure', $context)) {
                $hascapability = true;
                break;
            }
        }

        return $hascapability;
    }

    /**
     * Attempt to get the correct disguise id for the specified disguise.
     *
     * @param   int         $disguiseid     The ID of the disguise to find context for.
     * @return  \context                    The matching context.
     */
    public static function get_preferred_context($disguiseid) {
        $contexts = self::fetch_applicable_contexts($disguiseid);

        if (count($contexts) === 1) {
            // There is only one context - just use that context.
            return reset($contexts);
        }

        // Return the first context where the user has the configure capability.
        foreach ($contexts as $context) {
            if (has_capability('moodle/disguise:configure', $context)) {
                return $context;
            }
        }

        // The user does not have the configure capability. Just return the first context.
        return reset($contexts);
    }

    /**
     * Determine whether the current user can configure the disguise in any
     * of its contexts.
     *
     * @param   int         $disguiseid
     * @param   context     $context        The context if it is known.
     * @return bool
     */
    public static function require_configure_disguise($disguiseid, \context $context = null) {
        if ($context) {
            require_capability('moodle/disguise:configure', $context);
            if ($context->disguise->get_id() != $disguiseid) {
                print_error('disguisecontextmismatch');
            }
        }

        if (!self::can_configure_disguise($disguiseid)) {
            require_capability('moodle/disguise:configure', \context_system::instance());
        }

        return true;
    }

}
