<?php
/**
 * Plugin Name: SearchKings Africa UTM Grabber
 * Description: A plugin that dynamically updates links with UTM parameters and adds them to form fields.
 * Version: 1.3.1
 * Author: SearchKings Africa
 * License: MIT
 * Text Domain: ska-utm-grabber
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'SKA_UTM_GRABBER_VERSION', '1.3.1' );
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

// // Register activation hook
// register_activation_hook( __FILE__, 'ska_utm_grabber_activate' );

// /**
//  * Plugin activation function.
//  */
// function ska_utm_grabber_activate() {
//     // Activation tasks (if any)
// }

// Load plugin text domain
function ska_utm_grabber_load_textdomain() {
    load_plugin_textdomain( 'ska-utm-grabber', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'ska_utm_grabber_load_textdomain' );
