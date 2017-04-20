<?php 

// ---
// Add options page
// ---
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}



// ---
// Programatically Register Common Fields we use for every build
// ---

if( function_exists('acf_add_local_field_group') ):
    // tabbed structure
    acf_add_local_field_group([
        'key' => 'site_tabbed_options',
	    'title' => 'Site Options',
        'fields' => [
            // ---
            // Social Media Tab
            // ---
            [
                'key' => 'cm_tab_1',
                'label' => 'Social Media',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ],
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
            ],
            // ---
            // Organization Info Tab
            // ---
            [
                'key' => 'cm_tab_2',
                'label' => 'Org/Contact Info',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ],
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
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);

endif;


?>