<?php

// Prevents staging environment from being indexed by search engines after pulling from production
function preserve_search_engine_visibility( $options ) {
	$options[] = 'blog_public';
	return $options;
}
add_filter( 'wpmdb_preserved_options', 'preserve_search_engine_visibility' );
