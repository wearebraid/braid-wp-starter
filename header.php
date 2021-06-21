<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package braid-starter
 */

global $vite;
$vite = new BraidVite( defined( 'BRAID_LOCAL_DEV' ) && BRAID_LOCAL_DEV );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php echo $vite->vite_css( 'app.js' ); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'braid-starter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	</header> <!-- #masthead -->

	<div id="content" class="site-content">
