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
 * Needs to have a description about forms and stuff.
 *
 * @module     core/forms
 * @class      forms
 * @package    core
 * @copyright  2015 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.1
 */
define(['jquery', 'core/templates'], function($, templates) {

    var load_mform = function() {
        // Ajax stuff.
        var deferred = $.Deferred();

        var promise = $.ajax({
            method: "POST",
            url: "ajax.php",
            dataType: "json",
            data: { action: "getmform" }
        });

        promise.done(function(mform) {
            deferred.resolve(mform);
        });
        return deferred.promise();

    };

    return {

        init: function() {

            $("#id_submitbutton").click(function(event) {
                event.preventDefault();
                console.log('handle submit');
                return false;
            });

            // console.log('hello');
            $.when(load_mform()).then(function(data) {
                // console.log(data);
                console.log(data[0]);
                $("#maincontent").after(data[1]);
                // $('head').append("<p>Age</p>");
                // $('head').append(data[0]);
                // $("#add-action-here").append(data[1]);
                // var newcontentnode = $(data[2]);
                // $('#page').append("<p>Aids</p>");
                $('#page').append(data[2]);
                // var thing = newcontentnode.find("script");
                // console.log(thing);
            });
            // console.log(assignid);
        }

    };

});
