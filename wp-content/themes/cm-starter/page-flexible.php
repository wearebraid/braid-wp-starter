<?php
/*
	Template Name: Flexible Page Template
	Template Post Type: page, expertise
*/

$uploads = wp_upload_dir()['baseurl'];
$root = get_template_directory_uri();
$img_root = $root . "/lib/img";

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
									<?php if(get_sub_field('use_pillar_aught_logo')): ?>
									<img class="hero-banner--img mb2 mb3-ns dib" src="<?=$root;?>/lib/svg/pa_new.svg" alt="Pillar Aught Logo">
									<?php else: ?>
									<h2 class="fw7 lh-solid ma0 mb2"><?php the_sub_field('heading'); ?></h2>
									<?php endif; ?>
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




						<?php elseif( get_row_layout() == 'content_slides_5050' ): ?>

							<?php
							// ----
							// Layout: Content Slides 50/50
							?>

							<?php if( have_rows('slides') ): ?>
								<div class="content-slides flex-l">
									<div class="content-slides--content-wrap w-50-l pa3 pa4-ns">
										<div class="content-slides--content">
											<?php the_content(); ?>
										</div>
									</div>
									<div class="owl-carousel content-slides--slides owl-theme overflow-hidden relative">
										<?php while( have_rows('slides') ) : the_row(); ?>
											<?php 
												$image = get_sub_field('image');
												$style = "background-image: url(" . $image['sizes']['1:1-medium'] . ");";
												$topText = get_sub_field('top_text');
												$middleText = get_sub_field('middle_text');
												$bottomText = get_sub_field('bottom_text');
											?>
											<div class="content-slides--slide white ttu tc cover relative h-100" style="<?=$style; ?>">
												<div class="content-slides--slide-content ttu white center-it w-90">
													<p class="tc"><?=$topText;?></p>
													<h3><?=$middleText;?></h3>
													<p class="tc"><?=$bottomText;?></p>
												</div>
											</div>
										<?php endwhile; ?>
									</div>
								</div>
								
							<?php endif; // end have_rows('slides') ?>

							
								


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



						<?php elseif( get_row_layout() == 'leadership_block' ): ?>

							<?php
							// ----
							// Layout: Leadership Block
							get_template_part('template-parts/part-team-members');
							?>


						<?php elseif( get_row_layout() == 'form' ): ?>

							<?php
							// ----
							// Layout: Form
							$shortcode = get_sub_field('shortcode');
							?>
						
							<div class="row pa3 form-module mb4">
								<?php 
									if ($shortcode) {
										echo do_shortcode('[splitheading light="Inquiries" dark="Form"]');
										echo do_shortcode($shortcode);
									}
								?>
							</div>
							



						<?php elseif( get_row_layout() == 'location_module' ): ?>

							<?php
							// ----
							// Layout: Location Module
							if ( has_post_thumbnail() ) {
								$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), '1.78:1-small');
								$style = "background-image: url(" . $img_url[0] . ");";
							}

								global $genAddress;
								global $addressGoogleFormat;
								$addressHTML = str_replace('Circle', 'Circle <br>', $genAddress);
								global $genPhone;
								global $genPhoneHref;
								global $genFax;
								global $genFaxHref;
							?>

							<div class="row pa3">
								<div class="pa-location bd-pri row">
									<div class="pa-location--banner relative cover" style="<?=$style;?>">
										<div class="absolute center-it w-90 tc">
											<h3 class="fw3 ma0 white">Office Location</h3>
											<h2 class="fw7 ma0 white">Harrisburg</h2>
										</div>
									</div>

									<div class="pa-location--contact flex-ns">
										<div class="pa-location--address w-50-ns ">
											<div class="fw7 mb3">Address</div>
											<div class="mb3"><?=$addressHTML;?></div>
											
											<a href="https://maps.google.com/?daddr=<?=$addressGoogleFormat;?>" target="_blank" class="btn alt2">Directions</a>
										</div>
										<div class="pa-location--phone w-50-ns">
											<div class="fw7 mb3">Call</div>
											<div class="mb3">
												<?=$genPhone;?><br>
												Fax: <a class="copy-color" href="<?=$genFaxHref;?>"><?=$genFax;?></a>
											</div>
											
											<a href="<?=$genPhoneHref?>" class="btn alt2">Inquiries</a>
										</div>
									</div>
								</div>
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
