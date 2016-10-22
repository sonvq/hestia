<?php get_header(); ?>
<div class="enigma_header_breadcrum_title">	
	<div class="container">
		<div class="row">
		<?php if(have_posts()) :?>
			<div class="col-md-12">
			<h1>Khách hàng đối tác</h1></div>
		<?php endif; ?>	
		</div>
	</div>	
</div>
<div class="container">	
	<div class="row enigma_blog_wrapper">
	<?php 
		$page_id = 14;
		$page_data = get_page( $page_id );
		echo '<div style="margin-bottom: 35px;">' . $page_data->post_content . '</div>';
	?>
		<?php 
	if ( have_posts()): $count = 0;
	while ( have_posts() ): the_post(); $count++; ?>
        <div class="post-lists col-md-6" id="post-<?php the_ID(); ?>" <?php post_class('enigma_blog_full'); ?>>
            <div class="row">
                <div class="avatar col-md-4">
                    <img src="<?php echo types_render_field('avatar', array('post_id' => get_the_ID(), 'output' => 'raw')); ?>" style="width: 100%; height: auto; border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%" />
                </div>
                <div class="post-content-wrap col-md-8">
                    <div class="enigma_fuul_blog_detail_padding">
                    <h2 style="font-size: 28px"><?php if(!is_single()) {?><?php } ?><?php the_title(); ?></h2>
                    <h5><?php echo types_render_field('position', array('post_id' => get_the_ID(), 'output' => 'raw')); ?></h5>		
                            <hr class="title-divider">
                    <p style="text-align: justify"><em><?php echo types_render_field('main-content', array('post_id' => get_the_ID(), 'output' => 'raw')); ?></em></p>
                    </div>
                </div>
            </div>
        </div>		
        <?php if (($count %2 == 0) && ($count > 0)) : ?>
            <div class="push-right col-md-12">
                <hr class="big-hr-line">
            </div>
        <?php endif; ?>
	<?php endwhile; ?>
	<div class="clearfix"></div>

	<?php the_posts_pagination( array(
    		'mid_size' => 2,
    		'prev_text' => '<< Trang trước',
    		'next_text' => 'Trang tiếp theo >>',
	) ); 
	endif;
	?>
	</div>
</div>
<?php get_footer(); ?>