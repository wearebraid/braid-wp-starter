<?php
// ---
// Register Custom Post Types

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'cmstarter_flush_rewrite_rules' );

// Flush your rewrite rules
function cmstarter_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_types() {
	/*==========  Register Team Member Post Type  ==========*/
	$custom_post_type = 'cm_team_member';
	register_post_type( $custom_post_type, /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels'              => array(
				'name'               => __( 'Team Members', 'cmstarter' ),
				'singular_name'      => __( 'Team Member', 'cmstarter' ),
				'all_items'          => __( 'All Team Members', 'cmstarter' ),
				'add_new'            => __( 'Add New', 'cmstarter' ),
				'add_new_item'       => __( 'Add New Team Member', 'cmstarter' ),
				'edit'               => __( 'Edit', 'cmstarter' ),
				'edit_item'          => __( 'Edit Team Member', 'cmstarter' ),
				'new_item'           => __( 'New Team Member', 'cmstarter' ),
				'view_item'          => __( 'View Team Member', 'cmstarter' ),
				'search_items'       => __( 'Search Team Members', 'cmstarter' ),
				'not_found'          => __( 'Nothing found in the Database.', 'cmstarter' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'cmstarter' ),
				'parent_item_colon'  => ''
			),
			'description'         => __( 'PillarAught Team Members', 'cmstarter' ),
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'query_var'           => true,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-groups',
			'rewrite'             => array( 'slug' => 'team-member', 'with_front' => false ),
			/* you can specify its url slug */
			'has_archive'         => false,
			/* you can rename the slug here */
			'capability_type'     => 'post',
			'hierarchical'        => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports'            => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'revisions',
				'sticky',
				'page-attributes'
			)
		) /* end of options */
	); /* end of register post type */

	// associate custom post type with WordPress built in "category" taxonomy
	register_taxonomy_for_object_type( 'category', $custom_post_type );

	// associate custom post type with WordPress built in "tag" taxonomy
	register_taxonomy_for_object_type( 'post_tag', $custom_post_type );

}


// adding the function to the WordPress init
add_action( 'init', 'custom_post_types');

?>