<?php
/*
Plugin Name: Featured Image Details
Plugin URI: https://michaelott.id.au
Description: Qickly view details of the featured image.
Author: Michael Ott
Version: 1.0
Text Domain: featured-image-modal
Domain Path: /languages/
*/

// Look for translation file.
function load_fid_textdomain() {
    load_plugin_textdomain( 'fid', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'load_fid_textdomain' );

// Add popup JS into admin head
function fim_admin() { ?>
    <style>
    .fid-window {
        display: none; 
        position: fixed; 
        width: calc(100% - 100px); 
        height: calc(100% - 100px); 
        top: 50px; 
        left: 50px;
        z-index: 99999;
    }
    .fid-mask {
        display: none; 
        background: rgba(0, 0, 0, 0.60);
        position: fixed; 
        width: 100%; 
        height: 100%; 
        top: 0; 
        left: 0;
        z-index: 99998;
    }
    </style>
<?php }
add_action('admin_head', 'fim_admin');


function add_featured_image_display_settings( $content, $post_id ) {
    $button_label           = esc_html__( 'Featured Image Details', 'fid' );
    $post_thumbnail_id      = get_post_thumbnail_id( $post_id );
    $details_path           = get_admin_url() . 'post.php?post=' . $post_thumbnail_id . '&action=edit';
    //$fid_image_preview      = get_the_post_thumbnail_url(get_the_ID(),'full');
    $fid_image_preview      = plugins_url( 'preview.php', __FILE__ );
    $fid_button             = sprintf('<p><a class="button fid-button">%1$s</a></p>',$button_label);
    $fid_script             = '<script>jQuery(".fid-button").click(function() { jQuery(".fid-window").load("' . $fid_image_preview . '"); jQuery(".fid-mask, .fid-window").fadeIn(); });</script>';
    $fid_window             = '<div class="fid-window"></div>';
    $fid_mask               = '<div class="fid-mask"></div>';

    return $content .= $fid_button . $fid_script . $fid_window . $fid_mask;

}
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_display_settings', 10, 2 );