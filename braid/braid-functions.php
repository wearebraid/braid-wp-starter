<?php
// Custom Braid functions.php stuff
// so we can easily plug into any WordPress Theme
// Make sure to require this file in functions.php...
// require get_template_directory() . '/braid/braid-functions.php';

require_once(get_template_directory() . "/braid/braid-setup.php");

$modules = array(
  'acf', // Advanced Custom Fields Customizations
  'custom-post-types', // Register Custom Post Types
  'cli', // Adds Braid WP CLI commands for extended functionality
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
  'vite', // Add code for adding Vite build tags
  'wp-admin', // WP Admin Cleanup and Customizations
);

foreach ( $modules as $module ) {
  require_once(get_template_directory() . "/braid/braid-$module.php");
}
