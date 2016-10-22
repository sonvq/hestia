<div class="input-group">
	 <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>"> 	
		<input type="text" class="form-control"  name="s" id="s" placeholder="<?php _e( "Search for?", 'weblizar' ); ?>" />
		<span class="input-group-btn">
		<button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
		</span>
	 </form> 
</div>
<div class="input-group" style="margin-right: 10px;">
	<?php do_action('wpml_add_language_selector'); ?>
</div>