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
 * Class containing data for a user learning plans list page.
 *
 * @package    tool_lp
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_lp\output;

use renderable;
use templatable;
use renderer_base;
use stdClass;
use single_button;
use moodle_url;
use tool_lp\api;
use tool_lp\plan;
use context_user;

/**
 * Class containing data for a user learning plans list page.
 *
 * @copyright  2015 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plans_page implements renderable, templatable {

    /** @var array $navigation List of links to display on the page. Each link contains a url and a title. */
    protected $navigation = array();

    /** @var array|\tool_lp\plan[] $plans List of plans. */
    protected $plans = array();

    /** @var int $status The status of the plans we are viewing. */
    protected $status = null;

    /** @var context_user|null $context context.  */
    protected $context = null;

    /** @var int|null $userid Userid. */
    protected $userid = null;

    /** @var string $tabs The tabs to show. */
    var $tabs = array();

    /**
     * Construct this renderable.
     *
     * @param int $userid
     * @param int $status the status of the plans we are viewing
     */
    public function __construct($userid, $status = null) {
        $this->userid = $userid;
        $this->plans = api::list_user_plans($userid, $status);
        $this->context = context_user::instance($userid);

        if ($status === null) {
            $this->status = plan::STATUS_ACTIVE;
        } else {
            $this->status = $status;
        }

        $addplan = new single_button(
           new moodle_url('/admin/tool/lp/editplan.php', array('userid' => $userid)),
           get_string('addnewplan', 'tool_lp')
        );
        $this->navigation[] = $addplan;

        // Build the tabs we are going to use.
        $baseurl = (new moodle_url('/admin/tool/lp'))->out(true) . '/plans.php?userid=' . $userid;
        $tabs = array();
        $row = array();
        $row[] = new \tabobject(plan::STATUS_ACTIVE, $baseurl . '&status=' . plan::STATUS_ACTIVE,
            get_string('planstatusactive', 'tool_lp'));
        $row[] = new \tabobject(plan::STATUS_DRAFT, $baseurl . '&status=' . plan::STATUS_DRAFT,
            get_string('planstatusdraft', 'tool_lp'));
        $row[] = new \tabobject(plan::STATUS_COMPLETE, $baseurl . '&status=' . plan::STATUS_COMPLETE,
            get_string('planstatuscomplete', 'tool_lp'));
        $tabs[] = $row;

        $this->tabs = print_tabs($tabs, $this->status, null, null, true);
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->userid = $this->userid;
        $data->pluginbaseurl = (new moodle_url('/admin/tool/lp'))->out(true);
        $data->plans = array();

        // Attach standard objects as mustache can not parse \tool_lp\plan objects.
        if ($this->plans) {
            foreach ($this->plans as $plan) {
                $data->plans[] = $plan->to_record();
            }
        }

        $data->status = $this->status;

        $data->navigation = array();
        foreach ($this->navigation as $button) {
            $data->navigation[] = $output->render($button);
        }

        $data->tabs = $this->tabs;

        return $data;
    }
}
