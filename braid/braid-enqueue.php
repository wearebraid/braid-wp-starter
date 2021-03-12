<?php
// ---
// Enqueue styles and script from Gulp Output
// ---

function braid_starter_scripts()
{
    $siteData = [
        'ajaxurl' => admin_url('admin-ajax.php')
    ];
    wp_localize_script('jquery', 'siteData', $siteData);
    wp_enqueue_script('fontawesome-5', 'https://use.fontawesome.com/releases/v5.0.6/js/all.js', ['jquery']);
}
add_action('wp_enqueue_scripts', 'braid_starter_scripts');
