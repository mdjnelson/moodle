
// This is to avoid weird css behaviour when using Number.MAX_VALUE. Various browsers have different upper bound
// in pixel size, thus just to be safe, this value is still exceedingly big, but well below the values of inferior
// browsers (IEs).
Y.namespace('M.atto_image').maximum_pixel_size = 1000000;

Y.M.atto_image.hide_until_save_class = 'atto-image-helper-hide-until-save';
Y.M.atto_image.resize_node_container  = '<div class="atto-image-resize-container atto_control {{classes}}" ></div>';
Y.M.atto_image.resize_overlay_node_template = '<div class="atto-image-resize-overlay atto_control {{classes}}"></div>';