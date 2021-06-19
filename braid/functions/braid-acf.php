<?php

// ---
// Add options page
// ---
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/**
 * Styles ACF Flexible Content to be more user friendly
 */
function my_acf_admin_head() {
	?>
	<style type="text/css">
		.acf-flexible-content .layout .acf-fc-layout-handle {
			/*background-color: #00B8E4;*/
			background-color: #202428;
			color: #eee;
		}
		.acf-flexible-content .acf-flexible-content .acf-fc-layout-handle {
			background-color: #6d6a69;
		}
		.acf-repeater.-row > table > tbody > tr > td,
		.acf-repeater.-block > table > tbody > tr > td {
			border-top: 2px solid #202428;
		}
		.acf-repeater .acf-row-handle {
			vertical-align: top !important;
			padding-top: 16px;
		}
		.acf-repeater .acf-row-handle span {
			font-size: 20px;
			font-weight: bold;
			color: #202428;
		}
		.imageUpload img {
			width: 75px;
		}
		.acf-repeater .acf-row-handle .acf-icon.-minus {
			top: 30px;
		}
		.braid-flex-thumb {
			background-position: center center;
			background-repeat: no-repeat;
			background-size: cover;
			width: 160px;
			position: absolute;
			right: 90px;
			top: -10px;
			bottom: -10px;
			border: 1px solid black;
		}
		.braid-flex-title {
			display: inline-block;
			vertical-align: middle;
			margin: 7px;
		}
	</style>
	<?php
}
add_action( 'acf/input/admin_head', 'my_acf_admin_head' );

/**
 * ensure flexible rows are collapsed on post load
 * and if we have target scroll to it and open it
 */
function acf_flexible_content_ux() {
	?>
	<script type="text/javascript">
	(function($){
		$(document).ready(function(){
			$('.acf-flexible-content .layout').each(function( index ) {
					$(this).addClass('-collapsed');
				});
			});

			var urlParams = new URLSearchParams(window.location.search);
			if (urlParams.has('target')) {
				setTimeout(function() {
					var values = urlParams.get('target').split(':');
					var id = values[0];
					var element = values[1];
					var selector = '.layout[data-id="row-' + id + '"][data-layout="' + element + '"]'
					var $target = $(selector);
					$target.removeClass('-collapsed')
					setTimeout(function() {
						$('html, body').animate({
								scrollTop: $target.offset().top - 100
						}, 200);
					}, 200);
				}, 800);
			}
	})(jQuery);
	</script>
	<?php
}
add_action( 'acf/input/admin_head', 'acf_flexible_content_ux' );

/**
 * when using the Braid visual ACF menu plugin, provide images at the following path
 */
function custom_flexible_images_path() {
	return '/src/img/flexible';
}
add_filter( 'braid.flexible_visual_menu.images_path', 'custom_flexible_images_path' );

/**
 * Given a collection of layouts and an index from our page builder
 * get the original (not clone instance) group ID for ACF to operate with
 */
function get_original_row_key_from_content( $content, $index ) {
	if (
		( $content && $content['layouts'] && count( $content['layouts'] ) ) &&
		( $content && $content['value'] && count( $content['value'] ) )
	) {
		$layout = $content['value'][ $index ]['acf_fc_layout'];
		$key    = false;
		foreach ( $content['layouts'] as $l ) {
			if (
				$l['name'] === $layout &&
				$l['sub_fields'] &&
				count( $l['sub_fields'] )
			) {
				foreach ( $l['sub_fields'] as $f ) {
					if ( $f['_clone'] ) {
						$clone_key = $f['_clone'];
						$key       = get_field_object( $clone_key )['clone'][0];
						break;
					}
				}
				break;
			}
		}
		return $key;
	}
	return false;
}

/**
 * Adds a toggle for the griddle x-ray layer to the menu bar
 */
function xray_adminbar_menu() {
	global $wp_admin_bar;

	if ( ! is_user_logged_in() || ! is_admin_bar_showing() || is_admin() ) {
		return;
	}

	$current_value = isset( $_COOKIE['et-xray'] ) ? $_COOKIE['et-xray'] : false;

	$wp_admin_bar->add_menu(
		array(
			'id'    => 'xray_toggle',
			'title' => 'X-Ray: <span class="xray-toggle" data-active="' . $current_value . '"></span>',
		)
	);
}
add_action( 'admin_bar_menu', 'xray_adminbar_menu', 99 );
