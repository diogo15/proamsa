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

	add_theme_support( 'post-thumbnails' );

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
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Barra de Compa&ntilde;ias', 'proamsa_theme' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="logo-company %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="company-title">',
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
	wp_enqueue_style( 'nivo-lightbox', THEME_DIR . '/css/nivo-lightbox.css' );
	wp_enqueue_style( 'nivo-lightbox-default', THEME_DIR . '/nivo-lightbox/default/default.css' );
	//wp_enqueue_style( 'superfish', THEME_DIR . '/css/superfish.css' );
	
	
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'hoverIntent', JS_DIR . '/hoverIntent.js', array(), '1'  );
	wp_enqueue_script( 'skip-link-focus-fix', JS_DIR . '/skip-link-focus-fix.js', array(), '1' );	
	wp_enqueue_script( 'supersized-jquery-JS', JS_DIR . '/supersized.3.2.7.min.js', array('jquery'), '1' );
	wp_enqueue_script( 'address-jquery-JS', JS_DIR . '/jquery.address-1.5.min.js', array('jquery'), '1' );
	wp_enqueue_script( 'pajinate', JS_DIR . '/jquery.pajinate.js', array('jquery'), '1'  );
	wp_enqueue_script( 'proamsa-main-JS', JS_DIR . '/main-proamsa.js', array('jquery'), '1'  );
	wp_enqueue_script( 'nivo-lightbox', JS_DIR . '/nivo-lightbox.min.js', array('jquery'), '1'  );
	
	
	//wp_enqueue_script( 'superfish', JS_DIR . '/superfish.js', array(), '1'  );
	
	
	
	
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

require 'admin/proamsa-options.php';


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
	if(!is_numeric($id)) {
		$page = get_page_by_path( $id, null, 'sprint_boxes' );
		$id = $page->ID;	
		$id = icl_object_id($page->ID, 'sprint_boxes', false);
	}

	if($raw) {
		return get_post_field('post_content', $id);
		return get_post_field('post_content', icl_object_id($page->ID, 'sprint_boxes', false));
	}
	
	$content = apply_filters( 'the_content', get_post_field('post_content', $id) );
	$content = apply_filters( 'the_content', get_post_field('post_content', icl_object_id($page->ID, 'sprint_boxes', false)) );
	
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

/*-------------------------------------------------------------------------------------------------------------
 *
 * excerpt lenght changed
 *
 */

function new_excerpt_length($length) {
 return ((is_home())?10:25);
}
add_filter('excerpt_length', 'new_excerpt_length');

/*-------------------------------------------------------------------------------------------------------------
 *
 * function lenguages
 *
 */
 
 function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']) {
    echo '<a href="'.$l['url'].'">';
    echo '<img src="'.IMG_DIR."/".$l['language_code'].'-icon.png" height="38" alt="" width="38" />';
    echo '</a>';
   }
        }
    }
}

/*-------------------------------------------------------------------------------------------------------------
 *
 * post support type
 *
 */
 add_post_type_support( 'page', 'excerpt' );
 
 
 
 
/*-------------------------------------------------------------------------------------------------------------
 *
 * Downloads List
 *
 */
function get_attachment_icons($echo = false){
	$newLine = 0;
	$directoy = get_bloginfo('template_directory');
	$output = "<div class='documentIconsWrapper'> \n";
	$attachments = new Attachments( 'attachments' ); 
	if( $attachments->exist() ) {
	 $output .= '<table>';
	 while( $attachments->get() ) :
	 $extension = $attachments->subtype();
	    $output .= '<tr>';
		$output .= '<td class="file-icon">';
		$output .= "<a href='".$attachments->url()."'>";
		switch ($extension) {
			case 'pdf':
				$output .= "<img src='".$directoy."/img/file-pdf.png'/>";
				break;
			case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
			case 'msword':
				$output .= "<img src='".$directoy."/img/file-doc.png'/>";
				break;
			case 'vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			case 'vnd.ms-excel':
				$output .= "<img src='".$directoy."/img/file-xls.png'/>";
				break;
			case 'vnd.openxmlformats-officedocument.presentationml.presentation':
			case 'vnd.ms-powerpoint':
				$output .= "<img src='".$directoy."/img/file-ppt.png'/>";
				break;
		}		
		$output .= "</a>";
		$output .= '</td>';
		$output .= '<td class="file-desc">';
		$output .= "<a href='".$attachments->url()."'>".$attachments->field( 'title' )."</a>";
		$output .= "<p>".$attachments->field( 'caption' )."</p>";
		$output .= '</td>';
		$output .= '<td class="file-date">';
		$output .= __('Actualizado el: ' , 'proamsa_theme'). $attachments->date();
		$output .= '</td>';
		$output .= '<td class="file-btn">';
		$output .= "<a class='btn_download' href='".$attachments->url()."'>" .__('Descargue Aquí' , 'proamsa_theme')."</a>";
		$output .= '</td>';
		$output .= '</tr>';
	  endwhile;
	  $output .= '</table>';
	}
	
	$output .= "</div>";
	
	if($echo){
		echo $output;
	}

return $output;

}
add_shortcode('mostrarDescargas', 'get_attachment_icons');


/*-------------------------------------------------------------------------------------------------------------
 *
 * Fix for Gallery Issue with uppercase Extension
 *
 */

add_filter('sanitize_file_name', 'lowercase_upload_filename', 10);
function lowercase_upload_filename( $file )
{
	$file = strtolower($file);    
    return $file;
}

/*-------------------------------------------------------------------------------------------------------------
 *
 * resize img post noticias
 *
 */
update_option('medium_crop', 1);
add_image_size( 'homepage-thumb', 300, 190, true );


/*-------------------------------------------------------------------------------------------------------------
 *
 * Custom pass form
 *
 */
 
function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "Necesitas una contraseña para ver el contenido de esta pagina:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Enviar" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );


/*-------------------------------------------------------------------------------------------------------------
 *
 * Custom pass form
 *
 */
 
add_action( 'add_meta_boxes', 'proamsa_meta_boxes' );
add_action( 'save_post', 'proamsa_send_email', 10, 2 );

function proamsa_meta_boxes(){
	add_meta_box(
			'email-post-class',		// Unique ID
			esc_html__( 'Enviar Email', 'proamsa_theme' ),	// Title
			'send_password_meta_box',		// Callback function
			'page',					// Admin page (or post type)
			'side',					// Context
			'high'				// Priority
		);
}

function send_password_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'proamsa_send_email_nonce' ); ?>
	<p>
		<label for="email-pass"><?php _e( "Enviar email con contrasena", 'proamsa_theme' ); ?></label>
		<br />
		<input class="widefat" type="text" name="email-pass" id="email-pass" size="30" />
	</p>
	<?php 
}


function proamsa_send_email( $post_id, $post ) {

	if ( !isset( $_POST['proamsa_send_email_nonce'] ) || !wp_verify_nonce( $_POST['proamsa_send_email_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	
	
	$email = ( isset( $_POST['email-pass'] ) ? $_POST['email-pass'] : '' );
	$pass = $post->post_password;
	$permalink = get_permalink( $post_id ); 

	if ( $email && '' == $meta_value ){
		$headers[] = 'From: Proamsa <info@proamsa.com>';
		$sent = wp_mail( $email, "Acceso Proamsa", "Te han concedido acceso a esta pagina, \n{$permalink} \n utiliza la siguiente contraseña para acceder a ella: \n {$pass}", $headers );
		
	}

}

