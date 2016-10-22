<?php get_header(); ?>
<?php get_template_part('sections/section', 'header'); ?>

<section class="has-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <?php woocommerce_content(); ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .content-left-wrap -->
        </div><!--/.row-->
    </div><!-- .container -->
</section><!--/ SECTION -->

<?php get_footer(); ?>