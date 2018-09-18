<?php 
//---
// PHP functions and utilities
// ---

// Returns last two words with &nbsp; between them
function widowless($string)
{
    $string = explode(' ', trim($string));
    if (count($string) > 2) {
        $last = array_pop($string);
        $first = array_pop($string);
        return implode(' ', $string) . " $first&nbsp;$last";
    } else {
        return implode(' ', $string);
    }
}

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
function braid_button($atts) {
	$a = shortcode_atts([
		'link' => 'link',
		'href' => 'link',
		'text' => 'text'
	], $atts);

	$link = ($a['link'] === 'link') ? $a['href'] : $a['link'];

	return '<a class="btn" href="' . $link . '">' . $a['text'] .'</a>';
}

add_shortcode('button', 'braid_button');

function extract_inline_scripts_to_footer($output, $tag, $attr)
{
    global $jsextract;
    global $cssextract;

    preg_match_all('#<script(.*?)</script>#is', $output, $matches);
    foreach ($matches[0] as $value) {
        $jsextract .= $value;
    }
    $output = preg_replace('#<script(.*?)</script>#is', '', $output);

    preg_match_all('#<style(.*?)</style>#is', $output, $matches);
    foreach ($matches[0] as $value) {
        $cssextract .= $value;
    }
    $output = preg_replace('#<style(.*?)</style>#is', '', $output);

    return $output;
}
add_filter('do_shortcode_tag', 'extract_inline_scripts_to_footer', 10, 3);

function extract_inline_scripts_from_content_footer($content) {
    global $jsextract;
    global $cssextract;

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);

    preg_match_all('#<script(.*?)</script>#is', $content, $matches);
    foreach ($matches[0] as $value) {
        $jsextract .= $value;
    }
    $content = preg_replace('#<script(.*?)</script>#is', '', $content);

    preg_match_all('#<style(.*?)</style>#is', $content, $matches);
    foreach ($matches[0] as $value) {
        $cssextract .= $value;
    }
    $content = preg_replace('#<style(.*?)</style>#is', '', $content);

    return $content;
}
add_filter('the_content', 'extract_inline_scripts_from_content_footer');
