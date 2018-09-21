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
 * This file contains a service for issuing access tokens
 *
 * @package    mod_lti
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_DEBUG_DISPLAY', true);
define('NO_MOODLE_COOKIES', true);

use Firebase\JWT\JWT as JWT;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');


$response = new \mod_lti\local\ltiservice\response();

$ok = ($_SERVER['REQUEST_METHOD'] === 'POST') && ($_SERVER['CONTENT_TYPE'] === 'application/x-www-form-urlencoded');
$error = 'invalid_request';

if ($ok) {
    $ok = !empty($_POST['client_assertion']) && !empty($_POST['client_assertion_type']) &&
          !empty($_POST['grant_type']) && !empty($_POST['scope']);
}

if ($ok) {
    $ok = ($_POST['client_assertion_type'] === 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer') &&
          ($_POST['grant_type'] === 'client_credentials');
    $error = 'unsupported_grant_type';
}

if ($ok) {
    $parts = explode('.', $_POST['client_assertion']);
    $ok = (count($parts) === 3);
    if ($ok) {
        $payload = JWT::urlsafeB64Decode($parts[1]);
        $claims = json_decode($payload, true);
        $ok = !is_null($claims) && !empty($claims['sub']);
    }
    $error = 'invalid_request';
}

if ($ok) {
    $error = 'invalid_client';
    $tool = lti_get_type_from_clientid($claims['sub']);
    if ($tool) {
        $typeconfig = lti_get_type_config($tool->id);
        if (!empty($typeconfig['publickey'])) {
            try {
                $jwt = JWT::decode($_POST['client_assertion'], $typeconfig['publickey'], array('RS256'));
                $ok = true;
            } catch (Exception $e) {
                $ok = false;
            }
        }
    }
}

if ($ok) {
    $scopes = array();
    $requestedscopes = explode(' ', $_POST['scope']);
    $permittedscopes = lti_get_permitted_service_scopes($tool, $typeconfig);
    $scopes = array_intersect($requestedscopes, $permittedscopes);
    $ok = !empty($scopes);
    $error = 'invalid_scope';
}

if ($ok) {
    $token = lti_new_access_token($tool->id, $scopes);
    $expiry = LTI_ACCESS_TOKEN_LIFE;
    $scopes = implode(' ', $scopes);
    $body = <<< EOD
{
  "access_token" : "{$token->token}",
  "token_type" : "Bearer",
  "expires_in" : {$expiry},
  "scope" : "{$scopes}"
}
EOD;
} else {
    $response->set_code(400);
    $body = <<< EOD
{
  "error" : "{$error}"
}
EOD;
}

$response->set_body($body);

$response->send();
