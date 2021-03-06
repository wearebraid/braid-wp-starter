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

global $vite;
global $jsextract;
global $cssextract;

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	</footer><!-- #colophon -->
	<global-events></global-events>
</div><!-- #page -->

<?php
	wp_footer();
	echo $jsextract;
	echo $cssextract;
	echo $vite->vite_js( 'app.js' );
?>

</body>
</html>
