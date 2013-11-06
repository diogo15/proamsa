<?php
/**
 * @package proamsa_theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<!-- get featured image -->
	

    
	<div class="post-img"><a href="<?php echo get_post_permalink(); ?>">
    <?php   
    if ( has_post_thumbnail() ) {
	the_post_thumbnail();
}
else {
	echo '<img src="' . IMG_DIR . '/default-img.jpg" />';
}
?>
    </a></div>
    
    <header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		
        <div class="entry-meta">
			<?php proamsa_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
       
	</header><!-- .entry-header -->
<!--  
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
     //-->
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'proamsa_theme' ) ); ?>
 
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'proamsa_theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'proamsa_theme' ) );
				if ( $categories_list && proamsa_theme_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'proamsa_theme' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'proamsa_theme' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'proamsa_theme' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'proamsa_theme' ), __( '1 Comment', 'proamsa_theme' ), __( '% Comments', 'proamsa_theme' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'proamsa_theme' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

<div class="clear"></div>