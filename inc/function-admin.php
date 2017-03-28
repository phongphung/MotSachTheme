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
    add_submenu_page( 'van_motsach', 'MotSach Sidebar Options', 'Sidebar', 'manage_options', 'van_motsach', 'motsach_theme_create_page' );
    
    // Generate sub admin page
    add_submenu_page( 'van_motsach', 'MotSach Theme Options', 'Theme Options', 'manage_options', 'van_motsach_theme', 'motsach_theme_support_page' );
    add_submenu_page( 'van_motsach', 'MotSach CSS Options', 'Custom CSS', 'manage_options', 'van_motsach_css', 'motsach_theme_css_page' );

}

add_action( 'admin_menu', 'motsach_add_admin_page' );


//Activate custom settings -  register settings, settings section, and fields
add_action( 'admin_init', 'motsach_custom_settings');
//


//MotSach Subpage Generation
function motsach_theme_support_page(){
    require_once( get_template_directory(). '/inc/templates/motsach-theme-support.php' );
}

function motsach_theme_create_page(){
    require_once( get_template_directory(). '/inc/templates/motsach-admin.php' );
}

function motsach_theme_css_page(){
    echo '<h1>CSS page - Admin sub page</h1>';
}
//


function motsach_custom_settings(){
    //Sidebar options
    register_setting( 'motsach-settings-group', 'profile_picture' );
    register_setting( 'motsach-settings-group', 'first_name' );
    register_setting( 'motsach-settings-group', 'last_name' );
    register_setting( 'motsach-settings-group', 'user_description' );
    register_setting( 'motsach-settings-group', 'twitter_handler', 'twitter_saniization' );
    register_setting( 'motsach-settings-group', 'facebook_handler' );
    register_setting( 'motsach-settings-group', 'gplus_handler' );

    add_settings_section( 'motsach-sidebar-options', 'Sidebar Options', 'motsach_sidebar_options', 'van_motsach' );

    add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'motsach_sidebar_profile', 'van_motsach', 'motsach-sidebar-options' );
    add_settings_field( 'sidebar-name', 'Full Name', 'motsach_sidebar_name', 'van_motsach', 'motsach-sidebar-options' );
    add_settings_field( 'sidebar-description', 'Description', 'motsach_sidebar_user_description', 'van_motsach', 'motsach-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'motsach_sidebar_twitter', 'van_motsach', 'motsach-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'motsach_sidebar_facebook', 'van_motsach', 'motsach-sidebar-options' );
    add_settings_field( 'sidebar-gplus', 'GPlus Handler', 'motsach_sidebar_gplus', 'van_motsach', 'motsach-sidebar-options' );
    //

    //Theme support options
    register_setting( 'motsach-theme-support', 'post_formats', 'motsach_post_formats_callback' );

    add_settings_section( 'motsach-theme-options', 'Theme Options', 'motsach_theme_options', 'van_motsach_theme' );

    add_settings_field( 'post-formats', 'Post Formats', 'motsach_post_formats', 'van_motsach_theme', 'motsach-theme-options' );
    //
}

//Theme support options functions
function motsach_post_formats_callback( $input ){
    #var_dump($input) ;
    return $input;
}

function motsach_theme_options(){
    echo 'activate theme support';
}

function motsach_post_formats(){
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $options = get_option( 'post_formats' );
    $output = '';
    foreach ( $formats as $format ){
        $checked = ( @$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input id="'. $format .'" type="checkbox" name="post_formats['.$format.']" value="1" '.$checked.'/> '. $format . '</label><br>';
    }
    echo $output;
}
//


//Sidebar options functions
function motsach_sidebar_options(){
    echo 'Customize your sidebar information';
}

function motsach_sidebar_profile(){
    $picture = esc_attr(get_option( 'profile_picture' ));
    echo '<input type="button" value="Upload Profile Picture" id="upload-button" class="button button-secondary"/><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'"/>';
}

function motsach_sidebar_name(){
    $firstName = esc_attr(get_option( 'first_name' ));
    $lastName = esc_attr(get_option( 'last_name' ));
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>';
    echo '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
}

function motsach_sidebar_user_description(){
    $description = esc_attr(get_option( 'user_description' ));
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="User Description"/><p class="description">Write something smart</p>';
}

function motsach_sidebar_twitter(){
    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter"/><p class="description">Input your twitter name without the @ character</p>';
}

function motsach_sidebar_facebook(){
    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook"/>';
}

function motsach_sidebar_gplus(){
    $gplus = esc_attr( get_option( 'gplus_handler' ) );
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="GPlus"/>';
}
//


//Sanitization settings
function twitter_saniization( $input ){
    $output = sanitize_text_field( $input );
    $output = str_replace('@', '', $output);
    return $output;
}
//

?> 