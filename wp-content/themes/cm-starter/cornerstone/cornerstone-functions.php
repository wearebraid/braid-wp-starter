<?php 
    // Custom Cornerstone Media functions.php stuff
    // so we can easily plug into any WordPress Theme
    // Make sure to require this file in functions.php...
        // require get_template_directory() . '/cornerstone/cornerstone-functions.php';
?>

<?php 


// Global Variables For Use Theme-wide
require_once(get_template_directory() . '/cornerstone/global-vars.php');

// Advanced Custom Fields Customizations
require_once(get_template_directory() . '/cornerstone/acf.php');

// Performance
require_once(get_template_directory() . '/cornerstone/performance.php');

// WP Admin Cleanup
require_once(get_template_directory() . '/cornerstone/wp-admin.php');







?>
