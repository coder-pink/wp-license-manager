
<?php

class LMW_WC_Hooks {
    public function __construct() {
        add_action('woocommerce_order_status_changed', [$this, 'handle_license_delivery'], 20, 4);
    }

    public function handle_license_delivery($order_id, $from_status, $to_status, $order) {
        $delivery_map = get_option('lmw_license_delivery_map', []);
        if (!isset($delivery_map['wc-' . $to_status])) {
            return;
        }

        // TODO: license email/send logic
        error_log("License delivery triggered for Order #$order_id → $to_status");
    }
}
