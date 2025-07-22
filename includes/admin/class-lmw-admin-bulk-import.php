<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class LMW_Admin_Bulk_Import {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_bulk_import_menu']);
        add_action('admin_post_lmw_import_keys', [$this, 'handle_bulk_import']);
    }

    public function register_bulk_import_menu() {
        add_submenu_page(
            'license-manager',
            __('Bulk License Import', 'license-manager-woocommerce'),
            __('Bulk Import', 'license-manager-woocommerce'),
            'manage_woocommerce',
            'lmw-bulk-import',
            [$this, 'render_import_page']
        );
    }

    public function render_import_page() {
        include_once plugin_dir_path(__FILE__) . 'views/import-license-keys.php';
    }

    public function handle_bulk_import() {
        if (!current_user_can('manage_woocommerce') || !check_admin_referer('lmw_import_nonce')) {
            wp_die(__('Unauthorized.', 'license-manager-woocommerce'));
        }

        $source_type = $_POST['lmw_source'] ?? 'file';
        $license_text = '';

        if ($source_type === 'clipboard') {
            $license_text = sanitize_textarea_field($_POST['lmw_clipboard_keys'] ?? '');
        } elseif (!empty($_FILES['lmw_file']['tmp_name'])) {
            $license_text = file_get_contents($_FILES['lmw_file']['tmp_name']);
        }

        if (empty($license_text)) {
            wp_redirect(add_query_arg(['error' => 'no_input'], admin_url('admin.php?page=lmw-bulk-import')));
            exit;
        }

        $license_keys = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $license_text)));

        require_once plugin_dir_path(__DIR__) . 'core/class-lmw-license-storage.php';
        $inserted = LMW_License_Storage::bulk_insert($license_keys, [
            'valid_days' => absint($_POST['lmw_valid_days']),
            'max_uses'   => absint($_POST['lmw_max_activations']),
            'status'     => sanitize_text_field($_POST['lmw_status']),
            'product_id' => absint($_POST['lmw_product']),
            'order_id'   => absint($_POST['lmw_order']),
            'user_id'    => absint($_POST['lmw_customer']),
        ]);

        wp_redirect(add_query_arg(['imported' => count($inserted)], admin_url('admin.php?page=lmw-bulk-import')));
        exit;
    }
}
