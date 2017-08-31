<?php 

// ---
// Footer Modifications
// ---

function social_links() {
    get_template_part('cornerstone/template-parts/braid-social');
}

add_action('wp_footer', 'social_links');

?>