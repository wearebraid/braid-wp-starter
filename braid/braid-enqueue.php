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
    $manifestIgnore = ['external_use.css']; // IGNORE THESE CHUNKS FROM MANIFEST
    
    if (file_exists(dirname(__FILE__).'/../dist/manifest.json')) {
        ob_start();
        include dirname(__FILE__).'/../dist/manifest.json';
        $manifest = ob_get_clean();
        $registeredScripts = [];
        foreach (json_decode($manifest) as $key => $manifestFile) {
            if (in_array($key, $manifestIgnore)) {
                continue;
            }
            if (substr($manifestFile, -3) == '.js') {
                $chunk = explode('.', $manifestFile);
                $registeredScripts[] = 'site-script-' . $chunk[0];
                wp_register_script(
                    'site-script-' . $chunk[0],
                    $manifestFile,
                    $manifestRequires,
                    '1.0',
                    true
                );
                $manifestRequires = array('site-script-' . $chunk[0]);
            } elseif (substr($manifestFile, -4) == '.css') {
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
