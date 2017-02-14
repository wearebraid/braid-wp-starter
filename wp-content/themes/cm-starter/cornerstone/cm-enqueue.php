<?php 
// ---
// Enqueue styles and script from Gulp Output
// ---

function cm_starter_scripts() {
    // vars
    $clientCSSAbsolutePath = get_template_directory() . '/dist/app.min.css';
    $clientJSAbsolutePath = get_template_directory() . '/dist/app.min.js';

    // default style.css which has a normalize
    wp_enqueue_style( 'cm-starter-style', get_stylesheet_uri() );

    // Accessibility Improvements
	// wp_enqueue_script( 'cm-starter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    // skip-link-focus.js is included in gulp bundle for performance

	// Main Client CSS
	wp_enqueue_style( 'cm-starter-app-style', get_template_directory_uri() . '/dist/app.min.css', [], filemtime($clientCSSAbsolutePath));

	// Main Client JS
	wp_enqueue_script( 'cm-starter-app-js', get_template_directory_uri() . '/dist/app.min.js', ['jquery'], filemtime($clientJSAbsolutePath), true );

    // Font Awesome
    wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/8ef1cdd67b.js', [], false);
}

add_action( 'wp_enqueue_scripts', 'cm_starter_scripts' );

?>