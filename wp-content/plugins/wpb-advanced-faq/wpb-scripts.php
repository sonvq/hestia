<?php

/*
	WPB Advanced FAQ
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


/* ==========================================================================
   Adding Latest jQuery
   ========================================================================== */

function wpb_af_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'wpb_af_jquery');	


/* ==========================================================================
   include js files
   ========================================================================== */

function wpb_af_adding_scripts() {
	if ( !is_admin() ) {
		wp_enqueue_script('wpb_af_jquery_cookie', plugins_url('assets/js/jquery.cookie.js', __FILE__),'','1.4.1', true);
		wp_enqueue_script('wpb_af_navgoco_script', plugins_url('assets/js/jquery.navgoco.min.js', __FILE__),'','1.0', true);
		wp_enqueue_script('wpb_af_main', plugins_url('assets/js/main.js', __FILE__),'','1.0', true);
	}
}
add_action( 'wp_enqueue_scripts', 'wpb_af_adding_scripts' ); 


/* ==========================================================================
   include css files
   ========================================================================== */

function wpb_af_adding_style() {
	if ( !is_admin() ) {
		wp_enqueue_style('wpb_af_icons', plugins_url('assets/css/icons.css', __FILE__),'','1.0', false);
		wp_enqueue_style('wpb_af_style', plugins_url('assets/css/wpb_af_style.css', __FILE__),'','1.0', false);
	}
}
add_action( 'wp_enqueue_scripts', 'wpb_af_adding_style',11 );