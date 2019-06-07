<?php
// ---
// Shortcodes
// ---

// button
function braid_button($atts)
{
    $a = shortcode_atts([
        'link' => 'link',
        'href' => 'link',
        'text' => 'text'
    ], $atts);

    $link = ($a['link'] === 'link') ? $a['href'] : $a['link'];

    return '<a class="btn" href="' . $link . '">' . $a['text'] .'</a>';
}

add_shortcode('button', 'braid_button');

// Site Social Links
function braid_site_social_links($atts = [], $content = '')
{
    $networks = isset($atts['networks']) ?
        explode(',', $atts['networks']) :
        ['linkedin', 'facebook', 'youtube', 'twitter', 'pinterest', 'instagram', 'slack', 'github'];
    
    $return = '';
    foreach ($networks as $network) {
        $network = strtolower(trim($network));
        $network_url = get_field($network, 'option');
        if ($network_url) {
            $return .= '<li><a href="'.$network_url.'" target="_blank"><i class="fab fa-'.$network.'"></i></a></li>';
        }
    }
    return !empty($return) ? '<ul class="social-links">'.$return.'</ul>' : '';
}
add_shortcode('site_social', 'braid_site_social_links');

// Current Year
function braid_current_year($atts = [], $content = '')
{
    return date('Y');
}
add_shortcode('current_year', 'braid_current_year');
