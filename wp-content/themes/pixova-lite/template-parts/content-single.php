<div class="fluid-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php

                    $breadcrumbs_enabled = get_theme_mod('pixova_lite_enable_post_breadcrumbs', 'breadcrumbs_enabled');

                    if( $breadcrumbs_enabled == 'breadcrumbs_enabled' ) {
	                    pixova_lite_breadcrumbs();
                    }

                ?>
            </div>
        </div>
    </div>
</div>


 <div class="container">
        <div class="row">
            <section class="has-padding single-content">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if( has_post_thumbnail() ) { ?>
                        <div class="entry-featured-image">
                            <?php echo get_the_post_thumbnail($post->ID, 'pixova-lite-featured-blog-image'); ?>
                        </div><!--/.entry-featured-image-->
                    <?php } ?>

                    <div class="entry-meta">
                        <?php echo __('Written by: ', 'pixova-lite') . '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a>'; ?>
                        <?php echo '&middot;'; ?>
                        <?php echo __('Posted in: ', 'pixova-lite').get_the_category_list(', ', '', false); ?>
                        <?php echo '&middot;'; ?>
                        <?php the_tags( __('Tags:', 'pixova-lite') , ', ', '<br />' ); ?>
                    </div><!--/.entry-meta-->



                    <div class="entry-content">
                        <?php

                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'pixova-lite' ),
                            'after'  => '</div>',
                        ) );


                        ?>
                    </div><!-- .entry-content -->
                    <div class="clearfix"></div><!--/.clearfix-->
            </article>
        </div><!--.col-lg-8.col-xs-12.col-sm-12-->

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
            </div><!--/.col-lg-3-->
            <div class="clearfix"></div><!--/.clearfix-->

            <div class="mt-post-nav">
                <?php pixova_lite_content_nav('mt-post-nav'); ?>
            </div><!--/.mt-post-nav-->

                <div class="row mt-author-area">
                    <div class="col-lg-1">
                        <a class="mt-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 110 ); ?>
                        </a>
                    </div>

                    <div class="col-lg-11">
                        <h3> <?php _e('About the author: ', 'pixova-lite'); ?> <a class="mt-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h3>
                        <div class="mt-author-info">
                            <?php the_author_meta( 'description' ); ?>
                        </div>
                    </div><!--/.col-lg-9-->
                </div>

                <div class="clearfix"></div>

        <?php comments_template(); ?>
            </section><!--/section-->
        </div> <!--/.row-->
    </div><!--/.container-->
