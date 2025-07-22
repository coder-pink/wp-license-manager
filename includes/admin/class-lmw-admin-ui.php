<?php

class LMW_Admin_UI {
    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'lmw-admin-style',
            plugin_dir_url(__FILE__) . '../../assets/css/admin-style.css',
            [],
            '1.0.0'
        );
    }

    public function enqueue_scripts($hook) {
        // Only load on your license-related admin pages
        if (isset($_GET['page']) && $_GET['page'] === 'lmw-bulk-manager') {
            // Load Select2 CSS & JS
            wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
            wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['jquery'], null, true);

            // Load your plugin's custom JS
            wp_enqueue_script(
                'lmw-admin-script',
                plugin_dir_url(__FILE__) . '../../assets/js/admin-script.js',
                ['jquery', 'select2'],
                '1.0.0',
                true
            );
        }
    }
}
