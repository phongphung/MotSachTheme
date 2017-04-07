<h1>MotSach Custom CSS</h1>
<?php settings_errors() ?>


<form id="save-custom-css-form" method="post" action="options.php" class="motsach-general-form">  
    <?php settings_fields('motsach-custom-css-options'); ?>
    <?php do_settings_sections( 'van_motsach_css' ); ?>
    <?php submit_button();?>
</form>