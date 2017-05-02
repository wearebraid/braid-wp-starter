<?php
/*
	Template Name: Flexible Page Template
	Template Post Type: page
*/

global $uploads;
global $root;
global $img_root;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>

				<?php

				// check if the flexible content field has rows of data
				if( have_rows('content') ):

					// loop through the rows of data
					while ( have_rows('content') ) : the_row(); ?>


						<?php elseif( get_row_layout() == 'colored_text_bar' ): ?>

							<?php
							// ----
							// Layout: Colored Text Bar
							$text = get_sub_field('text');
							$bgColor = get_sub_field('bg_color');
							$copyElem = get_sub_field('text_size') === 'heading' ? 'h2' : 'p';
							?>

							<?php if($text) : ?>
								<div class="colored-text-bar bg-<?=$bgColor;?>">
									<div class="colored-text-bar--content">
										<<?=$copyElem;?>><?=$text;?></<?=$copyElem;?>>
									</div>
								</div>
							<?php endif; ?>



						<?php elseif( get_row_layout() == 'side_by_side_content' ): ?>

							<?php
							// ----
							// Layout: Two WYSIWYG editors side by side on desktop, stacked on mobile
							?>

							<div class="side-by-side row cf">
								<div class="side-by-side--left">
									<?php the_sub_field('left_side'); ?>
								</div>
								<div class="side-by-side--right">
									<?php the_sub_field('right_side'); ?>
								</div>
							</div>






						<?php elseif( get_row_layout() == 'the_content' ): ?>

							<?php
							// ----
							// Layout: The Main Content
							?>
							<div class="row content-section the-content">
								<?php  if (get_sub_field('show_title')) : ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php endif; ?>

								<?php the_content(); ?>
							</div>


							


					



						<?php endif;

					endwhile;

				else :

				// no layouts found

				endif;
			?>


			<?php wp_reset_postdata(); ?>

		<?php
		endwhile; // End of the loop.
		?>


		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();
