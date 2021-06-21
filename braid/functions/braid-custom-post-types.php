<?php

/**
 * Register Custom Post Types
 */

function theme_custom_post_types() {
	$custom_post_types = array(
		// 'team_member' => array(
		// 	'singular'  => 'Team Member',
		// 	'plural'    => 'Team Members',
		// 	'menu_icon' => 'dashicons-groups',
		// 	'overrides' => array(),
		// 	'labels'    => array(),
		// ),
	);

	$taxonomies = array(
		// 'team-category' => array(
		// 	'post_types' => array( 'team_member' ),
		// 	'singular'   => 'Category',
		// 	'plural'     => 'Categories',
		// 	'overrides'  => array(
		// 		'hierarchical' => true,
		// 	),
		// 	'labels'     => array(),
		// ),
	);

	foreach ( $custom_post_types as $pt => $data ) {
		braid_create_post_types( $pt, $data );
	}
	foreach ( $taxonomies as $tax => $data ) {
		braid_create_taxonomy( $tax, $data );
	}
}

/**
 * HELPER FUNCTIONS FOR CREATE CUSTOM POST TYPES BELOW
 */
// @codingStandardsIgnoreStart
function braid_create_post_types( $post_type, $data, $enable_capabilities = false ) {
	$labels = array(
		'name'                  => __($data['plural'], 'cmstarter' ),
		'singular_name'         => __($data['singular'], 'cmstarter'),
		'menu_name'             => __($data['plural'], 'cmstarter'),
		'name_admin_bar'        => __($data['plural'], 'cmstarter'),
		'archives'              => __(sprintf('%s Archives', $data['singular']), 'cmstarter'),
		'attributes'            => __(sprintf('%s Attributes', $data['singular']), 'cmstarter'),
		'parent_item_colon'     => __(sprintf('Parent %s', $data['singular']), 'cmstarter'),
		'all_items'             => __(sprintf('All %s', $data['plural']), 'cmstarter'),
		'add_new_item'          => __(sprintf('Add New %s', $data['singular']), 'cmstarter'),
		'add_new'               => __('Add New', 'cmstarter'),
		'new_item'              => __(sprintf('New %s', $data['singular']), 'cmstarter'),
		'edit_item'             => __(sprintf('Edit %s', $data['singular']), 'cmstarter'),
		'update_item'           => __(sprintf('Update %s', $data['singular']), 'cmstarter'),
		'view_item'             => __(sprintf('View %s', $data['singular']), 'cmstarter'),
		'view_items'            => __(sprintf('View %s', $data['plural']), 'cmstarter'),
		'search_items'          => __(sprintf('Search %s', $data['singular']), 'cmstarter'),
		'not_found'             => __('Not found', 'cmstarter'),
		'not_found_in_trash'    => __('Not found in Trash', 'cmstarter'),
		'featured_image'        => __('Featured Image', 'cmstarter'),
		'set_featured_image'    => __('Set featured image', 'cmstarter'),
		'remove_featured_image' => __('Remove featured image', 'cmstarter'),
		'use_featured_image'    => __('Use as featured image', 'cmstarter'),
		'insert_into_item'      => __(sprintf('Insert into %s', $data['singular']), 'cmstarter'),
		'uploaded_to_this_item' => __(sprintf('Uploaded to this %s', $data['singular']), 'cmstarter'),
		'items_list'            => __(sprintf('%s list', $data['plural']), 'cmstarter'),
		'items_list_navigation' => __(sprintf('%s list navigation', $data['plural']), 'cmstarter'),
		'filter_items_list'     => __(sprintf('Filter %s list', $data['plural']), 'cmstarter'),
	);

	if (isset($data['labels']) && !empty($data['labels'])) {
		$labels = array_merge($labels, $data['labels']);
	}

	$capability_type = strtolower($data['singular']);

	$args = array(
		'label'               => __($data['singular'], 'cmstarter'),
		'description'         => __(sprintf('%s Description', $data['singular']), 'cmstarter'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'           => isset($data['menu_icon']) ? $data['menu_icon'] : 'dashicons-admin-generic'
	);

	if ($enable_capabilities) {
		$args['map_meta_cap'] = true;
		$args['capabilities'] = [
			"edit_post"              => "edit_{$capability_type}",
			"read_post"              => "read_{$capability_type}",
			"delete_post"            => "delete_{$capability_type}",

			// Primitive capabilities used outside of map_meta_cap():
			"edit_posts"             => "edit_{$capability_type}s",
			"edit_others_posts"      => "edit_others_{$capability_type}s",
			"publish_posts"          => "publish_{$capability_type}s",
			"read_private_posts"     => "read_private_{$capability_type}s",

			// Primitive capabilities used within map_meta_cap():
			"read"                   => "read",
			"delete_posts"           => "delete_{$capability_type}s",
			"delete_private_posts"   => "delete_private_{$capability_type}s",
			"delete_published_posts" => "delete_published_{$capability_type}s",
			"delete_others_posts"    => "delete_others_{$capability_type}s",
			"edit_private_posts"     => "edit_private_{$capability_type}s",
			"edit_published_posts"   => "edit_published_{$capability_type}s",
			"create_posts"           => "edit_{$capability_type}s",
		];
	}

	if (isset($data['overrides']) && !empty($data['overrides'])) {
		$args = array_merge($args, $data['overrides']);
	}

	register_post_type($post_type, $args);
}

function braid_create_taxonomy($taxonomy, $data)
{
	$labels = array(
		'name'                       => _x($data['plural'], 'cmstarter'),
		'singular_name'              => _x($data['singular'], 'cmstarter'),
		'menu_name'                  => __($data['plural'], 'cmstarter'),
		'all_items'                  => __(sprintf('All %s', $data['plural']), 'cmstarter'),
		'parent_item'                => __(sprintf('Parent %s', $data['singular']), 'cmstarter'),
		'parent_item_colon'          => __(sprintf('Parent %s:', $data['singular']), 'cmstarter'),
		'new_item_name'              => __(sprintf('New %s Name', $data['singular']), 'cmstarter'),
		'add_new_item'               => __(sprintf('Add New %s', $data['singular']), 'cmstarter'),
		'edit_item'                  => __(sprintf('Edit %s', $data['singular']), 'cmstarter'),
		'update_item'                => __(sprintf('Update %s', $data['singular']), 'cmstarter'),
		'view_item'                  => __(sprintf('View %s', $data['singular']), 'cmstarter'),
		'separate_items_with_commas' => __(sprintf('Separate %s with commas', $data['plural']), 'cmstarter'),
		'add_or_remove_items'        => __(sprintf('Add or remove %s', $data['plural']), 'cmstarter'),
		'choose_from_most_used'      => __('Choose from the most used', 'cmstarter'),
		'popular_items'              => __(sprintf('Popular %s', $data['plural']), 'cmstarter'),
		'search_items'               => __(sprintf('Search %s', $data['plural']), 'cmstarter'),
		'not_found'                  => __('Not Found', 'cmstarter'),
		'no_terms'                   => __(sprintf('No %s', $data['plural']), 'cmstarter'),
		'items_list'                 => __(sprintf('%s list', $data['singular']), 'cmstarter'),
		'items_list_navigation'      => __(sprintf('%s list navigation', $data['plural']), 'cmstarter'),
	);
	if (isset($data['labels']) && !empty($data['labels'])) {
		$labels = array_merge($labels, $data['labels']);
	}
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
	);
	if (isset($data['overrides']) && !empty($data['overrides'])) {
		$args = array_merge($args, $data['overrides']);
	}
	register_taxonomy($taxonomy, $data['post_types'], $args);
}
add_action('init', 'theme_custom_post_types');
// @codingStandardsIgnoreEnd
