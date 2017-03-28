<?php 

/*

@package motsach-theme

   =================================
       THEME SUPPORT
   =================================
*/
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$options = get_option( 'post_formats' );
$output = array();
foreach ( $formats as $format ){
   $output[] = ( @$options[$format] == 1 ? $format : '');
}
if( !empty( $options ) ){
    add_theme_support( 'post-formats', $output);
}