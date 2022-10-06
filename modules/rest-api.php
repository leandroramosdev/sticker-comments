<?php 

if (!defined('ABSPATH')) {
    exit;
}

require_once 'endpoints/stickers/stickers.php';

add_action('rest_api_init', function () {
    register_rest_route('sc/v1', '/save_stickers', array(
        'methods' => 'POST',
        'callback' => 'rest_endpoint_save_stickers'
    ));
    
    register_rest_route('sc/v1', '/get_stickers', array(
        'methods' => 'GET',
        'callback' => 'rest_endpoint_get_stickers'
    ));

    register_rest_route('sc/v1', '/find_users', array(
        'methods' => 'POST',
        'callback' => 'rest_endpoint_find_users'
    ));

    
});

