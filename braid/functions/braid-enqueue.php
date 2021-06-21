<?php
// ---
// Enqueue styles and scripts
// ---

function braid_starter_scripts() {
	$site_data = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'jquery', 'siteData', $site_data );
}
add_action( 'wp_enqueue_scripts', 'braid_starter_scripts' );
