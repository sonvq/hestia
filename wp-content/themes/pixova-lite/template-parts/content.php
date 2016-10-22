<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="mt-date">
        <?php echo get_the_date( get_option('date_format'), $post->ID); ?>
    </div><!--/.mt-date-->

    <div class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </div><!-- .entry-header -->

    <div class="entry-meta">
        <?php echo __('Written by: ', 'pixova-lite').get_the_author(); ?>
        <?php echo '&middot;'; ?>
        <?php echo __('Posted in: ', 'pixova-lite').get_the_category_list(', ', '', false); ?>
        <?php echo '&middot;'; ?>
        <?php the_tags( __('Tags:', 'pixova-lite') , ', ', '<br />' ); ?>
    </div><!--/.entry-meta-->

    <?php if( has_post_thumbnail() ) { ?>
        <div class="entry-featured-image">
            <?php echo get_the_post_thumbnail($post->ID, 'pixova-lite-featured-blog-image'); ?>
        </div><!--/.entry-featured-image-->
    <?php } ?>

    <div class="entry-content">
        <?php
            echo apply_filters('the_content', substr(get_the_content(), 0, 200) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'pixova-lite' ),
                'after'  => '</div>',
            ) );

        ?>
    </div><!-- .entry-content -->

    <div class="clearfix"></div><!--/.clearfix-->
</article><!-- #post-## -->
