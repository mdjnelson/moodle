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
 * Unit tests for moodlelib.php's userdate function with TZ/DST.
 *
 * @package    core
 * @category   phpunit
 * @copyright  &copy; 2015 NC State University
 * @author     jonathan_champ@ncsu.edu
 */

defined('MOODLE_INTERNAL') || die();

class core_userdate_testcase extends advanced_testcase {

    /**
     * Test most TZ/DST.
     *
     * This method tests most TZ/DST combinations that were fixed
     * by MDL-44569. The tests are done by comparing the results of the
     * output using Moodle TZ/DST support and PHP native one.
     *
     * Note: If you don't trust PHP TZ/DST support, can verify the
     * harcoded expectations below with:
     * http://www.tools4noobs.com/online_tools/unix_timestamp_to_datetime/
     */

    public function test_timezone_Africa_Ceuta() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Africa/Ceuta';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Africa_Windhoek() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Africa/Windhoek';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396742399;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396742400;
            $expectation = '2014-04-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1410051599;
            $expectation = '2014-09-07 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1410051600;
            $expectation = '2014-09-07 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428191999;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428192000;
            $expectation = '2015-04-05 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1441501199;
            $expectation = '2015-09-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1441501200;
            $expectation = '2015-09-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459641599;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459641600;
            $expectation = '2016-04-03 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1472950799;
            $expectation = '2016-09-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1472950800;
            $expectation = '2016-09-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Adak() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Adak';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394366399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394366400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414925999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414926000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425815999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425816000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446375599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446375600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457870399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457870400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478429999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478430000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Anchorage() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Anchorage';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394362799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394362800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446371999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446372000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Asuncion() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Asuncion';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395543599;
            $expectation = '2014-03-22 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395543600;
            $expectation = '2014-03-22 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412481599;
            $expectation = '2014-10-04 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412481600;
            $expectation = '2014-10-05 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1426993199;
            $expectation = '2015-03-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1426993200;
            $expectation = '2015-03-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443931199;
            $expectation = '2015-10-03 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443931200;
            $expectation = '2015-10-04 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459047599;
            $expectation = '2016-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459047600;
            $expectation = '2016-03-26 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475380799;
            $expectation = '2016-10-01 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475380800;
            $expectation = '2016-10-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Bahia_Banderas() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Bahia_Banderas';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396771199;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396771200;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306799;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306800;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220799;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220800;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756399;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756400;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670399;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670400;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810799;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810800;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Boise() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Boise';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Cambridge_Bay() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Cambridge_Bay';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Campo_Grande() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Campo_Grande';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1392519599;
            $expectation = '2014-02-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1392519600;
            $expectation = '2014-02-15 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413691199;
            $expectation = '2014-10-18 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413691200;
            $expectation = '2014-10-19 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424573999;
            $expectation = '2015-02-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424574000;
            $expectation = '2015-02-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445140799;
            $expectation = '2015-10-17 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445140800;
            $expectation = '2015-10-18 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456023599;
            $expectation = '2016-02-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456023600;
            $expectation = '2016-02-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476590399;
            $expectation = '2016-10-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476590400;
            $expectation = '2016-10-16 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_America_Chicago() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Chicago';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Chihuahua() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Chihuahua';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396774799;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396774800;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414310399;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414310400;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428224399;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428224400;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445759999;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445760000;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459673999;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459674000;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477814399;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477814400;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Cuiaba() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Cuiaba';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1392519599;
            $expectation = '2014-02-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1392519600;
            $expectation = '2014-02-15 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413691199;
            $expectation = '2014-10-18 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413691200;
            $expectation = '2014-10-19 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424573999;
            $expectation = '2015-02-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424574000;
            $expectation = '2015-02-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445140799;
            $expectation = '2015-10-17 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445140800;
            $expectation = '2015-10-18 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456023599;
            $expectation = '2016-02-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456023600;
            $expectation = '2016-02-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476590399;
            $expectation = '2016-10-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476590400;
            $expectation = '2016-10-16 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Dawson() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Dawson';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394359199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394359200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Denver() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Denver';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Detroit() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Detroit';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Edmonton() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Edmonton';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Glace_Bay() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Glace_Bay';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Godthab() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Godthab';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-29 21:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-29 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-25 22:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-25 22:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-28 21:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-28 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-24 22:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-24 22:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-26 21:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-26 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-29 22:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-29 22:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Goose_Bay() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Goose_Bay';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_America_Halifax() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Halifax';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Havana() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Havana';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394341199;
            $expectation = '2014-03-08 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394341200;
            $expectation = '2014-03-09 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425790799;
            $expectation = '2015-03-07 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425790800;
            $expectation = '2015-03-08 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457845199;
            $expectation = '2016-03-12 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457845200;
            $expectation = '2016-03-13 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Indianapolis() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Indianapolis';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Knox() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Knox';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Marengo() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Marengo';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Petersburg() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Petersburg';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Tell_City() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Tell_City';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Vevay() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Vevay';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Vincennes() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Vincennes';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Indiana_Winamac() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Indiana/Winamac';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Inuvik() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Inuvik';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Iqaluit() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Iqaluit';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Juneau() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Juneau';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394362799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394362800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446371999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446372000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Kentucky_Louisville() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Kentucky/Louisville';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Kentucky_Monticello() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Kentucky/Monticello';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Los_Angeles() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Los_Angeles';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394359199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394359200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Matamoros() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Matamoros';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Mazatlan() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Mazatlan';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396774799;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396774800;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414310399;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414310400;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428224399;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428224400;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445759999;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445760000;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459673999;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459674000;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477814399;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477814400;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Menominee() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Menominee';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Merida() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Merida';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396771199;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396771200;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306799;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306800;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220799;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220800;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756399;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756400;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670399;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670400;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810799;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810800;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Mexico_City() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Mexico_City';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396771199;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396771200;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306799;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306800;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220799;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220800;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756399;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756400;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670399;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670400;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810799;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810800;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Miquelon() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Miquelon';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394341199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394341200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414900799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414900800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425790799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425790800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446350399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446350400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457845199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457845200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478404799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478404800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Moncton() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Moncton';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Monterrey() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Monterrey';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396771199;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396771200;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306799;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414306800;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220799;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428220800;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756399;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445756400;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670399;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459670400;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810799;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477810800;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Montevideo() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Montevideo';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394337599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394337600;
            $expectation = '2014-03-09 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412485199;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412485200;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425787199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425787200;
            $expectation = '2015-03-08 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443934799;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443934800;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457841599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457841600;
            $expectation = '2016-03-13 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475384399;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475384400;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Nassau() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Nassau';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_New_York() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/New_York';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Nipigon() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Nipigon';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Nome() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Nome';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394362799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394362800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446371999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446372000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_North_Dakota_Beulah() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/North_Dakota/Beulah';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_North_Dakota_Center() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/North_Dakota/Center';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_North_Dakota_New_Salem() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/North_Dakota/New_Salem';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Ojinaga() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Ojinaga';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Pangnirtung() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Pangnirtung';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Port_au_Prince() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Port-au-Prince';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Rainy_River() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Rainy_River';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Rankin_Inlet() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Rankin_Inlet';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Resolute() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Resolute';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Santa_Isabel() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Santa_Isabel';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396778399;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396778400;
            $expectation = '2014-04-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414313999;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414314000;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428227999;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428228000;
            $expectation = '2015-04-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445763599;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445763600;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459677599;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459677600;
            $expectation = '2016-04-03 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477817999;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477818000;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_America_Sao_Paulo() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Sao_Paulo';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1392515999;
            $expectation = '2014-02-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1392516000;
            $expectation = '2014-02-15 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413687599;
            $expectation = '2014-10-18 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1413687600;
            $expectation = '2014-10-19 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424570399;
            $expectation = '2015-02-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1424570400;
            $expectation = '2015-02-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445137199;
            $expectation = '2015-10-17 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445137200;
            $expectation = '2015-10-18 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456019999;
            $expectation = '2016-02-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1456020000;
            $expectation = '2016-02-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476586799;
            $expectation = '2016-10-15 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476586800;
            $expectation = '2016-10-16 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Scoresbysund() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Scoresbysund';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-29 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-28 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Sitka() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Sitka';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394362799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394362800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446371999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446372000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_St_Johns() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/St_Johns';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394342999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394343000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414902599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414902600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425792599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425792600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446352199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446352200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457846999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457847000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478406599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478406600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Thule() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Thule';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Thunder_Bay() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Thunder_Bay';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Tijuana() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Tijuana';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394359199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394359200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Toronto() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Toronto';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394348399;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394348400;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414907999;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414908000;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425797999;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425798000;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357599;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446357600;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852399;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457852400;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478411999;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478412000;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Vancouver() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Vancouver';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394359199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394359200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Whitehorse() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Whitehorse';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394359199;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394359200;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918799;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414918800;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808799;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425808800;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368399;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446368400;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863199;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457863200;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422799;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478422800;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Winnipeg() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Winnipeg';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394351999;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394352000;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911599;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414911600;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801599;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425801600;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361199;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446361200;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457855999;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457856000;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415599;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478415600;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Yakutat() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Yakutat';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394362799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394362800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414922400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425812400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446371999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446372000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457866800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478426400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_America_Yellowknife() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'America/Yellowknife';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394355599;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394355600;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915199;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414915200;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805199;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425805200;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364799;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446364800;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859599;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457859600;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419199;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478419200;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Asia_Amman() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Amman';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395957599;
            $expectation = '2014-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395957600;
            $expectation = '2014-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414706399;
            $expectation = '2014-10-31 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414706400;
            $expectation = '2014-10-31 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427407199;
            $expectation = '2015-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427407200;
            $expectation = '2015-03-27 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446155999;
            $expectation = '2015-10-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446156000;
            $expectation = '2015-10-30 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459461599;
            $expectation = '2016-03-31 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459461600;
            $expectation = '2016-04-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477605599;
            $expectation = '2016-10-28 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477605600;
            $expectation = '2016-10-28 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Baku() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Baku';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396137599;
            $expectation = '2014-03-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396137600;
            $expectation = '2014-03-30 05:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414281599;
            $expectation = '2014-10-26 04:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414281600;
            $expectation = '2014-10-26 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427587199;
            $expectation = '2015-03-29 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427587200;
            $expectation = '2015-03-29 05:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445731199;
            $expectation = '2015-10-25 04:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445731200;
            $expectation = '2015-10-25 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459036799;
            $expectation = '2016-03-27 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459036800;
            $expectation = '2016-03-27 05:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477785599;
            $expectation = '2016-10-30 04:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477785600;
            $expectation = '2016-10-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Beirut() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Beirut';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396130399;
            $expectation = '2014-03-29 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396130400;
            $expectation = '2014-03-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414270799;
            $expectation = '2014-10-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414270800;
            $expectation = '2014-10-25 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427579999;
            $expectation = '2015-03-28 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427580000;
            $expectation = '2015-03-29 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445720399;
            $expectation = '2015-10-24 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445720400;
            $expectation = '2015-10-24 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459029599;
            $expectation = '2016-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459029600;
            $expectation = '2016-03-27 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477774799;
            $expectation = '2016-10-29 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477774800;
            $expectation = '2016-10-29 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Asia_Choibalsan() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Choibalsan';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1427479199;
            $expectation = '2015-03-28 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427479200;
            $expectation = '2015-03-28 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443193199;
            $expectation = '2015-09-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443193200;
            $expectation = '2015-09-25 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458928799;
            $expectation = '2016-03-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458928800;
            $expectation = '2016-03-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474642799;
            $expectation = '2016-09-23 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474642800;
            $expectation = '2016-09-23 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Damascus() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Damascus';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395957599;
            $expectation = '2014-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395957600;
            $expectation = '2014-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414702799;
            $expectation = '2014-10-30 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414702800;
            $expectation = '2014-10-30 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427407199;
            $expectation = '2015-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427407200;
            $expectation = '2015-03-27 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446152399;
            $expectation = '2015-10-29 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446152400;
            $expectation = '2015-10-29 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458856799;
            $expectation = '2016-03-24 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458856800;
            $expectation = '2016-03-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477601999;
            $expectation = '2016-10-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477602000;
            $expectation = '2016-10-27 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Gaza() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Gaza';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395957599;
            $expectation = '2014-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395957600;
            $expectation = '2014-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414097999;
            $expectation = '2014-10-23 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414098000;
            $expectation = '2014-10-23 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427493599;
            $expectation = '2015-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427493600;
            $expectation = '2015-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445547599;
            $expectation = '2015-10-22 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445547600;
            $expectation = '2015-10-22 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458943199;
            $expectation = '2016-03-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458943200;
            $expectation = '2016-03-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476997199;
            $expectation = '2016-10-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476997200;
            $expectation = '2016-10-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Hebron() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Hebron';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395957599;
            $expectation = '2014-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395957600;
            $expectation = '2014-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414097999;
            $expectation = '2014-10-23 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414098000;
            $expectation = '2014-10-23 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427493599;
            $expectation = '2015-03-27 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427493600;
            $expectation = '2015-03-28 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445547599;
            $expectation = '2015-10-22 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445547600;
            $expectation = '2015-10-22 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458943199;
            $expectation = '2016-03-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458943200;
            $expectation = '2016-03-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476997199;
            $expectation = '2016-10-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1476997200;
            $expectation = '2016-10-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Hovd() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Hovd';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1427482799;
            $expectation = '2015-03-28 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427482800;
            $expectation = '2015-03-28 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443196799;
            $expectation = '2015-09-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443196800;
            $expectation = '2015-09-25 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458932399;
            $expectation = '2016-03-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458932400;
            $expectation = '2016-03-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474646399;
            $expectation = '2016-09-23 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474646400;
            $expectation = '2016-09-23 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Asia_Jerusalem() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Jerusalem';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395964799;
            $expectation = '2014-03-28 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395964800;
            $expectation = '2014-03-28 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414277999;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414278000;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427414399;
            $expectation = '2015-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427414400;
            $expectation = '2015-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445727599;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445727600;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458863999;
            $expectation = '2016-03-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458864000;
            $expectation = '2016-03-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477781999;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477782000;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Asia_Nicosia() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Nicosia';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Novokuznetsk() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Novokuznetsk';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1414263599;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414263600;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Asia_Tehran() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Tehran';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1395433799;
            $expectation = '2014-03-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1395433800;
            $expectation = '2014-03-22 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411327799;
            $expectation = '2014-09-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411327800;
            $expectation = '2014-09-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1426969799;
            $expectation = '2015-03-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1426969800;
            $expectation = '2015-03-22 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1442863799;
            $expectation = '2015-09-21 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1442863800;
            $expectation = '2015-09-21 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458505799;
            $expectation = '2016-03-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458505800;
            $expectation = '2016-03-21 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474399799;
            $expectation = '2016-09-20 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474399800;
            $expectation = '2016-09-20 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Asia_Ulaanbaatar() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Asia/Ulaanbaatar';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1427479199;
            $expectation = '2015-03-28 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427479200;
            $expectation = '2015-03-28 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443193199;
            $expectation = '2015-09-25 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443193200;
            $expectation = '2015-09-25 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458928799;
            $expectation = '2016-03-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1458928800;
            $expectation = '2016-03-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474642799;
            $expectation = '2016-09-23 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474642800;
            $expectation = '2016-09-23 23:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Atlantic_Azores() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Atlantic/Azores';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-29 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-28 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-26 23:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 00:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Atlantic_Bermuda() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Atlantic/Bermuda';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1394344799;
            $expectation = '2014-03-09 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1394344800;
            $expectation = '2014-03-09 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414904400;
            $expectation = '2014-11-02 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794399;
            $expectation = '2015-03-08 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1425794400;
            $expectation = '2015-03-08 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446353999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446354000;
            $expectation = '2015-11-01 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848799;
            $expectation = '2016-03-13 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1457848800;
            $expectation = '2016-03-13 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478408400;
            $expectation = '2016-11-06 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Atlantic_Canary() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Atlantic/Canary';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Atlantic_Faroe() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Atlantic/Faroe';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Atlantic_Madeira() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Atlantic/Madeira';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Adelaide() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Adelaide';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396715399;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396715400;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412440199;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412440200;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428164999;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428165000;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443889799;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443889800;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459614599;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459614600;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475339399;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475339400;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Broken_Hill() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Broken_Hill';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396715399;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396715400;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412440199;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412440200;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428164999;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428165000;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443889799;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443889800;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459614599;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459614600;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475339399;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475339400;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Currie() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Currie';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396713599;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396713600;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438399;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438400;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163199;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163200;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443887999;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443888000;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612799;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612800;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337599;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337600;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Hobart() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Hobart';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396713599;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396713600;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438399;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438400;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163199;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163200;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443887999;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443888000;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612799;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612800;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337599;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337600;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Lord_Howe() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Lord_Howe';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396709999;
            $expectation = '2014-04-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396710000;
            $expectation = '2014-04-06 01:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412436599;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412436600;
            $expectation = '2014-10-05 02:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428159599;
            $expectation = '2015-04-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428159600;
            $expectation = '2015-04-05 01:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443886199;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443886200;
            $expectation = '2015-10-04 02:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459609199;
            $expectation = '2016-04-03 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459609200;
            $expectation = '2016-04-03 01:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475335799;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475335800;
            $expectation = '2016-10-02 02:30:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Melbourne() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Melbourne';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396713599;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396713600;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438399;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438400;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163199;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163200;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443887999;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443888000;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612799;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612800;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337599;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337600;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Australia_Sydney() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Australia/Sydney';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396713599;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396713600;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438399;
            $expectation = '2014-10-05 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1412438400;
            $expectation = '2014-10-05 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163199;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428163200;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443887999;
            $expectation = '2015-10-04 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443888000;
            $expectation = '2015-10-04 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612799;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459612800;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337599;
            $expectation = '2016-10-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1475337600;
            $expectation = '2016-10-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Amsterdam() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Amsterdam';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Andorra() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Andorra';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Athens() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Athens';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Belgrade() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Belgrade';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Berlin() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Berlin';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Brussels() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Brussels';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Bucharest() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Bucharest';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Budapest() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Budapest';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Chisinau() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Chisinau';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Copenhagen() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Copenhagen';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Dublin() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Dublin';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Gibraltar() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Gibraltar';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Helsinki() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Helsinki';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Kiev() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Kiev';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Lisbon() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Lisbon';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_London() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/London';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Luxembourg() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Luxembourg';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Madrid() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Madrid';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Malta() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Malta';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Minsk() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Minsk';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1414274399;
            $expectation = '2014-10-26 00:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414274400;
            $expectation = '2014-10-26 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Monaco() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Monaco';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Oslo() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Oslo';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Paris() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Paris';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Prague() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Prague';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Riga() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Riga';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Rome() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Rome';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Sofia() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Sofia';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Stockholm() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Stockholm';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Tallinn() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Tallinn';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Tirane() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Tirane';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Uzhgorod() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Uzhgorod';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Vienna() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Vienna';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Vilnius() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Vilnius';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Warsaw() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Warsaw';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Europe_Zaporozhye() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Zaporozhye';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 04:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 03:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }

    }

    public function test_timezone_Europe_Zurich() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Europe/Zurich';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396141199;
            $expectation = '2014-03-30 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396141200;
            $expectation = '2014-03-30 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285199;
            $expectation = '2014-10-26 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414285200;
            $expectation = '2014-10-26 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590799;
            $expectation = '2015-03-29 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1427590800;
            $expectation = '2015-03-29 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734799;
            $expectation = '2015-10-25 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1445734800;
            $expectation = '2015-10-25 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040399;
            $expectation = '2016-03-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459040400;
            $expectation = '2016-03-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789199;
            $expectation = '2016-10-30 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1477789200;
            $expectation = '2016-10-30 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Pacific_Auckland() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Pacific/Auckland';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396706399;
            $expectation = '2014-04-06 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396706400;
            $expectation = '2014-04-06 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411826399;
            $expectation = '2014-09-28 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411826400;
            $expectation = '2014-09-28 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428155999;
            $expectation = '2015-04-05 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428156000;
            $expectation = '2015-04-05 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443275999;
            $expectation = '2015-09-27 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443276000;
            $expectation = '2015-09-27 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459605599;
            $expectation = '2016-04-03 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459605600;
            $expectation = '2016-04-03 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474725599;
            $expectation = '2016-09-25 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474725600;
            $expectation = '2016-09-25 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Pacific_Chatham() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Pacific/Chatham';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1396706399;
            $expectation = '2014-04-06 03:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1396706400;
            $expectation = '2014-04-06 02:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411826399;
            $expectation = '2014-09-28 02:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1411826400;
            $expectation = '2014-09-28 03:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428155999;
            $expectation = '2015-04-05 03:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1428156000;
            $expectation = '2015-04-05 02:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443275999;
            $expectation = '2015-09-27 02:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1443276000;
            $expectation = '2015-09-27 03:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459605599;
            $expectation = '2016-04-03 03:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1459605600;
            $expectation = '2016-04-03 02:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474725599;
            $expectation = '2016-09-25 02:44:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1474725600;
            $expectation = '2016-09-25 03:45:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }

    public function test_timezone_Pacific_Fiji() {
        $utcdtz = new DateTimeZone('UTC');
        $localtz = 'Pacific/Fiji';
        $localdtz = new DateTimeZone($localtz);
        {
            $stamp = 1390049999;
            $expectation = '2014-01-19 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1390050000;
            $expectation = '2014-01-19 01:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414850399;
            $expectation = '2014-11-02 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1414850400;
            $expectation = '2014-11-02 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1421503199;
            $expectation = '2015-01-18 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1421503200;
            $expectation = '2015-01-18 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446299999;
            $expectation = '2015-11-01 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1446300000;
            $expectation = '2015-11-01 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1453557599;
            $expectation = '2016-01-24 02:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1453557600;
            $expectation = '2016-01-24 02:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478354399;
            $expectation = '2016-11-06 01:59:59';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
        {
            $stamp = 1478354400;
            $expectation = '2016-11-06 03:00:00';
            $phpdt = DateTime::createFromFormat('U', $stamp, $utcdtz);
            $phpdt->setTimezone($localdtz);
            $phpres = $phpdt->format('Y-m-d H:i:s'); // PHP result.
            $moodleres = userdate($stamp, '%Y-%m-%d %H:%M:%S', $localtz, false, false); // Moodle result.
            $this->assertSame($expectation, $phpres);
            $this->assertSame($expectation, $moodleres);
        }
    }
}
