<?php
// Add custom functions
include_once( 'includes/functions.php' ); 

// Add theme support post thumbnails
add_theme_support('post-thumbnails');

// WP menus
add_theme_support( 'menus' );

add_editor_style('css/styles.css');
add_editor_style('css/editor-style.css');


add_filter("gform_confirmation_anchor", create_function("","return false;"));
add_filter( 'gform_ajax_spinner_url', 'tgm_io_custom_gforms_spinner' );

function tgm_io_custom_gforms_spinner( $src ) {

return get_stylesheet_directory_uri() . '/images/gf-spinner.gif';
    
}

//add svg support to media uploader
function cc_mime_types( $mimes ){

     $mimes['svg'] = 'image/svg+xml';
     return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


//fix svg display in admin
function fix_svg() {
   echo '<style type="text/css">
         .attachment-post-thumbnail, .acf-image-image {
              width: 100% !important;
              height: auto !important;
         }
         .acf-image-image{
              width: 120px !important;
             
         }
         </style>';
}
add_action('admin_head', 'fix_svg');
?>