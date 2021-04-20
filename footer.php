<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package braid-starter
 */

global $jsextract;
global $cssextract;

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			&copy; <?php echo date("Y"); ?> - All rights reserved.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<Griddle></Griddle>
</div><!-- #page -->

<?php
	wp_footer();
	echo $jsextract;
	echo $cssextract;
	$vite = new BraidVite(defined('BRAID_LOCAL_DEV') && BRAID_LOCAL_DEV);
	echo $vite->vite('app.js');
?>

</body>
</html>
