<?php
// check if the flexible content field has rows of data
if ( have_rows( 'content' ) ) :
	$index           = 0;
	$current_post_id = get_the_ID();
	$content_object  = get_field_object( 'content' );
	$user            = wp_get_current_user()->user_login;

	// loop through the rows of data
	while ( have_rows( 'content' ) ) :
		the_row();
		$layout        = get_row_layout();
		$row_key       = get_original_row_key_from_content( $content_object, $index );
		$group_object  = new WP_Query(
			array(
				'post_type' => 'acf-field-group',
				'name'      => $row_key,
			)
		);
		$group_post_id = false;
		if ( $group_object->posts && count( $group_object->posts ) ) {
			$group_post_id = $group_object->posts[0]->ID;
		}
		?>
			<flexible-content-stripe
				class="flexi-content <?php echo $layout; ?>"
				label="<?php echo $layout; ?>"
				index="<?php echo $index; ?>"
				post-id="<?php echo $current_post_id; ?>"
				group-id="<?php echo $group_post_id; ?>"
				current-user="<?php echo $user; ?>"
			>
				<?php get_template_part( 'braid/template-parts/flexible/flexible', $layout ); ?>
			</flexible-content-stripe>
		<?php
		$index++;
	endwhile;

else :
	the_content();
endif;

wp_reset_postdata();
?>
