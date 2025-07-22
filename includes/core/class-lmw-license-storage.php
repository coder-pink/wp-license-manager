<?php
if (!defined('ABSPATH')) {
    exit;
}

class LMW_License_Storage {

    public static function bulk_insert($keys, $meta = []) {
        $inserted = [];

        foreach ($keys as $key) {
            $post_id = wp_insert_post([
                'post_title'  => $key,
                'post_type'   => 'lmw_license',
                'post_status' => 'publish',
            ]);

            if ($post_id) {
                update_post_meta($post_id, '_lmw_valid_days', $meta['valid_days']);
                update_post_meta($post_id, '_lmw_max_activations', $meta['max_uses']);
                update_post_meta($post_id, '_lmw_status', $meta['status']);
                update_post_meta($post_id, '_lmw_product_id', $meta['product_id']);
                update_post_meta($post_id, '_lmw_order_id', $meta['order_id']);
                update_post_meta($post_id, '_lmw_user_id', $meta['user_id']);
                $inserted[] = $post_id;
            }
        }

        return $inserted;
    }
}
