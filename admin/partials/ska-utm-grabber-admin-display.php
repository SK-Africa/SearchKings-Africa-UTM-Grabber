<?php
// Check user capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}

// Show error/update messages
settings_errors( 'utmGrabber_messages' );
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields( 'utmGrabber' );
        do_settings_sections( 'utmGrabber' );
        submit_button( 'Save Settings' );
        ?>
    </form>
</div>
<?php
