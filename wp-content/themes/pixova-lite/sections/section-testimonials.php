<?php

$pixova_lite_section_title = get_theme_mod('pixova_lite_testimonial_section_title', __('Some words from our clients', 'pixova-lite') );
$pixova_lite_section_sub_title = get_theme_mod('pixova_lite_testimonial_section_sub_title', __('We don not like to brag, others do it for us.', 'pixova-lite') );

// Testimonial #1
$pixova_lite_testimonial_1_person_name = get_theme_mod('pixova_lite_testimonial_1_person_name', __('Katie Parry - Aviato', 'pixova-lite') );
$pixova_lite_testimonial_1_person_description = get_theme_mod('pixova_lite_testimonial_1_person_description', __('Working with Pixova has been the experience of a lifetime. I strongly recommend these guys for their amazing support. Lorem ipsum dolor sit amet lorem ipsum.', 'pixova-lite') );
$pixova_lite_testimonial_1_person_image = get_theme_mod('pixova_lite_testimonial_1_person_image', get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg');

// Testimonial #2
$pixova_lite_testimonial_2_person_name = get_theme_mod('pixova_lite_testimonial_2_person_name', __('Katie Parry - Aviato', 'pixova-lite') );
$pixova_lite_testimonial_2_person_description = get_theme_mod('pixova_lite_testimonial_2_person_description', __('Working with Pixova has been the experience of a lifetime. I strongly recommend these guys for their amazing support. Lorem ipsum dolor sit amet lorem ipsum.', 'pixova-lite') );
$pixova_lite_testimonial_2_person_image = get_theme_mod('pixova_lite_testimonial_2_person_image', get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned2-92x92.jpg');

// Testimonial #3
$pixova_lite_testimonial_3_person_name = get_theme_mod('pixova_lite_testimonial_3_person_name', __('Katie Parry - Aviato', 'pixova-lite') );
$pixova_lite_testimonial_3_person_description = get_theme_mod('pixova_lite_testimonial_3_person_description', __('Working with Pixova has been the experience of a lifetime. I strongly recommend these guys for their amazing support. Lorem ipsum dolor sit amet lorem ipsum.', 'pixova-lite') );
$pixova_lite_testimonial_3_person_image = get_theme_mod('pixova_lite_testimonial_3_person_image', get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg');

// Testimonial #4
$pixova_lite_testimonial_4_person_name = get_theme_mod('pixova_lite_testimonial_4_person_name', __('Katie Parry - Aviato', 'pixova-lite') );
$pixova_lite_testimonial_4_person_description = get_theme_mod('pixova_lite_testimonial_4_person_description', __('Working with Pixova has been the experience of a lifetime. I strongly recommend these guys for their amazing support. Lorem ipsum dolor sit amet lorem ipsum.', 'pixova-lite') );
$pixova_lite_testimonial_4_person_image = get_theme_mod('pixova_lite_testimonial_4_person_image', get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned2-92x92.jpg');

// Testimonial #5
$pixova_lite_testimonial_5_person_name = get_theme_mod('pixova_lite_testimonial_5_person_name', __('Katie Parry - Aviato', 'pixova-lite') );
$pixova_lite_testimonial_5_person_description = get_theme_mod('pixova_lite_testimonial_5_person_description', __('Working with Pixova has been the experience of a lifetime. I strongly recommend these guys for their amazing support. Lorem ipsum dolor sit amet lorem ipsum.', 'pixova-lite') );
$pixova_lite_testimonial_5_person_image = get_theme_mod('pixova_lite_testimonial_5_person_image', get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg');




$pixova_lite_no_of_testimonials = 0;

if( isset( $pixova_lite_testimonial_1_person_image ) && !empty( $pixova_lite_testimonial_1_person_image) ) {
    $pixova_lite_no_of_testimonials++;
}

if( isset( $pixova_lite_testimonial_2_person_image ) && !empty( $pixova_lite_testimonial_2_person_image) ) {
    $pixova_lite_no_of_testimonials++;
}

if($pixova_lite_no_of_testimonials == 1 || $pixova_lite_no_of_testimonials == 0 ) {
    $pixova_lite_wrapper_class = '';
} else if($pixova_lite_no_of_testimonials > 1 ) {
    $pixova_lite_wrapper_class = 'owlCarousel big-testimonial';
}

echo '<section class="has-padding" id="testimonials">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="text-center">';
				echo '<h2 class="section-heading light-section-heading">';
					echo esc_html( $pixova_lite_section_title );
					echo '<span>'.esc_html( $pixova_lite_section_sub_title ).'</span>';
				echo '</h2>';
			echo '</div><!--/.text-center-->';
		echo '</div><!--/.row-->';

		echo '<div class="row">';

			echo '<div class="'.$pixova_lite_wrapper_class.' col-lg-12">';

                if( isset( $pixova_lite_testimonial_1_person_image ) && !empty( $pixova_lite_testimonial_1_person_image) ) {
                    echo '<div>';

                    echo '<div class="media">';
                    echo '<div class="media-top align-center">';

                    if ($pixova_lite_testimonial_1_person_image) {
                        echo '<img width="138" height="138" class="testimonials-picture" src="' . esc_url( $pixova_lite_testimonial_1_person_image ). '">';
                    }

                    echo '</div><!--/.media-left.media-middle-->';

                    echo '<div class="media-body">';

                    echo '<p class="align-center">';
                    if (isset($pixova_lite_testimonial_1_person_description) && !empty($pixova_lite_testimonial_1_person_description)) {

                        echo esc_html( $pixova_lite_testimonial_1_person_description );

                    } else {
                        echo __('Please enter testimonial text', 'pixova-lite');
                    }
                    echo '</p><!--/.align-center-->';
                    echo '<div class="media-heading align-center">';
                    if (isset($pixova_lite_testimonial_1_person_name) && !empty($pixova_lite_testimonial_1_person_name)) {
                        echo '<span class="mt-person-name">' . esc_html( $pixova_lite_testimonial_1_person_name ). '</span>';
                        echo ' - ';
                    } else {
                        echo __('Please enter testimonial person name.', 'pixova-lite');
                    }

                    echo '</div><!--/.media-heading-->';

                    echo '</div><!--/.media-body-->';


                    echo '</div><!--/.media-->';
                    echo '</div>';
                }

                if( isset( $pixova_lite_testimonial_2_person_image ) && !empty( $pixova_lite_testimonial_2_person_image) ) {
                    echo '<div>';

                    echo '<div class="media">';
                    echo '<div class="media-top align-center">';

                    if ($pixova_lite_testimonial_2_person_image) {
                        echo '<img width="138" height="138" class="testimonials-picture" src="' . esc_url( $pixova_lite_testimonial_2_person_image ). '">';
                    }

                    echo '</div><!--/.media-left.media-middle-->';

                    echo '<div class="media-body">';

                    echo '<p class="align-center">';
                    if (isset($pixova_lite_testimonial_2_person_description) && !empty($pixova_lite_testimonial_2_person_description)) {

                        echo esc_html( $pixova_lite_testimonial_2_person_description );

                    } else {
                        echo __('Please enter testimonial text', 'pixova-lite');
                    }
                    echo '</p>';
                    echo '<div class="media-heading align-center">';
                    if (isset($pixova_lite_testimonial_2_person_name) && !empty($pixova_lite_testimonial_2_person_name)) {
                        echo '<span class="mt-person-name">' . esc_html( $pixova_lite_testimonial_2_person_name ). '</span>';
                        echo ' - ';
                    } else {
                        echo __('Please enter testimonial person name.', 'pixova-lite');
                    }

                    echo '</div><!--/.media-heading-->';

                    echo '</div><!--/.media-body-->';


                    echo '</div><!--/.media-->';
                    echo '</div>';
                }

                if( isset( $pixova_lite_testimonial_3_person_image ) && !empty( $pixova_lite_testimonial_3_person_image) ) {
                    echo '<div>';

                    echo '<div class="media">';
                    echo '<div class="media-top align-center">';

                    if ($pixova_lite_testimonial_3_person_image) {
                        echo '<img width="138" height="138" class="testimonials-picture" src="' . esc_url( $pixova_lite_testimonial_3_person_image ). '">';
                    }

                    echo '</div><!--/.media-left.media-middle-->';

                    echo '<div class="media-body">';

                    echo '<p class="align-center">';
                    if (isset($pixova_lite_testimonial_3_person_description) && !empty($pixova_lite_testimonial_3_person_description)) {

                        echo esc_html( $pixova_lite_testimonial_3_person_description );

                    } else {
                        echo __('Please enter testimonial text', 'pixova-lite');
                    }
                    echo '</p>';
                    echo '<div class="media-heading align-center">';
                    if (isset($pixova_lite_testimonial_3_person_name) && !empty($pixova_lite_testimonial_3_person_name)) {
                        echo '<span class="mt-person-name">' . esc_html( $pixova_lite_testimonial_3_person_name ). '</span>';
                        echo ' - ';
                    } else {
                        echo __('Please enter testimonial person name.', 'pixova-lite');
                    }

                    echo '</div><!--/.media-heading-->';

                    echo '</div><!--/.media-body-->';


                    echo '</div><!--/.media-->';
                    echo '</div>';
                }

                if( isset( $pixova_lite_testimonial_4_person_image ) && !empty( $pixova_lite_testimonial_4_person_image) ) {
                    echo '<div>';

                    echo '<div class="media">';
                    echo '<div class="media-top align-center">';

                    if ($pixova_lite_testimonial_4_person_image) {
                        echo '<img width="138" height="138" class="testimonials-picture" src="' . esc_url( $pixova_lite_testimonial_4_person_image ). '">';
                    }

                    echo '</div><!--/.media-left.media-middle-->';

                    echo '<div class="media-body">';

                    echo '<p class="align-center">';
                    if (isset($pixova_lite_testimonial_4_person_description) && !empty($pixova_lite_testimonial_4_person_description)) {

                        echo esc_html( $pixova_lite_testimonial_4_person_description );

                    } else {
                        echo __('Please enter testimonial text', 'pixova-lite');
                    }
                    echo '</p>';
                    echo '<div class="media-heading align-center">';
                    if (isset($pixova_lite_testimonial_4_person_name) && !empty($pixova_lite_testimonial_4_person_name)) {
                        echo '<span class="mt-person-name">' . esc_html( $pixova_lite_testimonial_4_person_name ). '</span>';
                        echo ' - ';
                    } else {
                        echo __('Please enter testimonial person name.', 'pixova-lite');
                    }

                    echo '</div><!--/.media-heading-->';

                    echo '</div><!--/.media-body-->';


                    echo '</div><!--/.media-->';
                    echo '</div>';
                }

                if( isset( $pixova_lite_testimonial_5_person_image ) && !empty( $pixova_lite_testimonial_5_person_image) ) {
                    echo '<div>';

                    echo '<div class="media">';
                    echo '<div class="media-top align-center">';

                    if ($pixova_lite_testimonial_5_person_image) {
                        echo '<img class="testimonials-picture" src="' . esc_url( $pixova_lite_testimonial_5_person_image ). '">';
                    }

                    echo '</div><!--/.media-left.media-middle-->';

                    echo '<div class="media-body">';

                    echo '<p class="align-center">';
                    if (isset($pixova_lite_testimonial_5_person_description) && !empty($pixova_lite_testimonial_5_person_description)) {

                        echo esc_html( $pixova_lite_testimonial_5_person_description );

                    } else {
                        echo __('Please enter testimonial text', 'pixova-lite');
                    }
                    echo '</p>';
                    echo '<div class="media-heading align-center">';
                    if (isset($pixova_lite_testimonial_5_person_name) && !empty($pixova_lite_testimonial_5_person_name)) {
                        echo '<span class="mt-person-name">' . esc_html( $pixova_lite_testimonial_5_person_name ). '</span>';
                        echo ' - ';
                    } else {
                        echo __('Please enter testimonial person name.', 'pixova-lite');
                    }

                    echo '</div><!--/.media-heading-->';

                    echo '</div><!--/.media-body-->';


                    echo '</div><!--/.media-->';
                    echo '</div>';
                }

		     echo '</div><!--/owl-carousel-->';


    	 echo '</div><!--/.row-->';
     echo '</div><!--/.container-->';
echo '</section><!--/ SECTION -->';
