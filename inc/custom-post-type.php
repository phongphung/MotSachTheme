<?php 

/*

@package motsach-theme

   =================================
       THEME CUSTOM POST TYPE
   =================================
*/

$contact = get_option( 'activate_contact' );
if( @$contact == 1 ){
    add_action( 'init', 'motsach_contact_form_post_type' );
}

/* CONTACT custom post type */
function motsach_contact_form_post_type() {
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message',
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => array( 'title', 'editor', 'author' ),
    );

    register_post_type( 'motsach-contact', $args );

}