<?php

// add_action( 'rest_api_init', function (){
//     register_rest_route('custom/v1', '/post-type', [
//         'methods' => 'GET',
//         'permission_callback' => '__return_true',
//         'callback' => 'custom_rest_get_post_type__listing'
//     ]);
//     register_rest_route('custom/v1', '/post-type/(?P<program>[a-zA-Z0-9-]+)', [
//         'methods' => 'GET',
//         'permission_callback' => '__return_true',
//         'callback' => 'custom_rest_get_post_type__single'
//     ]);
// });

add_filter('rest_endpoints', function($endpoints) {
    $endpointsToRemove = [
        '/wp/v2/users',
        '/wp/v2/users/(?P<id>[\d]+)'
    ];
    foreach ($endpointsToRemove as $endpoint) {
        if ( isset( $endpoints[$endpoint] ) ) {
            unset( $endpoints[$endpoint] );
        }
    }
    return $endpoints;
});
