YUI.add('moodle-atto_image-button', function (Y, NAME) {


// This is to avoid weird css behaviour when using Number.MAX_VALUE. Various browsers have different upper bound
// in pixel size, thus just to be safe, this value is still exceedingly big, but well below the values of inferior
// browsers (IEs).
Y.namespace('M.atto_image').maximum_pixel_size = 1000000;

Y.M.atto_image.hide_until_save_class = 'atto-image-helper-hide-until-save';
Y.M.atto_image.resize_node_container  = '<div class="atto-image-resize-container atto_control {{classes}}" ></div>';
Y.M.atto_image.resize_overlay_node_template = '<div class="atto-image-resize-overlay atto_control {{classes}}"></div>';// This file is part of Moodle - http://moodle.org/
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
};/**
 * Created by jandres on 21/06/16.
 */

Y.namespace('M.atto_image').resizable = function (cfg) {
    void(cfg);
    Y.M.atto_image.resizable.superclass.constructor.apply(this, arguments);
};
Y.extend(Y.namespace('M.atto_image').resizable, Y.Base, {
    /**
     * @property node
     * @type {null|Y.Node}
     * @required
     * @default null
     * @writeOnce
     * @public
     */
    node: null,

    /**
     * @property _ghost_node
     * @type {null|Y.Node}
     * @default null
     * @private
     */
    _ghost_node: null,

    /**
     * Wraps the _ghost_node. This is because _ghost_node is likely to be an img tag where we can't really
     * suspsend resize handles.
     *
     * @property _ghost_node_container
     * @type {null|Y.Node}
     * @default null
     * @private
     */
    _ghost_node_container: null,

    /**
     * False by default.
     *
     * @property _enable
     * @type {Boolean}
     * @default null
     * @private
     */
    _enable: false,

    /**
     * @property min_width
     * @type {int}
     * @default 640
     * @public
     */
    min_width: 640,

    /**
     * @property min_height
     * @type {int}
     * @default 480
     * @public
     */
    min_height: 480,

    /**
     * @property max_width
     * @type {int}
     * @default Y.M.atto_image.maximum_pixel_size
     * @public
     */
    max_width: Y.M.atto_image.maximum_pixel_size,

    /**
     * @property max_height
     * @type {int}
     * @default Y.M.atto_image.maximum_pixel_size
     * @public
     */
    max_height: Y.M.atto_image.maximum_pixel_size,

    /**
     * @property preserve_aspect_ratio
     * @type {Boolean}
     * @default false
     * @public
     */
    preserve_aspect_ratio: false,

    initializer: function (cfg) {
        this.node = cfg.node;
        if (!Y.Lang.isUndefined(cfg.min_width)) { this.min_width = cfg.min_width; }
        if (!Y.Lang.isUndefined(cfg.min_height)) { this.min_height = cfg.min_height; }
        if (!Y.Lang.isUndefined(cfg.max_width)) { this.max_width = cfg.max_width; }
        if (!Y.Lang.isUndefined(cfg.max_height)) { this.max_height = cfg.max_height; }
        if (!Y.Lang.isUndefined(cfg.preserve_aspect_ratio)) { this.preserve_aspect_ratio = cfg.preserve_aspect_ratio; }

        this.enable();

        this._publish_events();

    },

    /**
     * Call to build the resizing scaffolding.
     */
    enable: function() {
        // If scaffolding is already establish, don't do a thing.
        if (this._enable) return;

        // Note: No incentive to make resizable_overlay_node to be a property of atto_image::resizable since
        //       it is under this._ghost_node_container, which when deleted also deletes resizable_overlay_node.
        this._ghost_node = this._create_ghost_node();
        this._ghost_node_container = this._create_ghost_node_container();
        var resizable_overlay_node = this._create_resize_overlay_node();
        resizable_overlay_node.appendChild(this._ghost_node);

        this.node.insert(this._ghost_node_container, "before");
        this._ghost_node_container.appendChild(resizable_overlay_node);

        var resizable_overlay = this._create_resize_overlay(resizable_overlay_node, this._ghost_node_container);
        resizable_overlay.resize.on('resize:resize', function(e) {
            resizable_overlay.align();

            var new_width =
                Y.M.atto_image.utility.parseInt10(this._ghost_node.getComputedStyle("width")) -
                Y.M.atto_image.utility.get_horizontal_non_content_width(this._ghost_node);
            var new_height =
                Y.M.atto_image.utility.parseInt10(this._ghost_node.getComputedStyle("height")) -
                Y.M.atto_image.utility.get_vertical_non_content_width(this._ghost_node);


            this.node.setStyles({ width: new_width + 'px', height: new_height + 'px'});
            this._ghost_node_container.setStyles({ width: new_width + 'px', height: new_height + 'px'});
        }, this);
        resizable_overlay.resize.on('drag:end', function (e) {
            resizable_overlay.align();
        }, this);
        
        Y.M.atto_image.utility.enable_hide_until_save(this.node);

        this._enable = true;

    },

    /**
     * Call to take down the resizing scaffolding.
     */
    disable: function() {
        // If scaffolding is not a yet establish, don't do a thing.
        if (!this._enable) return;

        this._ghost_node_container.remove(true);  // Destroy it and its child nodes.
        this._ghost_node_container = null;
        this._ghost_node = null;

        Y.M.atto_image.utility.disable_hide_until_save(this.node);

        this._enable = false;

    },

    _publish_events: function() {
        /**
         * @event atto_image_resizable:click Fired when at least one of the nodes inside resize div is clicked. (Or resize obj is clicked).
         */
        this.publish('atto_image_resizable:click', {
            emitFacade: true,
            broadcast: 2  // Global broadcast, just like button clicks.
        }, this);

        /**
         * @event atto_image_resizable:resize:start Fired before resizing.
         */
        this.publish('atto_image_resizable:resize:start', {
            emitFacade: true,
            broadcast: 2  // Global broadcast, just like button clicks.
        }, this);

        /**
         * @event atto_image_resizable:resize:resize Fired during resizing.
         */
        this.publish('atto_image_resizable:resize:resize', {
            emitFacade: true,
            broadcast: 2  // Global broadcast, just like button clicks.
        }, this);

        /**
         * @event atto_image_resizable:resize:end Fired after resizing.
         */
        this.publish('atto_image_resizable:resize:end', {
            emitFacade: true,
            broadcast: 2  // Global broadcast, just like button clicks.
        }, this);

        /**
         * @event atto_image_resizable:tween Fired during the resizing animation.
         */
        this.publish('atto_image_resizable:tween', {
            emitFacade: true,
            broadcast: 2  // Global broadcast, just like button clicks.
        }, this);

        /**
         * @event atto_image_resizable:init Fired once at the beginning. Due to some bug in YUI.
         */
        this.publish('atto_image_resizable:init', {
            emitFacade: true,
            broadcast: 2, // Global broadcast, just like button clicks.
            context: this
        }, this);
    },

    _create_ghost_node: function() {
        var ghost_node = this.node.cloneNode(true);

        // Remove id attribute on _ghost_node for sanity and replace it with something else.
        ghost_node.removeAttribute('id').generateID();

        ghost_node.setStyles({
            // Remove styling that affect's non-content widths (e.g. margin and top/left css properties).
            margin: '0px',
            top: '0px',
            left: '0px',

            // To fill the resize_overlay, set width/height to 100%.
            width: '100%',
            height: '100%'
        });

        return ghost_node;
    },

    _create_ghost_node_container: function () {
        var container_template = Y.Handlebars.compile(Y.M.atto_image.resize_node_container);
        var ghost_node_container = Y.Node.create(container_template({ classess: '' }));

        // Copy all styling from node to container.
        ghost_node_container.getDOMNode().style.cssText = this.node.getDOMNode().style.cssText;

        /*
         * Setup some quirks, i.e. Although they are styling that applies outside the border, we don't want some
         * values of them since they can disrupt proper operation.
         *
         * display: We want initial|display|inline -> inline-block to respect the margins.
         */
        var node_display_style = this._ghost_node.getComputedStyle("display") || 'inline-block';
        if (node_display_style.toLowerCase() === "inline") {
            node_display_style = "inline-block";
        }

        // position: We want initial|static -> relative so child with position: absolute, respect container.
        var node_position_style = this._ghost_node.getComputedStyle("position") || 'relative';
        if (node_position_style.toLowerCase() === "static" || node_position_style.toLowerCase() === "initial") {
            node_position_style = "relative";
        }

        /*
         * Reset all styling that applies from border within, the following is the list of such, and explanation why:
         * a.) width/height: We want the container to hug ghost_node
         * b.) padding: We want the container to hug ghost_node
         * c.) border-width: We want the container to hug ghost_node, plus, ghost_node already have this (copied from node).
         * d.) (... Insert something due to a bug ...)
         */
        ghost_node_container.setStyles({
            // (3) Quirks.
            display: node_display_style,
            position: node_position_style,

            // (4) Reset all styling that applies from border within.
            width: this.node.getDOMNode().getBoundingClientRect().width + 'px',
            height: this.node.getDOMNode().getBoundingClientRect().height + 'px',

            padding: '0px',
            'border-width': '0px'
        });

        return ghost_node_container;
    },

    _create_resize_overlay_node: function() {
        var resizable_overlay_template = Y.Handlebars.compile(Y.M.atto_image.resize_overlay_node_template);
        var resizable_overlay_node = Y.Node.create(resizable_overlay_template({classes: ''}));

        return resizable_overlay_node;
    },

    _create_resize_overlay: function(resizable_overlay_node, node_to_overlay) {
        var resizable_overlay = new Y.Overlay({
            srcNode: resizable_overlay_node,

            // Note: We can only acquire the size of this.node since it's already in the DOM tree thus BoundingClientRect
            ///      exist. this._ghost_node on the other hand is not, thus getBoundingClientRect is 0 on all properties.
            width: this.node.getDOMNode().getBoundingClientRect().width + 'px',
            height: this.node.getDOMNode().getBoundingClientRect().height + 'px',

            visible: true,
            render: true,
            zIndex: 1000,  // TODO: Think about this. We want this on top of most things. Use case of something being of top of this?

            // Place overlay on top of each other.
            align: { node: node_to_overlay, points: ["tl", "tl"] }
        });
        resizable_overlay.plug(Y.Plugin.Resize, {
            handles: ['t', 'r', 'b','l', 'tr', 'tl', 'br', 'bl']
        });
        resizable_overlay.resize.plug(Y.Plugin.ResizeConstrained, {
            minWidth: this.min_width,
            minHeight: this.min_height,
            maxWidth: this.max_width,
            maxHeight: this.max_height,
            preserveRatio: this.preserve_aspect_ratio
        }, this);

        return resizable_overlay;
    }
}, {
    NAME: 'resizable'
});// This file is part of Moodle - http://moodle.org/
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
 * @copyright  2013 Damyon Wiese  <damyon@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @module moodle-atto_image_alignment-button
 */

/**
 * Atto image selection tool.
 *
 * @namespace M.atto_image
 * @class Button
 * @extends M.editor_atto.EditorPlugin
 */

var CSS = {
        RESPONSIVE: 'img-responsive',
        INPUTALIGNMENT: 'atto_image_alignment',
        INPUTALT: 'atto_image_altentry',
        INPUTHEIGHT: 'atto_image_heightentry',
        INPUTSUBMIT: 'atto_image_urlentrysubmit',
        INPUTURL: 'atto_image_urlentry',
        INPUTSIZE: 'atto_image_size',
        INPUTWIDTH: 'atto_image_widthentry',
        IMAGEALTWARNING: 'atto_image_altwarning',
        IMAGEBROWSER: 'openimagebrowser',
        IMAGEPRESENTATION: 'atto_image_presentation',
        INPUTCONSTRAIN: 'atto_image_constrain',
        INPUTCUSTOMSTYLE: 'atto_image_customstyle',
        IMAGEPREVIEW: 'atto_image_preview',
        IMAGEPREVIEWBOX: 'atto_image_preview_box'
    },
    SELECTORS = {
        INPUTURL: '.' + CSS.INPUTURL
    },
    ALIGNMENTS = [
        // Vertical alignment.
        {
            name: 'text-top',
            str: 'alignment_top',
            value: 'vertical-align',
            margin: '0 .5em'
        }, {
            name: 'middle',
            str: 'alignment_middle',
            value: 'vertical-align',
            margin: '0 .5em'
        }, {
            name: 'text-bottom',
            str: 'alignment_bottom',
            value: 'vertical-align',
            margin: '0 .5em',
            isDefault: true
        },

        // Floats.
        {
            name: 'left',
            str: 'alignment_left',
            value: 'float',
            margin: '0 .5em 0 0'
        }, {
            name: 'right',
            str: 'alignment_right',
            value: 'float',
            margin: '0 0 0 .5em'
        }, {
            name: 'customstyle',
            str: 'customstyle',
            value: 'style'
        }
    ],

    REGEX = {
        ISPERCENT: /\d+%/
    },

    COMPONENTNAME = 'atto_image',

    TEMPLATE = '' +
            '<form class="atto_form">' +
                '<label for="{{elementid}}_{{CSS.INPUTURL}}">{{get_string "enterurl" component}}</label>' +
                '<input class="fullwidth {{CSS.INPUTURL}}" type="url" id="{{elementid}}_{{CSS.INPUTURL}}" size="32"/>' +
                '<br/>' +

                // Add the repository browser button.
                '{{#if showFilepicker}}' +
                    '<button class="{{CSS.IMAGEBROWSER}}" type="button">{{get_string "browserepositories" component}}</button>' +
                '{{/if}}' +

                // Add the Alt box.
                '<div style="display:none" role="alert" class="warning {{CSS.IMAGEALTWARNING}}">' +
                    '{{get_string "presentationoraltrequired" component}}' +
                '</div>' +
                '<label for="{{elementid}}_{{CSS.INPUTALT}}">{{get_string "enteralt" component}}</label>' +
                '<input class="fullwidth {{CSS.INPUTALT}}" type="text" value="" id="{{elementid}}_{{CSS.INPUTALT}}" size="32"/>' +
                '<br/>' +

                // Add the presentation select box.
                '<input type="checkbox" class="{{CSS.IMAGEPRESENTATION}}" id="{{elementid}}_{{CSS.IMAGEPRESENTATION}}"/>' +
                '<label class="sameline" for="{{elementid}}_{{CSS.IMAGEPRESENTATION}}">' +
                    '{{get_string "presentation" component}}' +
                '</label>' +
                '<br/>' +

                // Add the size entry boxes.
                '<label class="sameline" for="{{elementid}}_{{CSS.INPUTSIZE}}">{{get_string "size" component}}</label>' +
                '<div id="{{elementid}}_{{CSS.INPUTSIZE}}" class="{{CSS.INPUTSIZE}}">' +
                '<label class="accesshide" for="{{elementid}}_{{CSS.INPUTWIDTH}}">{{get_string "width" component}}</label>' +
                '<input type="text" class="{{CSS.INPUTWIDTH}} input-mini" id="{{elementid}}_{{CSS.INPUTWIDTH}}" size="4"/> x ' +

                // Add the height entry box.
                '<label class="accesshide" for="{{elementid}}_{{CSS.INPUTHEIGHT}}">{{get_string "height" component}}</label>' +
                '<input type="text" class="{{CSS.INPUTHEIGHT}} input-mini" id="{{elementid}}_{{CSS.INPUTHEIGHT}}" size="4"/>' +

                // Add the constrain checkbox.
                '<input type="checkbox" class="{{CSS.INPUTCONSTRAIN}} sameline" id="{{elementid}}_{{CSS.INPUTCONSTRAIN}}"/>' +
                '<label for="{{elementid}}_{{CSS.INPUTCONSTRAIN}}">{{get_string "constrain" component}}</label>' +
                '</div>' +

                // Add the alignment selector.
                '<label class="sameline" for="{{elementid}}_{{CSS.INPUTALIGNMENT}}">{{get_string "alignment" component}}</label>' +
                '<select class="{{CSS.INPUTALIGNMENT}}" id="{{elementid}}_{{CSS.INPUTALIGNMENT}}">' +
                    '{{#each alignments}}' +
                        '<option value="{{value}}:{{name}};">{{get_string str ../component}}</option>' +
                    '{{/each}}' +
                '</select>' +
                // Hidden input to store custom styles.
                '<input type="hidden" class="{{CSS.INPUTCUSTOMSTYLE}}"/>' +
                '<br/>' +

                // Add the image preview.
                '<div class="mdl-align">' +
                '<div class="{{CSS.IMAGEPREVIEWBOX}}">' +
                    '<img src="#" class="{{CSS.IMAGEPREVIEW}}" alt="" style="display: none;"/>' +
                '</div>' +

                // Add the submit button and close the form.
                '<button class="{{CSS.INPUTSUBMIT}}" type="submit">{{get_string "saveimage" component}}</button>' +
                '</div>' +
            '</form>',

        IMAGETEMPLATE = '' +
            '<img src="{{url}}" alt="{{alt}}" ' +
                '{{#if width}}width="{{width}}" {{/if}}' +
                '{{#if height}}height="{{height}}" {{/if}}' +
                '{{#if presentation}}role="presentation" {{/if}}' +
                'style="{{alignment}}{{margin}}{{customstyle}}"' +
                '{{#if classlist}}class="{{classlist}}" {{/if}}' +
                '{{#if id}}id="{{id}}" {{/if}}' +
                '/>';

Y.namespace('M.atto_image').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
    /**
     * A reference to the current selection at the time that the dialogue
     * was opened.
     *
     * @property _currentSelection
     * @type Range
     * @private
     */
    _currentSelection: null,

    /**
     * The most recently selected image.
     *
     * @param _selectedImage
     * @type Node
     * @private
     */
    _selectedImage: null,

    /**
     * A reference to the currently open form.
     *
     * @param _form
     * @type Node
     * @private
     */
    _form: null,

    /**
     * The dimensions of the raw image before we manipulate it.
     *
     * @param _rawImageDimensions
     * @type Object
     * @private
     */
    _rawImageDimensions: null,

    initializer: function() {
        var self = this,
            host = this.get('host');

        this.addButton({
            icon: 'e/insert_edit_image',
            callback: this._displayDialogue,
            tags: 'img',
            tagMatchRequiresAll: false
        });
        this.editor.delegate('dblclick', this._displayDialogue, 'img', this);
        this.editor.delegate('click', this._handleClick, 'img', this);
        this.editor.on('drop', this._handleDragDrop, this);

        // Deselect the currently selected when something not an image is selected.
        // Cases when other image (not currently selected) is selected are handled in _handleClick too.
        this.editor.delegate('click', this._handleDeselect, ':not(img)', this);

        // e.preventDefault needed to stop the default event from clobbering the desired behaviour in some browsers.
        this.editor.on('dragover', function(e){e.preventDefault();}, this);
        this.editor.on('dragenter', function(e){e.preventDefault();}, this);

        host.on('atto:htmlcleaned', function(e) {
            e.args.html = self._cleanAttoImageHelperClasses(e.args.html);
        });
    },

    /**
     * @param {String} content HTML content.
     * @return {String} content without atto-image-helper-* classes.
     */
    _cleanAttoImageHelperClasses: function(content) {
        return content.replace(
            /(<[^>]*?class\s*?=\s*?")([^>"]*)(")/gi,
            function (match, group1, group2, group3) {
                var group2WithoutAttoHelperClass = group2.replace(/(?:^|[\s])[\s]*atto-image-helper[_a-zA-Z0-9\-]*/gi, "");
                return group1 + group2WithoutAttoHelperClass + group3;
            });
    },

    /**
     * Handle a drag and drop event with an image.
     *
     * @method _handleDragDrop
     * @param {EventFacade} e
     * @private
     */
    _handleDragDrop: function(e) {

        var self = this,
            host = this.get('host'),
            template = Y.Handlebars.compile(IMAGETEMPLATE);

        host.saveSelection();
        e = e._event;

        // Only handle the event if an image file was dropped in.
        var handlesDataTransfer = (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length);
        if (handlesDataTransfer && /^image\//.test(e.dataTransfer.files[0].type)) {

            var options = host.get('filepickeroptions').image,
                savepath = (options.savepath === undefined) ? '/' : options.savepath,
                formData = new FormData(),
                timestamp = 0,
                uploadid = "",
                xhr = new XMLHttpRequest(),
                imagehtml = "",
                keys = Object.keys(options.repositories);

            e.preventDefault();
            e.stopPropagation();
            formData.append('repo_upload_file', e.dataTransfer.files[0]);
            formData.append('itemid', options.itemid);

            // List of repositories is an object rather than an array.  This makes iteration more awkward.
            for (var i = 0; i < keys.length; i++) {
                if (options.repositories[keys[i]].type === 'upload') {
                    formData.append('repo_id', options.repositories[keys[i]].id);
                    break;
                }
            }
            formData.append('env', options.env);
            formData.append('sesskey', M.cfg.sesskey);
            formData.append('client_id', options.client_id);
            formData.append('savepath', savepath);
            formData.append('ctx_id', options.context.id);

            // Insert spinner as a placeholder.
            timestamp = new Date().getTime();
            uploadid = 'moodleimage_' + Math.round(Math.random() * 100000) + '-' + timestamp;
            host.focus();
            host.restoreSelection();
            imagehtml = template({
                url: M.util.image_url("i/loading_small", 'moodle'),
                alt: M.util.get_string('uploading', COMPONENTNAME),
                id: uploadid
            });
            host.insertContentAtFocusPoint(imagehtml);
            self.markUpdated();

            // Kick off a XMLHttpRequest.
            xhr.onreadystatechange = function() {
                var placeholder = self.editor.one('#' + uploadid),
                    result,
                    file,
                    newhtml,
                    newimage;

                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        result = JSON.parse(xhr.responseText);
                        if (result) {
                            if (result.error) {
                                if (placeholder) {
                                    placeholder.remove(true);
                                }
                                return new M.core.ajaxException(result);
                            }

                            file = result;
                            if (result.event && result.event === 'fileexists') {
                                // A file with this name is already in use here - rename to avoid conflict.
                                // Chances are, it's a different image (stored in a different folder on the user's computer).
                                // If the user wants to reuse an existing image, they can copy/paste it within the editor.
                                file = result.newfile;
                            }

                            // Replace placeholder with actual image.
                            newhtml = template({
                                url: file.url,
                                presentation: true
                            });
                            newimage = Y.Node.create(newhtml);
                            if (placeholder) {
                                placeholder.replace(newimage);
                            } else {
                                self.editor.appendChild(newimage);
                            }
                            self.markUpdated();
                        }
                    } else {
                        Y.use('moodle-core-notification-alert', function() {
                            new M.core.alert({message: M.util.get_string('servererror', 'moodle')});
                        });
                        if (placeholder) {
                            placeholder.remove(true);
                        }
                    }
                }
            };
            xhr.open("POST", M.cfg.wwwroot + '/repository/repository_ajax.php?action=upload', true);
            xhr.send(formData);
            return false;
        }

},

    /**
     * Handle a click on an image.
     *
     * @method _handleClick
     * @param {EventFacade} e
     * @private
     */
    _handleClick: function(e) {
        var image = e.target;

        var selection = this.get('host').getSelectionFromNode(image);
        if (this.get('host').getSelection() !== selection) {
            this.get('host').setSelection(selection);
        }

        var resize_cfg = {
            node: image
        };
        this._resizable = new Y.M.atto_image.resizable(resize_cfg);

        // Prevent further bubbling the DOM tree.
        // @see http://yuilibrary.com/yui/docs/event/#facade-properties
        // Without this, this will propagate up (bubble) and will hit the textarea, thus calling _handleDeselect,
        // immediately deselecting anything.
        
        e.halt(true);
    },

    /**
     * Deselect event handler.
     *
     * @param {EventTarget} e
     * @private
     */
    _handleDeselect: function(e) {
        void(e);
        if (this._resizable) {
            // Select nothing, destroy options overlay, and destroy the resizable object.
            this.get('host').setSelection([]);
            this._resizable.disable();
            this._resizable = null;
        }
    },

    /**
     * Display the image editing tool.
     *
     * @method _displayDialogue
     * @private
     */
    _displayDialogue: function() {
        // Store the current selection.
        this._currentSelection = this.get('host').getSelection();
        if (this._currentSelection === false) {
            return;
        }

        // Reset the image dimensions.
        this._rawImageDimensions = null;

        var dialogue = this.getDialogue({
            headerContent: M.util.get_string('imageproperties', COMPONENTNAME),
            width: '480px',
            focusAfterHide: true,
            focusOnShowSelector: SELECTORS.INPUTURL
        });

        // Set the dialogue content, and then show the dialogue.
        dialogue.set('bodyContent', this._getDialogueContent())
                .show();
    },

    /**
     * Set the inputs for width and height if they are not set, and calculate
     * if the constrain checkbox should be checked or not.
     *
     * @method _loadPreviewImage
     * @param {String} url
     * @private
     */
    _loadPreviewImage: function(url) {
        var image = new Image(), self = this;

        image.onerror = function() {
            var preview = self._form.one('.' + CSS.IMAGEPREVIEW);
            preview.setStyles({
                'display': 'none'
            });

            // Centre the dialogue when clearing the image preview.
            self.getDialogue().centerDialogue();
        };

        image.onload = function() {
            var input, currentwidth, currentheight, widthRatio, heightRatio;

            self._rawImageDimensions = {
                width: this.width,
                height: this.height
            };

            input = self._form.one('.' + CSS.INPUTWIDTH);
            currentwidth = input.get('value');
            if (currentwidth === '') {
                input.set('value', this.width);
                currentwidth = "" + this.width;
            }
            input = self._form.one('.' + CSS.INPUTHEIGHT);
            currentheight = input.get('value');
            if (currentheight === '') {
                input.set('value', this.height);
                currentheight = "" + this.height;
            }
            input = self._form.one('.' + CSS.IMAGEPREVIEW);
            input.setAttribute('src', this.src);
            input.setStyles({
                'display': 'inline'
            });

            input = self._form.one('.' + CSS.INPUTCONSTRAIN);
            if (currentwidth.match(REGEX.ISPERCENT) && currentheight.match(REGEX.ISPERCENT)) {
                input.set('checked', currentwidth === currentheight);
            } else {
                if (this.width === 0) {
                    this.width = 1;
                }
                if (this.height === 0) {
                    this.height = 1;
                }
                // This is the same as comparing to 3 decimal places.
                widthRatio = Math.round(1000*parseInt(currentwidth, 10) / this.width);
                heightRatio = Math.round(1000*parseInt(currentheight, 10) / this.height);
                input.set('checked', widthRatio === heightRatio);
            }

            // Apply the image sizing.
            self._autoAdjustSize(self);

            // Centre the dialogue once the preview image has loaded.
            self.getDialogue().centerDialogue();
        };

        image.src = url;
    },

    /**
     * Return the dialogue content for the tool, attaching any required
     * events.
     *
     * @method _getDialogueContent
     * @return {Node} The content to place in the dialogue.
     * @private
     */
    _getDialogueContent: function() {
        var template = Y.Handlebars.compile(TEMPLATE),
            canShowFilepicker = this.get('host').canShowFilepicker('image'),
            content = Y.Node.create(template({
                elementid: this.get('host').get('elementid'),
                CSS: CSS,
                component: COMPONENTNAME,
                showFilepicker: canShowFilepicker,
                alignments: ALIGNMENTS
            }));

        this._form = content;

        // Configure the view of the current image.
        this._applyImageProperties(this._form);

        this._form.one('.' + CSS.INPUTURL).on('blur', this._urlChanged, this);
        this._form.one('.' + CSS.IMAGEPRESENTATION).on('change', this._updateWarning, this);
        this._form.one('.' + CSS.INPUTALT).on('change', this._updateWarning, this);
        this._form.one('.' + CSS.INPUTWIDTH).on('blur', this._autoAdjustSize, this);
        this._form.one('.' + CSS.INPUTHEIGHT).on('blur', this._autoAdjustSize, this, true);
        this._form.one('.' + CSS.INPUTCONSTRAIN).on('change', function(event) {
            if (event.target.get('checked')) {
                this._autoAdjustSize(event);
            }
        }, this);
        this._form.one('.' + CSS.INPUTURL).on('blur', this._urlChanged, this);
        this._form.one('.' + CSS.INPUTSUBMIT).on('click', this._setImage, this);

        if (canShowFilepicker) {
            this._form.one('.' + CSS.IMAGEBROWSER).on('click', function() {
                    this.get('host').showFilepicker('image', this._filepickerCallback, this);
            }, this);
        }

        return content;
    },

    _autoAdjustSize: function(e, forceHeight) {
        forceHeight = forceHeight || false;

        var keyField = this._form.one('.' + CSS.INPUTWIDTH),
            keyFieldType = 'width',
            subField = this._form.one('.' + CSS.INPUTHEIGHT),
            subFieldType = 'height',
            constrainField = this._form.one('.' + CSS.INPUTCONSTRAIN),
            keyFieldValue = keyField.get('value'),
            subFieldValue = subField.get('value'),
            imagePreview = this._form.one('.' + CSS.IMAGEPREVIEW),
            rawPercentage,
            rawSize;

        // If we do not know the image size, do not do anything.
        if (!this._rawImageDimensions) {
            return;
        }

        // Set the width back to default if it is empty.
        if (keyFieldValue === '') {
            keyFieldValue = this._rawImageDimensions[keyFieldType];
            keyField.set('value', keyFieldValue);
            keyFieldValue = keyField.get('value');
        }

        // Clear the existing preview sizes.
        imagePreview.setStyles({
            width: null,
            height: null
        });

        // Now update with the new values.
        if (!constrainField.get('checked')) {
            // We are not keeping the image proportion - update the preview accordingly.

            // Width.
            if (keyFieldValue.match(REGEX.ISPERCENT)) {
                rawPercentage = parseInt(keyFieldValue, 10);
                rawSize = this._rawImageDimensions.width / 100 * rawPercentage;
                imagePreview.setStyle('width', rawSize + 'px');
            } else {
                imagePreview.setStyle('width', keyFieldValue + 'px');
            }

            // Height.
            if (subFieldValue.match(REGEX.ISPERCENT)) {
                rawPercentage = parseInt(subFieldValue, 10);
                rawSize = this._rawImageDimensions.height / 100 * rawPercentage;
                imagePreview.setStyle('height', rawSize + 'px');
            } else {
                imagePreview.setStyle('height', subFieldValue + 'px');
            }
        } else {
            // We are keeping the image in proportion.
            if (forceHeight) {
                // By default we update based on width. Swap the key and sub fields around to achieve a height-based scale.
                var _temporaryValue;
                _temporaryValue = keyField;
                keyField = subField;
                subField = _temporaryValue;

                _temporaryValue = keyFieldType;
                keyFieldType = subFieldType;
                subFieldType = _temporaryValue;

                _temporaryValue = keyFieldValue;
                keyFieldValue = subFieldValue;
                subFieldValue = _temporaryValue;
            }

            if (keyFieldValue.match(REGEX.ISPERCENT)) {
                // This is a percentage based change. Copy it verbatim.
                subFieldValue = keyFieldValue;

                // Set the width to the calculated pixel width.
                rawPercentage = parseInt(keyFieldValue, 10);
                rawSize = this._rawImageDimensions.width / 100 * rawPercentage;

                // And apply the width/height to the container.
                imagePreview.setStyle('width', rawSize);
                rawSize = this._rawImageDimensions.height / 100 * rawPercentage;
                imagePreview.setStyle('height', rawSize);
            } else {
                // Calculate the scaled subFieldValue from the keyFieldValue.
                subFieldValue = Math.round((keyFieldValue / this._rawImageDimensions[keyFieldType]) *
                        this._rawImageDimensions[subFieldType]);

                if (forceHeight) {
                    imagePreview.setStyles({
                        'width': subFieldValue,
                        'height': keyFieldValue
                    });
                } else {
                    imagePreview.setStyles({
                        'width': keyFieldValue,
                        'height': subFieldValue
                    });
                }
            }

            // Update the subField's value within the form to reflect the changes.
            subField.set('value', subFieldValue);
        }
    },

    /**
     * Update the dialogue after an image was selected in the File Picker.
     *
     * @method _filepickerCallback
     * @param {object} params The parameters provided by the filepicker
     * containing information about the image.
     * @private
     */
    _filepickerCallback: function(params) {
        if (params.url !== '') {
            var input = this._form.one('.' + CSS.INPUTURL);
            input.set('value', params.url);

            // Auto set the width and height.
            this._form.one('.' + CSS.INPUTWIDTH).set('value', '');
            this._form.one('.' + CSS.INPUTHEIGHT).set('value', '');

            // Load the preview image.
            this._loadPreviewImage(params.url);
        }
    },

    /**
     * Applies properties of an existing image to the image dialogue for editing.
     *
     * @method _applyImageProperties
     * @param {Node} form
     * @private
     */
    _applyImageProperties: function(form) {
        var properties = this._getSelectedImageProperties(),
            img = form.one('.' + CSS.IMAGEPREVIEW),
            i,
            css;

        if (properties === false) {
            img.setStyle('display', 'none');
            // Set the default alignment.
            for (i in ALIGNMENTS) {
                if (ALIGNMENTS[i].isDefault === true) {
                    css = ALIGNMENTS[i].value + ':' + ALIGNMENTS[i].name + ';';
                    form.one('.' + CSS.INPUTALIGNMENT).set('value', css);
                }
            }
            // Remove the custom style option if this is a new image.
            form.one('.' + CSS.INPUTALIGNMENT).getDOMNode().options.remove(ALIGNMENTS.length - 1);
            return;
        }

        if (properties.align) {
            form.one('.' + CSS.INPUTALIGNMENT).set('value', properties.align);
            // Remove the custom style option if we have a standard alignment.
            form.one('.' + CSS.INPUTALIGNMENT).getDOMNode().options.remove(ALIGNMENTS.length - 1);
        } else {
            form.one('.' + CSS.INPUTALIGNMENT).set('value', 'style:customstyle;');
        }
        if (properties.customstyle) {
            form.one('.' + CSS.INPUTCUSTOMSTYLE).set('value', properties.customstyle);
        }
        if (properties.width) {
            form.one('.' + CSS.INPUTWIDTH).set('value', properties.width);
        }
        if (properties.height) {
            form.one('.' + CSS.INPUTHEIGHT).set('value', properties.height);
        }
        if (properties.alt) {
            form.one('.' + CSS.INPUTALT).set('value', properties.alt);
        }
        if (properties.src) {
            form.one('.' + CSS.INPUTURL).set('value', properties.src);
            this._loadPreviewImage(properties.src);
        }
        if (properties.presentation) {
            form.one('.' + CSS.IMAGEPRESENTATION).set('checked', 'checked');
        }

        // Update the image preview based on the form properties.
        this._autoAdjustSize();
    },

    /**
     * Gets the properties of the currently selected image.
     *
     * The first image only if multiple images are selected.
     *
     * @method _getSelectedImageProperties
     * @return {object}
     * @private
     */
    _getSelectedImageProperties: function() {
        var properties = {
                src: null,
                alt :null,
                width: null,
                height: null,
                align: '',
                presentation: false
            },

            // Get the current selection.
            images = this.get('host').getSelectedNodes(),
            i,
            width,
            height,
            style,
            css,
            image,
            margin;

        if (images) {
            images = images.filter('img');
        }

        if (images && images.size()) {
            image = images.item(0);
            this._selectedImage = image;

            style = image.getAttribute('style');
            properties.customstyle = style;
            style = style.replace(/ /g, '');

            width = image.getAttribute('width');
            if (!width.match(REGEX.ISPERCENT)) {
                width = parseInt(width, 10);
            }
            height = image.getAttribute('height');
            if (!height.match(REGEX.ISPERCENT)) {
                height = parseInt(height, 10);
            }

            if (width !== 0) {
                properties.width = width;
            }
            if (height !== 0) {
                properties.height = height;
            }
            for (i in ALIGNMENTS) {
                css = ALIGNMENTS[i].value + ':' + ALIGNMENTS[i].name + ';';
                if (style.indexOf(css) !== -1) {
                    margin = 'margin:' + ALIGNMENTS[i].margin + ';';
                    margin = margin.replace(/ /g, '');
                    // Must match alignment and margins - otherwise custom style is selected.
                    if (style.indexOf(margin) !== -1) {
                        properties.align = css;
                        break;
                    }
                }
            }
            properties.src = image.getAttribute('src');
            properties.alt = image.getAttribute('alt') || '';
            properties.presentation = (image.get('role') === 'presentation');
            return properties;
        }

        // No image selected - clean up.
        this._selectedImage = null;
        return false;
    },

    /**
     * Update the form when the URL was changed. This includes updating the
     * height, width, and image preview.
     *
     * @method _urlChanged
     * @private
     */
    _urlChanged: function() {
        var input = this._form.one('.' + CSS.INPUTURL);

        if (input.get('value') !== '') {
            // Load the preview image.
            this._loadPreviewImage(input.get('value'));
        }
    },

    /**
     * Update the image in the contenteditable.
     *
     * @method _setImage
     * @param {EventFacade} e
     * @private
     */
    _setImage: function(e) {
        var form = this._form,
            url = form.one('.' + CSS.INPUTURL).get('value'),
            alt = form.one('.' + CSS.INPUTALT).get('value'),
            width = form.one('.' + CSS.INPUTWIDTH).get('value'),
            height = form.one('.' + CSS.INPUTHEIGHT).get('value'),
            alignment = form.one('.' + CSS.INPUTALIGNMENT).get('value'),
            margin = '',
            presentation = form.one('.' + CSS.IMAGEPRESENTATION).get('checked'),
            constrain = form.one('.' + CSS.INPUTCONSTRAIN).get('checked'),
            imagehtml,
            customstyle = '',
            i,
            css,
            classlist = [],
            host = this.get('host');

        e.preventDefault();

        // Check if there are any accessibility issues.
        if (this._updateWarning()) {
            return;
        }

        // Focus on the editor in preparation for inserting the image.
        host.focus();
        if (url !== '') {
            if (this._selectedImage) {
                host.setSelection(host.getSelectionFromNode(this._selectedImage));
            } else {
                host.setSelection(this._currentSelection);
            }

            if (alignment === 'style:customstyle;') {
                alignment = '';
                customstyle = form.one('.' + CSS.INPUTCUSTOMSTYLE).get('value');
            } else {
                for (i in ALIGNMENTS) {
                    css = ALIGNMENTS[i].value + ':' + ALIGNMENTS[i].name + ';';
                    if (alignment === css) {
                        margin = ' margin: ' + ALIGNMENTS[i].margin + ';';
                    }
                }
            }

            if (constrain) {
                classlist.push(CSS.RESPONSIVE);
            }

            if (!width.match(REGEX.ISPERCENT) && isNaN(parseInt(width, 10))) {
                form.one('.' + CSS.INPUTWIDTH).focus();
                return;
            }
            if (!height.match(REGEX.ISPERCENT) && isNaN(parseInt(height, 10))) {
                form.one('.' + CSS.INPUTHEIGHT).focus();
                return;
            }

            var template = Y.Handlebars.compile(IMAGETEMPLATE);
            imagehtml = template({
                url: url,
                alt: alt,
                width: width,
                height: height,
                presentation: presentation,
                alignment: alignment,
                margin: margin,
                customstyle: customstyle,
                classlist: classlist.join(' ')
            });

            this.get('host').insertContentAtFocusPoint(imagehtml);

            this.markUpdated();
        }

        this.getDialogue({
            focusAfterHide: null
        }).hide();

    },

    /**
     * Update the alt text warning live.
     *
     * @method _updateWarning
     * @return {boolean} whether a warning should be displayed.
     * @private
     */
    _updateWarning: function() {
        var form = this._form,
            state = true,
            alt = form.one('.' + CSS.INPUTALT).get('value'),
            presentation = form.one('.' + CSS.IMAGEPRESENTATION).get('checked');
        if (alt === '' && !presentation) {
            form.one('.' + CSS.IMAGEALTWARNING).setStyle('display', 'block');
            form.one('.' + CSS.INPUTALT).setAttribute('aria-invalid', true);
            form.one('.' + CSS.IMAGEPRESENTATION).setAttribute('aria-invalid', true);
            state = true;
        } else {
            form.one('.' + CSS.IMAGEALTWARNING).setStyle('display', 'none');
            form.one('.' + CSS.INPUTALT).setAttribute('aria-invalid', false);
            form.one('.' + CSS.IMAGEPRESENTATION).setAttribute('aria-invalid', false);
            state = false;
        }
        this.getDialogue().centerDialogue();
        return state;
    }
});


}, '@VERSION@', {"requires": ["moodle-editor_atto-plugin"]});
