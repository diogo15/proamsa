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


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<div class="wraper">
    	<div class="main-header">
        	<div class="contact-logos">
            	<span class="icon"><img src="../imagenes/icono-telefono.png" width="37" height="38" alt=""/>
                	<span class="arrow-bg"><span>xxx</span></span>
                </span>
                
                <span class="icon"><img src="../imagenes/icono-correo.png" width="38" height="38" alt=""/>
                <span class="arrow-bg"><span>info@grupoproamsa.com</span></span>
                </span>
            </div>
            <div class="logo">
            	<img src="../imagenes/logo.png" width="252" height="176" alt=""/>
            </div>
            <div class="nav">
              	<?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            	<ul>
                	<li><a href="#">Inicio</a></li>
                    <li class="dos-lineas"><a href="#">Quienes Somos</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Noticias</a></li>
                    <li class="largo"><a href="#">Descargas</a></li>
                    <li><a href="#">Galería</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    	<div class ="main-content">
       		<div class="inner">
          
            
        