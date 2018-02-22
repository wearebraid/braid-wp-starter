<?php 
// ---
// Enqueue styles and script from Gulp Output
// ---

function braid_starter_scripts() {
    // each time the below files are saved, the version fingerprint changes to bust cache
    $clientCSSversion = filemtime(get_template_directory() . '/dist/css/app.min.css');
    $clientJSversion = filemtime(get_template_directory() . '/dist/js/app.min.js');
    $styleCSSVersion = filemtime(get_template_directory() . '/style.css');

    // default style.css which has a normalize
    wp_enqueue_style( 'braid-starter-style', get_stylesheet_uri(), [], $styleCSSVersion );

    // Accessibility Improvements
	// wp_enqueue_script( 'braid-starter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    // skip-link-focus.js is included in gulp bundle for performance

	// Main Client CSS
	wp_enqueue_style( 'braid-starter-app-style', get_template_directory_uri() . '/dist/css/app.min.css', [], $clientCSSversion);

	// Main Client JS
	wp_enqueue_script( 'braid-starter-app-js', get_template_directory_uri() . '/dist/js/app.min.js', ['jquery'], $clientJSversion, true );

    // Font Awesome
    wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/8ef1cdd67b.js', [], false);
}

add_action( 'wp_enqueue_scripts', 'braid_starter_scripts' );

?>