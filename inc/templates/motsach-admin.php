<h1>MotSach Sidebar Options</h1>
<?php settings_errors() ?>
<?php
    $picture_url = esc_attr( get_option( 'profile_picture' ) );
    $firstName = esc_attr(get_option( 'first_name' ));
    $lastName = esc_attr(get_option( 'last_name' ));
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr(get_option( 'user_description' ));
?>
<div class='motsach-sidebar-preview'>
    <div class='motsach-sidebar'>
        <div class='image-container'>
            <div id= 'profile-picture-preview' class='profile-picture' style='background-image: url(<?php print $picture_url ?>)'>
            </div>
        </div>
        <h1 class='motsach-username'><?php print $fullName; ?></h1>
        <h2 class='motsach-description'><?php print $description; ?></h2>
        <div class='icon-wrapper'></div>
    </div>
</div>

<form method="post" action="options.php" class="motsach-general-form">  
    <?php settings_fields('motsach-settings-group'); ?>
    <?php do_settings_sections( 'van_motsach' ); ?>
    <?php submit_button( 'Save Changes', 'primary', 'btnSubmitMotsachSidebarPage' );?>
</form>