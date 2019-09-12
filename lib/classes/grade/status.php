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
 * Provides a way to show the status of a grade item
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\grade;

defined('MOODLE_INTERNAL') || die();

/**
 * Provides a way to show the status of a grade item
 *
 * @package     core
 * @copyright   2019 Monash University (http://www.monash.edu)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class status implements \JsonSerializable {

    /** @var string $identifier The grade rule plugin. */
    private $identifier;

    /** @var string $component Purpose of the status. */
    private $component;

    /** @var array $data The status data. */
    private $data;

    /**
     * Instantiate a new status class
     *
     * @param array $data
     *
     * @return void
     */
    public function __construct(array $data) {

        if (array_key_exists('type', $data)) {

            if ($data['type'] != self::class) {

                throw new \InvalidArgumentException();
            }

            $this->component  = $data['component'];
            $this->identifier = $data['identifier'];
            $this->data       = $data['data'];
        }
    }

    /**
     * Get the status message.
     *
     * @return \lang_string
     */
    public function get_lang_string() {
        return new \lang_string($this->identifier, $this->component, $this->data);
    }

    /**
     * Returns the string version of the status.
     *
     * @return string
     */
    public function __toString() {
        return $this->get_lang_string()->out();
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() { // @codingStandardsIgnoreLine
        return [
            'type'       => 'core\grade\status',
            'component'  => $this->component,
            'identifier' => $this->identifier,
            'data'       => $this->data
        ];
    }
}
