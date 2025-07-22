<?php
if (!defined('ABSPATH')) exit;

class LMW_License {
    public function __construct() {
        add_action('init', [$this, 'register_license_post_type']);
    }

    public function register_license_post_type() {
        $labels = [
            'name'               => __('Licenses', 'license-manager-woocommerce'),
            'singular_name'      => __('License', 'license-manager-woocommerce'),
            'menu_name'          => __('License Manager', 'license-manager-woocommerce'),
            'name_admin_bar'     => __('License', 'license-manager-woocommerce'),
            'add_new'            => __('Add New', 'license-manager-woocommerce'),
            'add_new_item'       => __('Add New License', 'license-manager-woocommerce'),
            'edit_item'          => __('Edit License', 'license-manager-woocommerce'),
            'new_item'           => __('New License', 'license-manager-woocommerce'),
            'view_item'          => __('View License', 'license-manager-woocommerce'),
            'all_items'          => __('All Licenses', 'license-manager-woocommerce'),
            'search_items'       => __('Search Licenses', 'license-manager-woocommerce'),
            'not_found'          => __('No licenses found.', 'license-manager-woocommerce'),
            'not_found_in_trash' => __('No licenses found in Trash.', 'license-manager-woocommerce'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 56,
            'menu_icon'          => 'dashicons-admin-network',
            'supports'           => ['title', 'custom-fields'],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'show_in_menu' => true, 
        ];

        register_post_type('lmw_license', $args);
    }
}
