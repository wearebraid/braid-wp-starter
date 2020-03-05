<?php

$braid_users = [
    [
        'user_name' => 'Braid_Luan',
        'user_email' => 'luan@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_Andrew',
        'user_email' => 'andrew@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_Chris',
        'user_email' => 'chris@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_CGeelhoed',
        'user_email' => 'cgeelhoed@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_Justin',
        'user_email' => 'justin@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_Ellinger',
        'user_email' => 'cellinger@wearebraid.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'Braid_Sasha',
        'user_email' => 'sasha@wearebraid.com',
        'role' => 'administrator'
    ],
];

// you can merge users from multiple teams if this is a group project
// $all_users = array_merge($default_users, $other_users, $even_more_users);
$all_users = $braid_users;

foreach($all_users as $user) {
    $user_id = username_exists( $user['user_name'] );
    if ( !$user_id and email_exists( $user['user_email'] ) == false ) {
        $random_password = wp_generate_password( $length=16, $include_standard_special_chars=false );
        $user_id = wp_create_user( $user['user_name'], $random_password, $user['user_email'] );

        // make user admin
        wp_update_user([
            'ID' => $user_id,
            'role' => $user['role']
        ]);

    } else {
        $random_password = __('User already exists.  Password inherited.');
    }
}
