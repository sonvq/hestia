<?php


$pixova_lite_section_title = get_theme_mod('pixova_lite_team_section_title', __('The team', 'pixova-lite') );
$pixova_lite_section_sub_title = get_theme_mod('pixova_lite_team_section_sub_title', __('Meet the people that made it all happen.', 'pixova-lite') );

// Team member #1 
$pixova_lite_team_member_1_name = get_theme_mod('pixova_lite_team_member_1_name', __('John doe', 'pixova-lite') );
$pixova_lite_team_member_1_image = get_theme_mod('pixova_lite_team_member_1_image', get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg');
$pixova_lite_team_member_1_fburl = get_theme_mod('pixova_lite_team_member_1_facebook', 'https://www.facebook.com/machothemes/');
$pixova_lite_team_member_1_dribbble_url = get_theme_mod('pixova_lite_team_member_1_dribbble', 'http://www.dribbble.com/');

// Team member #2 
$pixova_lite_team_member_2_name = get_theme_mod('pixova_lite_team_member_2_name', __('John doe', 'pixova-lite') );
$pixova_lite_team_member_2_image = get_theme_mod('pixova_lite_team_member_2_image', get_template_directory_uri() . '/layout/images/team/teammembru2-150x150.jpg');
$pixova_lite_team_member_2_fburl = get_theme_mod('pixova_lite_team_member_2_facebook', 'https://www.facebook.com/machothemes/');
$pixova_lite_team_member_2_dribbble_url = get_theme_mod('pixova_lite_team_member_2_dribbble', 'http://www.dribbble.com/');

// Team member #3
$pixova_lite_team_member_3_name = get_theme_mod('pixova_lite_team_member_3_name', __('John doe', 'pixova-lite') );
$pixova_lite_team_member_3_image = get_theme_mod('pixova_lite_team_member_3_image', get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg');
$pixova_lite_team_member_3_fburl = get_theme_mod('pixova_lite_team_member_3_facebook', 'https://www.facebook.com/machothemes/');
$pixova_lite_team_member_3_dribbble_url = get_theme_mod('pixova_lite_team_member_3_dribbble', 'http://www.dribbble.com/');

// Team member #4
$pixova_lite_team_member_4_name = get_theme_mod('pixova_lite_team_member_4_name', __('John doe', 'pixova-lite') );
$pixova_lite_team_member_4_image = get_theme_mod('pixova_lite_team_member_4_image', get_template_directory_uri() . '/layout/images/team/teammembru2-150x150.jpg');
$pixova_lite_team_member_4_fburl = get_theme_mod('pixova_lite_team_member_4_facebook', 'https://www.facebook.com/machothemes/');
$pixova_lite_team_member_4_dribbble_url = get_theme_mod('pixova_lite_team_member_4_dribbble', 'http://www.dribbble.com/');

// Team member #5
$pixova_lite_team_member_5_name = get_theme_mod('pixova_lite_team_member_5_name', __('John doe', 'pixova-lite') );
$pixova_lite_team_member_5_image = get_theme_mod('pixova_lite_team_member_5_image', get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg');
$pixova_lite_team_member_5_fburl = get_theme_mod('pixova_lite_team_member_5_facebook', 'https://www.facebook.com/machothemes/');
$pixova_lite_team_member_5_dribbble_url = get_theme_mod('pixova_lite_team_member_5_dribbble', 'http://www.dribbble.com/');

echo '<section class="has-padding" id="team">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="text-center">';
				echo '<h2 class="section-heading light-section-heading">';
					echo esc_html( $pixova_lite_section_title );
					echo '<span>'.esc_html( $pixova_lite_section_sub_title ).'</span>';
				echo '</h2>';
			echo '</div><!--/.text-center-->';
		echo '</div><!--/.row-->';

		echo '<div class="row align-center">';

    if( isset( $pixova_lite_team_member_1_image ) && !empty( $pixova_lite_team_member_1_image ) ) {
        echo '<div class="mt-team">';
        echo '<img class="mt-team-img" src="' . esc_url( $pixova_lite_team_member_1_image ). '">';

        echo '<div class="mt-team-member-name">';
            echo esc_html( $pixova_lite_team_member_1_name );
        echo '</div><!--/.mt-team-member-name-->';

            echo '<div class="mt-team-description">';

            if ($pixova_lite_team_member_1_fburl !== '' || $pixova_lite_team_member_1_dribbble_url !== '') {

                echo '<div class="mt-team-member-icons">';

                if ($pixova_lite_team_member_1_fburl !== '') {
                    echo '<div class="mt-team-member-icon">';
                        echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_1_fburl ). '"><i class="fa fa-facebook-official"></i></a>';
                    echo '</div><!--/.mt-team-member-icon-->';
                }

                if ($pixova_lite_team_member_1_dribbble_url !== '') {
                    echo '<div class="mt-team-member-icon">';
                        echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_1_dribbble_url ). '"><i class="fa fa-dribbble"></i></a>';
                    echo '</div><!--/.mt-team-member-icon-->';
                }

                echo '</div><!--/.mt-team-member-icons-->';
            }
            echo '</div><!--/.mt-team-description-->';
        echo '</div> <!--/.mt-team-->';
    }

    if( isset( $pixova_lite_team_member_2_image ) && !empty( $pixova_lite_team_member_2_image ) ) {
        echo '<div class="mt-team">';

        echo '<img class="mt-team-img" src="' . esc_url( $pixova_lite_team_member_2_image ). '">';

        echo '<div class="mt-team-member-name">';
            echo esc_html( $pixova_lite_team_member_2_name );
        echo '</div><!--/.mt-team-member-name-->';

        echo '<div class="mt-team-description">';

        if ($pixova_lite_team_member_2_fburl !== '' || $pixova_lite_team_member_2_dribbble_url !== '') {

            echo '<div class="mt-team-member-icons">';

            if ($pixova_lite_team_member_2_fburl !== '') {
                echo '<div class="mt-team-member-icon">';
                    echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_2_fburl ). '"><i class="fa fa-facebook-official"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            if ($pixova_lite_team_member_2_dribbble_url !== '') {
                echo '<div class="mt-team-member-icon">';
                    echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_2_dribbble_url ). '"><i class="fa fa-dribbble"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            echo '</div><!--/.mt-team-member-icons-->';
        }
        echo '</div><!--/.mt-team-description-->';
        echo '</div> <!--/.mt-team-->';
    }

    if( isset( $pixova_lite_team_member_3_image ) && !empty( $pixova_lite_team_member_3_image ) ) {
        echo '<div class="mt-team">';

        echo '<img class="mt-team-img" src="' . esc_url( $pixova_lite_team_member_3_image ). '">';

        echo '<div class="mt-team-member-name">';
        echo esc_html( $pixova_lite_team_member_3_name );
        echo '</div><!--/.mt-team-member-name-->';

        echo '<div class="mt-team-description">';

        if ($pixova_lite_team_member_3_fburl !== '' || $pixova_lite_team_member_3_dribbble_url !== '') {

            echo '<div class="mt-team-member-icons">';

            if ($pixova_lite_team_member_3_fburl !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_3_fburl ). '"><i class="fa fa-facebook-official"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            if ($pixova_lite_team_member_3_dribbble_url !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_3_dribbble_url ). '"><i class="fa fa-dribbble"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            echo '</div><!--/.mt-team-member-icons-->';
        }
        echo '</div><!--/.mt-team-description-->';
        echo '</div> <!--/.mt-team-->';
    }

    if( isset( $pixova_lite_team_member_4_image ) && !empty( $pixova_lite_team_member_4_image ) ) {
        echo '<div class="mt-team">';

        echo '<img class="mt-team-img" src="' . esc_url( $pixova_lite_team_member_4_image ). '">';

        echo '<div class="mt-team-member-name">';
        echo esc_html( $pixova_lite_team_member_4_name );
        echo '</div><!--/.mt-team-member-name-->';

        echo '<div class="mt-team-description">';

        if ($pixova_lite_team_member_4_fburl !== '' || $pixova_lite_team_member_4_dribbble_url !== '') {

            echo '<div class="mt-team-member-icons">';

            if ($pixova_lite_team_member_4_fburl !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_4_fburl ). '"><i class="fa fa-facebook-official"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            if ($pixova_lite_team_member_4_dribbble_url !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_4_dribbble_url ). '"><i class="fa fa-dribbble"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            echo '</div><!--/.mt-team-member-icons-->';
        }
        echo '</div><!--/.mt-team-description-->';
        echo '</div> <!--/.mt-team-->';
    }

    if( isset( $pixova_lite_team_member_5_image ) && !empty( $pixova_lite_team_member_5_image ) ) {
        echo '<div class="mt-team">';

        echo '<img class="mt-team-img" src="' . esc_url( $pixova_lite_team_member_5_image ). '">';

        echo '<div class="mt-team-member-name">';
        echo esc_html( $pixova_lite_team_member_5_name );
        echo '</div><!--/.mt-team-member-name-->';

        echo '<div class="mt-team-description">';

        if ($pixova_lite_team_member_5_fburl !== '' || $pixova_lite_team_member_5_dribbble_url !== '') {

            echo '<div class="mt-team-member-icons">';

            if ($pixova_lite_team_member_5_fburl !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_5_fburl ). '"><i class="fa fa-facebook-official"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            if ($pixova_lite_team_member_5_dribbble_url !== '') {
                echo '<div class="mt-team-member-icon">';
                echo '<a rel="nofollow" href="' . esc_url( $pixova_lite_team_member_5_dribbble_url ). '"><i class="fa fa-dribbble"></i></a>';
                echo '</div><!--/.mt-team-member-icon-->';
            }

            echo '</div><!--/.mt-team-member-icons-->';
        }
        echo '</div><!--/.mt-team-description-->';
        echo '</div> <!--/.mt-team-->';
    }

        echo '</div><!--/.row-->';
    echo '</div><!--/.container-->';
echo '</section><!--/ SECTION -->';