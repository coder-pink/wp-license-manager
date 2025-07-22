<?php
if (!defined('ABSPATH')) exit;

class LMW_Admin_Export {

    public function __construct() {
        add_action('admin_menu', [$this, 'add_export_submenu']);
        add_action('admin_post_lmw_export_keys', [$this, 'process_export']);
    }

    public function add_export_submenu() {
        add_submenu_page(
            'license-manager',
            __('Export License Keys', 'license-manager-woocommerce'),
            __('Export', 'license-manager-woocommerce'),
            'manage_woocommerce',
            'lmw-export-keys',
            [$this, 'render_export_form']
        );
    }

    public function render_export_form() {
        include plugin_dir_path(__FILE__) . 'views/export-license-keys.php';
    }

    public function process_export() {
        if (!current_user_can('manage_woocommerce') || !check_admin_referer('lmw_export_nonce')) {
            wp_die(__('Unauthorized access', 'license-manager-woocommerce'));
        }

        $format = sanitize_text_field($_POST['export_format'] ?? 'csv');
        $args = [
            'post_type'   => 'lmw_license',
            'post_status' => 'publish',
            'numberposts' => -1,
        ];

        if (!empty($_POST['export_status'])) {
            $args['meta_query'][] = [
                'key'   => '_lmw_status',
                'value' => sanitize_text_field($_POST['export_status']),
            ];
        }

        $licenses = get_posts($args);
        if ($format === 'pdf') {
            self::export_pdf($licenses);
        } else {
            self::export_csv($licenses);
        }
        exit;
    }

    private static function export_csv($licenses) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="license-keys.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['License Key', 'Status', 'Product ID', 'Order ID', 'User ID']);

        foreach ($licenses as $license) {
            fputcsv($output, [
                $license->post_title,
                get_post_meta($license->ID, '_lmw_status', true),
                get_post_meta($license->ID, '_lmw_product_id', true),
                get_post_meta($license->ID, '_lmw_order_id', true),
                get_post_meta($license->ID, '_lmw_user_id', true),
            ]);
        }
        fclose($output);
    }

    private static function export_pdf($licenses) {
        require_once plugin_dir_path(__FILE__) . '../../vendor/autoload.php';

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', '', 10);

        $html = '<h2>Exported License Keys</h2><table border="1" cellpadding="4"><tr><th>License Key</th><th>Status</th><th>Product</th><th>Order</th><th>User</th></tr>';

        foreach ($licenses as $license) {
            $html .= '<tr>';
            $html .= '<td>' . esc_html($license->post_title) . '</td>';
            $html .= '<td>' . esc_html(get_post_meta($license->ID, '_lmw_status', true)) . '</td>';
            $html .= '<td>' . esc_html(get_post_meta($license->ID, '_lmw_product_id', true)) . '</td>';
            $html .= '<td>' . esc_html(get_post_meta($license->ID, '_lmw_order_id', true)) . '</td>';
            $html .= '<td>' . esc_html(get_post_meta($license->ID, '_lmw_user_id', true)) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $pdf->writeHTML($html);
        $pdf->Output('license-keys.pdf', 'D');
    }
}
