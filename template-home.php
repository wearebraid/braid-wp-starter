<?php
/*
	Template Name: Home Page Template
	Template Post Type: page
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'braid/template-parts/flexible/flexible', 'block-loop' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();

