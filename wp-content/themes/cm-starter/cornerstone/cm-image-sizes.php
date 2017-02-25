<?php 
//---
// Custom Image Sizes
// ---

// custom image sizes
add_image_size('full-bleed', 2000, 9999, false);
add_image_size('container-width', 1400, 9999, false);
// 3 : 1 aspect ratio for hero images
add_image_size('3:1-large', 2100, 700, false);
// 1 : 1 aspect ratio
add_image_size('1:1-medium', 600, 600, false);



function cm_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'full-bleed' => __('2000px by auto-height'),
		'container-width' => __('1400px by auto-height'),
	) );
}

add_filter( 'image_size_names_choose', 'cm_custom_image_sizes' );

?>