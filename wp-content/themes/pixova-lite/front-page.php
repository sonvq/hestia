<?php get_header(); ?>
<?php get_template_part('sections/section', 'header'); ?>

<?php 

	if ( 'page' == get_option( 'show_on_front' ) ) { ?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="container">
                        <div class="row">
                            <section class="has-padding">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="entry-content">
                                        <?php

                                        echo '<h1>' . esc_html( get_the_title() ). '</h1>';

                                        the_content();

                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . __( 'Pages:', 'pixova-lite' ),
                                            'after'  => '</div>',
                                        ) );
                                        ?>
                                    </div><!-- .entry-content -->
                                </article><!-- #post-## -->
                            </section><!--/section-->
                        </div><!--/.row-->
                    </div><!--/.container-->
                <?php endwhile; // end of the loop. ?>
            </main><!-- #main -->
        </div><!-- #primary -->

<?php } // if
else {


	/**
	 * Header section
	 * @var [type]
	 */
	$intro_section_show = get_theme_mod('pixova_lite_intro_visibility', 1);

	if( isset( $intro_section_show ) && $intro_section_show == 1 ) {
		get_template_part('sections/section', 'intro');
	}

	$about_section_show = get_theme_mod('pixova_lite_about_visibility', 1);

	if( isset( $about_section_show ) && $about_section_show == 1 ) {
		get_template_part('sections/section', 'about');
	}
	/**
	 * Recent works section
	 * @var [type]
	 */
	$works_section_show = get_theme_mod('pixova_lite_works_visibility', 1);

	if( isset( $works_section_show ) && $works_section_show == 1) {
		get_template_part('sections/section', 'works');
	}
	/**
	 * Testimonials section
	 * @var [type]
	 */
	$testimonials_section_show = get_theme_mod('pixova_lite_testimonials_visibility', 1);

	if( isset( $testimonials_section_show ) && $testimonials_section_show == 1 ) {
		get_template_part('sections/section', 'testimonials');
	}

	/**
	 * News section
	 * @var [type]
	 */
	$news_section_show = get_theme_mod('pixova_lite_news_visibility', 1);

	if( isset( $news_section_show ) && $news_section_show == 1 ) {
		get_template_part('sections/section', 'news');
	}

	/**
	 * Team section
	 * @var [type]
	 */
	$team_section_show = get_theme_mod('pixova_lite_team_visibility', 1);
	if( isset( $team_section_show ) && $team_section_show == 1 ) {
		get_template_part('sections/section', 'team');
	}

	/**
	 * Contact section
	 * @var [type]
	 */
	$contact_section_show = get_theme_mod('pixova_lite_contact_visibility', 1);

	if( isset( $contact_section_show ) && $contact_section_show == 1 ) {
		get_template_part('sections/section', 'contact');
	}

	} // else
?>


<?php get_footer(); ?>