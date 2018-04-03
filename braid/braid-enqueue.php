<?php
// ---
// Enqueue styles and script from Gulp Output
// ---

function braid_starter_scripts()
{
    wp_enqueue_style(
        'theme-fonts',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700',
        [],
        $styleCSSVersion
    );
    wp_enqueue_style(
        'braid-starter-style',
        get_template_directory_uri() . '/dist/build.css',
        ['theme-fonts'],
        filemtime(get_template_directory() . '/dist/build.css')
    );
    
    ob_start();
    include dirname(__FILE__).'/../dist/manifest.json';
    $manifest = ob_get_clean();
    $manifestRequires = ['jquery', 'fontawesome-5'];
    $registeredScripts = [];
    foreach (json_decode($manifest) as $manifestFile) {
        if (substr($manifestFile, -3) == '.js') {
            $chunk = explode('.', $manifestFile);
            $registeredScripts[] = 'site-script-' . $chunk[0];
            wp_register_script(
                'site-script-' . $chunk[0],
                get_template_directory_uri() . '/dist/' . $manifestFile,
                $manifestRequires,
                '1.0',
                true
            );
            $manifestRequires = array('site-script-' . $chunk[0]);
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

add_action('wp_enqueue_scripts', 'braid_starter_scripts');
