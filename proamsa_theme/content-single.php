<?php
/**
 * @package proamsa_theme
 */
$posts_page_id = get_option( 'page_for_posts');
$posts_page = get_page( $posts_page_id);
$posts_page_title = $posts_page->post_title;
$posts_page_url = get_page_uri($posts_page_id  );
?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php proamsa_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'proamsa_theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<button type="button" class="ver-mas-noticias" value="ver mas noticias">
    <a rel="address:/<?php echo basename($posts_page_url) ?>" href="<?php echo $posts_page_url; ?>"><?php _e('OTRAS NOTICIAS' , 'proamsa_theme');?></a>
    </button>
	
		<?php edit_post_link( __( 'Edit', 'proamsa_theme' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->
