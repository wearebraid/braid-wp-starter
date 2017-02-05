<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Home Page Template
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="owl-carousel owl-theme">
					<?php if( have_rows('slides') ): ?>
						<?php
							// vars
							$btn_text = get_field('button_text');
							$btn_link = get_field('button_link');
						?>
						<?php while( have_rows('slides') ) : the_row(); ?>
							<?php 
								$image = get_sub_field('image');
								$style = "background-image: url(" . $image['sizes']['1.5:1-large'] . ");";
							?>
							<div class="slide" style="<?=$style; ?>">
								<div class="slide--content center-it ttu white w-90">
									<h2 class="fw7 lh-solid ma0 mb1"><?php the_sub_field('heading'); ?></h2>
									<h3 class="fw3 lh-heading mt0 mb4"><?php the_sub_field('sub-heading'); ?></h3>
									<a class="btn" href="<?=$btn_link;?>"><?=$btn_text;?></a>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; // end have_rows('slides') ?>
				</div>
			<?php endwhile; // End of the loop.?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
