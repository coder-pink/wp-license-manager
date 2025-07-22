<?php

class LMW_Loader {
    public function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(__FILE__) . 'admin/class-lmw-admin-settings.php';
        require_once plugin_dir_path(__FILE__) . 'admin/class-lmw-admin-ui.php';
        require_once plugin_dir_path(__FILE__) . 'admin/class-lmw-admin-bulk-import.php';
        require_once plugin_dir_path(__FILE__) . 'admin/class-lmw-admin-export.php';
        require_once plugin_dir_path(__FILE__) . 'core/class-lmw-license-storage.php';
        // require_once plugin_dir_path(__FILE__) . 'core/class-lmw-license.php';


        require_once plugin_dir_path(__FILE__) . 'integrations/class-lmw-wc-hooks.php';
    }

    private function init_hooks() {
        if (is_admin()) {
            new LMW_Admin_Settings();
            new LMW_Admin_UI();
            new LMW_Admin_Bulk_Import();
            new LMW_Admin_Export();
            new LMW_License_Storage();
            // new LMW_License();
        }
        new LMW_WC_Hooks();
    }
}
