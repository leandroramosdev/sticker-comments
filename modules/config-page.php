<?php

if (!class_exists('SCConfigPage')) {
    class SCConfigPage
    {
        public function __construct()
        {
            add_action('admin_menu', array($this, 'add_admin_menu'));
        }

        public function add_admin_menu()
        {
            add_menu_page(
                'Sticker Comments - Config Page',
                'Sticker Comments',
                'manage_options',
                'sticker_comments',
                array($this, 'create_config_page'),
                'dashicons-smiley',
                25
            );
        }

        /**
         *
         * Prints the plugin settings page.
         */
        public function create_config_page()
        {

            $this->options = get_option('mc_customizer_settings');

            ?>
            <div class="wrap">
                <h1>Sticker Comments - Config Page</h1>
                <?php require_once 'views/config.php';  ?>
            </div>
            <?php
        }
    }

    $sc_config_page = new SCConfigPage();
}
