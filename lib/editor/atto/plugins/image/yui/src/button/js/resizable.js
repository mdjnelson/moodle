/**
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

        Y.log('initialized', 'debug', 'atto_image:resizable');
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

            Y.log('resizing to {' + new_width + 'px, ' + new_height + 'px }', 'debug', 'atto_image:resizable');

            this.node.setStyles({ width: new_width + 'px', height: new_height + 'px'});
            this._ghost_node_container.setStyles({ width: new_width + 'px', height: new_height + 'px'});
        }, this);
        resizable_overlay.resize.on('drag:end', function (e) {
            resizable_overlay.align();
        }, this);
        
        Y.M.atto_image.utility.enable_hide_until_save(this.node);

        this._enable = true;

        Y.log('enabled', 'debug', 'atto_image:resizable');
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

        Y.log('disabled', 'debug', 'atto_image:resizable');
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
});