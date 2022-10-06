<?php

if (!defined('ABSPATH')) {
    exit;
} 

if (!function_exists('rest_endpoint_get_stickers')) {
    function rest_endpoint_get_stickers(WP_REST_Request $request){
        $data = get_option('stickers_list') ? get_option('stickers_list') : [];
        $response = rest_ensure_response($data);

        return $response;
    }
}

if (!function_exists('rest_endpoint_save_stickers')) {
    function rest_endpoint_save_stickers(WP_REST_Request $request){
        $params = $request->get_params();
        $stickers = $params['stickers'];
        $categories_removed = $params['categories_removed'];
        $site_url = get_site_url();
        
        $result = [];
        if(isset($stickers) &&  is_array($stickers)){
            foreach($stickers as $id => $url) {
                $result[$id] = str_replace($site_url, '', $url);
            }

            update_option('stickers_list', $result);
        }

        if(isset($categories_removed) &&  is_array($categories_removed)){
            update_option('categories_removed', $categories_removed);
        }

        return rest_ensure_response([
            'message' => 'Save with success!'
        ]);
    }
}

if (!function_exists('rest_endpoint_find_users')) {
    function rest_endpoint_find_users(WP_REST_Request $request){
        global $wpdb;
        $params = $request->get_params();
        $term = $params['term'];
        $results = [];

        $sql = "SELECT * FROM wp_users as user WHERE user.user_email LIKE '%$term%'";
        $users = $wpdb->get_results($sql, ARRAY_A);

        foreach($users as $user) {
            $results[] = [
                'name'   => $user['user_login'],
                'email'  => $user['user_email'],
                'slug'   => $user['user_nicename'],
                'avatar' => get_avatar_url($user['ID'], ['size' => 120])
            ];
        }
        
        return rest_ensure_response($results);
    }
}