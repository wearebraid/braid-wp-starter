<?php 
    // Custom Cornerstone Media functions.php stuff
    // so we can easily plug into any WordPress Theme
    // Make sure to require this file in functions.php...
        // require get_template_directory() . '/braid/braid-functions.php';


// Global Variables For Use Theme-wide
require_once(get_template_directory() . '/braid/braid-global-vars.php');

// Advanced Custom Fields Customizations
require_once(get_template_directory() . '/braid/braid-acf.php');

// Performance
require_once(get_template_directory() . '/braid/braid-performance.php');

// WP Admin Cleanup and Customizations
require_once(get_template_directory() . '/braid/braid-wp-admin.php');

// Enqueue Scripts and Styles
require_once(get_template_directory() . '/braid/braid-enqueue.php');

// Custom Image Sizes
require_once(get_template_directory() . '/braid/braid-image-sizes.php');

// Gravity Forms Customizations
require_once(get_template_directory() . '/braid/braid-gravity-forms.php');

// General Utilities
require_once(get_template_directory() . '/braid/braid-utilities.php');

// Theme Shortcodes
require_once(get_template_directory() . '/braid/braid-shortcodes.php');

// Footer Modifications
require_once(get_template_directory() . '/braid/braid-footer.php');

// Header Modifications
require_once(get_template_directory() . '/braid/braid-header.php');

// Register Custom Post Types
require_once(get_template_directory() . '/braid/braid-custom-post-types.php');

// Setup Default Users
require_once(get_template_directory() . '/braid/braid-default-users.php');

// Include Post Meta in Search results
require_once(get_template_directory() . '/braid/braid-search.php');

// Adds Braid WP CLI commands for extended functionality
require_once(get_template_directory() . '/braid/braid-cli.php');

// Code for managing different deployment environments
require_once(get_template_directory() . '/braid/braid-environments.php');

// Add code for adding Vite build tags
require_once(get_template_directory() . '/braid/braid-vite.php');
