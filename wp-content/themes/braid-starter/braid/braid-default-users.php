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


// $all_users = array_merge($braid_users, $bbm_users, $ds_users);
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

    // edit user to be admin.
}

    
?>