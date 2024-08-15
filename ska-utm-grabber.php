<?php
/**
 * Plugin Name: SearchKings Africa UTM Grabber
 * Description: A plugin that dynamically updates links with UTM parameters and adds them to form fields.
 * Version: 1.4.2
 * Author: SearchKings Africa
 * License: MIT
 * Text Domain: ska-utm-grabber
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'SKA_UTM_GRABBER_VERSION', '1.4.2' );
define( 'SKA_UTM_GRABBER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SKA_UTM_GRABBER_URL', plugin_dir_url( __FILE__ ) );

// Include main plugin class
require_once SKA_UTM_GRABBER_PATH . 'includes/class-ska-utm-grabber.php';

// Initialize the plugin
function ska_utm_grabber_init() {
    $plugin = new SKA_UTM_Grabber();
    $plugin->run();
}
add_action( 'plugins_loaded', 'ska_utm_grabber_init' );

// Load plugin text domain
function ska_utm_grabber_load_textdomain() {
    load_plugin_textdomain( 'ska-utm-grabber', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'ska_utm_grabber_load_textdomain' );

// Check and update plugin version
function ska_utm_grabber_check_version() {
    if ( version_compare( get_option( 'ska_utm_grabber_version' ), SKA_UTM_GRABBER_VERSION, '<' ) ) {
        ska_utm_grabber_update();
    }
}
add_action( 'plugins_loaded', 'ska_utm_grabber_check_version', 0 );

// Update routine
function ska_utm_grabber_update() {
    // Perform any necessary updates based on version differences
    // For example, you might need to update database schemas or plugin settings

    // Update the version in the database
    update_option( 'ska_utm_grabber_version', SKA_UTM_GRABBER_VERSION );
}

// Activation hook
function ska_utm_grabber_activate() {
    // Perform any necessary actions on plugin activation
    // This is a good place to set default options if needed
    
    // Set the initial version in the database
    add_option( 'ska_utm_grabber_version', SKA_UTM_GRABBER_VERSION );

    // Set default options
    add_option( 'utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/' );
    add_option( 'utm_grabber_show_icon', 'yes' );
    add_option( 'utm_grabber_link_class', 'sudonim-link' );
}
register_activation_hook( __FILE__, 'ska_utm_grabber_activate' );

// Deactivation hook
function ska_utm_grabber_deactivate() {
    // Perform any cleanup if necessary
}
register_deactivation_hook( __FILE__, 'ska_utm_grabber_deactivate' );

// Uninstall hook (typically defined in uninstall.php)
// register_uninstall_hook( __FILE__, 'ska_utm_grabber_uninstall' );