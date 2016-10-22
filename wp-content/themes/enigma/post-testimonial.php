<div class="post-lists col-md-6" id="post-<?php the_ID(); ?>" <?php post_class('enigma_blog_full'); ?>>
	<div class="post-content-wrap">
		<div class="enigma_fuul_blog_detail_padding">
		<h2><?php if(!is_single()) {?><?php } ?><?php the_title(); ?></h2>
		<h5><?php echo types_render_field('position', array('post_id' => get_the_ID(), 'output' => 'raw')); ?></h5>		
		<p><?php echo types_render_field('main-content', array('post_id' => get_the_ID(), 'output' => 'raw')); ?></p>
		</div>
	</div>
</div>	