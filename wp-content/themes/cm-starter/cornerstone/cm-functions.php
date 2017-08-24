<?php 
    // Custom Cornerstone Media functions.php stuff
    // so we can easily plug into any WordPress Theme
    // Make sure to require this file in functions.php...
        // require get_template_directory() . '/cornerstone/cornerstone-functions.php';


// Global Variables For Use Theme-wide
require_once(get_template_directory() . '/cornerstone/cm-global-vars.php');

// Advanced Custom Fields Customizations
require_once(get_template_directory() . '/cornerstone/cm-acf.php');

// Performance
require_once(get_template_directory() . '/cornerstone/cm-performance.php');

// WP Admin Cleanup and Customizations
require_once(get_template_directory() . '/cornerstone/cm-wp-admin.php');

// Enqueue Scripts and Styles
require_once(get_template_directory() . '/cornerstone/cm-enqueue.php');

// Custom Image Sizes
require_once(get_template_directory() . '/cornerstone/cm-image-sizes.php');

// Gravity Forms Customizations
require_once(get_template_directory() . '/cornerstone/cm-gravity-forms.php');

// General Utilities
require_once(get_template_directory() . '/cornerstone/cm-utilities.php');

// Footer Modifications
require_once(get_template_directory() . '/cornerstone/cm-footer.php');

// Header Modifications
require_once(get_template_directory() . '/cornerstone/cm-header.php');

// Register Custom Post Types
require_once(get_template_directory() . '/cornerstone/cm-custom-post-types.php');

// Setup Default Users
require_once(get_template_directory() . '/cornerstone/cm-default-users.php');

// Include Post Meta in Search results
require_once(get_template_directory() . '/cornerstone/cm-search.php');







?>
