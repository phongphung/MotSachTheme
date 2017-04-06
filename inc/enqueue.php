<?php 

/*

@package motsach-theme

   =================================
       ADMIN ENQUEUE FUNCTIONS
   =================================
*/

function motsach_load_admin_scripts( $hook ){
    //echo $hook;
    if( 'toplevel_page_van_motsach' == $hook ){

    wp_register_style( 'motsach_admin', get_template_directory_uri() . '/css/motsach.admin.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'motsach_admin');

    wp_enqueue_media();

    wp_register_script( 'motsach_admin_script', get_template_directory_uri() . '/js/motsach.admin.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'motsach_admin_script' );

    } else if ( $hook == 'motsach_page_van_motsach_css' ) {

        wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/motsach.ace.css', array(), '1.0.0', 'all' );

        wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/src-noconflict/ace.js', array('jquery'), '1.2.1', true );
        wp_enqueue_script( 'motsach_custom_css_script', get_template_directory_uri() . '/js/motsach.custom_css.js', array('jquery'), '1.0.0', true );
    } else { return; }
}

add_action( 'admin_enqueue_scripts', 'motsach_load_admin_scripts' );