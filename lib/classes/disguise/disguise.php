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
 * The disguise base class which all disguise types must extend.
 *
 * @package    core
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\disguise;

defined('MOODLE_INTERNAL') || die();

/**
 * The disguise base class which all disguise types must extend.
 *
 * @package    core
 * @copyright  2015 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class disguise {
    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var int $showrealidentity
     */
    protected $showrealidentity;

    /**
     * @var int $disabledisguisefrom
     */
    protected $disabledisguisefrom;

    /**
     * @var bool $loganonymously
     */
    protected $loganonymously;

    /**
     * @var bool $mode
     */
    protected $mode;

    /**
     * @var bool $lockdisguise
     */
    protected $lockdisguise;

    /**
     * Please use get_config() to fetch the current configuration.
     * @var array $config
     */
    private $config;

    /**
     * @var \context $context
     */
    protected $context;

    /**
     * @var string $pluginpath
     */
    protected $pluginpath;

    /**
     * Constructor.
     *
     * @param stdClass  $record Typically the database record for this disguise
     * @param context   $context Context at which to instantiate this disguise
     */
    public function __construct($record, \context $context) {
        $this->id                   = $record->id;
        $this->showrealidentity     = (int)  $record->showrealidentity;
        $this->disabledisguisefrom  = (int)  $record->disabledisguisefrom;
        $this->loganonymously       = (bool) $record->loganonymously;
        $this->mode                 = (int)  $record->mode;
        $this->lockdisguise         = (bool) $record->lockdisguise;
        $this->config               = json_decode($record->configdata);

        // We need the context that this disguise is active in for capability checking.
        $this->context = $context;

        // Determine the path to this plugin instance. We use this for URLs generated for management URLs, etc.
        $this->pluginpath = '/user/disguise/' . $this->get_type();

        // Complete config initialisation.
        if (!$this->config) {
            $this->config = new \stdClass();
        }

        foreach ($this->get_config_defaults() as $key => $value) {
            if (!isset($this->config->$key)) {
                $this->config->$key = $value;
            }
        }
    }

    /**
     * Get the ID for the disguise instance.
     *
     * @return int
     */
    final public function get_id() {
        return $this->id;
    }

    /**
     * Return the configuration for this disguise instance.
     *
     * @param   string  $key        The configuration key to fetch.
     * @return  mixed               If a key is specified, the value for that key, otherwise
     *                              All configuration properties for this instance.
     */
    final public function get_config($key = null) {
        if (!empty($key)) {
            if (isset($this->config->$key)) {
                return $this->config->$key;
            }
            return null;
        }
        return $this->config;
    }

    /**
     * Return the default configuration values for the current plugin.
     *
     * @return  array   The default configuration
     */
    protected function get_config_defaults() {
        return [];
    }

    /**
     * Set the configuration for this disguise instance.
     *
     * @param  stdClass $config The configuration values for this instance.
     * @param   string  $key        The configuration key to set.
     * @param   mixed   $value      The value to set.
     * @return self
     */
    final public function set_config($key, $value) {
        $this->config->$key = $value;

        return $this;
    }

    /**
     * Is this disguise enabled?
     *
     * @return bool
     */
    final public function is_enabled() {
        return $this->mode !== helper::DISGUISE_DISABLED;
    }

    /**
     * Is this disguise forced?
     * Disguises may be optional within a context.
     *
     * @return bool
     */
    final public function is_forced() {
        return $this->mode === helper::DISGUISE_FORCED;
    }

    /**
     * Is the disguise configured for the specified user?
     *
     * @param \stdClass $user The user to check.
     * @return bool
     */
    public function is_configured_for_user(\stdClass $user = null) {
        global $USER;

        if (!$this->requires_user_configuration()) {
            // This plugin does not require per-user configuration.
            return true;
        }

        if (null === $user) {
            $user = $USER;
        }

        // Assume not configured.
        return false;
    }

    /**
     * Ensure that the the user has configured their disguise.
     *
     * @param \stdClass $user The user to check.
     */
    final public function ensure_configured_for_user(\stdClass $user) {
        if ($this->is_configured_for_user($user)) {
            // This user is already configured.
            return true;
        }

        if ($this->mode === helper::DISGUISE_OPTIONAL) {
            // This disguise is optional. Configuration is not *required*.
            return true;
        }

        return $this->handle_unconfigured_for_user($user);
    }

    /**
     * Ensure that the the user has configured their disguise.
     *
     * @param \stdClass $user The user to check.
     */
    public function handle_unconfigured_for_user(\stdClass $user) {
        global $SESSION;
        $SESSION->disguiseredirect = qualified_me();

        // Fallback and redirect to the user configuration path.
        return redirect($this->user_configuration_path($user));
    }

    /**
     * Redirect back to the original location if possible once
     * configuration is complete.
     */
    public function handle_user_now_configured() {
        global $SESSION, $PAGE;

        if (isset($SESSION->disguiseredirect)) {
            $redirectto = $SESSION->disguiseredirect;
            unset($SESSION->disguiseredirect);
        }

        if (empty($redirectto)) {
            if ($PAGE->cm) {
                $node = $PAGE->navigation->find($PAGE->cm->id, \navigation_node::TYPE_ACTIVITY);
                $redirectto = $node->action;
            }
        }

        redirect($redirectto);
    }

    /**
     * Should the user's real identity be shown alongside their disguise?
     *
     * @return bool
     */
    final public function should_show_real_identity() {
        global $SESSION;

        if ($this->showrealidentity === helper::IDENTITY_SHOWN) {
            // This plugin has been configured to always display the users real identity.
            return true;
        }

        if ($this->disabledisguisefrom && $this->disabledisguisefrom < time()) {
            // This plugin is configured to display the users real identity after a datetime, and that datetime has now passed.
            return true;
        }

        if ($this->can_toggle_real_identity()) {
            // The user can toggle display of real identity. Check whether they have done so.
            // Note, we use the session here rather than a user preference because this should not be persisted between sessions.
            if (isset($SESSION->disguiserevealed) && $SESSION->disguiserevealed) {
                return true;
            }
        }

        return false;
    }

    /**
     * Whether the current user can toggle display of the real user identity.
     *
     * This takes into account the revealidentity capability; and the showidentity capability in combination with the
     * restricted showrealidentity setting.
     *
     * @return bool
     */
    final public function can_toggle_real_identity() {
        if (has_capability('moodle/disguise:revealidentity', $this->context)) {
            // This user holds the revealidentity capability, therefore they are able to toggle identity display.
            return true;
        }

        $showrealidentity = $this->showrealidentity === helper::IDENTITY_RESTRICTED;
        $showrealidentity = $showrealidentity && has_capability('moodle/disguise:showidentity', $this->context);
        if ($showrealidentity) {
            // This user holds the showidentity capability, therefore they are able to toggle identity display.
            return true;
        }

        // Fallback to false.
        return false;
    }

    /**
     * A convenience function to ensure the current user has the required
     * capabilities to reveal user identities.
     *
     * @throws required_capability_exception
     * @return bool
     */
    final public function require_toggle_real_identity() {
        if (has_capability('moodle/disguise:revealidentity', $this->context)) {
            // This user has revealidentity - this takes precedence over the showidentity capability below.
            return true;
        }

        if ($this->showrealidentity === helper::IDENTITY_RESTRICTED) {
            // This user must hold the showidentity capability.
            require_capability('moodle/disguise:showidentity', $this->context);
            return true;
        }

        // Require revealidentity to except if neither of the above matches have worked.
        require_capability('moodle/disguise:revealidentity', $this->context);
    }

    /**
     * Set the state of real identity revelation.
     *
     * @param bool $state
     * @return self
     */
    final public function set_show_real_identity_state($state) {
        global $SESSION;

        $this->require_toggle_real_identity();
        $SESSION->disguiserevealed = (bool) $state;

        return $this;
    }

    /**
     * Taking into account the is_forced disguise setting, and the forcedisguise option, should the user be disguised.
     *
     * @param array $options                The list of options provided to displayname, profileurl, and other functions.
     * @param bool  $options.forcedisguise  Force use of the disguise when it is optional.
     * @return bool
     */
    final protected function should_use_disguise($options) {
        if ($this->is_enabled()) {
            $usedisguise = $this->is_forced();
            $usedisguise = $usedisguise || isset($options['forcedisguise']) && $options['forcedisguise'];

            return $usedisguise;
        }
        return false;
    }

    /**
     * Whether this disguise has requested anonymous logging.
     *
     * @return bool
     */
    final public function should_log_anonymously() {
        return $this->loganonymously;
    }

    /**
     * The displayed displayname for the user, taking into account the disguise configuration, and whether the real identity
     * should also be displayed.
     *
     * Generally, this function should not be overridden. Use @link disguise_displayname instead.
     *
     * @param \stdClass $user The user being displayed.
     * @param array $options The list of options for the displayname.
     * @param bool $options.usefullnamedisplay Whether to override the display of the displayname when shown to show the first,
     *                                    then the last name instead of adherring to the displaynamedisplay setting.
     * @param bool $options.forcedisguise Force use of the disguise when it is optional.
     * @return string The disguise user displayname
     * @link disguise_displayname
     */
    public function displayname(\stdClass $user, $options) {
        // The 'override' setting for when we need to call displayname() too.
        $override = isset($options['usefullnamedisplay']) && $options['usefullnamedisplay'];

        if ($this->should_use_disguise($options)) {
            if ($this->should_show_real_identity()) {
                $a = new \stdClass();
                $a->disguise = $this->disguise_displayname($user, $options);
                $a->fullname = \core_user::_displayname($user, $this->context, $options);
                return get_string('disguisewithreal', 'moodle', $a);
            }

            return $this->disguise_displayname($user, $options);
        }

        return \core_user::_displayname($user, $this->context, $options);
    }

    /**
     * The displayed name for the user, taking into account the disguise configuration, and whether the real identity
     * should also be displayed.
     *
     * @param \stdClass     $user                   The user being displayed.
     * @param array         $options                The list of options for display.
     * @param bool          $options.usefullnamedisplay  Whether to override the display of the displayname when shown
     *                                              to show the first, then the last name instead of adherring to the
     *                                              fullnamedisplay setting.
     * @param bool          $options.forcedisguise  Force use of the disguise when it is optional.
     * @return string                               The disguise user display name
     */
    protected abstract function disguise_displayname(\stdClass $user, $options);

    /**
     * Taking into account the disguise configuration, and whether the real identity should also be displayed, determine
     * whether profile links should be displayed.
     *
     * Generally, this function should not be overridden. Use @link disguise_profile_url instead.
     *
     * @param \stdClass     $user                   The user being displayed.
     * @param array         $options                The list of options for the profile_url.
     * @param bool          $options.forcedisguise  Force use of the disguise when it is optional.
     * @return \moodle_url|null                     The link to the profile field.
     * @link disguise_profile_url
     */
    public function allow_profile_links(\stdClass $user, $options, $courseid = null) {
        if ($this->should_use_disguise($options) && !$this->should_show_real_identity()) {
            // The disguise should be active, and the real identity is not being displayed.
            return false;
        }

        return true;
    }

    /**
     * Taking into account the disguise configuration, and whether the real identity should also be displayed, determine
     * whether messaging users should be allowed.
     *
     * Generally, this function should not need to be overridden.
     *
     * @param \stdClass     $user                   The user being displayed.
     * @param array         $options                The list of options to use when calculating.
     * @param bool          $options.forcedisguise  Force use of the disguise when it is optional.
     * @return \moodle_url|null                     The link to the message URL.
     */
    public function allow_messaging(\stdClass $user, $options) {
        if ($this->should_use_disguise($options) && !$this->should_show_real_identity()) {
            // The disguise should be active, and the real identity is not being displayed.
            return false;
        }

        return true;
    }

    /**
     * The user picture for the user, taking into account the disguise configuration, and whether the real identity
     * should also be displayed. If no picture should be displayed, an empty string value will be returned.
     *
     * Generally, this function should not need to be overridden.
     *
     * @param \stdClass $user                   The user being displayed.
     * @param array     $options                The list of options for the user picture.
     * @param bool      $options.forcedisguise  Force use of the disguise when it is optional.
     * @param array     $userpictureoptions     Any additional options to pass to the user_picture renderer.
     * @return string                           The HTML fragment to use
     */
    public function user_picture(\stdClass $user, $options = array(), $userpictureoptions = array()) {
        global $OUTPUT;
        if ($this->should_use_disguise($options) && !$this->should_show_real_identity()) {
            // The disguise should be active, and the real identity is not being displayed.
            return $this->disguise_user_picture($user, $options, $userpictureoptions);
        }

        return $OUTPUT->user_picture($user, $userpictureoptions);
    }

    /**
     * The user picture for the user, taking into account the disguise configuration, and whether the real identity
     * should also be displayed. If no picture should be displayed, an empty string value will be returned.
     *
     * @param \stdClass $user                   The user being displayed.
     * @param array     $options                The list of options for the user picture.
     * @param bool      $options.forcedisguise  Force use of the disguise when it is optional.
     * @param array     $userpictureoptions     Any additional options to pass to the user_picture renderer.
     * @return string                           The HTML fragment to use
     */
    protected function disguise_user_picture(\stdClass $user, $options, $userpictureoptions = array()) {
        global $OUTPUT;

        $userpictureoptions['link'] = false;
        $userpictureoptions['visibletoscreenreaders'] = false;
        $userpictureoptions['alttext'] = false;
        return $OUTPUT->user_picture(\core_user::get_disguised_user($user, $this->context, $options), $userpictureoptions);
    }

    /**
     * Does this plugin require interaction from a user for initial configuration.
     *
     * @return bool
     */
    abstract protected function requires_user_configuration();

    /**
     * The user-configuration URL.
     *
     * @param \stdClass $user The user to handle configuration for
     * @return \moodle_url
     * @throws \coding_exception
     */
    protected function user_configuration_path(\stdClass $user) {
        // This function is only called if requires_user_configuration is true.
        return new \moodle_url($this->pluginpath . '/configure.php', array(
                'id'            => $this->context->id,
                'userid'        => $user->id,
            ));
    }

    /**
     * Whether the current user can make changes to the disguise.
     *
     * @return bool
     */
    final public function can_make_changes() {
        return !$this->lockdisguise;
    }

    /**
     * Whether the current user can enable the disguise lock.
     * Once the disguise lock has been enabled, that user may not be able to disable it again. This can be verified with
     * the sister function can_disable_disguiselock().
     *
     * Once the disguise lock has been enabled, changes to the disguise cannot be made.
     *
     * @return bool
     */
    final public function can_enable_disguiselock() {
        // Users can toggle the lock on if they are able to make changes.
        // This does not mean that they can disable it again!
        return ($this->can_make_changes());
    }

    /**
     * Whether the current user can disable the disguise lock, allowing them to make changes.
     *
     * @return bool
     */
    final public function can_disable_disguiselock() {
        if (has_capability('moodle/disguise:disablelock', $this->context)) {
            // The user is able to disable the lock based on their capabilities.
            return true;
        }

        // Do not allow this user to disable the lock.
        return false;
    }

    /**
     * Get the type of disguise.
     *
     * @return string
     */
    final public function get_type() {
        preg_match('/disguise_([^\\\]*)\\\disguise/', get_called_class(), $matches);
        return $matches[1];
    }

    /**
     * Export the raw settings of this disguise.
     *
     * @return stdClass
     */
    final public function to_record() {
        return (object) array(
            'id'                    => $this->get_id(),
            'type'                  => $this->get_type(),
            'mode'                  => $this->mode,
            'showrealidentity'      => $this->showrealidentity,
            'disabledisguisefrom'   => $this->disabledisguisefrom,
            'loganonymously'        => $this->loganonymously,
            'lockdisguise'          => $this->lockdisguise,
            'configdata'            => json_encode($this->config),
        );
    }

    /**
     * Prepare a user record for use in web services.
     *
     * @param stdClass $user                A {@link $USER} object to prepare.
     * @param array    $options             Any relevant options.
     * @return stdClass
     */
    public function prepare_external_user(\stdClass $user, array $options = array()) {
        if ($this->should_use_disguise($options) && !$this->should_show_real_identity()) {
            return \core_user::get_disguised_user($user, $this->context, $options);
        }

        return $user;
    }

    /**
     * Add disguise navigation links to the settings navigation tree.
     *
     * Generally, this function should not be overridden. @link add_disguise_navigation instead.
     *
     * @param settings_navigation   $settings   The settings navigation object
     * @param navigation_node       $parentnav  The node to add settings to
     */
    public function add_settings_navigation(\settings_navigation $settingsnav, \navigation_node $parentnav) {
        $nodes = array();
        if ($this->can_toggle_real_identity()) {
            // Note, use of can_make_changes() here is not relevant as the settings on this page do not reveal the true identity.
            // It may be necessary to configure the display name, whilst the plugin is locked.
            if ($this->should_show_real_identity()) {
                $revealstring = get_string('disguise_hide');
            } else {
                $revealstring = get_string('disguise_reveal');
            }
            $nodes[] = \navigation_node::create(
                    $revealstring,
                    $this->get_toggle_reveal_link(),
                    \navigation_node::TYPE_SETTING,
                    null,
                    'revealdisguise'
                );
        }

        $nodes = array_merge($nodes, $this->add_disguise_navigation($settingsnav, $parentnav));

        if (count($nodes) > 1) {
            $addto = $parentnav->add(
                    get_string('disguisesettingsmenu'),
                    null,
                    \navigation_node::TYPE_CONTAINER
                );
        } else {
            $addto = $parentnav;
        }

        foreach ($nodes as $node) {
            $addto->add_node($node);
        }
    }

    /**
     * Add disguise-specific navigation links to the settings navigation tree.
     *
     * @param settings_navigation   $settings   The settings navigation object
     * @param navigation_node       $parentnav  The node to add settings to
     * @return array An array of nodes to add
     */
    public abstract function add_disguise_navigation();

    /**
     * Create the URL required to toggle the user identity.
     *
     * @return moodle_url
     */
    protected function get_toggle_reveal_link() {
        global $PAGE;

        return new \moodle_url('/user/disguise.php', array(
                'sesskey'       => sesskey(),
                'context'       => $this->context->id,
                'action'        => 'reveal',
                'tostate'       => !$this->should_show_real_identity(),
                'returnto'      => $PAGE->url->out_as_local_url(),
            ));
    }

    public function save() {
        global $DB;

        $record = $this->to_record();
        $DB->update_record('disguises', $record);

        return $this;
    }
}
