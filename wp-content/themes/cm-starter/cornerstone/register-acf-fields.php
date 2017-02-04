<?php 
// ---
// Programatically Register Common Fields we use for every build
// ---


if( function_exists('acf_add_local_field_group') ):
    // Social Media Fields
    acf_add_local_field_group(array(
        'key' => 'social_group',
        'title' => 'Social URLs',
        'fields' => [
            [
                'key' => 'field_linkedin',
                'label' => 'LinkedIn',
                'name' => 'linkedin',
                'type' => 'url',
            ],
            [
                'key' => 'field_facebook',
                'label' => 'Facebook',
                'name' => 'facebook',
                'type' => 'url',
            ],
            [
                'key' => 'field_youtube',
                'label' => 'YouTube',
                'name' => 'youtube',
                'type' => 'url',
            ],
            [
                'key' => 'field_twitter',
                'label' => 'Twitter',
                'name' => 'twitter',
                'type' => 'url',
            ],
            [
                'key' => 'field_pinterest',
                'label' => 'Pinterest',
                'name' => 'pinterest',
                'type' => 'url',
            ],
            [
                'key' => 'field_instagram',
                'label' => 'Instagram',
                'name' => 'instagram',
                'type' => 'url',
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                ],
            ],
        ],
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => 'Social Media URLs',
    ));

    // Organization Information
    acf_add_local_field_group(array(
        'key' => 'organization_group',
        'title' => 'Organization Information',
        'fields' => [
            [
                'key' => 'field_address',
                'label' => 'Address',
                'name' => 'address',
                'type' => 'text',
            ],
            [
                'key' => 'field_phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
            ],
            [
                'key' => 'field_fax',
                'label' => 'Fax',
                'name' => 'fax',
                'type' => 'text',
            ],
            [
                'key' => 'field_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => 'Organization details',
    ));
endif;

?>