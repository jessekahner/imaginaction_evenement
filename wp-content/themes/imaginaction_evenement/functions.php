<?php
/**
 * imaginaction functions and definitions
 *
 * @package imaginaction
 */

global $translation_name, $detect;


$translation_name = "imaginaction";

if ( ! function_exists( 'imaginaction_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */


function imaginaction_setup() {
	global $translation_name, $detect;
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on imaginaction, use a find and replace
	 * to change $translation_name to the name of your theme in all the template files
	 */
	if (function_exists('load_theme_textdomain')) {
		load_theme_textdomain($translation_name, get_template_directory().'/languages');
	}

	// require(get_template_directory()."/includes/get-plugins.php");

	require_once(get_template_directory()."/libs/Mobile_Detect.php");
	$detect = new Mobile_Detect;

	


	// add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url() ) );
	add_editor_style( array( 'css/editor-style.css', twentyfifteen_fonts_url() ) );


	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	// add_theme_support( 'woocommerce' );
	add_post_type_support( 'page', 'excerpt' );



	automatic_feed_links(false);
	remove_action( 'wp_head','feed_links_extra', 3 );
  	remove_action( 'wp_head','feed_links', 2 );

	remove_action( 'wp_head', 'wp_generator');
	remove_action( 'wp_head', 'wp_shortlink_wp_head');

	define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
	define('ICL_DONT_LOAD_LANGUAGES_JS', true);
	define('ICL_DONT_LOAD_NAVIGATION_CSS', true);


	/* IMAGE SIZES
	=================================================================== */
	// add_image_size( "main_thumbnail", 235, 170 ,true );
	add_image_size( "image_principale", 460, 305 ,true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => __( 'Menu principal', $translation_name ),
		'secondary' => __( 'Menu secondaire', $translation_name ),
		'footer' => __( 'Menu pied de page', $translation_name ),


	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );



	// add_filter( "mce_external_plugins", "imaginaction_tinymce_add" );
 //    add_filter( 'mce_buttons_2', 'imaginaction_tinymce_register' );

	function imaginaction_tinymce_add( $plugin_array ) {
		$plugin_array['imaginaction'] = get_template_directory_uri() . '/js/imaginaction-tinymce-plugin.js';
		return $plugin_array;
	}
	function imaginaction_tinymce_register( $buttons ) {
		array_push( $buttons, 'seperator', 'bouton-full', 'bouton-border', 'collapse-expand' );
		return $buttons;
	}


	add_action('comment_closed', 'site_no_comments');
	function site_no_comments($id){
		return '';
	}


	//changing the logo
	function imaginaction_login_logo() {
		wp_enqueue_style(
			'login-style',
			get_template_directory_uri() . '/css/login.min.css',
			false,
			false,
			"screen"
		);
	}
	// add_action('login_enqueue_scripts', 'imaginaction_login_logo');

	// changing the login page URL
	function put_my_url(){
		return ('http://garderieimaginaction.com/'); // putting my URL in place of the WordPress one
	}
	add_filter('login_headerurl', 'put_my_url');

	//changing the login page URL hover text
	function put_my_title(){
		return ('Garderie Imaginaction - Événement'); // changing the title from "Powered by WordPress" to whatever you wish
	}
	add_filter('login_headertitle', 'put_my_title');


	function imaginaction_admin_styles(){
		wp_enqueue_style(
			'imaginaction-admin-style',
			get_template_directory_uri() . '/css/imaginaction-admin.min.css',
			false,
			false,
			"screen"
		);
	}
	// add_action('admin_enqueue_scripts', 'imaginaction_admin_styles');


	/**
	 * Enqueue scripts and styles.
	 */
	function imaginaction_scripts() {
		wp_enqueue_script(
			'modernizr',
			get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js',
			false,
			'2.6.2',
			false
		);
		wp_enqueue_script(
			'selectivizr',
			get_template_directory_uri() . '/js/libs/selectivizr.js',
			array("jquery"),
			'1.0.3',
			false
		);
		
		wp_register_script(
			'google_maps',
			"//maps.google.com/maps/api/js?v=3&sensor=false",
			array("jquery"),
			null,
			false
		);


		// wp_enqueue_script(
		// 	'plugins-js',
		// 	get_template_directory_uri().'/js/plugins.min.js',
		// 	array("jquery"),
		// 	null,
		// 	true
		// );

		wp_enqueue_script(
			'fancybox-js',
			get_template_directory_uri().'/bower_components/fancybox/source/jquery.fancybox.js',
			array("jquery"),
			null,
			true
		);

		wp_enqueue_script(
			'global-js',
			get_template_directory_uri().'/js/script.min.js',
			array("jquery"),
			null,
			true
		);

		
		wp_register_script(
			"imaginaction-maps",
			get_template_directory_uri().'/js/maps.min.js',
			array("google_maps"),
			null,
			true
		);

	}
	add_action( 'wp_enqueue_scripts', 'imaginaction_scripts',99 );



	function imaginaction_styles() {
		
		wp_enqueue_style(
			'googlefont',
			'//fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,500italic,700italic,700',
			false,
			null,
			"all"
       );

		wp_enqueue_style(
			'bootstrap-custom',
			get_template_directory_uri().'/css/bootstrap.min.css',
			false,
			null,
			'screen'
		);

		wp_enqueue_style(
			'fancybox-css',
			get_template_directory_uri().'/bower_components/fancybox/source/jquery.fancybox.css',
			false,
			null,
			'screen'
		);
		wp_enqueue_style(
			'imaginaction-style',
			get_template_directory_uri().'/css/style.min.css',
			false,
			null,
			'screen'
		);



	}
	add_action( 'wp_enqueue_scripts', 'imaginaction_styles',100 );


	function medias_sociaux_func(){
		global $translation_name;

		$transientLabel = strtoupper($translation_name)."_socialmedia";
			set_transient( $transientLabel,"",0 );
		$this_content = get_transient( $transientLabel );
		if (empty($this_content)) {
			ob_start();

		
			if(get_field("medias_sociaux","option")){ ?>
				<ul>
					<?php while (has_sub_field("medias_sociaux","option")): ?>
						<li><a href="<?php the_sub_field("social_media_link") ?>" class="" target="_blank" title="<?php the_sub_field("social_media_name") ?>"><span class="icons <?php the_sub_field("social_media_class") ?>"></span><span class="content display-none"><?php the_sub_field("social_media_name") ?></span></a></li>
					<?php endwhile ?>
				<?php
				// while (has_sub_field("medias_sociaux","option")) {
				// 	$social_icons .= "\t<li><a href=\"".get_sub_field("social_media_link")."\" class=\"\" target=\"_blank\" title=\"".get_sub_field("social_media_name")."\"><span class=\"icons ".get_sub_field("social_media_class")."\"></span><span class=\"content\">".get_sub_field("social_media_name")."</span></a></li>\n";
				// }
				?>
				</ul>
			<?php }

			$this_content = ob_get_contents();
			ob_end_clean();

			// set_transient($transientLabel,$this_content,60*15);

		}

		if ($this_content) {
			echo $this_content;
		} else {
			return false;
		}
		
	}
	add_shortcode('medias_sociaux','medias_sociaux_func');

	


	function templatebang_excerpt_length( $length ) {
		// echo "---".get_query_var("paged");
		if (!is_admin() && is_post_type_archive( array("events", "blog","careers") ) && is_main_query()) {
			return 15;
		}
		if (!is_admin() && is_post_type_archive( array("publications") ) && is_main_query()) {
			// return -1;
			return 25;
		}

		return 40;

		// if( (is_page_template('section.php')) ){
		// 	return 16;
		// /*}elseif(is_post_type_archive(array("business-blog","personal-blog"))){
		// 	return 16;*/

		// }elseif( (is_front_page() && get_post_type()==="services") || (is_post_type_archive(array("case_studies","documentation")) && $latestpost==true)){
		// 	return 34;
		// }elseif (!is_admin() && is_search()){
		// 	return 23;
		// }elseif((is_front_page() && get_post_type()==='news')){
		// 	return 35;
		// }else{
		// 	return 40;
		// }
	}
	// add_filter( 'excerpt_length', 'templatebang_excerpt_length',999);


	function templatebang_comment_excerpt($comment,$length=10){
		$comment = get_comment( $comment );
		$comment = strip_tags($comment->comment_content);
		$blah = explode(' ', $comment);

		if (count($blah) > $length) {
			$k = $length;
			$use_dotdotdot = 1;
		} else {
			$k = count($blah);
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ($i=0; $i<$k; $i++) {
			$excerpt .= $blah[$i] . ' ';
		}
		$excerpt .= ($use_dotdotdot) ? '...' : '';

		echo apply_filters('get_comment_excerpt', $excerpt);
		#return $excerpt;
	}
	#add_filter("comment_excerpt","templatebang_comment_excerpt",10,2);

	function templatebang_continue_reading_link() {
		global $translation_name, $inside_project, $target_blank;


		if(is_search() || is_post_type_archive( array("publications") )){
			return;
			// return ' <a href="'. esc_url( get_permalink() ) . '" class="">' . __( 'Continue reading <span class="icon-arrow-right-thin icons"></span>', $translation_name ) . '</a>';

			return  ( '&nbsp;<a href="'. esc_url( get_permalink() ) . '" class="read-more" '.($target_blank===true?'target="_blank"':null).'><span class="content">'.__("Read more", $translation_name).'</span></a>' );

		}elseif(is_post_type_archive( array("getquote","personal-insurance","personal-blog","business-blog","news") ) || (get_post_type()==="claims" && !is_post_type_archive("claims"))){
			return '&nbsp;<span class="icon-play"></span>';
		}elseif((get_post_type()==="news" && is_front_page()) || (is_tax() && get_post_type()==="services") || (is_tax() && get_post_type()==="markets") || is_post_type_archive(array("case_studies","documentation")) || (get_post_type()==="documentation" || get_post_type()==="case_studies") || ( (get_post_type() === "services" || get_post_type() === "markets") && is_page_template("service_markets-archive.php")) ){
			return;
		}elseif(get_post_type()==="post"){
			return  ( '<a href="'. esc_url( get_permalink() ) . '" class="read-more" '.($target_blank===true?'target="_blank"':null).'><span class="content">'.__("Read more", $translation_name).'</span><span class="icon-arrow-right icons"></span></a>' );
		}elseif (is_front_page()&&get_post_type()==="feature") {
			# code...
			return '<p><a href="'. esc_url( get_permalink() ) . '" class="read-more">' . __( 'Continue reading', $translation_name ) . '</a></p>';
		}else{
			return '<span class="display-block read-more">'.__("Learn more", $translation_name ).'</span>';
			// return ' <a href="'. esc_url( get_permalink() ) . '" class="icon-plus-sign">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', $translation_name ) . '</a>';
		}

	}



	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
	 *
	 * To override this in a child theme, remove the filter and add your own
	 * function tied to the excerpt_more filter hook.
	 */
	function templatebang_auto_excerpt_more( $more ) {
		return '&nbsp;&hellip;' . templatebang_continue_reading_link();
	}
	add_filter( 'excerpt_more', 'templatebang_auto_excerpt_more' );


	/**
	 * Adds a pretty "Continue Reading" link to custom post excerpts.
	 *
	 * To override this link in a child theme, remove the filter and add your own
	 * function tied to the get_the_excerpt filter hook.
	 */
	function templatebang_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= templatebang_continue_reading_link();
		}
		return $output;
	}
	add_filter( 'get_the_excerpt', 'templatebang_custom_excerpt_more' );



	function hwl_home_pagesize($query){
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		if (!is_admin() && (is_wc_endpoint_url("view-order") || ( is_post_type_archive( array("blog","careers") ))  ) && $query->is_main_query() ){
			$query->query_vars['paged'] = $paged;
			$query->query_vars['posts_per_page']=5;


			return;
		}
		if (!is_admin() && is_post_type_archive("events") && $query->is_main_query() && (get_query_var( "calen_year" )==="" && get_query_var( "calen_month" )==="" && get_query_var( "calen_day" )==="")) {
			$events_meta = array();
			$query->query_vars['paged'] = $paged;
			// $query->query_vars['posts_per_page']=1;

			$events_meta[] = array(
				"key" => "event_start_date",
				"value" => date("Ymd"),
				"type" => "date",
				"compare" => ">=",
			);


			$query->set("orderby", "meta_value");
			$query->set("meta_key", "event_start_date");
			$query->set("meta_type", "date");
			$query->set("order", "ASC");
			// print_r($query->get("meta_query"));
			if ($query->get("meta_query")) {
				$meta = array_merge($query->get("meta_query"), $events_meta);
			}else{
				$meta = $events_meta;
			}
			$query->set("meta_query", $meta );
			return;
		}
		// echo get_post_type();
		// exit;
		if (!is_admin() && get_query_var( "post_type" )==="events" && $query->is_main_query() && (get_query_var( "calen_year" )!=="" && get_query_var( "calen_month" )!=="" && get_query_var( "calen_day" )!=="")) {

			$events_meta = array();
			$query->query_vars['paged'] = 1;
			$query->query_vars['posts_per_page']=-1;

			$events_meta[] = array(
				"key" => "event_start_date",
				"value" => date("Ymd",strtotime(get_query_var('calen_year').get_query_var('calen_month').get_query_var('calen_day'))),
				"type" => "date",
				"compare" => ">=",
			);
			$events_meta[] = array(
				"key" => "event_start_date",
				"value" => date("Ymd",strtotime(get_query_var('calen_year').get_query_var('calen_month').get_query_var('calen_day'))),
				"type" => "date",
				"compare" => "<=",
			);


			$query->set("orderby", "meta_value");
			$query->set("meta_key", "event_start_date");
			$query->set("meta_type", "date");
			$query->set("order", "ASC");
			// print_r($query->get("meta_query"));
			if ($query->get("meta_query")) {
				$meta = array_merge($query->get("meta_query"), $events_meta);
			}else{
				$meta = $events_meta;
			}
			$query->set("meta_query", $meta );
			return;
		}
		if (!is_admin() && (is_post_type_archive( "programs" ) && get_query_var( 'show_programs' )==='true' && get_query_var( 'product_category' ) !=='') ){

			$query->query_vars['paged'] = $paged;
			$query->query_vars['posts_per_page']=5;
			// exit;
			return;

		}

		if (!is_admin() && $query->is_main_query() && is_post_type_archive( array("publications") )) {
			$query->set('publications'.'-search', $_GET['publications'.'-search']);

			$query->set("s", get_query_var("publications"."-search"));
			// $query->set("post_type", "publications");
			// $query->set("suppress_filters", 0);

			$query->query_vars['paged'] = $paged;
			$query->query_vars['posts_per_page']=5;
		}

		if (!is_admin() && is_tax(array("product_cat")) && $query->is_main_query() ){
			// $query->query_vars['paged'] = $paged;
			// $query->set("posts_per_page",1);



			$query->set('filter_training-type', $_GET['filter_training-type']);

			$query->set('filter_expertise', $_GET['filter_expertise']);
			$query->set('filter_level', $_GET['filter_level']);
			$query->set('filter_location', $_GET['filter_location']);
			$query->set('filter_begin', $_GET['filter_begin']);
			$query->set('filter_end', $_GET['filter_end']);

			if (get_query_var("filter_training-type")!=="" && wp_get_referer()!==get_query_var("filter_training-type")) {
				// wp_get_referer();
				$new_url = add_query_arg(array(
					"filter_expertise" => get_query_var("filter_expertise"),
					"filter_level" => get_query_var("filter_level"),
					"filter_location" => get_query_var("filter_location"),
					"filter_begin" => get_query_var("filter_begin"),
					"filter_end" => get_query_var("filter_end"),
					) ,
					get_query_var("filter_training-type")
				);
				wp_redirect($new_url);
				exit;

			}

			return;
		}

		if (!is_admin() && is_page_template( "page-templates/sidebar-training-search.php" )) {
			
			exit;
		}
	}
	// add_action('pre_get_posts', 'hwl_home_pagesize', 1);


	function change_mce_options($initArray) {
		$initArray['entities'] = '160,nbsp,38,amp,60,lt,62,gt';
		#$initArray['theme_advanced_buttons2_add'] = 'styleselect';
		
		return $initArray;
	}
	add_filter('tiny_mce_before_init', 'change_mce_options');



	function wpb_last_menu_class($items, $args) {
		global $menu_item_dernier, $menu_item_dernier_sub;
		// print_r($menu_item_dernier_sub);
		$last_child_sub = null;

		$last_child = array_pop($menu_item_dernier);

		if ($args->theme_location !== 'woocommerce-logged') {
			foreach($items as $k => &$item){
				if($item->menu_item_parent!=0 && empty($last_child_sub) && isset($menu_item_dernier_sub[$item->menu_item_parent])){
					$last_child_sub = array_pop($menu_item_dernier_sub[$item->menu_item_parent]);
					unset($menu_item_dernier_sub[$item->menu_item_parent]);
				}

				if($item->ID==$last_child || $item->ID==$last_child_sub){
					$items[$k]->classes[]='last';
					$last_child_sub=null;
				}
			}
		}

		return $items;
	}
	add_filter('wp_nav_menu_objects', 'wpb_last_menu_class', 11,2);


	function wpb_first_and_last_menu_class($items, $args) {
		global $menu_item_dernier, $menu_item_dernier_sub;
		// print_r($items);
		if ($args->theme_location !== 'woocommerce-logged') {

			$items[1]->classes[] = 'first';

		}
			foreach($items as &$item){
				if($item->menu_item_parent==0){
					$menu_item_dernier[]=$item->ID;
				}
				if($item->menu_item_parent!=0){
					$menu_item_dernier_sub[$item->menu_item_parent][]=$item->ID;
				}
			}

	   # $items[count($items)]->classes[] = 'last';

		return $items;
	}
	add_filter('wp_nav_menu_objects', 'wpb_first_and_last_menu_class',10,2);



	function template_body_classes( $classes ) {
		global $post,$detect;

		$classes[] ='lang-'.ICL_LANGUAGE_CODE;

		if ($detect->isMobile()) {
			$classes[] = 'is-mobile';
		}


		return $classes;
	}
	// add_filter( 'body_class', 'template_body_classes' );


	// if( function_exists('acf_add_options_page') ) {
	
	// 	acf_add_options_page(array(
	// 		'page_title' 	=> __('Theme General Settings',$translation_name),
	// 		'menu_title'	=> __('Theme Settings',$translation_name),
	// 		'menu_slug' 	=> 'theme-general-settings',
	// 		'capability'	=> 'manage_options',
	// 		'redirect'		=> false,
	// 		'position'		=> '60.5',
	// 		'icon_url'		=> 'dashicons-analytics'
	// 	));
		
	// 	// acf_add_options_sub_page(array(
	// 	// 	'page_title' 	=> 'Theme Header Settings',
	// 	// 	'menu_title'	=> 'Header',
	// 	// 	'parent_slug'	=> 'theme-general-settings',
	// 	// ));
		
	// 	// acf_add_options_sub_page(array(
	// 	// 	'page_title' 	=> 'Theme Footer Settings',
	// 	// 	'menu_title'	=> 'Footer',
	// 	// 	'parent_slug'	=> 'theme-general-settings',
	// 	// ));
	
	// }



}
endif; // imaginaction_setup
add_action( 'after_setup_theme', 'imaginaction_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function imaginaction_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', $translation_name ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget woocommerce-tabs %2$s"><article class="panels">',
		'after_widget'  => '</article></aside>',
		'before_title'  => '<div class="panels__title collapse-trigger"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
}
add_action( 'widgets_init', 'imaginaction_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
// require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';

function custom_field_excerpt($title) {
	global $post;
	$text = get_field($title);
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 20; // 20 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}


function customtemplate_paginate($nav_id, $query = null, $issearch = false){
	global $wp_query, $post, $translation_name;
	#print_r($wp_query->query_vars["paged"]);
	#print_r(get_post_type_object(get_post_type()));
	$url = explode("/",$_SERVER['REQUEST_URI']);
	array_shift($url);
	array_pop($url);

	$big = 999999999; // need an unlikely integer

	if($query==NULL){
		$query = $wp_query;
	}
	// print_r($query);
	// echo $query->found_posts;

	/*if($query->query_vars["paged"]>1){
		array_pop($url);
		array_pop($url);
	}*/

	$url = implode("/",$url);
	#echo get_query_var("s");

	// print_r($wp_query)

	if ( $query->max_num_pages > 1 ) :

		$pagination = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			// 'base'         => esc_url( str_replace( $big, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( $big ) ) ) ) ),
			// 'format'       => '',
			'current' => max( 1, get_query_var('paged') ),
			// 'total' => 50,
			'total' => $query->max_num_pages,
			// 'show_all' => true,
			'prev_next'=>true,
			'prev_text'=>"<span class=\"icon-arrow-left-thin icons\"></span>".sprintf('<span class="hidden">%s</span>',__("Previous",$translation_name)),
			'next_text'=>sprintf('<span class="hidden">%s</span>',__("Next",$translation_name))."<span class=\"icon-arrow-right-thin icons\"></span>",
			'type' => 'plain',
		);
		// print_r($pagination); test

		?>

		<nav id="<?php echo $nav_id; ?>" class="navigation-pages clearfix clear-all">
			<!-- <strong>Page:</strong> -->
			<?php if ($issearch): ?>
			<div class="search-results"><?php printf(
					_n( '%1$s result', '%1$s results', $query->found_posts, $translation_name ),
					number_format_i18n($query->found_posts)
				); ?></div>
			<?php endif ?>
			<div class="pagination"><?php echo paginate_links( $pagination ); ?></div>
		</nav>


	<?php endif;


}


function mbpc_remove_menu_items() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
	remove_menu_page('tools.php');
}
add_action('admin_menu', 'mbpc_remove_menu_items');


function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}
if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['icl_dashboard_widget']);


	wp_add_dashboard_widget( 'example_dashboard_widget', 'Example Dashboard Widget', 'example_dashboard_widget_function' );

	// print_r($wp_meta_boxes);

}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


function example_dashboard_widget_function(){
	$dashboard = '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum odit quasi quam, hic harum, facere dolor deserunt deleniti! Illum eveniet aperiam porro beatae molestiae temporibus ipsam dolorum alias sunt nulla.</p>';

	echo $dashboard;
}



add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );
function mycustom_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );

	return $form;
}

function cf7_custom_update_subject($cf7){
	global $post;

	/* So, use prop() method to access them. */
	$form = $cf7->prop( 'form' );
	 
	/* To set the properties, use set_properties() method, like this: */
	$mail = $cf7->prop( 'mail' );

	$submission = WPCF7_Submission::get_instance();
	if ( $submission ) {
	    $posted_data = $submission->get_posted_data();
	}
	$mail['subject'] = $posted_data['encan_titre'];
	$cf7->set_properties( array( 'mail' => $mail ) );


	// $fields = get_fields($posted_data['encan_post_id']);
	update_sub_field(array(
		'encan_item',
		$posted_data['encan_rangee']+1,
		'encan_etat'
	), $posted_data["valeur_mise"], $posted_data['encan_post_id']);

	return;
}
add_action('wpcf7_before_send_mail', 'cf7_custom_update_subject');



function wpcf7_encan_titre(){
	global $translation_name,$post,$row_num;

	$field = "field_556e5ae0ea674";
	$all_fields = get_fields();

	$hidden = "<input type=\"hidden\" name=\"encan_titre\" value=\"".$all_fields["encan_item"][$row_num]["encan_titre"]."\">\n";
	$hidden .= "<input type=\"hidden\" name=\"encan_rangee\" value=\"".$row_num."\">";
	$hidden .= "<input type=\"hidden\" name=\"encan_post_id\" value=\"".$post->ID."\">";

	return $hidden;
}
wpcf7_add_shortcode( 'encan', 'wpcf7_encan_titre');

function wpcf7_titre_encan(){
	global $translation_name,$post,$row_num;

	$field = "field_556e5ae0ea674";
	$all_fields = get_fields();

	$titre ="<h3>".$all_fields["encan_item"][$row_num]["encan_titre"]."</h3>";

	return $titre;
}
wpcf7_add_shortcode( 'titre_encan', 'wpcf7_titre_encan');


// apply_filters( );
add_filter('wpcf7_validate_number*', 'wpcf7_check_valeur_encan',55,2);
function wpcf7_check_valeur_encan( $result, $tag ) {
	global $post;
	$submission = WPCF7_Submission::get_instance();
	if ( $submission ) {
	    $posted_data = $submission->get_posted_data();
	}

	$fields = get_fields($posted_data['encan_post_id']);

	if ($fields['encan_item'][$posted_data['encan_rangee']]['encan_etat'] >= $posted_data["valeur_mise"]) {
		$result->invalidate( $tag, "Désolé, votre mise doit être plus élevée que <strong>".$fields['encan_item'][$posted_data['encan_rangee']]['encan_etat']."$</strong>");
	}

	return $result;
}


add_filter('wpseo_opengraph_author_facebook', '__return_false');
add_filter('wpseo_opengraph_tags', '__return_false');
add_filter('wpseo_opengraph_category', '__return_false');
add_filter('wpseo_og_article_section', '__return_false');
add_filter('wpseo_og_article_published_time', '__return_false');
add_filter('wpseo_og_article_modified_time', '__return_false');

add_filter('wpseo_metabox_prio', 'seo_metabox_priority');
function seo_metabox_priority($priority){
	return '0';
}


/* MAIN NAVIGATION WALKER
=================================================================== */
class main_nav_walker extends Walker_Nav_Menu{
	
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $parent_id,$translation_name;

		preg_match_all("/menu\-item\-(?P<digit>\d+)/", $output, $matches);

        $parent_id = end($matches['digit']);
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"mega-menu clearfix display-none\">\n";

		$fetch_menu = (wp_get_nav_menu_items("principal"));
		// get the specific menu item
		$item_menu = wp_list_filter( $fetch_menu, array( 'ID' => $parent_id));
		$key = key($item_menu);
		// print_r($key);
		// print_r($item_menu);
		if ($item_menu[$key]->type==="taxonomy") {
			// print_r($item_menu[$key]);
			$text_block = get_field("menu_text",$item_menu[$key]->object."_".$item_menu[$key]->object_id);
			$this_permalink = get_term_link((int)$item_menu[$key]->object_id, 'product_cat');
			// echo "---".$this_permalink."---";
			// $this_permalink = '#';
		}else{
			$text_block = get_field("menu_text",$item_menu[$key]->object_id);
			$this_permalink = get_permalink($item_menu[$key]->object_id);
		}
		// echo $this_permalink;
		if (!empty($text_block)) {
			$output .= "\n\t"."<div class=\"mega-menu__extra-content fleft\" data-mh=\"nav-item-group-".$parent_id."\">";
			$output .= "\n\t"."<a class=\"display-block height-full\" href=\"".esc_url($this_permalink)."\">";
			$output .= "\n\t\t"."<div class=\"mega-menu__extra-content-header\"><span class=\"mega-menu__extra-content-title\">".$item_menu[$key]->title."</span></div>";
			$output .= "\n\t\t".$text_block."";
			$output .= "\n\t\t<span class=\"btn-border\">".__("Access this section",$translation_name)."</span>\n";
			$output .= "\n\t"."</a>";
			$output .= "\t"."</div>"."\n";
		}



		$output .= "\n$indent<ul class=\"sub-menu flefts\" data-mh=\"nav-item-group-".$parent_id."\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
		$output .= "$indent</div>\n";
	}

}

