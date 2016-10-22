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

                echo '<!-- /menu icon -->';
                echo '<!-- main navigation -->';
                
                echo '<nav class="main-navigation">';
                    echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
                echo '</nav>';
                    echo '<!-- /main-navigation -->';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<!-- main navigation mobile -->';
    echo '<div class="offset-canvas-mobile">';
        echo '<nav class="mobile-nav-holder">';
            echo '  <a href="#" class="close-btn mobile-nav-close-btn"><span class="fa fa-close"></span></a>';
            echo '<ul class="mobile-nav">';
                echo wp_nav_menu( array('theme_location' => 'primary', 'fallback_cb' => 'pixova_lite_fallback_cb') );
            echo '</ul><!--/.mobile-nav-->';
        echo '</nav><!--/.mobile-nav-holder-->';
    echo '</div><!--ofset-canvas-mobile-->';
    echo '<!-- /main navigation mobile -->';
echo '</header><!--/Header-->';