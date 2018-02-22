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
function braid_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['vcf'] = 'text/x-vcard';

  return $mimes;
}
add_filter('upload_mimes', 'braid_mime_types');



// add custom widget to dashboard
function braid_add_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;

	wp_add_dashboard_widget(
        'braid_dashboard_widget',         // Widget slug.
        'Site Notes and Support',         // Title.
        'braid_dash_maintenance_notes' // Display function.
    );
	
	// Get the regular dashboard widgets array 
	// (which has our new widget already but at the end)
	$dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashbaord widget from the end of the array
	$widget_backup = ['braid_dashboard_widget' => $dashboard['braid_dashboard_widget']];
	unset($dashboard['braid_dashboard_widget']);

	// Merge the two arrays together so our widget is at the beginning
	$sorted_dashboard = array_merge($widget_backup, $dashboard);

	// Save the sorted array back into the original metaboxes 
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

add_action( 'wp_dashboard_setup', 'braid_add_dashboard_widgets' );

// the function to output the contents of our Dashboard Widget.
function braid_dash_maintenance_notes() {
	// Display whatever it is you want to show.
	?> 
        <p>
          Hello! Here are some notes for maintaining this website.
          If you have any extra questions,
          please email <a href="mailto:hello@wearebraid.com">hello@wearebraid.com</a>,
          the theme author.
        </p>
    <?php
}
