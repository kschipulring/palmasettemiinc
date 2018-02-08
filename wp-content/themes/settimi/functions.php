<?php
/**
 *
 * @package settimi
 */

global $settimi_site_layout;
$settimi_site_layout = array(
					'mz-sidebar-left' =>  esc_html__('Left Sidebar','settimi'),
					'mz-sidebar-right' => esc_html__('Right Sidebar','settimi'),
					'no-sidebar' => esc_html__('No Sidebar','settimi'),
					'mz-full-width' => esc_html__('Full Width', 'settimi')
					);
$settimi_thumbs_layout = array(
					'landscape' =>  esc_html__('Landscape','settimi'),
					'portrait' => esc_html__('Portrait','settimi')
					);

if ( ! function_exists( 'settimi_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function settimi_setup() {

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'settimi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'settimi-slider-thumbnail', 900, 515, true );
	add_image_size( 'settimi-large-thumbnail', 1140, 640, true );
	add_image_size( 'settimi-landscape-thumbnail', 735, 490, true );
	add_image_size( 'settimi-portrait-thumbnail', 735, 1100, true );
	add_image_size( 'settimi-author-thumbnail', 170, 170, true );
	add_image_size( 'settimi-small-thumbnail', 100, 80, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-menu' => __( 'Top Menu' ),
		'primary' => esc_html__( 'Primary Menu', 'settimi' ),
	) );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1140; /* pixels */
	} 

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'settimi_custom_background_args', array(
		'default-color' => 'FFFFFF',
		'default-image' => '',
	) ) );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 140,
		'width'       => 500,
		'flex-height' => true,
	) );


	//* Add support for custom flexible header
	/*add_theme_support( 'custom-header', array(
		'flex-width'    => true,
		'width'           => 260,
		'flex-height'    => true,
		'height'          => 100,
		'header-selector' => '.site-title a',
		'header-text'     => false
	 
	) );*/

}
endif; // settimi_setup
add_action( 'after_setup_theme', 'settimi_setup' );


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
if ( ! function_exists( 'settimi_the_custom_logo' ) ) :
function settimi_the_custom_logo() {
	// Try to retrieve the Custom Logo
	$output = '';
	if ((function_exists('get_custom_logo'))&&(has_custom_logo()))
		$output = get_custom_logo();

		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
	if (empty($output))
		$output = '<hgroup><h1><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_attr(get_bloginfo('name')) . '</a></h1><div class="description">'.esc_attr(get_bloginfo('description')).'</div></hgroup>';

	echo $output;
}
endif; // sanremo_custom_logo


/*
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if ( ! function_exists( 'settimi_content_bootstrap_classes' ) ) :
function settimi_content_bootstrap_classes() {
	if ( is_page_template( 'template-fullwidth.php' ) ) {
		return 'col-md-12';
	}
	return 'col-md-8';
}
endif; // settimi_content_bootstrap_classes


/*
 * Generate categories for slider customizer
 */
function settimi_cats() {
	$cats = array();
	$cats[0] = esc_html__("All", "settimi");
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}

/*
 * generate navigation from default bootstrap classes
 */
include( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

if ( ! function_exists( 'settimi_header_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function settimi_header_menu($paramArr=array()) {

	$settimi_menu_center = get_theme_mod( 'settimi_menu_center' );

	/* display the WordPress Custom Menu if available */
	$settimi_add_center_class = "";
	if ( true == $settimi_menu_center ) {
		$settimi_add_center_class = " navbar-center";
	}

	$defaultArr = array(
		'theme_location'    => 'primary',
		'depth'             => 3,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse'.$settimi_add_center_class,
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'settimi_bootstrap_navwalker::fallback',
		'walker'            => new settimi_bootstrap_navwalker()
	);

	//$finalParamArr = array_merge($defaultArr, $paramArr);

	$finalParamArr = array();

	foreach( $defaultArr as $key=>$val ){
		if( array_key_exists ($key, $paramArr ) && $paramArr[$key] !== null ){
			$finalParamArr[$key] = $paramArr[$key];
		}else{
			$finalParamArr[$key] = $defaultArr[$key];
		}
	}

	wp_nav_menu( $finalParamArr );
} /* end header menu */
endif;

/*
 * Register Google fonts for theme.
 */
if ( ! function_exists( 'settimi_fonts_url' ) ) :
/**
 * Create your own settimi_fonts_url() function to override in a child theme.
 *
 * @since settimi 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function settimi_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	//$subsets   = 'all';

	//https://fonts.googleapis.com/css?directory=3&family=Proxima+Nova:400,600,700,800|Montserrat:400,700|Lora:400,400i,700,700i&subset=latin,latin-ext&text=+,.-_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghiklmnoprstuvwyz1234567890

	$fonts[] = 'Lora:400,400i,700,700i';
	$fonts[] = 'Montserrat:400,700';
	//$fonts[] = 'Proxima+Nova:400,600,700,800';
	//$fonts[] = 'Proxima+Nova';
	$fonts[] = 'Muli';

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			//'family' => implode( '|', $fonts ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/*
 * load css/js
 */
function settimi_scripts() {

	// Add Google Fonts
	wp_enqueue_style( 'settimi-webfonts', settimi_fonts_url(), array(), null, null );

	// Add Bootstrap default CSS
	//wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/src/css/bootstrap.min.css' );
	//wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/src/css/font-awesome.min.css' );

	// Add main theme stylesheet
	wp_enqueue_style( 'settimi-style', get_stylesheet_uri() );
	//wp_enqueue_style( 'settimi-style', get_template_directory_uri() . '/dist/css/style.dist.css' );

	// Add JS Files
	//wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
	//wp_enqueue_script( 'settimi-js', get_template_directory_uri().'/dist/js/bundle.js', array('jquery') );
	wp_enqueue_script( 'settimi-js', get_template_directory_uri().'/dist/js/bundle.js' );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'settimi_scripts' );

/*
 * Add custom colors css to header
 */
if (!function_exists('settimi_custom_css_output'))  {
	function settimi_custom_css_output() {

		$settimi_accent_color = get_theme_mod( 'settimi_accent_color' );
		$settimi_links_color = get_theme_mod( 'settimi_links_color' );
		$settimi_hover_color = get_theme_mod( 'settimi_hover_color' );

		$outStr = '<style type="text/css" id="settimi-custom-theme-css">';

		if ( $settimi_accent_color != "") {
			$outStr .= '.widget-title span { box-shadow: ' . esc_attr($settimi_accent_color) . ' 0 -4px 0 inset;}';
		}

		if ( $settimi_links_color != "") {
			$outStr .= 'a, .page-title { color: ' . esc_attr($settimi_links_color) . '; }' .
			'::selection { background-color: ' . esc_attr($settimi_links_color) . '; }' .
			'.section-title h2:after { background-color: ' . esc_attr($settimi_links_color) . '; }' .
			'.page-numbers .current, .widget_search button { background-color: ' . esc_attr($settimi_links_color) . '; border-color: ' . esc_attr($settimi_links_color) . '; }';
		}
		if ( $settimi_hover_color != "" ) {
			$outStr .= 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background-color: ' . esc_attr($settimi_hover_color) . '; border-color: ' . esc_attr($settimi_hover_color) . '; }' .
			'.comment-reply-link:hover, .comment-reply-login:hover, .page-numbers li a:hover { background-color: ' . esc_attr($settimi_hover_color) . '; border-color: ' . esc_attr($settimi_hover_color) . '; }' .
			'.post-share a:hover, .post-header span a:hover, .post-meta .meta-info a:hover { border-color: ' . esc_attr($settimi_hover_color) . '; }' .
			'a:hover, a:focus, a:active, a.active, .mz-social-widget a:hover { color: ' . esc_attr($settimi_hover_color) . '; }';
		}
		if ( $settimi_buttons_hover_color != "" ) {
			$outStr .= '.read-more a:hover, .null-instagram-feed p a:hover { background-color: ' . esc_attr($settimi_buttons_hover_color) . '; border-color: ' . esc_attr($settimi_buttons_hover_color) . '; }' .
			'.posts-navigation a:hover { background-color: ' . esc_attr($settimi_buttons_hover_color) . '; border-color: ' . esc_attr($settimi_buttons_hover_color) . '; }' .
			'.nav>li>a:focus, .nav>li>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover { background-color: ' . esc_attr($settimi_buttons_hover_color) . '; }' .
			'#back-top a:hover { background-color: ' . esc_attr($settimi_buttons_hover_color) . '; }';
		}

		$outStr .= '</style>';

		echo $outStr;
	}
}
add_action( 'wp_head', 'settimi_custom_css_output');

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';

/*
 * Register widget areas.
 */

// if no title then add widget content wrapper to before widget
add_filter( 'dynamic_sidebar_params', 'settimi_check_sidebar_params' );
function settimi_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0][ 'after_widget' ] == '</div></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) )
		$params[0][ 'before_widget' ] .= '<div class="content">';

	return $params;
}

function settimi_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'settimi' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'settimi' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'settimi' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Appears in the footer section of the site.', 'settimi' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'settimi' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Appears in the footer section of the site.', 'settimi' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'settimi' ),
		'id'            => 'footer-widget-3',
		'description'   => __( 'Appears in the footer section of the site.', 'settimi' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Full Width Footer', 'settimi' ),
		'id'            => 'footer-wide-widget',
		'description'   => __( 'Full width footer area for Instagram, etc. Appears in the footer section after widgets.', 'settimi' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );

}
add_action( 'widgets_init', 'settimi_widgets_init' );

/*
 * Misc. functions
 */

/**
 * Footer credits
 */
function settimi_footer_credits() {
	$settimi_footer_text = get_theme_mod( 'settimi_footer_text' );
	?>
	<div class="site-info">
	<?php if ($settimi_footer_text == '') { ?>
	&copy; <?php echo date_i18n( __( 'Y', 'settimi' ) ); ?> <?php bloginfo( 'name' ); ?><?php esc_html_e(',  Palma Settimi, Inc. All rights reserved.', 'settimi'); ?>
	<?php } else { echo esc_html( $settimi_footer_text ); } ?>
	</div><!-- .site-info -->

	<?php
	printf( esc_html__( 'theme by %1$s Powered by %2$s', 'settimi' ) , '<a href="https://3ringprototype.com" target="_blank">Three Ring Design</a>, modified from theme originally created by <a href="https://moozthemes.com/" target="_blank">MOOZ Themes</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}
add_action( 'settimi_footer', 'settimi_footer_credits' );

/* Wrap Post count in a span */
add_filter('wp_list_categories', 'settimi_cat_count_span');
function settimi_cat_count_span($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}



/*
------------------------------------------------------------------------
Copyright Ryan Hellyer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for.
 * @return array                 Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {

	if ( 'dns-prefetch' == $relation_type ) {

		// Strip out any URLs referencing the WordPress.org emoji location
		$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
		foreach ( $urls as $key => $url ) {
			if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
				unset( $urls[$key] );
			}
		}

	}

	return $urls;
}