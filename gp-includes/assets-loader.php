<?php
/**
 * Defines default styles and scripts
 */

function gp_styles_default( &$styles ) {
	$styles->base_url = gp_url( 'css' );
    $styles->default_version = gp_get_option( 'version' );
	// TODO: get text direction for current locale
    //$styles->text_direction = 'rtl' == get_bloginfo( 'text_direction' ) ? 'rtl' : 'ltr';
	$styles->text_direction = 'ltr';
	
	$styles->add( 'base', '/base.css', array() );
}

add_action( 'wp_default_styles', 'gp_styles_default' );

function gp_scripts_default( &$scripts ) {
	$scripts->base_url = gp_url( 'js' );
    $scripts->default_version = gp_get_option( 'version' );
	
	$scripts->add( 'jquery', '/jquery/jquery.js', array(), '1.2.6-min' );
	$scripts->add( 'jquery-ui-core', '/jquery/ui.core.js', array('jquery'), '1.5.2' );
}

add_action( 'wp_default_scripts', 'gp_scripts_default' );