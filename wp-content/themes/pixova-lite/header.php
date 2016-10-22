<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

    global $wp_customize;
    $preloader_enabled = get_theme_mod('pixova_lite_preloader_enabled', 'preloader_enabled');

    if( !isset( $wp_customize ) && $preloader_enabled == 'preloader_enabled' ) { ?>

    <!-- Site Preloader -->
    <div id="page-loader">
        <div class="page-loader-inner">
            <div class="loader"><strong><?php echo esc_html__('Loading', 'pixova-lite'); ?></strong></div>
        </div>
    </div>
    <!-- END Site Preloader -->

    <?php } ?>

<div id="container" class="hfeed">