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
	wp_enqueue_script( 'supersized-jquery-JS', JS_DIR . '/supersized.3.2.7.min.js', array(), '1' );
	wp_enqueue_script( 'address-jquery-JS', JS_DIR . '/jquery.address-1.5.min.js', array(), '1' );
	wp_enqueue_script( 'proamsa-main-JS', JS_DIR . '/main-proamsa.js', array(), '1'  );
	
	
	
	
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


/*-------------------------------------------------------------------------------------------------------------
 *
 * Boxes Sub-plugin Sprint Connection
 *
 */
 
add_shortcode( 'box', 'boxes_shortcode');
add_filter( 'manage_edit-sprint_boxes_columns', 'sprint_boxes_columns' );
add_action( 'manage_sprint_boxes_posts_custom_column', 'sprint_boxes_add_columns' );


register_post_type( 'sprint_boxes',
	array(
		'labels' => array(
			'name' => __( 'Boxes' ),
			'singular_name' => __( 'Box' ),
			'add_new_item' => __( 'Add New Box' ),
				
		),
		'public' => true,
		'has_archive' => false,
		)
	);

function get_box($id, $raw = false)
{
	// IF ID IS NOT NUMERIC CHECK FOR SLUG
	if(!is_numeric($id))
	{
		$page = get_page_by_path( $id, null, 'sprint_boxes' );
		$id = $page->ID;
	}

	if($raw)
	{
		return get_post_field('post_content', $id);
	}
	
	$content = apply_filters( 'the_content', get_post_field('post_content', $id) );
	return $content;
}

// Shortcode
function boxes_shortcode($atts)
{
	$id = isset($atts['id']) ? $atts['id'] : false;
	$raw = isset($atts['raw']) ? 1 : 0;
	
	if($id) { 
		return get_box($id, $raw); 
	} else { 
		return false; 
	}
}

// Columns
function sprint_boxes_columns( $columns ) 
{
	return array(
		'cb'       	=> '<input type="checkbox" />',
		'title'    	=> 'Title',		
		'shortcode'	=> 'Shortcode / Function',
		'ID'    	=> 'ID',
		'text'     	=> 'Text'
	);
}

// Column Data
function sprint_boxes_add_columns( $column )
{
	global $post;
	$edit_link = get_edit_post_link( $post->ID );

	if ( $column == 'ID' ) echo strip_tags($post->ID);
	if ( $column == 'text' ) echo strip_tags($post->post_content);	
 	if(	$column == "shortcode") 
 	{
 		echo "
 				[box id={$post->post_name}]  &nbsp/ &nbspget_box('{$post->post_name}');
 			";
 	}	
}

/*-------------------------------------------------------------------------------------------------------------
 *
 * Wordpress Backend Clean
 *
 */
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');

}
add_action('admin_menu', 'disable_default_dashboard_widgets');

/* ---------------------------------------------------------------------- */

function default_unregister_widgets() {
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Pages' );	
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
}

add_action( 'widgets_init', 'default_unregister_widgets' );

/* ---------------------------------------------------------------------- */