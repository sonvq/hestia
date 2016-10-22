<?php
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
?>

<div class="enigma_blog_area ">
<?php $wl_theme_options = weblizar_get_options();
if($wl_theme_options['blog_title'] !='') { ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="enigma_heading_title">
					<h3><?php echo esc_attr($wl_theme_options['blog_title']); ?></h3>		
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="container">	
	<div class="row" id="enigma_blog_section">
	<?php 	if ( have_posts()) : 			
			$posts_count =wp_count_posts()->publish;
			$args = array( 'post_type' => 'post','posts_per_page' => $posts_count ,'ignore_sticky_posts' => 1);		
			$post_type_data = new WP_Query( $args );
			while($post_type_data->have_posts()):
			$post_type_data->the_post(); ?>
			<div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left">
			<div class="enigma_blog_thumb_wrapper">
				<div class="enigma_blog_thumb_wrapper_showcase">					
					<?php $img = array('class' => 'enigma_img_responsive');
							if(has_post_thumbnail()): 
							the_post_thumbnail('home_post_thumb',$img);
					endif; ?>
					<div class="enigma_blog_thumb_wrapper_showcase_overlay">
						<div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
							<div class="enigma_blog_thumb_wrapper_showcase_icons">
								<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
				</div>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php $newString = str_replace("<!-- AddThis Sharing Buttons above -->","",get_the_excerpt('Read More','weblizar'));?>
				<p><?php echo string_limit_words($newString,25) . '...'; ?></p>
				<a href="<?php the_permalink(); ?>" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i><?php _e('Read More','weblizar'); ?></a>

			</div>
			</div>
			<?php  endwhile; 
			else : ?>
			<div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left">
			<div class="enigma_blog_thumb_wrapper">
				<div class="enigma_blog_thumb_wrapper_showcase">
					<img  alt="Enigma" src="<?php echo WL_TEMPLATE_DIR_URI ?>/images/wall/img(11).jpg">
					<div class="enigma_blog_thumb_wrapper_showcase_overlay">
						<div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
							<div class="enigma_blog_thumb_wrapper_showcase_icons">
								<a title="Enigma" href="#"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
				</div>
				<h2><a href="#"><?php _e('NO Post','weblizar'); ?></a></h2>
				
				<div class="enigma_tags">
					<?php _e('Tags :&nbsp;','weblizar'); ?>
					<a href="#"><?php _e('Bootstrap','weblizar'); ?></a>
					<a href="#"><?php _e('HTML5','weblizar'); ?></a>
				   
				</div>
				<p><?php _e('Add You Post To show post here..','weblizar'); ?></p>
				<a href="#" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i><?php _e('Read More','weblizar'); ?></a>

			</div>
			</div>
		<?php endif; ?>
		
	</div>
	<div class="enigma_carousel-navi">
				<div id="port-next" class="enigma_carousel-prev" ><i class="fa fa-arrow-left"></i></div>
				<div id="port-prev" class="enigma_carousel-next" ><i class="fa fa-arrow-right"></i></div>
	</div>
	</div>
</div>