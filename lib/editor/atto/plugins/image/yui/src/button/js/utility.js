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

/*
 * @package    atto_image
 * @copyright  2015 Joey Andres <jandres@ualberta.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This is where I placed the utility functions so they can be modified easily.
 *
 * @module moodle-atto_image-utility
 */

Y.M.atto_image.utility = {
    /**
     * A helper function for parsing string to base 10 and avoiding jsling/shifter complains about having no radix.
     * @param val
     * @returns {Number}
     */
    parseInt10: function(val) { return parseInt(val, 10); },

    /**
     * A helper function for getting the natural image size prior to any html attributes and css styling.
     *
     * @param {string} src Source of the image.
     */
    get_natural_image_size: function(src) {
        var img = new Image();
        img.src = src;
        return {width: img.width, height: img.height};
    },

    /**
     * A helper function for getting the approximate aspect ratio.
     *
     * @param {{width: {Number}, height: {Number}} size of the image to acquire aspect ratio of.
     * @returns {number} aspect ratio approximation.
     */
    get_natural_image_aspect_ratio: function(size) {
        return (size.width*Y.M.atto_image.get('image_size_multiplier')) /
            (size.height*Y.M.atto_image.get('image_size_multiplier'));
    },

    /**
     * @param {Y.Node} node to acquire the total horizontal border.
     * @returns {Number} Total horizontal border in px.
     */
    get_horizontal_border_width: function(node){
        return Y.M.atto_image.utility.parseInt10(node.getComputedStyle("border-left-width")) +
            Y.M.atto_image.utility.parseInt10(node.getComputedStyle("border-right-width"));
    },

    /**
     * @param {Y.Node} node to acquire the total vertical border.
     * @returns {Number} Total vertical border in px.
     */
    get_vertical_border_width: function(node){
        return Y.M.atto_image.utility.parseInt10(node.getComputedStyle("border-top-width")) +
            Y.M.atto_image.utility.parseInt10(node.getComputedStyle("border-bottom-width"));
    },

    /**
     * @param {Y.Node} node to acquire the total horizontal padding.
     * @returns {Number} Total horizontal border in px.
     */
    get_horizontal_padding_width: function(node){
        return Y.M.atto_image.utility.parseInt10(node.getComputedStyle("padding-left")) +
            Y.M.atto_image.utility.parseInt10(node.getComputedStyle("padding-right"));
    },

    /**
     * @param {Y.Node} node to acquire the total vertical padding.
     * @returns {Number} Total vertical border in px.
     */
    get_vertical_padding_width: function(node){
        return Y.M.atto_image.utility.parseInt10(node.getComputedStyle("padding-bottom")) +
            Y.M.atto_image.utility.parseInt10(node.getComputedStyle("padding-top"));
    },

    /**
     * @param {Y.Node} node to acquire the total non-content (border+padding) width .
     * @returns {Number} Total horizontal non-content in px.
     *
     * Note: Margin is not part of this, since by def'n, margin is outside box-model.
     */
    get_horizontal_non_content_width: function(node){
        return this.get_horizontal_border_width(node) + this.get_horizontal_padding_width(node);
    },

    /**
     * @param {Y.Node} node to acquire the total non-content (border+padding) height.
     * @returns {Number} Total vertical non-content in px.
     *
     * Note: Margin is not part of this, since by def'n, margin is outside box-model.
     */
    get_vertical_non_content_width: function(node){
        return this.get_vertical_border_width(node) + this.get_vertical_padding_width(node);
    },

    /**
     * "Hide until save" simply means the given node is hidden from the user until atto does an autosave/save.
     * @see clean.js of atto
     *
     * @param {Y.Node} node to enable hide until save feature.
     */
    enable_hide_until_save: function(node) {
        node.addClass(Y.M.atto_image.hide_until_save_class);
    },

    /**
     * @see enable_hide_until_save, this is simply the opposite.
     *
     * @param {Y.Node} node to enable hide until save feature.
     */
    disable_hide_until_save: function(node) {
        node.removeClass(Y.M.atto_image.hide_until_save_class);
    }
};