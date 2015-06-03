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
<div id="page" class="hfeed site clearfix container">
	<!--[if lte IE 9]>
		<p class="chromeframe"><?php _ex('You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">activate Google Chrome Frame</a> to improve your experience.',"Chrome Frame",$translation_name) ?></p>
	<![endif]-->
	<?php 
		// wp_nav_menu( array( 'theme_location' => 'primary', 'depth' =>1, "menu_id" => "mobile-main-menu") );
	 ?>
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', $translation_name ); ?></a>

	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="is-relative container__main">
			<div class="main-header container clear-all clearfix">
			<div class="row header-responsive">
				<div class="logo col-md-2 col-sm-2 col-xs-12">
					<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/quadrilium/images/logo.svg" class="img-responsive"><span><?php bloginfo( 'name' ); ?></span></a></div>
				</div>
				<div class="header-right col-md-10">
					<div class="above-nav clearfix">
						<div class="col-sm-9 col-md-3 col-lg-4 search-form-wrapper hidden-xs"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
						<div class="mobile-lang col-md-3 col-sm-3 hidden-lg hidden-md hidden-xs">
						
						<div class="info-box col-xs-12 col-sm-5 col-md-6 col-lg-5">
						besoin d’information ?
						<span><?php the_field('main_phone_number','option') ?></span><span class="icon-phone icons"></span>
						</div>
						<?php if (!is_user_logged_in()): ?>
							<?php wp_nav_menu( array(
							'theme_location' => 'woocommerce',
							'container_class' => 'menu-woo-container col-sm-4 col-md-3 hidden-xs'
							) ); ?>
							<!-- menu-woo-container -->
						<?php else: ?>
							<?php wp_nav_menu( array(
							'theme_location' => 'woocommerce-logged',
							'container_class' => 'menu-woo-container is-table-cell'
							) ); ?>
							<!-- menu-woo-logged-container -->
						<?php endif ?>
						
					</div>
					
					
					<div class="nav-container hidden-xs">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 
						'menu_class' => 'menu' )); ?>
						
					</nav><!-- #site-navigation -->
					</div>
					
					
					
				</div>
			</div><!-- .row -->	
			</div><!-- .main-header -->
		

			

		</div>
	</header><!-- #masthead -->
	<hr>

	<div id="content" class="site-content clearfix">
	