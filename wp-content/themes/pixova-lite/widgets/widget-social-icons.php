<?php



class Pixova_Lite_Widget_Social_Media extends WP_Widget {

    function Pixova_Lite_Widget_Social_Media() {
        $widget_ops = array( 
            'classname' => 'pixova_lite_widget_social_media',
            'description' => __('A widget that displays social media icons designed for blog sidebar', 'pixova-lite') );
        
        $control_ops = array( 
            'width' => 300, 
            'height' => 350, 
            'id_base' => 'pixova_lite_widget_social_media' );
        parent::__construct( 'pixova_lite_widget_social_media', __('[MT] - Social Media', 'pixova-lite'), $widget_ops, $control_ops );
    }



    function widget( $args, $instance ) {
        extract( $args );
        global $post;

        $title = apply_filters('widget_title', $instance['title'] );

        $profile_facebook 	=  esc_url( $instance['profile_facebook'] );
        $profile_twitter 	=  esc_url( $instance['profile_twitter'] );
        $profile_plus 		=  esc_url( $instance['profile_plus'] );
        $profile_pinterest	=  esc_url( $instance['profile_pinterest'] );
        $profile_youtube 	=  esc_url( $instance['profile_youtube'] );
        $profile_dribbble 	=  esc_url( $instance['profile_dribbble'] );
        $profile_tumblr 	=  esc_url( $instance['profile_tumblr'] );
        $profile_instagram 	=  esc_url( $instance['profile_instagram'] );

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;


        echo '<div class="fixed">';
        echo '<ul>';

        if ($profile_facebook){
            echo '<li><a class="facebook-icon social-icon" href="'.esc_url( $profile_facebook ).'"><i class="fa fa-facebook"></i>'. __('Facebook', 'pixova-lite'). '</a></li>';
        }

        if ($profile_twitter){
            echo '<li><a class="twitter-icon social-icon" href="'.esc_url( $profile_twitter ).'"><i class="fa fa-twitter"></i>'. __('Twitter', 'pixova-lite') . '</a></li>';
        }

        if ($profile_plus){
            echo '<li><a class="googleplus-icon social-icon" href="'.esc_url( $profile_plus ).'"><i class="fa fa-google-plus"></i>' . __('Google+', 'pixova-lite') . '</a></li>';
        }

        if ($profile_pinterest){
            echo '<li><a class="pinterest-icon social-icon" href="'.esc_url( $profile_pinterest ).'"><i class="fa fa-pinterest"></i>'. __('Pinterest', 'pixova-lite'). '</a></li>';
        }

        if ($profile_youtube){
            echo '<li><a class="youtube-icon social-icon" href="'.esc_url( $profile_youtube ).'"><i class="fa fa-youtube"></i>'. __('YouTube', 'pixova-lite').'</a></li>';
        }

        if ($profile_dribbble){
            echo '<li><a class="dribble-icon social-icon" href="'.esc_url( $profile_dribbble ).'"><i class="fa fa-dribbble"></i>'.__('Dribbble', 'pixova-lite').'</a></li>';
        }

        if ($profile_tumblr){
            echo '<li><a class="tumblr-icon social-icon" href="'.esc_url( $profile_tumblr ).'"><i class="fa fa-tumblr"></i>' . __('Tumblr', 'pixova-lite').'</a></li>';
        }

        if ($profile_instagram){
            echo '<li><a class="instagram-icon social-icon" href="'.esc_url( $profile_instagram ).'"><i class="fa fa-instagram"></i>' . __('Instagram', 'pixova-lite').'</a></li>';
        }

        echo '</ul>';
        echo '</div>';



        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] 				= esc_html ( $new_instance['title'] );
        $instance['profile_facebook'] 	= esc_url( $new_instance['profile_facebook'] );
        $instance['profile_twitter'] 	= esc_url( $new_instance['profile_twitter'] );
        $instance['profile_plus'] 		= esc_url( $new_instance['profile_plus'] );
        $instance['profile_pinterest'] 	= esc_url( $new_instance['profile_pinterest'] );
        $instance['profile_youtube'] 	= esc_url( $new_instance['profile_youtube'] );
        $instance['profile_dribbble'] 	= esc_url( $new_instance['profile_dribbble'] );
        $instance['profile_tumblr'] 	= esc_url( $new_instance['profile_tumblr'] );
        $instance['profile_instagram'] 	= esc_url( $new_instance['profile_instagram'] );

        return $instance;
    }


    function form( $instance ) {
        $defaults = array(
            'title' => null,
            'profile_facebook' => null,
            'profile_twitter' => null,
            'profile_plus' => null,
            'profile_pinterest' => null,
            'profile_youtube' => null,
            'profile_dribbble' => null,
            'profile_tumblr' => null,
            'profile_instagram' => null,
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <div class="ewf-meta">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_facebook' ); ?>"><?php _e('Facebook profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_facebook' ); ?>" name="<?php echo $this->get_field_name( 'profile_facebook' ); ?>" value="<?php echo esc_url( $instance['profile_facebook'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_twitter' ); ?>"><?php _e('Twitter profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_twitter' ); ?>" name="<?php echo $this->get_field_name( 'profile_twitter' ); ?>" value="<?php echo esc_url( $instance['profile_twitter'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_plus' ); ?>"><?php _e('Google Plus profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_plus' ); ?>" name="<?php echo $this->get_field_name( 'profile_plus' ); ?>" value="<?php echo esc_url( $instance['profile_plus'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_pinterest' ); ?>"><?php _e('Pinterest profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'profile_pinterest' ); ?>" value="<?php echo esc_url( $instance['profile_pinterest'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_youtube' ); ?>"><?php _e('YouTube profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_youtube' ); ?>" name="<?php echo $this->get_field_name( 'profile_youtube' ); ?>" value="<?php echo esc_url( $instance['profile_youtube'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_dribbble' ); ?>"><?php _e('Dribbble profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_dribbble' ); ?>" name="<?php echo $this->get_field_name( 'profile_dribbble' ); ?>" value="<?php echo esc_url( $instance['profile_dribbble'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_tumblr' ); ?>"><?php _e('Tumblr profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_tumblr' ); ?>" name="<?php echo $this->get_field_name( 'profile_tumblr' ); ?>" value="<?php echo esc_url( $instance['profile_tumblr'] ); ?>" style="width:100%;" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'profile_instagram' ); ?>"><?php _e('Instagram profile URL:', 'pixova-lite'); ?></label>
                <input id="<?php echo $this->get_field_id( 'profile_instagram' ); ?>" name="<?php echo $this->get_field_name( 'profile_instagram' ); ?>" value="<?php echo esc_url( $instance['profile_instagram'] ); ?>" style="width:100%;" />
            </p>

        </div>

    <?php
    }
}


// register the shortcode
    register_widget('pixova_lite_widget_social_media');