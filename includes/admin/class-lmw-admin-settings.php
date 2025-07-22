<?php

class LMW_Admin_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_pages']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_pages() {
        // Main menu page 
        add_menu_page(
            __('License Manager', 'license-manager-woocommerce'), 
            __('License Manager', 'license-manager-woocommerce'), 
            'manage_woocommerce',                                
            'license-manager',                                    
            [$this, 'render_settings_page'],                       
            'dashicons-admin-network',                             
            56                                                    
        );

        // Submenu: All Licenses
        add_submenu_page(
            'license-manager',
            __('All Licenses', 'license-manager-woocommerce'),
            __('All Licenses', 'license-manager-woocommerce'),
            'manage_woocommerce',
            'lmw-all-licenses',
            [$this, 'render_all_licenses_page']
        );
    }

    public function register_settings() {
        register_setting('lmw_settings_group', 'lmw_license_delivery_map');
    }

    public function render_settings_page() {
        include plugin_dir_path(__FILE__) . 'views/settings-general.php';
    }

    public function render_all_licenses_page() {
        include plugin_dir_path(__FILE__) . 'views/view-all-licenses.php';
    }
}

