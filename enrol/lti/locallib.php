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
 * LTI enrolment plugin locallib functions.
 *
 * @package enrol_lti
 * @copyright 2016 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/*
 * The value used when we always want to send grades.
 */
define('ENROL_LTI_GRADE_SYNC_ALWAYS', 1);

/*
 * The value used when we want to send grades when they differ.
 */
define('ENROL_LTI_GRADE_SYNC_DIFFERS', 2);

/*
 * The value used when we want to send grades the first time only.
 */
define('ENROL_LTI_GRADE_SYNC_FIRST_TIME', 3);

/*
 * The value used when we want to enrol new members and unenrol old ones.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_AND_UNENROL', 1);

/*
 * The value used when we want to enrol new members only.
 */
define('ENROL_LTI_MEMBER_SYNC_ENROL_NEW', 2);

/*
 * The value used when we want to unenrol missing users.
 */
define('ENROL_LTI_MEMBER_SYNC_UNENROL_MISSING', 3);
