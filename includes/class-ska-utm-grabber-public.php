<?php
class SKA_UTM_Grabber_Public {
    public function enqueue_scripts() {
        wp_enqueue_script( 'ska-utm-grabber-script', SKA_UTM_GRABBER_URL . 'assets/js/ska-utm-grabber.js', array('jquery'), SKA_UTM_GRABBER_VERSION, true );
        wp_enqueue_style( 'ska-utm-grabber-style', SKA_UTM_GRABBER_URL . 'assets/css/ska-utm-grabber.css', array(), SKA_UTM_GRABBER_VERSION );
        
        wp_localize_script( 'ska-utm-grabber-script', 'utmGrabberData', array(
            'baseUrl' => get_option( 'utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/' ),
            'showIcon' => get_option( 'utm_grabber_show_icon', 'yes' ),
            'linkClass' => get_option( 'utm_grabber_link_class', 'sudonim-link' ),
            'utmParams' => array('utm_id', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'device','keyword', 'network', 'placement','adposition','gad_source','gclid')
        ) );
    }

    public function anchor_shortcode() {
        $base_url = get_option('utm_grabber_base_url', 'https://rply.link/d/27600899357/SKWA?Link=https://searchkingsafrica.com/');
        $show_icon = get_option('utm_grabber_show_icon', 'yes');
        if ($show_icon === 'yes') {
            return '<a id="sudonim-link" class="whatsapp-icon-wrapper" href="' . esc_url($base_url) . '"><svg class="whatsapp-icon" width="360" height="362" viewBox="0 0 360 362" fill="none" xmlns="http://www.w3.org/2000/svg"><!-- SVG content --></svg></a>';
        } else {
            return '';
        }
    }
}