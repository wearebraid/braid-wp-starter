<?php
// ---
// Enqueue styles and script from Gulp Output
// ---

function braid_starter_scripts()
{
    // each time the below files are saved, the version fingerprint changes to bust cache
    // $clientCSSversion = filemtime(get_template_directory() . '/' . $site_css);
    // default style.css which has a normalize

    wp_enqueue_script('fontawesome-5', 'https://use.fontawesome.com/releases/v5.0.6/js/all.js');

    $manifestRequires = ['jquery', 'fontawesome-5'];

    /**
     * ONLY THESE KEYS WILL BE IMPORTED FROM THE MANIFEST
     * IF EMPTY, IT WILL IMPORT ALL JS AND CSS FILES
     */
    $manifestRestrict = [];

    if (file_exists(dirname(__FILE__).'/../dist/manifest.json')) {
        ob_start();
        include dirname(__FILE__).'/../dist/manifest.json';
        $manifest = ob_get_clean();
        $registeredScripts = [];
        foreach (json_decode($manifest) as $key => $manifestFile) {
            if (count($manifestRestrict) > 0 && !in_array($key, $manifestRestrict)) {
                continue;
            }
            if (substr($key, -3) == '.js') {
                $registeredScripts[] = $key;
                wp_register_script(
                    $key,
                    $manifestFile,
                    $manifestRequires,
                    filemtime(get_template_directory() . '/dist/' . basename($manifestFile)),
                    true
                );
                $manifestRequires = array($key);
            } elseif (substr($key, -4) == '.css') {
                wp_enqueue_style($key, $manifestFile, [], filemtime(get_template_directory() . '/dist/' . basename($manifestFile)));
            }
        }

        $siteData = [
            'ajaxurl' => admin_url('admin-ajax.php')
        ];

        foreach ($registeredScripts as $key => $script) {
            if ($key == 0) {
                wp_localize_script($script, 'siteData', $siteData);
            }
            wp_enqueue_script($script);
        }
    }
}

add_action('wp_enqueue_scripts', 'braid_starter_scripts');
