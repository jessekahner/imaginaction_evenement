<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package quadrilium
 */
global $translation_name, $ng_apps;
?><!DOCTYPE html>
<!--[if lt IE 7]>	 <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>	   <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>	   <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>	   <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site clearfix ">
	<!--[if lte IE 9]>
		<p class="chromeframe"><?php _ex('You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">activate Google Chrome Frame</a> to improve your experience.',"Chrome Frame",$translation_name) ?></p>
	<![endif]-->
	<?php 
		// wp_nav_menu( array( 'theme_location' => 'primary', 'depth' =>1, "menu_id" => "mobile-main-menu") );
	 ?>

	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="is-relative container">
			<h1 class="site-title"><?php echo get_bloginfo('name'); ?></h1>

			<h2 class="site-slogan"><?php echo get_bloginfo('description'); ?></h2>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 
				'menu_class' => 'menu' )); ?>
				
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<hr>

	<div id="content" class="site-content clearfix">
	