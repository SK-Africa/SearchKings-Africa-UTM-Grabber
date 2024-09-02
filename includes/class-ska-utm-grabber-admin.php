<?php
class SKA_UTM_Grabber_Admin {
    public function add_plugin_admin_menu() {
        add_options_page(
            __( 'SearchKings Africa UTM Grabber Settings', 'ska-utm-grabber' ),
            __( 'SearchKings Africa UTM Grabber', 'ska-utm-grabber' ),
            'manage_options',
            'ska-utm-grabber',
            array( $this, 'display_plugin_admin_page' )
        );
    }

    public function display_plugin_admin_page() {
        // Display admin settings page
        include_once SKA_UTM_GRABBER_PATH . 'admin/partials/ska-utm-grabber-admin-display.php';
    }

    public function register_and_build_fields() {
        // Register settings
        register_setting( 'utmGrabber', 'utm_grabber_base_url' );
        register_setting( 'utmGrabber', 'utm_grabber_show_icon' );
        register_setting( 'utmGrabber', 'utm_grabber_link_class' );

        // Add settings section
        add_settings_section(
            'utm_grabber_section',
            __( 'SearchKings Africa UTM Grabber Settings', 'ska-utm-grabber' ),
            array( $this, 'utm_grabber_settings_section_callback' ),
            'utmGrabber'
        );

        // Add settings fields
        add_settings_field(
            'utm_grabber_base_url',
            __( 'Base URL', 'ska-utm-grabber' ),
            array( $this, 'utm_grabber_base_url_render' ),
            'utmGrabber',
            'utm_grabber_section'
        );

        add_settings_field(
            'utm_grabber_show_icon',
            __( 'Show WhatsApp Icon', 'ska-utm-grabber' ),
            array( $this, 'utm_grabber_show_icon_render' ),
            'utmGrabber',
            'utm_grabber_section'
        );

        add_settings_field(
            'utm_grabber_link_class',
            __( 'Link Class', 'ska-utm-grabber' ),
            array( $this, 'utm_grabber_link_class_render' ),
            'utmGrabber',
            'utm_grabber_section'
        );
    }

    public function utm_grabber_settings_section_callback() {
        echo __( 'Enter the settings for the SearchKings Africa UTM Grabber plugin.', 'ska-utm-grabber' );
    }

    public function utm_grabber_base_url_render() {
        $base_url = get_option( 'utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/' );
        ?>
        <input type='text' name='utm_grabber_base_url' value='<?php echo esc_attr( $base_url ); ?>' style="width: 80%; margin-bottom: 20px;" placeholder='<?php echo esc_attr( $base_url ); ?>'>
        <?php
    }

    public function utm_grabber_show_icon_render() {
        $show_icon = get_option( 'utm_grabber_show_icon', 'yes' );
        ?>
        <select name='utm_grabber_show_icon'>
            <option value='yes' <?php selected( $show_icon, 'yes' ); ?>><?php _e( 'Yes', 'ska-utm-grabber' ); ?></option>
            <option value='no' <?php selected( $show_icon, 'no' ); ?>><?php _e( 'No', 'ska-utm-grabber' ); ?></option>
        </select>
        <?php
    }

}