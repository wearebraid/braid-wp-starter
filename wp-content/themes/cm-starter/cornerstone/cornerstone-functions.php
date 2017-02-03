<?php 
    // Custom Cornerstone Media functions.php stuff
    // so we can easily plug into any WordPress Theme
    // Make sure to require this file in functions.php...
        // require get_template_directory() . '/cornerstone/cornerstone-functions.php';
?>



<?php 

// ---
// Advanced Custom Fields
// ---

require get_template_directory() . '/cornerstone/register-acf-fields.php';

// Add options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}








?>
