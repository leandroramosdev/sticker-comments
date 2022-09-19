<?php 
/*
 * Plugin Name: Sticker Comments
 * Version: 1.0.0
 * Description: Add stickers figures in native comments from wordpress
 * Author: Leandro Ramos
 * Author URI: https://github.com/leandroramosdev
 *
 */

if (!defined('ABSPATH')) {
    exit;
}

if(!class_exists('StickerComments')){
    class StickerComments {
        
        /**
		 * class constructor.
		 */
		public function __construct() {
			add_action('wp_enqueue_scripts', array($this, 'scripts_front'));
            add_action('admin_enqueue_scripts', array( $this , 'scripts_admin' ) );
            $this->modules();
		}

        public function scripts_front(){
            wp_enqueue_script('jquery');

            wp_register_script('emojionarea', plugin_dir_url( __FILE__ ). 'assets/js/emojionearea.js' , false, null, true);
            wp_enqueue_script('emojionarea');

            $stickers = get_option('stickers_list') ? get_option('stickers_list') : [];
            $categories_removed = get_option('categories_removed') ? get_option('categories_removed') : [];
            $users = $this->get_users_by_email();

            $script_values = [
                'site_url' => get_site_url(), 
                'stickers' => $stickers,
                'categories_removed' => $categories_removed,
                'users' => $users
            ];
            wp_localize_script( 'emojionarea', 'script_values', $script_values);

            wp_register_script('sticker-comments', plugin_dir_url( __FILE__ ). 'assets/js/sticker-comments.js' , false, null, true);
            wp_enqueue_script('sticker-comments');

            wp_enqueue_style( 'emojionearea', plugin_dir_url( __FILE__ ). 'assets/css/emojionearea.css' );    
        }

        public function scripts_admin(){
            wp_register_script('config-page', plugin_dir_url( __FILE__ ). 'assets/js/config-page.js' , false, null, true);
            wp_enqueue_script('config-page');

            $stickers = get_option('stickers_list') ? get_option('stickers_list') : null;
            $categories_removed = get_option('categories_removed') ? get_option('categories_removed') : [];

            $script_values = ['stickers' => $stickers, 'categories_removed' => $categories_removed];
            wp_localize_script( 'config-page', 'script_values', $script_values);

            wp_enqueue_style( 'config-page', plugin_dir_url( __FILE__ ). 'assets/css/config-page.css' );    

            wp_enqueue_media();
            wp_enqueue_script( 'media-grid' );
            wp_enqueue_script( 'media' );
            
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }

        public function modules(){
            require_once 'modules/rest-api.php';
            require_once 'modules/config-page.php';
        }

        public function get_users_by_email(){
            $all_users = get_users();
            $users = [];

            foreach($all_users as $user){
                $users[$user->user_nicename] = $user->data->user_email;
            }

            return $users;
        }
    }

    $sticker_comments = new StickerComments();
}
?>