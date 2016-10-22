<?php

$pixova_lite_header_logo_text = get_theme_mod('pixova_lite_text_logo', 'Pixova');

echo '<!-- Header -->';
echo '<header id="header-wrap">';
    echo '<div class="container header clearfix">';
        echo '<div class="row">';
            echo '<div class="col-md-12">';
                echo '<!-- logo -->';
                    echo '<a class="logo" href="'.esc_url( get_site_url() ).'">'.esc_html( $pixova_lite_header_logo_text ).'</a>';
                echo '<!-- /logo -->';

                echo '<!-- menu icon -->';
                echo '<a id="nav-expander" class="pull-right" href="#">';
                    echo '<i class="fa fa-bars fa-lg white"></i>';
                echo '</a>';

                echo '<nav class="main-navigation">';
                        echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
                echo '</nav><!--/.main-navigation.main-nav-single-project.visible-->';
            echo '</div><!--/.col-md-12-->';
        echo '</div><!--/.row-->';
    echo '</div><!--/.container-->';

    echo '<!-- main navigation mobile -->';
    echo '<div class="offset-canvas-mobile">';
        echo '<nav class="mobile-nav-holder">';
            echo '  <a href="#" class="close-btn mobile-nav-close-btn"><span class="fa fa-close"></span></a>';
            echo '<ul class="mobile-nav">';
                    echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
            echo '</ul><!--/.mobile-nav-->';
        echo '</nav><!--/.mobile-nav-holder-->';
    echo '</div><!--/.offset-canvas-mobile-->';
    echo '<!-- /main navigation mobile -->';
echo '</header>';
echo '<!-- /Header -->';

echo '<section id="intro" class="blog-intro">';
  echo '<div class="parallax-bg-container">';


    if ( get_header_image() !== '' ) {
        echo '<div class="parallax-bg-image" data-image-source="'. get_header_image() .'" alt="" /></div>';
    } else {
        echo '<div class="parallax-bg-image" data-image-source='. get_template_directory_uri() .'/layout/images/header-bg.jpg"></div>';
    }

   echo '</div><!--/.parallax-bg-container-->';


    echo '<div class="container">';
        echo '<div class="intro-content parallax-text-fade">';
            echo '<div class="row">';
                echo '<div class="col-md-12">';
                    echo '<div class="text-center">';
                        echo '<div class="mt-date">'.get_the_date(get_option('date_format'), $post->ID) .'</div>';
                        echo '<h1 class="intro-title">'.esc_html( get_the_title() ).'</h1>';
                        echo '<p class="intro-tagline">';
                            echo '<span class="mt-category">'.get_the_category_list(', ', '', false).'</span>';
                            echo '<span class="mt-comments">'.pixova_lite_get_number_of_comments($post->ID).'</span>';
                        echo '</p>';
                    echo '</div><!--/.text-center-->';
                echo '</div><!--/.col-md-12-->';
            echo '</div><!--/.row-->';
        echo '</div><!--/.intro-content.parallax-text-fade-->';
    echo '</div><!--/.container-->';
echo '</section><!--/ SECTION -->';