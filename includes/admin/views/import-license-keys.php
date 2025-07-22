<div class="wrap">
    <h1><?php esc_html_e('Add License Keys in Bulk', 'license-manager-woocommerce'); ?></h1>

    <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('lmw_import_nonce'); ?>
        <input type="hidden" name="action" value="lmw_import_keys" />

        <table class="form-table">
            <tr>
                <th scope="row"><?php esc_html_e('Source', 'license-manager-woocommerce'); ?></th>
                <td>
                    <label><input type="radio" name="lmw_source" value="file" checked> File Upload</label>
                    <label><input type="radio" name="lmw_source" value="clipboard"> Clipboard</label>
                </td>
            </tr>

            <tr>
                <th><?php esc_html_e('File (CSV or TXT)', 'license-manager-woocommerce'); ?></th>
                <td><input type="file" name="lmw_file" /></td>
            </tr>

            <tr>
                <th><?php esc_html_e('Clipboard Text', 'license-manager-woocommerce'); ?></th>
                <td><textarea name="lmw_clipboard_keys" rows="5" cols="50"></textarea></td>
            </tr>

            <tr>
                <th><?php esc_html_e('Valid For (Days)', 'license-manager-woocommerce'); ?></th>
                <td><input type="number" name="lmw_valid_days" min="1" value="365" /></td>
            </tr>

            <tr>
                <th><?php esc_html_e('Maximum Activation Count', 'license-manager-woocommerce'); ?></th>
                <td><input type="number" name="lmw_max_activations" min="1" value="1" /></td>
            </tr>

            <tr>
                <th><?php esc_html_e('Status', 'license-manager-woocommerce'); ?></th>
                <td>
                    <select name="lmw_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </td>
            </tr>


            <tr>
                <th><?php _e('Select Product', 'license-manager-woocommerce'); ?></th>
                <td>
                    <select name="lmw_product_id" class="lmw-select2" style="width: 100%;">
                        <option value=""><?php _e('Select a Product', 'license-manager-woocommerce'); ?></option>
                        <?php
                        $products = wc_get_products(['limit' => -1]);
                        foreach ($products as $product) {
                            echo '<option value="' . esc_attr($product->get_id()) . '">' . esc_html($product->get_name()) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php esc_html_e('Order', 'license-manager-woocommerce'); ?></th>
                <td><input type="number" name="lmw_order" /></td>
            </tr>

            <tr>
                <th><?php esc_html_e('Customer (User ID)', 'license-manager-woocommerce'); ?></th>
                <td><input type="number" name="lmw_customer" /></td>
            </tr>
        </table>

        <p><input type="submit" class="button button-primary" value="<?php esc_attr_e('Import License Keys', 'license-manager-woocommerce'); ?>"></p>
    </form>
</div>
