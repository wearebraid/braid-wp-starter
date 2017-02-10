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