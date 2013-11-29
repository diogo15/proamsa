<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package proamsa_theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>

<script> var base = '<?php echo trailingslashit( get_bloginfo( 'url' ) ); ?>',IMG_DIR = '<?php echo IMG_DIR; ?>';</script>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

		<div class="wraper">
        
    	<div class="main-header">
        	<div class="contact-logos">
            	<span class="icon"><?php language_selector_flags(); ?></span>
            	<span class="icon"><img src="<?php echo IMG_DIR; ?>/icono-telefono.png" width="37" height="38" alt=""/>
                	<span class="arrow-bg"><span>( 506 ) 2283 - 0876</span></span>
                </span>
                
                <span class="icon"><img src="<?php echo IMG_DIR; ?>/icono-correo.png" width="38" height="38" alt=""/>
                <span class="arrow-bg"><span>info@grupoproamsa.com</span></span>
                </span>
            </div>
            <div class="logo">
            	<a href="#"><img src="<?php echo IMG_DIR; ?>/logo.png" width="252" height="176" alt=""/></a>
            </div>
            <div class="nav">
              	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div>
            <div class="clear"></div>
        </div>
        
        <div id="animation-wrapper">
    	<div class ="main-content">
       		<div class="inner">
          
            
        