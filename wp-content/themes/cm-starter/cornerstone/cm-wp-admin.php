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

?>