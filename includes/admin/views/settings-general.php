<?php
$order_statuses = wc_get_order_statuses();
$saved_map = get_option('lmw_license_delivery_map', []);
?>

<div class="lmw-container">
    <h1 class="lmw-heading"><?php _e('License Key Delivery', 'license-manager-woocommerce'); ?></h1>

    <form method="post" action="options.php">
        <?php settings_fields('lmw_settings_group'); ?>
        <?php do_settings_sections('lmw_settings_group'); ?>

        <label class="lmw-switch">
            <input type="checkbox" name="lmw_license_delivery_enabled" value="yes" <?php checked('yes', get_option('lmw_license_delivery_enabled', 'yes')); ?>>
            <strong><?php _e('Automatically send license keys when an order is set to \'complete\'', 'license-manager-woocommerce'); ?></strong>
        </label>

        <h3 class="lmw-section-title"><?php _e('Define License Key Delivery', 'license-manager-woocommerce'); ?></h3>
        <table class="lmw-settings-table">
            <thead>
                <tr>
                    <th><?php _e('Order Status', 'license-manager-woocommerce'); ?></th>
                    <th><?php _e('Send', 'license-manager-woocommerce'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_statuses as $status_key => $status_label) : ?>
                    <tr>
                        <td><?php echo esc_html($status_label); ?></td>
                        <td>
                            <input class="lmw-checkbox" type="checkbox"
                                   name="lmw_license_delivery_map[<?php echo esc_attr($status_key); ?>]"
                                   value="1"
                                   <?php checked(isset($saved_map[$status_key])); ?>>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" class="lmw-save-button"><?php _e('Save Settings', 'license-manager-woocommerce'); ?></button>
    </form>
</div>
