<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package imaginaction
 */
global $translation_name;

if (has_post_thumbnail()) {
	$class[] = "col-tb-8";
}else{
	$class[] = "col-mb-12";
}
?>
<?php if (has_post_thumbnail()): ?>
<div id="post-<?php the_ID(); ?>-img" class="post-image col-tb-4">
	<!-- <img src="http://placehold.it/700x500" alt=""> -->
	<?php the_post_thumbnail( "image_principale" ) ?>
</div>
<?php endif ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
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

<?php if (have_rows("encan_item")): ?>
<div class="encan clear-all clearfix">
	<?php while(have_rows("encan_item")): the_row(); ?>
	<div class="encan__item clear-all clearfix">
		<?php if (get_sub_field("encan_image")): ?>
		<div class="encan__item-image col-tb-4">
		<?php echo wp_get_attachment_image( get_sub_field("encan_image"), "image_principale"); ?>
		</div>
		<?php endif ?>
		<div class="encan__item-contenu <?php echo (get_sub_field("encan_image")?"col-tb-8":"col-tb-12") ?>">		
			<h2><?php the_sub_field("encan_titre") ?></h2>
			<div class="description">
				<?php the_sub_field("encan_description") ?>
			</div>
			<?php if (get_sub_field("encan_valeur") > 0): ?>
			<p>Ce prix à une valeur de <strong><?php echo get_sub_field("encan_valeur") ?>$</strong></p>
			<?php endif ?>
			<?php if (get_sub_field("encan_etat") > 0): ?>
			<p>Les enchères sont à <strong><?php echo get_sub_field("encan_etat") ?>$</strong></p>
			<?php endif ?>
			<?php if (get_sub_field("encan_site_titre") || get_sub_field("encan_siteweb_url")): ?>
			<p><?php echo (get_sub_field("encan_site_titre")?"<strong>".get_sub_field("encan_site_titre")."</strong><br>":null) ?>
				<?php if (get_sub_field("encan_site_titre")): ?>
				<a href="<?php the_sub_field("encan_siteweb_url") ?>" target="_blank"><?php the_sub_field("encan_siteweb_url") ?></a>
				<?php endif ?>
			</p>
			<?php endif ?>
		</div>
	</div>
<?php endwhile; ?>
</div>
<?php endif ?>