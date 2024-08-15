<?php
// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete plugin options
delete_option( 'utm_grabber_base_url' );
delete_option( 'utm_grabber_show_icon' );
delete_option( 'utm_grabber_link_class' );

// Perform any other cleanup necessary for your plugin
