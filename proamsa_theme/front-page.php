<?php
/**
 * The front page template file.
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<!-- Primera consulta para cargar la pagina de quienes somos -->
        
        
		<?php $primer_query = new WP_Query( 'page_id=83' ); ?>

		<div class="quienes-somos-frontpage">
        
		<?php if ( $primer_query->have_posts() ) : ?>
			<?php while ( $primer_query->have_posts() ) : $primer_query->the_post(); ?>
			
            <h2>Quienes Somos</h2>
            	 <div class="quienes-somos-imagen">  
                    <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php echo get_post_permalink(); ?>">
                        <?php   
                        if ( has_post_thumbnail() ) 
                            the_post_thumbnail();
                        else 
                            echo '<img src="' . IMG_DIR . '/default-img.jpg" />';
                        ?>            
                    </a>                            
				</div>
			<?php the_excerpt(); ?>
                
            <button type="button" class="quienes-somos" value="leer mas">
            <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php the_permalink(); ?>">
                <?php _e('VER MÁS...','proamsa_theme') ?>
            </a>
            </button>
			<?php endwhile; ?>
            
		<?php endif; ?>
        </div>
        
        
        <!-- Segunda consulta para cargar todas las noticias -->
        
        
        <?php $segunda_query = new WP_Query( array('post_type' => 'post') ); ?>
        
        <div class="noticias-frontpage">
        
        <span class="arrow-prev"></span>
        <span class="arrow-next"></span>
            
        <h2><?php _e('Noticias','proamsa_theme') ?></h2>
            
            <div id="news-container" class="news-wrapper">
                <?php if ( $segunda_query->have_posts() ) : ?>
                    <?php while ( $segunda_query->have_posts() ) : $segunda_query->the_post(); ?>
                                <div class="front-page-post">
                                    <h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></h3>
                                    <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php echo get_post_permalink(); ?>">
                                <?php   
                                
                                if ( has_post_thumbnail() ) 
                                    the_post_thumbnail();
                                else 
                                    echo '<img src="' . IMG_DIR . '/default-img.jpg" />';
                                
                                ?>
                            </a>
                                    <?php the_excerpt(); ?>
                                  <button type="button" class="post-leer-mas" value="leer mas">
                                    <a rel="address:/<?php echo basename(get_permalink()) ?>" href="<?php the_permalink(); ?>">
                                        <?php _e('VER MÁS...','proamsa_theme') ?>
                                    </a>
                                  </button>
                            </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>   
            
        </div>
        <div class="clear"></div>
        
        
        <?php wp_reset_postdata(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>