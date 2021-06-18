<?php
/*
	Template Name: Flexible Page Template
	Template Post Type: page
*/

// themes global vars are location in braid/braid-global-vars.php
global $uploads;
global $root;
global $img_root;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php
                // check if the flexible content field has rows of data
                if( have_rows('content') ):

                    // loop through the rows of data
                    while ( have_rows('content') ) : the_row();
                    ?>
                        <div class="flexi-content <?php echo get_row_layout(); ?>">
                            <?php get_template_part('braid/template-parts/flexible/flexible', get_row_layout()); ?>
                        </div>
                    <?php
                    endwhile;

                else :
                    the_content();
                endif;
			?>

			<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();
