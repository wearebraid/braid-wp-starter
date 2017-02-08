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

						<?php if( get_row_layout() == 'hero_banner' ): ?>

							<?php
							// ----
							// Layout: Hero Banner -- tops of internal pages
							$img = get_sub_field('image');
							$bgPos = get_sub_field('bg_position') ? get_sub_field('bg_position') : 'center center';
							$style = "background-image: url(" . $img['sizes']['1.78:1-large'] . "); background-position:" . $bgPos . ";";
							$bgCol = empty($img) ? 'bg-pri' : '';
							?>

							<div class="hero-banner hero-banner--<?php the_sub_field('size');?> <?=$bgCol;?> ttu white tc cover relative" style="<?=$style; ?>">
								<div class="hero-banner--content absolute center-it ttu white w-90">
									<h2 class="fw7 lh-solid ma0 mb2"><?php the_sub_field('heading'); ?></h2>
									<h3 class="fw3 mt0"><?php the_sub_field('sub_heading'); ?></h3>
								</div>
							</div>


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


							


						<?php elseif( get_row_layout() == 'grid_width_image' ): ?>

							<?php
							// ----
							// Layout: Image: Full Width Img Container
							$img = get_sub_field('image');
							?>
							<?php if(!empty($img)) : ?>
								<div class="image-container row">
									<img class="w-100" src="<?php echo $img['sizes']['container-width']; ?>" alt="<?php echo $img['alt']; ?>" />
								</div>
							<?php endif; ?>




						<?php elseif( get_row_layout() == 'full_bleed_image' ): ?>

							<?php
							// ----
							// Layout: Full Bleed Images
							$full_width_img = get_sub_field('image');
							$image_src = $full_width_img['sizes']['full-bleed'] != '' ? $full_width_img['sizes']['full-bleed'] : $full_width_img['url'];
							?>

							<?php if(!empty($full_width_img)) : ?>
								<div class="full-bleed-image">
									<img class="lazy full-width-img" src="<?=$image_src;?>" alt="<?php echo $full_width_img['alt']; ?>" />
								</div>
							<?php endif; ?>


					


						<?php elseif( get_row_layout() == 'wysiwyg' ): ?>

							<?php
							// ----
							// Layout: WYSIWYG

							$elem_classes = get_sub_field('constrained_content') ? 'constrained-content' : '';
							$elem_classes = get_sub_field('reduce_padding') ? $elem_classes . ' reduce' : $elem_classes;
							?>
							<?php if (get_sub_field('bg_color')) { echo '<div class="bg-'. get_sub_field('bg_color') . '">'; } ?>
								<div class="row content-section wysiwyg <?=$elem_classes;?>">
									<?php the_sub_field('content'); ?>
								</div>
							<?php if (get_sub_field('bg_color')) { echo '</div>'; } ?>




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




						<?php elseif( get_row_layout() == 'form' ): ?>

							<?php
							// ----
							// Layout: Form
							$shortcode = get_sub_field('shortcode');
							?>
						
							<div class="row pa3 form-module mb4">
								<?php 
									if ($shortcode) {
										echo do_shortcode($shortcode);
									}
								?>
							</div>
							


							




						<?php endif;

					endwhile;

				else :

				// no layouts found

				endif;
			?>


			<?php get_template_part('template-parts/part-expertise'); ?>
			

			<?php wp_reset_postdata(); ?>

		<?php
		endwhile; // End of the loop.
		?>


		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();
