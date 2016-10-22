<?php

$pixova_lite_main_cta_text = get_theme_mod('pixova_lite_intro_cta', __('Probably the BEST FREE WordPress theme of all times. Now with WooCommerce Support.', 'pixova-lite') );
$pixova_lite_main_cta_sub_text = get_theme_mod('pixova_lite_intro_sub_cta', __('60fps smooth parallax header; Random header images (multiple images allowed here).', 'pixova-lite') );
$pixova_lite_main_cta_button_text = get_theme_mod('pixova_lite_intro_button_text', __('Explore Pixova.', 'pixova-lite') );
$pixova_lite_main_cta_button_url = get_theme_mod('pixova_lite_intro_button_url', 'http://www.machothemes.com/themes/pixova-lite/');

$pixova_lite_what_we_do_1 = get_theme_mod('pixova_lite_intro_what_we_do_1_title', __('Web design', 'pixova-lite') );
$pixova_lite_what_we_do_1_description = get_theme_mod('pixova_lite_intro_what_we_do_1_description', __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite') );
$pixova_lite_what_we_do_2 = get_theme_mod('pixova_lite_intro_what_we_do_2_title', __('Development', 'pixova-lite') );
$pixova_lite_what_we_do_2_description = get_theme_mod('pixova_lite_intro_what_we_do_2_description', __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite') );
$pixova_lite_what_we_do_3 = get_theme_mod('pixova_lite_intro_what_we_do_3_title', __('Print design', 'pixova-lite') );
$pixova_lite_what_we_do_3_description = get_theme_mod('pixova_lite_intro_what_we_do_3_description', __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite') );


echo '<section id="intro" class="home-intro" >';
    echo '<div class="parallax-bg-container">';


    if ( get_header_image() !== '' ) {
        echo '<div class="parallax-bg-image" data-image-source="'. get_header_image() .'" alt="" /></div>';
    } else {
        echo '<div class="parallax-bg-image" data-image-source='. get_template_directory_uri() .'/layout/images/header-bg.jpg"></div>';
    }

    echo '</div>';

    echo '<div class="container">';
        echo '<div class="intro-content parallax-text-fade">';
            echo '<div class="row">';
                echo '<div class="col-md-12">';
                    echo '<div class="text-center">';
                        echo '<h1 class="intro-title">'.esc_html( $pixova_lite_main_cta_text ).'</h1>';
                        echo '<p class="intro-tagline">'.esc_html( $pixova_lite_main_cta_sub_text ).'</p>';
                        echo '<a class="btn btn-cta btn-cta-intro "href="'.esc_url( $pixova_lite_main_cta_button_url ).'"><span>'.esc_html( $pixova_lite_main_cta_button_text ).'</span></a>';
                    echo '</div><!--/.text-center-->';
                echo '</div><!--/.col-md-12-->';
            echo '</div><!--/.row-->';
        echo '</div><!--/.intro-content.parallax-text-fade-->';
    echo '</div><!--/.container-->';



    echo '<!-- intro services -->';
    echo '<div class="container">';
            echo '<div class="intro-services parallax-text-fade">';
                echo '<div class="row">';
                    echo '<div class="col-md-12">';

                    echo '<!-- intro heading -->';
                    echo '<div class="intro-heading">';
                        echo '<h4>'.__('What We Do','pixova-lite').'</h4>';
                    echo '</div><!--/.intro-heading-->';

                    echo '<!-- intro services -->';
                    echo '<div id="intro-services-wrap">';

                    echo '<!-- intro service -->';
                    echo '<div class="intro-services col-md-4 col-sm-4 col-xs-4">';
                        echo '<span style="color: '.pixova_lite_hex2rgba('#FFFFFF').'" class="fa fa-tint"></span>';
                        echo '<h3 class="intro-service-title">'.esc_html( $pixova_lite_what_we_do_1 ).'</h3>';
                        echo '<p class="intro-service-text">'.esc_html( $pixova_lite_what_we_do_1_description ).'</p>';
                         echo '</div>';
                    echo '<!-- /intro service -->';

                    echo '<!-- intro service -->';
                        echo '<div class="intro-services col-md-4 col-sm-4 col-xs-4">';
                        echo '<span style="color: '.pixova_lite_hex2rgba('#FFFFFF').'" class="fa fa-pagelines"></span>';
                        echo '<h3 class="intro-service-title">'.esc_html( $pixova_lite_what_we_do_2 ).'</h3>';
                        echo '<p class="intro-service-text">'.esc_html( $pixova_lite_what_we_do_2_description ).'</p>';
                    echo '</div>';
                    echo '<!-- /intro service -->';

                    echo '<!-- intro service -->';
                    echo '<div class="intro-services col-md-4 col-sm-4 col-xs-4">';
                        echo '<span style="color: '.pixova_lite_hex2rgba('#FFFFFF').'" class="fa fa-envelope-o"></span>';
                        echo '<h3 class="intro-service-title">'.esc_html( $pixova_lite_what_we_do_3 ).'</h3>';
                        echo '<p class="intro-service-text">'.esc_html( $pixova_lite_what_we_do_3_description ).'</p>';
                    echo '</div>';
                    echo '<!-- /intro service -->';

                echo '</div><!--/.col-md-12-->';
    echo '<!-- /intro services -->';

        echo '</div><!--/.row-->';
    echo '</div><!--/.intro-services.parallax-text-fade-->';
echo '</div><!--/.container-->';
echo '</section><!--/ SECTION -->';