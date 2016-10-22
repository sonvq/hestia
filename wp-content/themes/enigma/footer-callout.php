<div class="enigma_callout_area">
	<div class="container">
		<div class="row">
		<?php
        $args = array('post_type' => 'testimonial', 'posts_per_page' => 9, 'orderby' => 'rand');
        $testimonial_list = new WP_Query($args);
        ?>
        <?php if ($testimonial_list->have_posts()): ?>
            <section class="project-list-home">
                <div class="container">
                    <div class="row">
                        <div id="mycarou">
                        <?php while ($testimonial_list->have_posts()): $testimonial_list->the_post(); ?>
                            <div class="gridSingleItem" style="cursor: pointer"> 
                                <div class="col-sm-12">
<a style="display:none" href="http://passioninvestment.vn/testimonial/"></a>
                                    <p><i class="fa fa-thumbs-up"></i><?php echo '"' . get_the_content() . '"';?></p>
                                </div>
                                <div class="col-sm-12 text-right tesimonial-name">
	                             	<p><em><b>~ <?php the_title(); ?> ~</b></em>
	                                <span class="position"><em><?php echo types_render_field('position', array('post_id' => get_the_ID(), 'output' => 'raw')); ?></em></span>
                                </p>
			             
                                </div>                                
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
		</div>
		
	</div>
	<div class="enigma_callout_shadow"></div>
</div>

<script>
jQuery(".gridSingleItem").click(function() {
  window.location = jQuery(this).find("a").attr("href"); 
  return false;
});
</script>