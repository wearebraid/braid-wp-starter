<?php 
    // Custom Cornerstone Media functions.php stuff
    // so we can easily plug into any WordPress Theme
    // Make sure to require this file in functions.php...
        // require get_template_directory() . '/cornerstone/cornerstone-functions.php';
?>

<?php 


// Global Variables For Use Theme-wide
require_once(get_template_directory() . '/cornerstone/cm-global-vars.php');

// Advanced Custom Fields Customizations
require_once(get_template_directory() . '/cornerstone/cm-acf.php');

// Performance
require_once(get_template_directory() . '/cornerstone/cm-performance.php');

// WP Admin Cleanup
require_once(get_template_directory() . '/cornerstone/cm-wp-admin.php');

// Enqueue Scripts and Styles
require_once(get_template_directory() . '/cornerstone/cm-enqueue.php');

// Footer Modifications
require_once(get_template_directory() . '/cornerstone/cm-footer.php');

// Header Modifications
require_once(get_template_directory() . '/cornerstone/cm-header.php');





?>
