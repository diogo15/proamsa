<?php
/**
 * proamsa_theme functions and definitions
 *
 * @package proamsa_theme
 */

define( 'THEME_DIR', get_bloginfo('template_url'));
define( 'IMG_DIR', THEME_DIR ."/img");
define( 'JS_DIR', THEME_DIR ."/js");

if ( ! function_exists( 'proamsa_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function proamsa_theme_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on proamsa_theme, use a find and replace
	 * to change 'proamsa_theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'proamsa_theme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	//add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'proamsa_theme' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'proamsa_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // proamsa_theme_setup
add_action( 'after_setup_theme', 'proamsa_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function proamsa_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'proamsa_theme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'proamsa_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function proamsa_theme_scripts() {
	wp_enqueue_style( 'proamsa_theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'supersized-jquery-style', THEME_DIR . '/css/supersized.css' );
	wp_enqueue_style( 'oswald-googlefont', 'http://fonts.googleapis.com/css?family=Oswald:300,400' );
	
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'skip-link-focus-fix', JS_DIR . '/skip-link-focus-fix.js', array(), '1' );
	wp_enqueue_script( 'proamsa-main-JS', JS_DIR . '/main-proamsa.js', array(), '1'  );
	wp_enqueue_script( 'supersized-jquery-JS', JS_DIR . '/supersized.3.2.7.min.js', array(), '1' );
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'proamsa_theme_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


