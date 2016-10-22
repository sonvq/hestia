<?php

$pixova_lite_section_title = get_theme_mod('pixova_lite_work_section_title', __('Recent works', 'pixova-lite') );
$pixova_lite_section_sub_title = get_theme_mod('pixova_lite_work_section_sub_title', __('Show and tell time', 'pixova-lite') );

// Project #1
$pixova_lite_project_1_image = get_theme_mod('pixova_lite_works_project_1_image', get_template_directory_uri() . '/layout/images/recent-works/recent-works-1-270x426.jpg');
$pixova_lite_project_1_logo = get_theme_mod('pixova_lite_works_project_1_logo', get_template_directory_uri() . '/layout/images/recent-works/logo1.png');
$pixova_lite_project_1_url = get_theme_mod('pixova_lite_works_project_1_url', 'http://www.machothemes.com/themes/pixova-lite/');

// Project #2
$pixova_lite_project_2_image = get_theme_mod('pixova_lite_works_project_2_image', get_template_directory_uri() . '/layout/images/recent-works/recent-works-2-270x426.jpg');
$pixova_lite_project_2_logo = get_theme_mod('pixova_lite_works_project_2_logo', get_template_directory_uri() . '/layout/images/recent-works/logo2.png');
$pixova_lite_project_2_url = get_theme_mod('pixova_lite_works_project_2_url', 'http://www.machothemes.com/themes/pixova-lite/');

// Project #3
$pixova_lite_project_3_image = get_theme_mod('pixova_lite_works_project_3_image', get_template_directory_uri() . '/layout/images/recent-works/recent-works-3-270x426.jpg');
$pixova_lite_project_3_logo = get_theme_mod('pixova_lite_works_project_3_logo', get_template_directory_uri() . '/layout/images/recent-works/logo3.png');
$pixova_lite_project_3_url = get_theme_mod('pixova_lite_works_project_3_url', 'http://www.machothemes.com/themes/pixova-lite/');

// Project #4
$pixova_lite_project_4_image = get_theme_mod('pixova_lite_works_project_4_image', get_template_directory_uri() . '/layout/images/recent-works/recent-works-4-270x426.jpg');
$pixova_lite_project_4_logo = get_theme_mod('pixova_lite_works_project_4_logo', get_template_directory_uri() . '/layout/images/recent-works/logo4.png');
$pixova_lite_project_4_url = get_theme_mod('pixova_lite_works_project_4_url', 'http://www.machothemes.com/themes/pixova-lite/');


/**
 * Logic used to dynamically create the layout, based on how many projects are active
**/
    $pixova_lite_no_of_projects = 0;
	$pixova_lite_cols = '';
	$pixova_lite_project_size = '';

    if( isset( $pixova_lite_project_1_image ) && !empty( $pixova_lite_project_1_image) ) {
        $pixova_lite_no_of_projects++;
    }

    if( isset( $pixova_lite_project_2_image ) && !empty( $pixova_lite_project_2_image) ) {
        $pixova_lite_no_of_projects++;
    }

    if( isset( $pixova_lite_project_3_image ) && !empty( $pixova_lite_project_3_image) ) {
        $pixova_lite_no_of_projects++;
    }

    if( isset( $pixova_lite_project_4_image ) && !empty( $pixova_lite_project_4_image) ) {
        $pixova_lite_no_of_projects++;
    }

    if($pixova_lite_no_of_projects == 1) {
        $pixova_lite_cols = 'col-lg-12 col-lg-offset-4';
        $pixova_lite_project_size = 'col-lg-4 col-md-4';
    } else if($pixova_lite_no_of_projects == 2) {
        $pixova_lite_cols = 'col-lg-12 col-lg-offset-2';
        $pixova_lite_project_size = 'col-lg-4 col-md-4';
    } else if($pixova_lite_no_of_projects == 3) {
        $pixova_lite_cols = 'col-lg-12';
        $pixova_lite_project_size = 'col-lg-4 col-md-4';
    } else if($pixova_lite_no_of_projects == 4){
        $pixova_lite_cols = 'col-xs-12';
        $pixova_lite_project_size = 'col-lg-3 col-md-3';
    } else if ( $pixova_lite_no_of_projects == 0 ) {
        $pixova_lite_cols = 'col-xs-12';
        $pixova_lite_no_of_projects = 'col-xs-12';
    }


echo '<section class="has-padding" id="works">';
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
		  echo '<div class="owlCarousel project-carousel">';

echo '<div class="mt-projects-wrapper '.$pixova_lite_cols.'">';

	if(isset($pixova_lite_project_1_image) && !empty($pixova_lite_project_1_image)) {

		// start building the return string for project #1
		echo '<div class="work '.$pixova_lite_project_size.'">';

		// Sanitization
		$pixova_lite_main_image = esc_url( $pixova_lite_project_1_image );
		$pixova_lite_logo_image = esc_url( $pixova_lite_project_1_logo );

		echo '<img src="' . $pixova_lite_main_image . '">';

		echo '<div class="logo-background">';
		if ($pixova_lite_logo_image) {
			echo '<img src="' . $pixova_lite_logo_image . '">';
		}

		echo '</div>';

		echo '<div class="work-description">';
			echo '<a target="_blank" class="work-project-link" href="' . esc_url( $pixova_lite_project_1_url ). '"><span class="work-description-icon fa fa-eye"><em>'.__('See project', 'pixova-lite').'</em></span></a>';
		echo '</div>';

		echo '</div><!--/.work-->';
	}

	if(isset($pixova_lite_project_2_image) && !empty($pixova_lite_project_2_image)) {
		// start building the return string for project #2
		echo '<div class="work '.$pixova_lite_project_size.'">';

		// Sanitization
		$pixova_lite_main_image = esc_url( $pixova_lite_project_2_image );
		$pixova_lite_logo_image = esc_url( $pixova_lite_project_2_logo );

		echo '<img src="' . $pixova_lite_main_image . '">';

		echo '<div class="logo-background">';
		if ($pixova_lite_logo_image) {
			echo '<img src="' . $pixova_lite_logo_image . '">';
		}

		echo '</div>';

		echo '<div class="work-description">';
			echo '<a target="_blank" class="work-project-link" href="' . esc_url( $pixova_lite_project_2_url ) . '"><span class="work-description-icon fa fa-eye"><em>'.__('See project', 'pixova-lite').'</em></span></a>';
		echo '</div>';

		echo '</div><!--/.work-->';
	}

	if(isset($pixova_lite_project_3_image) && !empty($pixova_lite_project_3_image)) {

		// start building the return string
		echo '<div class="work '.$pixova_lite_project_size.'">';


		$pixova_lite_main_image = esc_url( $pixova_lite_project_3_image );
		$pixova_lite_logo_image = esc_url( $pixova_lite_project_3_logo );

		echo '<img src="' . $pixova_lite_main_image . '">';

		echo '<div class="logo-background">';
		if ($pixova_lite_logo_image) {
			echo '<img src="' . $pixova_lite_logo_image . '">';
		}

		echo '</div>';

		echo '<div class="work-description">';
			echo '<a target="_blank" class="work-project-link" href="' . esc_url( $pixova_lite_project_3_url ) . '"><span class="work-description-icon fa fa-eye"><em>'.__('See project', 'pixova-lite').'</em></span></a>';
		echo '</div>';

		echo '</div><!--/.work-->';
	}

	if(isset($pixova_lite_project_4_image) && !empty($pixova_lite_project_4_image)) {
		// start building the return string
		echo '<div class="work '.$pixova_lite_project_size.'">';


		$pixova_lite_main_image = esc_url( $pixova_lite_project_4_image );
		$pixova_lite_logo_image = esc_url( $pixova_lite_project_4_logo );

		echo '<img src="' . $pixova_lite_main_image . '">';

		echo '<div class="logo-background">';
		if ($pixova_lite_logo_image) {
			echo '<img src="' . $pixova_lite_logo_image . '">';
		}

		echo '</div>';

		echo '<div class="work-description">';
			echo '<a target="_blank" class="work-project-link" href="' . esc_url( $pixova_lite_project_4_url ) . '"><span class="work-description-icon fa fa-eye"><em>'.__('See project', 'pixova-lite').'</em></span></a>';
		echo '</div>';

		echo '</div><!--/.work-->';
	}

echo '</div><!--/.mt-projects-wrapper-->';
		    echo '</div><!--/owl-carousel-->';

    	echo '</row> <!--/.row-->';
    echo '</container><!--/.container-->';
echo '</section>';