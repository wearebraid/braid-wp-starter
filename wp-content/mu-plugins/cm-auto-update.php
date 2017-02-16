<?php 
// ---
// WordPress Auto Updates
// ---



// update core minor and major, but not development (bleeding edge)
add_filter( 'allow_dev_auto_core_updates', '__return_false' );  // Enable development updates 
add_filter( 'allow_minor_auto_core_updates', '__return_true' ); // Enable minor updates
add_filter( 'allow_major_auto_core_updates', '__return_true' ); // Enable major updates

// To enable automatic updates even if a VCS folder (.git, .hg, .svn etc) was found in the WordPress directory
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );  



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