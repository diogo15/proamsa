<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package proamsa_theme
 */
?>

		</div>
        </div>
        
        <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
            <div class="footer-logos">
                <?php dynamic_sidebar( 'sidebar-2' ); ?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        
         <div class="footer-contact">
       			<div class="contact-logo">
                	<img src="<?php echo IMG_DIR; ?>/footer-contact-logo.png" width="89" height="62" alt=""/>
                </div>
                <div class="company-info">
           <?php echo get_box('informacion-compania-pie-de-pagina'); ?>
           		</div>
            <a href="#" ><img class="facebook" src="<?php echo IMG_DIR; ?>/facebook-logo.png" width="32" height="31" alt=""/></a>
            	<div class="contactenos">
                	<img class="arrow-right" src="<?php echo IMG_DIR; ?>/arrow-right.png" width="14" height="27" alt=""/>
                    <p> <span>CONTACTENOS</span><br/>
               		CRC +(506) 2283-0876<br/>
                       DOM +(809) 983-6095</p>
                    <img class="arrow-left" src="<?php echo IMG_DIR; ?>/arrow-left.png" width="14" height="27" alt=""/>
                    <div class="clear"></div>
                </div>
           		<div class="clear"></div>
        </div>
         <div class="footer-legal">
       		<p class="copy">&copy; 2013 Todos los derechos reservados, Proamsa<br/>
Teléfonos: CRC +(506) 2283-0876  DOM +(809) 986095  info@grupoproamsa.com</p>
            <p class="credit">Diseñado y Desarrollado por <a class="dame-click" href="#"><img src="<?php echo IMG_DIR; ?>/dame-click-logo.png" alt=""/> DameClic</a></p>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>

</body>
</html>