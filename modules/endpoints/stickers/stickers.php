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
        $site_url = get_site_url();
        
        $result = [];
        if(isset($stickers) &&  is_array($stickers)){
            foreach($stickers as $id => $url) {
                $result[$id] = str_replace($site_url, '', $url);
            }

            update_option('stickers_list', $result);
        }

        return rest_ensure_response([
            'message' => 'Save with success!'
        ]);
    }
}