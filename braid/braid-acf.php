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
                'key' => 'braid_tab_1',
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
                'key' => 'braid_tab_2',
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

/**
 * Styles ACF Flexible Content to be more user friendly
 */
function my_acf_admin_head()
{
    ?>
    <style type="text/css">

        .acf-flexible-content .layout .acf-fc-layout-handle {
            /*background-color: #00B8E4;*/
            background-color: #202428;
            color: #eee;
        }

        .acf-flexible-content .acf-flexible-content .acf-fc-layout-handle {
            background-color: #6d6a69;
        }

        .acf-repeater.-row > table > tbody > tr > td,
        .acf-repeater.-block > table > tbody > tr > td {
            border-top: 2px solid #202428;
        }

        .acf-repeater .acf-row-handle {
            vertical-align: top !important;
            padding-top: 16px;
        }

        .acf-repeater .acf-row-handle span {
            font-size: 20px;
            font-weight: bold;
            color: #202428;
        }

        .imageUpload img {
            width: 75px;
        }

        .acf-repeater .acf-row-handle .acf-icon.-minus {
            top: 30px;
        }

        .braid-flex-thumb {
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 160px;
            position: absolute;
            right: 90px;
            top: -10px;
            bottom: -10px;
            border: 1px solid black;
        }

        .braid-flex-title {
            display: inline-block;
            vertical-align: middle;
            margin: 7px;
        }

    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');
