<?php 
//---
// PHP functions and utilities
// ---

// shorten excerpt
// usage "echo strip_tags(excerpt(20));"
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);

    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }	
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}



// ---
// Shortcodes
// ---

// button
function cm_button($atts) {
	$a = shortcode_atts([
		'link' => 'link',
		'href' => 'link',
		'text' => 'text'
	], $atts);

	$link = ($a['link'] === 'link') ? $a['href'] : $a['link'];

	return '<a class="btn" href="' . $link . '">' . $a['text'] .'</a>';
}

add_shortcode('button', 'cm_button');

?>