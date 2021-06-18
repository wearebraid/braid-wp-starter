<?php
//---
// Custom Image Sizes
// ---

// custom image sizes
//add_image_size('full-bleed', 2000, 9999, false);
add_image_size('container-width', 1400, 9999, false);
add_image_size('mid-size', 750, 9999, false);
// 3 : 1 aspect ratio for hero images
// add_image_size('3:1-large', 2100, 700, false);
// 1 : 1 aspect ratio
// add_image_size('1:1-medium', 600, 600, false);

// remove default image thumbnail sizes in wordpress
// to prevent uploads folder from ballooning
function braid_remove_default_image_sizes( $sizes) {
    unset( $sizes['medium'] );
    unset( $sizes['medium_large'] );
    unset( $sizes['large'] );
    return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'braid_remove_default_image_sizes' );

// var_dump( get_intermediate_image_sizes() );


// Register Custom Image sizes so user can select from them within the content editor
function braid_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		// 'full-bleed' => __('2000px by auto-height'),
		'container-width' => __('1400px by auto-height'),
		'mid-size' => __('900px by auto-height'),
	) );
}

add_filter( 'image_size_names_choose', 'braid_custom_image_sizes' );

