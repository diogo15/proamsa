<?php
/**
 * @package proamsa_theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    
	<div class="post-img">
        <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php echo get_post_permalink(); ?>">
            <?php   
            
            if ( has_post_thumbnail() ) 
                the_post_thumbnail('medium');
            else 
                echo '<img src="' . IMG_DIR . '/default-1.png" />';
            
            ?>
        </a>
    </div>
    
    
    <header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		
        <div class="entry-meta">
			<?php proamsa_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
       
	</header><!-- .entry-header -->
    

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php 
		if (is_singular())
			the_excerpt(); 
		else
			the_content(); 
		?>
	</div><!-- .entry-summary -->
	<?php else : ?>

	<div class="entry-content">
		<?php the_excerpt(); ?>
 
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'proamsa_theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
    <button type="button" class="post-leer-mas" value="leer mas">
    <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php the_permalink(); ?>"><?php _e('VER MÁS...' , 'proamsa_theme');?></a>
    </button>

	<footer class="entry-meta">
		
		

		<?php edit_post_link( __( 'Edit', 'proamsa_theme' ), '<span class="edit-link">', '</span>' ); ?>
        
       
	</footer><!-- .entry-meta -->
    
</article><!-- #post-## -->

<div class="clear"></div>