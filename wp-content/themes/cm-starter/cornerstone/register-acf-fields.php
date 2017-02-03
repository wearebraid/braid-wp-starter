<?php 
// ---
// Programatically Register Common Fields we use for every build
// ---

// Social Media Fields
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'social_group',
        'title' => 'Social',
        'fields' => [
            [
                'key' => 'field_linkedin',
                'label' => 'LinkedIn',
                'name' => 'linkedin',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
            ],
            [
                'key' => 'field_facebook',
                'label' => 'Facebook',
                'name' => 'facebook',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
            ],
            [
                'key' => 'field_youtube',
                'label' => 'YoutTube',
                'name' => 'youtube',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
            ],
            [
                'key' => 'field_twitter',
                'label' => 'Twitter',
                'name' => 'twitter',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
            ],
            [
                'key' => 'field_pinterest',
                'label' => 'Pinterest',
                'name' => 'pinterest',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
            ],
            [
                'key' => 'field_instagram',
                'label' => 'Instagram',
                'name' => 'instagram',
                'type' => 'url',
                'required' => 0,
                'conditional_logic' => 0,
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
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => 'Social Media URLS',
    ));
endif;

?>