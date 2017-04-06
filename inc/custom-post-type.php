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

    add_filter( 'manage_motsach-contact_posts_columns', 'motsach_set_motsachcontact_post_columns' );
    add_action( 'manage_motsach-contact_posts_custom_column', 'motsach_contact_custom_column', 10, 2 );

    add_action( 'add_meta_boxes', 'motsach_contact_email_add_meta_box' );
    add_action( 'save_post', 'motsach_save_contac_email_data' );
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

function motsach_set_motsachcontact_post_columns( $columns ){
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';

    return $newColumns;
}

function motsach_contact_custom_column( $column, $post_id ){
    switch( $column ){
        case 'message' :
            echo get_the_excerpt();
            break;
        case 'email' :
            $email = get_post_meta( $post_id, '_contact_email_value_key', true );
            echo '<a href= "mailto:' . $email . '">'.$email.'</a>';
            break;

    }
}

/* CONTACT META BOXES */

function motsach_contact_email_add_meta_box() {
    add_meta_box( 'contact-email', 'User Email', 'motsach_contact_email_callback', 'motsach-contact', 'side', 'default' );
}

function motsach_contact_email_callback( $post ){
    wp_nonce_field( 'motsach_save_contac_email_data_secret_key', 'motsach_contact_email_meta_box_nonce' );

    $value = get_post_meta( $post -> ID, '_contact_email_value_key', true );

    echo '<label for="motsach_contact_email_field">User Email Address: </label>';
    echo '<input type="email" id="motsach_contact_email_field" name="motsach_contact_email_field" value="'. esc_attr( $value ) .'" size="25" />';
}

function motsach_save_contac_email_data( $post_id ) {
    if( ! isset($_POST['motsach_contact_email_meta_box_nonce']) ){
        return;
    }

    if( !wp_verify_nonce( $_POST['motsach_contact_email_meta_box_nonce'], 'motsach_save_contac_email_data_secret_key' )) {
        return;
    }

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE0 ){
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    if( ! isset( $_POST['motsach_contact_email_field'] ) ){
        return;
    }

    $my_data = sanitize_text_field($_POST['motsach_contact_email_field'] );

    update_post_meta( $post_id, '_contact_email_value_key', $my_data );

}
