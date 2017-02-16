<?php 

// ---
// WP Admin Customizations
// ---



// remove comments tab in admin since it wont' be needed
function remove_menus(){
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_menus' );



// Ability to upload SVGs and .VCF to Media
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['vcf'] = 'text/x-vcard';

  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



// add custom widget to dashboard
function cm_add_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;

	wp_add_dashboard_widget(
        'cm_dashboard_widget',         // Widget slug.
        'Site Maintenance Notes',         // Title.
        'cm_dash_maintenance_notes' // Display function.
    );
	
	// Get the regular dashboard widgets array 
	// (which has our new widget already but at the end)
	$dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashbaord widget from the end of the array
	$widget_backup = ['cm_dashboard_widget' => $dashboard['cm_dashboard_widget']];
	unset($dashboard['cm_dashboard_widget']);

	// Merge the two arrays together so our widget is at the beginning
	$sorted_dashboard = array_merge($widget_backup, $dashboard);

	// Save the sorted array back into the original metaboxes 
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

add_action( 'wp_dashboard_setup', 'cm_add_dashboard_widgets' );

// the function to output the contents of our Dashboard Widget.
function cm_dash_maintenance_notes() {
	// Display whatever it is you want to show.
	?> 
        <p>Hello!</p>
    <?php
}




// update core minor and major, but not development (bleeding edge)
add_filter( 'allow_dev_auto_core_updates', '__return_false' );  // Enable development updates 
add_filter( 'allow_minor_auto_core_updates', '__return_true' ); // Enable minor updates
add_filter( 'allow_major_auto_core_updates', '__return_true' ); // Enable major updates



// update these plugins automatically -- they are from reputable authors
function auto_update_specific_plugins ( $update, $item ) {
    // Array of plugin slugs to always auto-update
    $plugins = array ( 
        'advanced-custom-fields-pro',
        'gravityforms',
        'gravityformsmailchimp',
        'regenerate-thumbnails',
        'sucuri-scanner',
        'updraftplus',
        'wordpress-seo',
        'wordpress-seo-premium',
        'wp-migrate-db-pro',
        'wp-migrate-db-pro-media-files',
        'akismet'
    );
    if ( in_array( $item->slug, $plugins ) ) {
        return true; // Always update plugins in this array
    } else {
        return $update; // Else, use the normal API response to decide whether to update or not
    }
}
add_filter( 'auto_update_plugin', 'auto_update_specific_plugins', 10, 2 );

?>