<h1>MotSach Theme Options</h1>
<?php settings_errors() ?>
<?php
    #$options = get_option( 'post_formats' );
    #var_dump($options)
?>

<form method="post" action="options.php" class="motsach-general-form">  
    <?php settings_fields('motsach-theme-support'); ?>
    <?php do_settings_sections( 'van_motsach_theme' ); ?>
    <?php submit_button();?>
</form>