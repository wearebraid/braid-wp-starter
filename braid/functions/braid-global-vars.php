<?php

// ---
// Global Variables For Use Theme-wide
// ---

// use within templates by calling "global $uploads"
$uploads  = wp_upload_dir()['baseurl'];
$root     = get_template_directory_uri();
$img_root = $root . '/lib/img';

if ( class_exists( 'acf' ) ) {
	$gen_phone             = get_field( 'phone', 'option' );
	$gen_phone_href        = 'tel:' . str_replace( array( '-', '.', '(', ')' ), '', $gen_phone );
	$gen_fax               = get_field( 'fax', 'option' );
	$gen_fax_href          = 'fax:' . str_replace( array( '-', '.' ), '', $gen_fax );
	$gen_email             = get_field( 'email', 'option' );
	$gen_address           = get_field( 'address', 'option' );
	$address_google_format = 'https://maps.google.com/?daddr=' . str_replace( array( ', ', ' ' ), '+', $gen_address );
}
