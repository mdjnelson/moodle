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
 * This file contains a class definition for the Memberships service
 *
 * @package    ltiservice_memberships
 * @copyright  2015 Vital Source Technologies http://vitalsource.com
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace ltiservice_memberships\local\service;

defined('MOODLE_INTERNAL') || die();

/**
 * A service implementing Memberships.
 *
 * @package    ltiservice_memberships
 * @since      Moodle 3.0
 * @copyright  2015 Vital Source Technologies http://vitalsource.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class memberships extends \mod_lti\local\ltiservice\service_base {

    /** Default prefix for context-level roles */
    const CONTEXT_ROLE_PREFIX = 'http://purl.imsglobal.org/vocab/lis/v2/membership#';
    /** Context-level role for Instructor */
    const CONTEXT_ROLE_INSTRUCTOR = 'http://purl.imsglobal.org/vocab/lis/v2/membership#Instructor';
    /** Context-level role for Learner */
    const CONTEXT_ROLE_LEARNER = 'http://purl.imsglobal.org/vocab/lis/v2/membership#Learner';
    /** Capability used to identify Instructors */
    const INSTRUCTOR_CAPABILITY = 'moodle/course:manageactivities';
    /** Membership services enabled */
    const MEMBERSHIP_ENABLED = 1;
    /** Always include field */
    const ALWAYS_INCLUDE_FIELD = 1;
    /** Allow the instructor to decide if included */
    const DELEGATE_TO_INSTRUCTOR = 2;
    /** Instructor chose to include field */
    const INSTRUCTOR_INCLUDED = 1;
    /** Instructor delegated and approved for include */
    const INSTRUCTOR_DELEGATE_INCLUDED = array(self::DELEGATE_TO_INSTRUCTOR && self::INSTRUCTOR_INCLUDED);
    /** Scope for reading membership data */
    const SCOPE_MEMBERSHIPS_READ = 'https://purl.imsglobal.org/spec/lti-nrps/scope/contextmembership.readonly';

    /**
     * Class constructor.
     */
    public function __construct() {

        parent::__construct();
        $this->id = 'memberships';
        $this->name = get_string($this->get_component_id(), $this->get_component_id());

    }

    /**
     * Get the resources for this service.
     *
     * @return array
     */
    public function get_resources() {

        if (empty($this->resources)) {
            $this->resources = array();
            $this->resources[] = new \ltiservice_memberships\local\resources\contextmemberships($this);
            $this->resources[] = new \ltiservice_memberships\local\resources\linkmemberships($this);
        }

        return $this->resources;

    }

    /**
     * Get the scope(s) permitted for this service.
     *
     * @return array
     */
    public function get_permitted_scopes() {

        $scopes = array();
        $ok = !empty($this->get_type());
        if ($ok && isset($this->get_typeconfig()[$this->get_component_id()]) &&
            ($this->get_typeconfig()[$this->get_component_id()] == self::MEMBERSHIP_ENABLED)) {
            $scopes[] = self::SCOPE_MEMBERSHIPS_READ;
        }

        return $scopes;

    }

    /**
     * Get the JSON for members.
     *
     * @param \mod_lti\local\ltiservice\resource_base $resource       Resource handling the request
     * @param \context_course   $context    Course context
     * @param string            $contextid  Course ID
     * @param string            $role       User role requested (empty if none)
     * @param int               $limitfrom  Position of first record to be returned
     * @param int               $limitnum   Maximum number of records to be returned
     * @param object            $lti        LTI instance record
     * @param \core_availability\info_module $info Conditional availability information
     *      for LTI instance (null if context-level request)
     * @param \mod_lti\local\ltiservice\response $response       Response object for the request
     *
     * @return string
     */
    public function get_users_json($resource, $context, $contextid, $role, $limitfrom, $limitnum, $lti, $info, $response) {

        $withcapability = '';
        $exclude = array();
        if (!empty($role)) {
            if ((strpos($role, 'http://') !== 0) && (strpos($role, 'https://') !== 0)) {
                $role = self::CONTEXT_ROLE_PREFIX . $role;
            }
            if ($role === self::CONTEXT_ROLE_INSTRUCTOR) {
                $withcapability = self::INSTRUCTOR_CAPABILITY;
            } else if ($role === self::CONTEXT_ROLE_LEARNER) {
                $exclude = array_keys(get_enrolled_users($context, self::INSTRUCTOR_CAPABILITY, 0, 'u.id',
                                                         null, null, null, true));
            }
        }
        $users = get_enrolled_users($context, $withcapability, 0, 'u.*', null, $limitfrom, $limitnum, true);
        if (count($users) < $limitnum) {
            $limitfrom = 0;
            $limitnum = 0;
        }
        if (($response->get_accept() === 'application/vnd.ims.lti-nprs.v2.membershipcontainer+json') ||
            ($this->get_type()->ltiversion === LTI_VERSION_1P3)) {
            $json = $this->users_to_json2($resource, $users, $contextid, $exclude, $limitfrom, $limitnum, $lti, $info, $response);
        } else {
            $json = $this->users_to_json($resource, $users, $contextid, $exclude, $limitfrom, $limitnum, $lti, $info, $response);
        }

        return $json;
    }

    /**
     * Get the JSON representation of the users.
     *
     * Note that when a limit is set and the exclude array is not empty, then the number of memberships
     * returned may be less than the limit.
     *
     * @param \mod_lti\local\ltiservice\resource_base $resource       Resource handling the request
     * @param array  $users               Array of user records
     * @param string $contextid           Course ID
     * @param object $tool                Tool instance object
     * @param array  $exclude             Array of user records to be excluded from the response
     * @param int    $limitfrom           Position of first record to be returned
     * @param int    $limitnum            Maximum number of records to be returned
     * @param object $lti                 LTI instance record
     * @param \core_availability\info_module $info Conditional availability information
     *      for LTI instance (null if context-level request)
     * @param \mod_lti\local\ltiservice\response $response       Response object for the request
     *
     * @return string
     */
    private function users_to_json($resource, $users, $contextid, $exclude, $limitfrom, $limitnum,
            $lti, $info, $response) {
        global $DB;

        $tool = $this->get_type();
        $toolconfig = $this->get_typeconfig();
        $arrusers = [
            '@context' => 'http://purl.imsglobal.org/ctx/lis/v2/MembershipContainer',
            '@type' => 'Page',
            '@id' => $resource->get_endpoint(),
        ];

        if ($limitnum > 0) {
            $limitfrom += $limitnum;
            $nextpage = "{$resource->get_endpoint()}?limit={$limitnum}&from={$limitfrom}";
            if (!is_null($lti)) {
                $nextpage .= "&rlid={$lti->id}";
            }
            $arrusers['nextPage'] = $nextpage;
        }

        $arrusers['pageOf'] = [
            '@type' => 'LISMembershipContainer',
            'membershipSubject' => [
                '@type' => 'Context',
                'contextId' => $contextid,
                'membership' => []
            ]
        ];

        $enabledcapabilities = lti_get_enabled_capabilities($tool);
        $islti2 = $tool->toolproxyid > 0;
        foreach ($users as $user) {
            if (in_array($user->id, $exclude)) {
                continue;
            }
            if (!empty($info) && !$info->is_user_visible($info->get_course_module(), $user->id)) {
                continue;
            }

            $member = new \stdClass();
            $member->{"@type" } = 'LISPerson';
            $membership = new \stdClass();
            $membership->status = 'Active';
            $membership->role = explode(',', lti_get_ims_role($user->id, null, $contextid, true));

            $instanceconfig = null;
            if (!is_null($lti)) {
                $instanceconfig = lti_get_type_config_from_instance($lti->id);
            }
            $isallowedlticonfig = self::is_allowed_field_set($toolconfig, $instanceconfig,
                                    ['name' => 'sendname', 'email' => 'sendemailaddr']);
            $includedcapabilities = [
                'User.id'              => ['type' => 'id',
                                            'member.field' => 'userId',
                                            'source.value' => $user->id],
                'Person.sourcedId'     => ['type' => 'id',
                                            'member.field' => 'sourcedId',
                                            'source.value' => format_string($user->idnumber)],
                'Person.name.full'     => ['type' => 'name',
                                            'member.field' => 'name',
                                            'source.value' => format_string("{$user->firstname} {$user->lastname}")],
                'Person.name.given'    => ['type' => 'name',
                                            'member.field' => 'givenName',
                                            'source.value' => format_string($user->firstname)],
                'Person.name.family'   => ['type' => 'name',
                                            'member.field' => 'familyName',
                                            'source.value' => format_string($user->lastname)],
                'Person.email.primary' => ['type' => 'email',
                                            'member.field' => 'email',
                                            'source.value' => format_string($user->email)]
            ];

            if (!is_null($lti)) {
                $message = new \stdClass();
                $message->message_type = 'basic-lti-launch-request';
                $conditions = array('courseid' => $contextid, 'itemtype' => 'mod',
                        'itemmodule' => 'lti', 'iteminstance' => $lti->id);

                if (!empty($lti->servicesalt) && $DB->record_exists('grade_items', $conditions)) {
                    $message->lis_result_sourcedid = json_encode(lti_build_sourcedid($lti->id,
                                                                                     $user->id,
                                                                                     $lti->servicesalt,
                                                                                     $lti->typeid));
                    // Not per specification but added to comply with earlier version of the service.
                    $member->resultSourcedId = $message->lis_result_sourcedid;
                }
                $membership->message = [$message];
            }

            foreach ($includedcapabilities as $capabilityname => $capability) {
                if ($islti2) {
                    if (in_array($capabilityname, $enabledcapabilities)) {
                        $member->{$capability['member.field']} = $capability['source.value'];
                    }
                } else {
                    if (($capability['type'] === 'id')
                     || ($capability['type'] === 'name' && $isallowedlticonfig['name'])
                     || ($capability['type'] === 'email' && $isallowedlticonfig['email'])) {
                        $member->{$capability['member.field']} = $capability['source.value'];
                    }
                }
            }

            $membership->member = $member;

            $arrusers['pageOf']['membershipSubject']['membership'][] = $membership;
        }

        $response->set_content_type('application/vnd.ims.lis.v2.membershipcontainer+json');

        return json_encode($arrusers);
    }

    /**
     * Get the NRP service JSON representation of the users.
     *
     * Note that when a limit is set and the exclude array is not empty, then the number of memberships
     * returned may be less than the limit.
     *
     * @param \mod_lti\local\ltiservice\resource_base $resource       Resource handling the request
     * @param array  $users               Array of user records
     * @param string $contextid           Course ID
     * @param array  $exclude             Array of user records to be excluded from the response
     * @param int    $limitfrom           Position of first record to be returned
     * @param int    $limitnum            Maximum number of records to be returned
     * @param object $lti                 LTI instance record
     * @param \core_availability\info_module  $info     Conditional availability information for LTI instance
     * @param \mod_lti\local\ltiservice\response $response       Response object for the request
     *
     * @return string
     */
    private function users_to_json2($resource, $users, $contextid, $exclude, $limitfrom, $limitnum,
            $lti, $info, $response) {
        global $DB;

        $tool = $this->get_type();
        $toolconfig = $this->get_typeconfig();
        $arrusers = [
            'id' => $resource->get_endpoint(),
            'members' => []
        ];

        if ($limitnum > 0) {
            $limitfrom += $limitnum;
            $nextpage = "{$resource->get_endpoint()}?limit={$limitnum}&from={$limitfrom}";
            if (!is_null($lti)) {
                $nextpage .= "&rlid={$lti->id}";
            }
            $response->add_additional_header("Link: {$nextpage};rel=next");
        }

        $enabledcapabilities = lti_get_enabled_capabilities($tool);
        $islti2 = $tool->toolproxyid > 0;
        foreach ($users as $user) {
            if (in_array($user->id, $exclude)) {
                continue;
            }
            if (!empty($info) && !$info->is_user_visible($info->get_course_module(), $user->id)) {
                continue;
            }

            $member = new \stdClass();
            $member->status = 'Active';
            $member->roles = explode(',', lti_get_ims_role($user->id, null, $contextid, true));

            $instanceconfig = null;
            if (!is_null($lti)) {
                $instanceconfig = lti_get_type_config_from_instance($lti->id);
            }
            $isallowedlticonfig = self::is_allowed_field_set($toolconfig, $instanceconfig,
                                    ['name' => 'sendname', 'email' => 'sendemailaddr']);
            $includedcapabilities = [
                'User.id'              => ['type' => 'id',
                                            'member.field' => 'user_id',
                                            'source.value' => $user->id],
                'Person.name.full'     => ['type' => 'name',
                                            'member.field' => 'name',
                                            'source.value' => format_string("{$user->firstname} {$user->lastname}")],
                'Person.name.given'    => ['type' => 'name',
                                            'member.field' => 'given_name',
                                            'source.value' => format_string($user->firstname)],
                'Person.name.family'   => ['type' => 'name',
                                            'member.field' => 'family_name',
                                            'source.value' => format_string($user->lastname)],
                'Person.email.primary' => ['type' => 'email',
                                            'member.field' => 'email',
                                            'source.value' => format_string($user->email)]
            ];

            if (!is_null($lti)) {
                $message = new \stdClass();
                $message->{'https://purl.imsglobal.org/spec/lti/claim/message_type'} = 'LtiResourceLinkRequest';
                $conditions = array('courseid' => $contextid, 'itemtype' => 'mod',
                        'itemmodule' => 'lti', 'iteminstance' => $lti->id);

                if (!empty($lti->servicesalt) && $DB->record_exists('grade_items', $conditions)) {
                    $basicoutcome = new \stdClass();
                    $basicoutcome->lis_result_sourcedid = json_encode(lti_build_sourcedid($lti->id,
                                                                                     $user->id,
                                                                                     $lti->servicesalt,
                                                                                     $lti->typeid));
                    // Add outcome service URL.
                    $serviceurl = new \moodle_url('/mod/lti/service.php');
                    $serviceurl = $serviceurl->out();
                    $forcessl = false;
                    if (!empty($CFG->mod_lti_forcessl)) {
                        $forcessl = true;
                    }
                    if ((isset($typeconfig['forcessl']) && ($typeconfig['forcessl'] == '1')) or $forcessl) {
                        $serviceurl = lti_ensure_url_is_https($serviceurl);
                    }
                    $basicoutcome->lis_outcome_service_url = $serviceurl;
                    $message->{'https://purl.imsglobal.org/spec/lti-bo/claim/basicoutcome'} = $basicoutcome;
                }
                $member->message = [$message];
            }

            foreach ($includedcapabilities as $capabilityname => $capability) {
                if ($islti2) {
                    if (!in_array($capabilityname, $enabledcapabilities)) {
                        continue;
                    }
                } else {
                    if (($capability['type'] === 'id')
                     || ($capability['type'] === 'name' && $isallowedlticonfig['name'])
                     || ($capability['type'] === 'email' && $isallowedlticonfig['email'])) {
                        $member->{$capability['member.field']} = $capability['source.value'];
                    }
                }
            }

            $arrusers['members'][] = $member;
        }

        $response->set_content_type('application/vnd.ims.lti-nprs.v2.membershipcontainer+json');

        return json_encode($arrusers);
    }

    /**
     * Determines whether a user attribute may be used as part of LTI membership
     * @param object            $toolconfig      Tool config
     * @param object            $instanceconfig  Tool instance config
     * @param array             $fields          Set of fields to return if allowed or not
     * @return array Verification which associates an attribute with a boolean (allowed or not)
     */
    private static function is_allowed_field_set($toolconfig, $instanceconfig, $fields) {
        $isallowedstate = [];
        foreach ($fields as $key => $field) {
            $allowed = self::ALWAYS_INCLUDE_FIELD == $toolconfig[$field];
            if (!$allowed) {
                if (self::DELEGATE_TO_INSTRUCTOR == $toolconfig[$field] & !is_null($instanceconfig)) {
                    $allowed = $instanceconfig[$field] == self::INSTRUCTOR_INCLUDED;
                }
            }
            $isallowedstate[$key] = $allowed;
        }
        return $isallowedstate;
    }

    /**
     * Create form element for membership add/edit page.
     *
     * @return array of \HTML_QuickForm_element Form elements
     */
    public function get_configuration_options() {
        $elements = array();
        $options = [
            get_string('notallow', $this->get_component_id()),
            get_string('allow', $this->get_component_id())
        ];
        $elements[''] = new \MoodleQuickForm_select($this->get_component_id(), get_string($this->get_component_id(),
            $this->get_component_id()), $options);

        return $elements;
    }

    /**
     * Return an array of key/values to add to the launch parameters.
     *
     * @param string $messagetype 'basic-lti-launch-request' or 'ContentItemSelectionRequest'.
     * @param string $courseid The course id.
     * @param string $user The user id.
     * @param string $typeid The tool lti type id.
     * @param string $modlti The id of the lti activity.
     *
     * The type is passed to check the configuration
     * and not return parameters for services not used.
     *
     * @return array of key/value pairs to add as launch parameters.
     */
    public function get_launch_parameters($messagetype, $courseid, $user, $typeid, $modlti = null) {
        global $COURSE;

        $launchparameters = array();
        $tool = lti_get_type_type_config($typeid);
        if (isset($tool->{$this->get_component_id()})) {
            if ($tool->{$this->get_component_id()} == self::MEMBERSHIP_ENABLED && $this->is_used_in_context($typeid, $courseid)) {
                $launchparameters['context_memberships_url'] = '$ToolProxyBinding.memberships.url';
                $launchparameters['context_memberships_version'] = '2.0';
            }
        }
        return $launchparameters;
    }

}
