<?php
/**
 * Plugin Name: SearchKings Africa UTM Grabber
 * Description: A plugin that dynamically updates an anchor tag link with UTM parameters from the current URL.
 * Version: 1.1.0
 * Author: SearchKings Africa
 * License: MIT
 * Text Domain: ska-utm-grabber
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue the JavaScript and CSS
function utm_grabber_enqueue_scripts() {
    wp_enqueue_script( 'ska-utm-grabber-script', plugin_dir_url( __FILE__ ) . 'ska-utm-grabber.js', array(), '1.0', true );
    wp_enqueue_style( 'ska-utm-grabber-style', plugin_dir_url( __FILE__ ) . 'ska-utm-grabber.css' );
    // Pass the dynamic URL to JavaScript
    wp_localize_script( 'ska-utm-grabber-script', 'utmGrabberData', array(
        'baseUrl' => get_option( 'utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/' ),
        'showIcon' => get_option( 'utm_grabber_show_icon', 'yes' ),
        'linkClass' => get_option( 'utm_grabber_link_class', 'sudonim-link' ),
    ) );
}

add_action( 'wp_enqueue_scripts', 'utm_grabber_enqueue_scripts' );

// Add the anchor tag with shortcode
function ska_utm_grabber_anchor_shortcode() {
    $base_url = get_option('utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/');
    $show_icon = get_option('utm_grabber_show_icon', 'yes');
    if ($show_icon === 'yes') {
        return '<a id="sudonim-link" class="whatsapp-icon-wrapper" href="' . esc_url($base_url) . '"><svg class="whatsapp-icon" width="360" height="362" viewBox="0 0 360 362" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_2301_8)"><path d="M42.0878 319.717L57.7289 259.225L102.383 303.332L42.0878 319.717Z" fill="white"/><circle cx="179.5" cy="180.5" r="151.5" fill="white"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M307.546 52.5655C273.709 18.685 228.706 0.0171895 180.756 0C81.951 0 1.53846 80.404 1.50408 179.235C1.48689 210.829 9.74646 241.667 25.4319 268.844L0 361.736L95.0236 336.811C121.203 351.096 150.683 358.616 180.679 358.625H180.756C279.544 358.625 359.966 278.212 360 179.381C360.017 131.483 341.392 86.4547 307.546 52.5741V52.5655ZM180.756 328.354H180.696C153.966 328.346 127.744 321.16 104.865 307.589L99.4242 304.358L43.034 319.149L58.0834 264.168L54.5423 258.53C39.6304 234.809 31.749 207.391 31.7662 179.244C31.8006 97.1036 98.6334 30.2707 180.817 30.2707C220.61 30.2879 258.015 45.8015 286.145 73.9665C314.276 102.123 329.755 139.562 329.738 179.364C329.703 261.513 262.871 328.346 180.756 328.346V328.354ZM262.475 216.777C257.997 214.534 235.978 203.704 231.869 202.209C227.761 200.713 224.779 199.966 221.796 204.452C218.814 208.939 210.228 219.029 207.615 222.011C205.002 225.002 202.389 225.372 197.911 223.128C193.434 220.885 179.003 216.158 161.891 200.902C148.578 189.024 139.587 174.362 136.975 169.875C134.362 165.389 136.7 162.965 138.934 160.739C140.945 158.728 143.412 155.505 145.655 152.892C147.899 150.279 148.638 148.406 150.133 145.423C151.629 142.432 150.881 139.82 149.764 137.576C148.646 135.333 139.691 113.287 135.952 104.323C132.316 95.5909 128.621 96.777 125.879 96.6309C123.266 96.5019 120.284 96.4762 117.293 96.4762C114.302 96.4762 109.454 97.5935 105.346 102.08C101.238 106.566 89.6691 117.404 89.6691 139.441C89.6691 161.478 105.716 182.785 107.959 185.776C110.202 188.767 139.544 234.001 184.469 253.408C195.153 258.023 203.498 260.782 210.004 262.845C220.731 266.257 230.494 265.776 238.212 264.624C246.816 263.335 264.71 253.786 268.44 243.326C272.17 232.866 272.17 223.893 271.053 222.028C269.936 220.163 266.945 219.037 262.467 216.794L262.475 216.777Z" fill="#25D366"/>
        </g><defs><clipPath id="clip0_2301_8"><rect width="360" height="362" fill="white"/></clipPath></defs></svg></a>';
    } else {
        return '';
    }
}

add_shortcode( 'ska_utm_grabber_anchor', 'ska_utm_grabber_anchor_shortcode' );

// Add settings page
function utm_grabber_add_admin_menu() {
    add_options_page(
        __( 'SearchKings Africa UTM Grabber Settings', 'utm-grabber' ),
        __( 'SearchKings Africa UTM Grabber', 'utm-grabber' ),
        'manage_options',
        'ska-utm-grabber',
        'utm_grabber_options_page'
    );
}
add_action( 'admin_menu', 'utm_grabber_add_admin_menu' );

// Register settings
function utm_grabber_settings_init() {
    register_setting( 'utmGrabber', 'utm_grabber_base_url' );
    register_setting( 'utmGrabber', 'utm_grabber_show_icon' );
    register_setting( 'utmGrabber', 'utm_grabber_link_class' );

    add_settings_section(
        'utm_grabber_section',
        __( 'SearchKings Africa UTM Grabber Settings', 'utm-grabber' ),
        'utm_grabber_settings_section_callback',
        'utmGrabber'
    );

    add_settings_field(
        'utm_grabber_base_url',
        __( 'Base URL', 'utm-grabber' ),
        'utm_grabber_base_url_render',
        'utmGrabber',
        'utm_grabber_section'
    );

    add_settings_field(
        'utm_grabber_show_icon',
        __( 'Show WhatsApp Icon', 'utm-grabber' ),
        'utm_grabber_show_icon_render',
        'utmGrabber',
        'utm_grabber_section'
    );

    add_settings_field(
        'utm_grabber_link_class',
        __( 'Link Class', 'utm-grabber' ),
        'utm_grabber_link_class_render',
        'utmGrabber',
        'utm_grabber_section'
    );
}
add_action( 'admin_init', 'utm_grabber_settings_init' );

function utm_grabber_base_url_render() {
    $base_url = get_option('utm_grabber_base_url');
    ?>
    <input type='text' name='utm_grabber_base_url' value='<?php echo esc_attr($base_url); ?>' style="width: 100%; margin-bottom: 20px;">
    <?php


}

function utm_grabber_show_icon_render() {
    $show_icon = get_option('utm_grabber_show_icon', 'yes');
    ?>
    <input type='checkbox' name='utm_grabber_show_icon' value='yes' <?php checked($show_icon, 'yes'); ?>> <?php _e( 'Show the WhatsApp icon', 'utm-grabber' ); ?>
    <?php
}

function utm_grabber_link_class_render() {
    $link_class = get_option('utm_grabber_link_class', 'sudonim-link');
    ?>
    <input type='text' name='utm_grabber_link_class' value='<?php echo esc_attr($link_class); ?>' style="width: 100%;">
    <?php
}


function utm_grabber_settings_section_callback() {
    echo __( 'Enter the settings for the SearchKings Africa UTM Grabber plugin.', 'utm-grabber' );
}

function utm_grabber_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h1><?php esc_html_e( 'SearchKings Africa UTM Grabber Settings', 'utm-grabber' ); ?></h1>
        <?php
        settings_fields( 'utmGrabber' );
        do_settings_sections( 'utmGrabber' );
        submit_button();
        ?>
        <h2><?php esc_html_e( 'Usage Instructions', 'utm-grabber' ); ?></h2>
        <p><?php esc_html_e( 'To use the WhatsApp call to action link in your posts or pages, follow these steps:', 'utm-grabber' ); ?></p>
        <ol>
            <li><?php esc_html_e( 'Configure the Base URL, Show Icon Option, and Link Class in the settings below.', 'utm-grabber' ); ?></li>
            <li><?php esc_html_e( 'If the "Show WhatsApp Icon" option is enabled, use the shortcode [ska_utm_grabber_anchor] in any post, page, or widget where you want the WhatsApp button to appear.', 'utm-grabber' ); ?></li>
            <li><?php esc_html_e( 'To dynamically update all links with a specified class, add the class to your links. The default class is "sudonim-link".', 'utm-grabber' ); ?></li>
        </ol>
        <p><?php esc_html_e( 'Example Shortcode Usage:', 'utm-grabber' ); ?></p>
        <code>[ska_utm_grabber_anchor]</code>
        <p><?php esc_html_e( 'This shortcode will display the WhatsApp icon link with the configured URL and UTM parameters if the icon is enabled.', 'utm-grabber' ); ?></p>
        <p><?php esc_html_e( 'Example Class Usage:', 'utm-grabber' ); ?></p>
        <code>&lt;a href="#" class="sudonim-link"&gt;Your Link Text&lt;/a&gt;</code>
        <p><?php esc_html_e( 'All links with the specified class will be dynamically updated with the configured URL and UTM parameters.', 'utm-grabber' ); ?></p>
    </form>
    <?php
}
?>