/**
 * JS to help with management of predefined disguise settings.
 *
 * @module     disguise_predefined/settings
 * @class      settings
 * @package    disguise_predefined
 * @copyright  2016 Andrew Nicols <andrew@nicols.co.uk>
 */
define(
['jquery', 'core/str', 'core/notification'],
function($, str, notification) {
    return {
        init: function() {
            $('body').on(
                'click',
                '[data-type="sets"][data-action="delete"]',
                function(e) {
                    e.preventDefault();
                    str.get_strings([
                        {
                            component:  'disguise_predefined',
                            key:        'dialogue_delete_set_title'
                        },
                        {
                            component:  'disguise_predefined',
                            key:        'dialogue_delete_set_question',
                            param:      $(e.currentTarget).data()
                        },
                        {
                            component:  'moodle',
                            key:        'yes'
                        },
                        {
                            component:  'moodle',
                            key:        'no'
                        }
                    ]).done(function(s) {
                        notification.confirm(s[0], s[1], s[2], s[3], $.proxy(function() {
                                window.location = $(this).attr('href');
                            }, e.currentTarget));
                    });
                }
            );

            $('body').on(
                'click',
                '[data-type="set_data"][data-action="delete"]',
                function(e) {
                    e.preventDefault();
                    str.get_strings([
                        {
                            component:  'disguise_predefined',
                            key:        'dialogue_delete_set_data_title'
                        },
                        {
                            component:  'disguise_predefined',
                            key:        'dialogue_delete_set_data_question',
                            param:      $(e.currentTarget).data()
                        },
                        {
                            component:  'moodle',
                            key:        'yes'
                        },
                        {
                            component:  'moodle',
                            key:        'no'
                        }
                    ]).done(function(s) {
                        notification.confirm(s[0], s[1], s[2], s[3], $.proxy(function() {
                                window.location = $(this).attr('href');
                            }, e.currentTarget));
                    });
                }
            );

        }
    };
});
