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
        'Site Notes and Support',         // Title.
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
        <p>
          Hello! Here are some notes for maintaining this website.
          If you have any extra questions,
          please email <a href="mailto:luan@wearebraid.com">luan@wearebraid.com</a>,
          the theme author.
        </p>
    <?php
}



?>