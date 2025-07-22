<div class="wrap">
    <h1><?php esc_html_e('All Licenses', 'license-manager-woocommerce'); ?></h1>
    <p>This will list all licenses here.</p>

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <th><?php esc_html_e('License Key', 'license-manager-woocommerce'); ?></th>
                <th><?php esc_html_e('Product ID', 'license-manager-woocommerce'); ?></th>
                <th><?php esc_html_e('Status', 'license-manager-woocommerce'); ?></th>
                <th><?php esc_html_e('Order ID', 'license-manager-woocommerce'); ?></th>
                <th><?php esc_html_e('User ID', 'license-manager-woocommerce'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $licenses = get_posts([
                'post_type'      => 'lmw_license',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ]);

            if (!empty($licenses)) {
                foreach ($licenses as $license) {
                    echo '<tr>';
                    echo '<td>' . esc_html($license->post_title) . '</td>';
                    echo '<td>' . esc_html(get_post_meta($license->ID, '_lmw_product_id', true)) . '</td>';
                    echo '<td>' . esc_html(get_post_meta($license->ID, '_lmw_status', true)) . '</td>';
                    echo '<td>' . esc_html(get_post_meta($license->ID, '_lmw_order_id', true)) . '</td>';
                    echo '<td>' . esc_html(get_post_meta($license->ID, '_lmw_user_id', true)) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">' . __('No licenses found.', 'license-manager-woocommerce') . '</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
