<?php get_header(); ?>
<?php get_template_part('sections/section', 'header-page'); ?>
<section class="has-padding">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
                <div class="container">
                    <div class="row">

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-content">
                                    <?php
                                        the_content();

                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . __( 'Pages:', 'pixova-lite' ),
                                            'after'  => '</div>',
                                        ) );
                                    ?>
                                </div><!-- .entry-content -->
                            </article><!-- #post-## -->
                        <?php comments_template(); ?>

                    </div><!--/.row-->
                </div><!--/.container-->
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->

    </section>
<?php get_footer(); ?>
