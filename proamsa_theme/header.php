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
            </div>
            <div class="logo">
            </div>
            <div class="nav">
            	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div>
        </div>
    	<div class ="main-content">
       		<div class="inner">