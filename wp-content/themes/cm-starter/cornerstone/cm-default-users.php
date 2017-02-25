<?php 

$cm_users = [
    [
        'user_name' => 'LuanCornerstone',
        'user_email' => 'luan@cornerstone.media',
        'role' => 'administrator'
    ]
];

$bbm_users = [
    [
        'user_name' => 'BBMAdmin',
        'user_email' => 'info@agencybbm.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'BBMAmanda',
        'user_email' => 'amanda@agencybbm.com',
        'role' => 'editor'
    ],
    [
        'user_name' => 'BBMNic',
        'user_email' => 'nic@agencybbm.com',
        'role' => 'editor'
    ],
    [
        'user_name' => 'BBMMatt',
        'user_email' => 'matt@agencybbm.com',
        'role' => 'editor'
    ],
    [
        'user_name' => 'BBMLauren',
        'user_email' => 'lauren@agencybbm.com',
        'role' => 'editor'
    ],
    [
        'user_name' => 'BBMAshleigh',
        'user_email' => 'ashleigh@agencybbm.com',
        'role' => 'editor'
    ],
];

$ds_users = [
    [
        'user_name' => 'DSAdmin',
        'user_email' => 'tanner@deuxsouth.com',
        'role' => 'administrator'
    ],
    [
        'user_name' => 'DSTori',
        'user_email' => 'tori@deuxsouth.com',
        'role' => 'editor'
    ],
    [
        'user_name' => 'DSRebecca',
        'user_email' => 'rebecca@deuxsouth.com',
        'role' => 'editor'
    ]
];


// $all_users = array_merge($cm_users, $bbm_users, $ds_users);
$all_users = $cm_users;

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

    // edit user to be admin.
}

    
?>