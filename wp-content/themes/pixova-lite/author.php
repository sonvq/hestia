<?php get_header(); ?>
<?php get_template_part('sections/section', 'header'); ?>
    <div class="container">
        <div class="row">



            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <section class="has-padding">


                    <div class="row mt-author-area">
                        <div class="col-lg-2">
                            <a class="mt-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), 110 ); ?>
                            </a>
                        </div>

                        <div class="col-lg-10">
                            <h3> <?php echo __('Written by: ', 'pixova-lite') .get_the_author(); ?></h3>
                            <div class="mt-author-info">
                                <?php the_author_meta( 'description' ); ?>
                            </div>
                        </div><!--/.col-lg-9-->
                    </div>

                    <div class="clearfix"></div>



                    <?php if(have_posts() ) { while(have_posts() ) { the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <!-- Check that the date is enabled before displaying it -->

                            <div class="mt-date">
                                <?php echo get_the_date( get_option('date_format'), $post->ID); ?>
                            </div>

                            <div class="entry-header">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                            </div><!-- .entry-header -->



                            <div class="entry-meta">


                                <?php echo __('Written by: ', 'pixova-lite'). get_the_author(); ?>

                                
                                <?php

                                    echo '&middot;';
                                    echo __('Posted in:', 'pixova-lite') . get_the_category_list(', ', '', false);

                                ?>
                                
                                <?php

                                echo '&middot;';
                                 the_tags( __('Tags:', 'pixova-lite') , ', ', '<br />' );

                                ?>
                            </div><!--/.entry-meta-->
                            
                            <?php
                                if( has_post_thumbnail() ) { ?>
                                    <div class="entry-featured-image">
                                        <?php echo get_the_post_thumbnail($post->ID, 'pixova-lite-featured-blog-image'); ?>
                                    </div><!--/.entry-featured-image-->
                                <?php }  ?>

                            <div class="entry-content">
                                <?php

                                echo apply_filters('the_content', substr(get_the_content(), 0, 200) );

                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . __( 'Pages:', 'pixova-lite' ),
                                    'after'  => '</div>',
                                ) );
                                ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->

                    <?php } ?>
                    <?php } ?>

            </div><!--/.col-lg-8-->


            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs pull-right">
                <div class="mt-blog-sidebar">
                    <?php
                    if(is_active_sidebar('blog-sidebar')) {
                        dynamic_sidebar('blog-sidebar');
                    } else {
                        the_widget( 'WP_Widget_Search', sprintf('title=%s', __('Search', 'pixova-lite') ) );
                        the_widget( 'WP_Widget_Calendar', sprintf('title=%s', __('Calendar', 'pixova-lite') ) );
                    }
                    ?>
                </div> <!--/.mt-blog-sidebar-->
            </div><!--/.col-md-3-->


        <div class="mt-custom-pagination col-lg-12">
            <?php pixova_lite_pagination(); ?>
        </div><!--/.mt-custom-pagination-->

    </section><!-- SECTION -->
            </div><!--/.row-->
    </div><!--/.container-->

<?php get_footer(); ?>