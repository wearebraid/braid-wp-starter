<?php
// Custom Braid functions.php stuff
// so we can easily plug into any WordPress Theme
// Make sure to require this file in functions.php...
// require get_template_directory() . '/braid/braid-functions.php';

require_once get_template_directory() . '/braid/functions/braid-setup.php';
require_once get_template_directory() . '/braid/functions/class-braidthemeclicommands.php';
require_once get_template_directory() . '/braid/functions/class-braidvite.php';

$modules = array(
	'acf', // Advanced Custom Fields Customizations
	'custom-post-types', // Register Custom Post Types
	'default-users', // Setup Default Users
	'enqueue', // Enqueue Scripts and Styles
	'environments', // Code for managing different deployment environments
	'extras', // Custom functions that act independently of the theme templates
	'global-vars', // Global Variables For Use Theme-wide
	'gravity-forms', // Gravity Forms Customizations
	'image-sizes', // Custom Image Sizes
	'performance', // Performance optimizations
	'search', // Include Post Meta in Search results
	'shortcodes', // Theme Shortcodes
	'template-tags', // Custom template tags for this theme
	'utilities', // General Utilities
	'rest', // Adds some basic REST API endpoints and remove users endpoint for security
	'wp-admin', // WP Admin Cleanup and Customizations
);

foreach ( $modules as $module ) {
	require_once get_template_directory() . "/braid/functions/braid-$module.php";
}
