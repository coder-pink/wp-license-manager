<?php
/**
 * Plugin Name: New License Manager
 * Description: Automates software license generation and delivery via WooCommerce.
 * Version: 1.0.0
 * Author: Pinky Singh
 * Text Domain: license-manager-woocommerce
 * Domain Path: /languages
 */


if (!defined('ABSPATH')) {
    exit;
}

// Check WooCommerce is active
add_action('plugins_loaded', 'lmw_check_dependencies');
function lmw_check_dependencies() {
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>';
            esc_html_e('License Manager for WooCommerce requires WooCommerce to be active.', 'license-manager-woocommerce');
            echo '</p></div>';
        });
        return;
    }

    // plugin loader
    require_once plugin_dir_path(__FILE__) . 'includes/class-lmw-loader.php';
    
    new LMW_Loader();
}
