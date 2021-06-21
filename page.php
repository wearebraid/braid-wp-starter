<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package braid-starter
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php get_template_part( 'braid/template-parts/flexible/flexible', 'block-loop' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
