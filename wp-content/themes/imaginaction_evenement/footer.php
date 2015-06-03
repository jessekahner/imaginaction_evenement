	<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package quadrilium
 */
global $translation_name, $post;

?>

	</div><!-- #content -->
	<hr>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<p>&copy;Copyright <?php echo date("Y") ?> <?php echo get_bloginfo('sitename'); ?></p>
		</div>
    <!-- /End Footer -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>