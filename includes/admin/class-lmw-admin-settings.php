<?php

class LMW_Admin_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page() {
        add_menu_page(
            __('License Manager', 'license-manager-woocommerce'),
            __('License Manager', 'license-manager-woocommerce'),
            'manage_woocommerce',
            'license-manager',
            [$this, 'render_settings_page'],
            'dashicons-admin-network',
            56
        );
    }

    public function register_settings() {
        register_setting('lmw_settings_group', 'lmw_license_delivery_map');
    }

    public function render_settings_page() {
        include plugin_dir_path(__FILE__) . 'views/settings-general.php';
    }
}
