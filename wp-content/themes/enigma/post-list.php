<div class="row post-lists" id="post-<?php the_ID(); ?>" <?php post_class('enigma_blog_full'); ?>>

	<ul class="blog-date-left col-md-4">
				<?php if(has_post_thumbnail()): 
		$img = array('class' => 'enigma_img_responsive'); ?>
		<div class="enigma_blog_thumb_wrapper_showcase">						
			<div class="enigma_blog-img">
			<?php the_post_thumbnail('blog_2c_thumb',$img); ?>						
			</div>			
		</div>
		<?php endif; ?>
	</ul>
	<div class="post-content-wrap col-md-8">
		<div class="enigma_fuul_blog_detail_padding">
		<h2><?php if(!is_single()) {?><a href="<?php the_permalink(); ?>"><?php } ?><?php the_title(); ?></a></h2>
		<?php the_excerpt( __( 'Read More' , 'weblizar' ) ); 
		$defaults = array(
              'before'           => '<div class="enigma_blog_pagination"><div class="enigma_blog_pagi">' . __( 'Pages:','weblizar'  ),
              'after'            => '</div></div>',
	          'link_before'      => '',
	          'link_after'       => '',
	          'next_or_number'   => 'number',
	          'separator'        => ' ',
	          'nextpagelink'     => __( 'Next page'  ,'weblizar' ),
	          'previouspagelink' => __( 'Previous page' ,'weblizar'),
	          'pagelink'         => '%',
	          'echo'             => 1
	          );
	          wp_link_pages( $defaults ); ?>
		</div>
	</div>
</div>	
<div class="push-right">
<hr class="blog-sep header-sep">
</div>