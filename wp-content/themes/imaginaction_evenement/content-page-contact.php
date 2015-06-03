<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package imaginaction
 */
global $translation_name;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', $translation_name ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php if (!has_post_thumbnail()): ?>
<div id="post-<?php the_ID(); ?>-img" class="post-image col-tb-6">
	<img src="http://placehold.it/700x500" alt="">
</div>
<?php endif ?>