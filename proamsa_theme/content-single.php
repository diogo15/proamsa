<?php
/**
 * @package proamsa_theme
 */
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

	
		<?php edit_post_link( __( 'Edit', 'proamsa_theme' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->
