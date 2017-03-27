<?php 

/*

@package motsach-theme

   =================================
       ADMIN PAGE
   =================================
*/

function motsach_add_admin_page(){

    // Generate admin page
    add_menu_page( 'MotSach Theme Options', 'MotSach', 'manage_options', 'van_motsach', 'motsach_theme_create_page', get_template_directory_uri() . '/img/Thank-you.png', 110 );
    
    // Generate admin page
    add_submenu_page( 'van_motsach', 'MotSach Theme Options', 'Settings', 'manage_options', 'van_motsach', 'motsach_theme_create_page' );
    
    // Generate sub admin page
    add_submenu_page( 'van_motsach', 'MotSach CSS Options', 'Custom CSS', 'manage_options', 'van_motsach_css', 'motsach_theme_css_page' );

}

add_action( 'admin_menu', 'motsach_add_admin_page' );

function motsach_theme_create_page(){
    require_once( get_template_directory(). '/inc/templates/motsach_admin.php' );
}

function motsach_theme_css_page(){
    echo '<h1>CSS page - Admin sub page</h1>';

}

?>