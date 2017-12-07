/**
 * Show/hide admin settings based on other settings selected
 *
 * @package core
 * @copyright 2018 Davo Smith, Synergy Learning
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['jquery'], function($) {
    var dependencies;

    // -------------------------------
    // Specific dependency functions.
    // -------------------------------

    var depFns = {
        notchecked: function($dependon, value) {
            var hide = false;
            value = String(value);
            $dependon.each(function(idx, el) {
                var $el = $(el);
                if ($el.is('input[type=hidden]') && $el.siblings('input[type=checkbox][name="' + $el.attr('name') + '"]').length) {
                    // This is the hidden input that is part of the checkbox setting.
                    return;
                }
                if ($el.is('input[type=radio]') && $el.attr('value') !== value) {
                    return;
                }
                hide = hide || !$el.prop('checked');
            });
            return hide;
        },

        checked: function($dependon, value) {
            var hide = false;
            value = String(value);
            $dependon.each(function(idx, el) {
                var $el = $(el);
                if ($el.is('input[type=hidden]') && $el.siblings('input[type=checkbox][name="' + $el.attr('name') + '"]').length) {
                    // This is the hidden input that is part of the checkbox setting.
                    return;
                }
                if ($el.is('input[type=radio]') && $el.attr('value') !== value) {
                    return;
                }
                hide = hide || $el.prop('checked');
            });
            return hide;
        },

        noitemselected: function($dependon) {
            var hide = false;
            $dependon.each(function(idx, el) {
                var $el = $(el);
                hide = hide || ($el.prop('selectedIndex') === -1);
            });
            return hide;
        },

        eq: function($dependon, value) {
            var hide = false;
            var hiddenVal = false;
            value = String(value);
            $dependon.each(function(idx, el) {
                var $el = $(el);
                if ($el.is('input[type=radio]') && !$el.prop('checked')) {
                    return;
                } else if ($el.is('input[type=hidden]') &&
                    $el.siblings('input[type=checkbox][name="' + $el.attr('name') + '"]').length) {
                    // This is the hidden input that is part of the checkbox setting.
                    hiddenVal = ($el.val() === value);
                    return;
                } else if ($el.is('input[type=checkbox]') && !$el.prop('checked')) {
                    hide = hide || hiddenVal;
                    return;
                }
                if ($el.is('select') && $el.prop('multiple')) {
                    var values = value.split('|');
                    var selected = $el.val() || [];
                    if (values.length > 0 && selected.length === values.length) {
                        for (var i in selected) {
                            if (selected.hasOwnProperty(i)) {
                                if (values.indexOf(selected[i]) > -1) {
                                    hide = true;
                                } else {
                                    hide = false;
                                    return;
                                }
                            }
                        }
                    } else {
                        hide = false;
                    }
                } else {
                    hide = hide || ($el.val() === value);
                }
            });
            return hide;
        },

        'in': function($dependon, value) {
            var hide = false;
            var hiddenVal = false;
            var values = value.split('|');
            $dependon.each(function(idx, el) {
                var $el = $(el);
                if ($el.is('input[type=radio]') && !$el.prop('checked')) {
                    return;
                } else if ($el.is('input[type=hidden]') &&
                    $el.siblings('input[type=checkbox][name="' + $el.attr('name') + '"]').length) {
                    // This is the hidden input that is part of the checkbox setting.
                    hiddenVal = (values.indexOf($el.val()) > -1);
                    return;
                } else if ($el.is('input[type=checkbox]') && !$el.prop('checked')) {
                    hide = hide || hiddenVal;
                    return;
                }
                if ($el.is('select') && $el.prop('multiple')) {
                    var selected = $el.val() || [];
                    if (values.length > 0 && selected.length === values.length) {
                        for (var i in selected) {
                            if (selected.hasOwnProperty(i)) {
                                if (values.indexOf(selected[i]) > -1) {
                                    hide = true;
                                } else {
                                    hide = false;
                                    return;
                                }
                            }
                        }
                    } else {
                        hide = false;
                    }
                } else {
                    hide = hide || (values.indexOf($el.val()) > -1);
                }
            });
            return hide;
        },

        defaultCondition: function($dependon, value) {
            var hide = false;
            var hiddenVal = false;
            value = String(value);
            $dependon.each(function(idx, el) {
                var $el = $(el);
                if ($el.is('input[type=radio]') && !$el.prop('checked')) {
                    return;
                } else if ($el.is('input[type=hidden]') &&
                    $el.siblings('input[type=checkbox][name="' + $el.attr('name') + '"]').length) {
                    // This is the hidden input that is part of the checkbox setting.
                    hiddenVal = ($el.val() !== value);
                    return;
                } else if ($el.is('input[type=checkbox]') && !$el.prop('checked')) {
                    hide = hide || hiddenVal;
                    return;
                }
                if ($el.is('select') && $el.prop('multiple')) {
                    var values = value.split('|');
                    var selected = $el.val() || [];
                    if (values.length > 0 && selected.length === values.length) {
                        for (var i in selected) {
                            if (selected.hasOwnProperty(i)) {
                                if (values.indexOf(selected[i]) > -1) {
                                    hide = false;
                                } else {
                                    hide = true;
                                    return;
                                }
                            }
                        }
                    } else {
                        hide = true;
                    }
                } else {
                    hide = hide || ($el.val() !== value);
                }
            });
            return hide;
        }
    };

    /**
     * Find the element with the given name
     * @param {String} name
     * @returns {*|jQuery|HTMLElement}
     */
    function getElementsByName(name) {
        return $('[name="' + name + '"],[name="' + name + '[]"]');
    }

    /**
     * Find the name of the given element
     * @param {EventTarget} el
     * @returns {String}
     */
    function getElementName(el) {
        return $(el).attr('name').replace(/\[]/, '');
    }

    /**
     * Check to see whether a particular condition is met
     * @param {*|jQuery|HTMLElement} $dependon
     * @param {String} condition
     * @param {mixed} value
     * @returns {Boolean}
     */
    function checkDependency($dependon, condition, value) {
        if ($.isFunction(depFns[condition])) {
            return depFns[condition]($dependon, value);
        }
        return depFns.defaultCondition($dependon, value);
    }

    /**
     * Show / hide the elements that depend on the element(s) with the given name
     * OR (if no dependonname given) the element(s) with the same name as the element that
     * triggered the event e.
     * @param {Event} e
     * @param {String} dependonname (optional)
     */
    function updateDependencies(e, dependonname) {
        dependonname = dependonname || getElementName(e.currentTarget);
        var $dependon = getElementsByName(dependonname);
        if (!dependencies.hasOwnProperty(dependonname)) {
            return;
        }
        // Process all dependency conditions related to the updated element.
        var toHide = {};
        $.each(dependencies[dependonname], function(condition, values) {
            $.each(values, function(value, elements) {
                var hide = checkDependency($dependon, condition, value);
                $.each(elements, function(idx, elToHide) {
                    if (toHide.hasOwnProperty(elToHide)) {
                        toHide[elToHide] = toHide[elToHide] || hide;
                    } else {
                        toHide[elToHide] = hide;
                    }
                });
            });
        });

        // Update the hidden status of all relevant elements.
        $.each(toHide, function(elToHide, hide) {
            getElementsByName(elToHide).each(function(idx, el) {
                var $parent = $(el).closest('.form-item');
                if ($parent.length) {
                    if (hide) {
                        $parent.attr('hidden', 'hidden');
                        $parent.css('display', 'none');
                    } else {
                        $parent.removeAttr('hidden');
                        $parent.css('display', '');
                    }
                }
            });
        });
    }

    /**
     * Initialise the event handlers.
     */
    function initHandlers() {
        $.each(dependencies, function(depname) {
            var $el = getElementsByName(depname);
            if ($el.length) {
                $el.on('change', updateDependencies);
                updateDependencies(null, depname);
            }
        });
    }

    return {
        init: function(opts) {
            dependencies = opts.dependencies;
            initHandlers();
        }
    };
});