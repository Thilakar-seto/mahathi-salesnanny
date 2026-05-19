<?php
class WPTS_Shortcode_Handler {

    public function __construct() {
        add_shortcode('wp_teams_scheduler', [$this, 'render_scheduler']);
    }

    public function render_scheduler($atts) {
        // Enqueue scripts and styles
        wp_enqueue_style('wpts-scheduler-css', WPTS_PLUGIN_URL . 'assets/css/scheduler.css', [], WPTS_VERSION);
        wp_enqueue_script('wpts-scheduler-js', WPTS_PLUGIN_URL . 'assets/js/scheduler.js', ['jquery'], WPTS_VERSION, true);

        // Localize script to pass data
        wp_localize_script('wpts-scheduler-js', 'wpts_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wpts_nonce')
        ]);

        $event_types = new WP_Query([
            'post_type' => 'event_type',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ]);

        ob_start();
        // Pass the query object to the template
        include(WPTS_PLUGIN_DIR . 'templates/scheduler-interface.php');
        return ob_get_clean();
    }
}