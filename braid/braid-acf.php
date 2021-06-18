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
