<div class="wrap">
    <h1><?php esc_html_e('Export License Keys', 'license-manager-woocommerce'); ?></h1>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('lmw_export_nonce'); ?>
        <input type="hidden" name="action" value="lmw_export_keys" />

        <table class="form-table">
            <tr>
                <th><?php esc_html_e('License Status', 'license-manager-woocommerce'); ?></th>
                <td>
                    <select name="export_status">
                        <option value=""><?php esc_html_e('All', 'license-manager-woocommerce'); ?></option>
                        <option value="active"><?php esc_html_e('Active', 'license-manager-woocommerce'); ?></option>
                        <option value="inactive"><?php esc_html_e('Inactive', 'license-manager-woocommerce'); ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <th><?php esc_html_e('Export Format', 'license-manager-woocommerce'); ?></th>
                <td>
                    <select name="export_format">
                        <option value="csv"><?php esc_html_e('CSV', 'license-manager-woocommerce'); ?></option>
                        <option value="pdf"><?php esc_html_e('PDF', 'license-manager-woocommerce'); ?></option>
                    </select>
                </td>
            </tr>
        </table>

        <p><input type="submit" class="button button-primary" value="<?php esc_attr_e('Export Now', 'license-manager-woocommerce'); ?>"></p>
    </form>
</div>
