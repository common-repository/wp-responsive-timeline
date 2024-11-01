<div class="timeline-container">
	<?php if( $wprt_posts ): ?>
		<ul class="timeline">
	    		<?php foreach ($wprt_posts as $post): setup_postdata( $post ); ?>
	    		<li class="<?php echo wpt_get_timeline_class(); ?>">
		            <div class="timeline-badge">
		            	<span class=" spinner-cube-1 spinner-cube"></span>
		            	<span class="spinner-cube-2 spinner-cube"></span>
		            </div>
		            <div class="timeline-panel">
		                <div class="timeline-heading">
		                    <h4 class="timeline-title"><?php echo get_the_title(); ?></h4>
		                </div>
		                <div class="timeline-body">
		                    <p><?php echo get_the_excerpt(); ?></p>
		                </div>
		                 <div class="timeline-footer">
		                 	<small class="text-muted">
		                 		<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) .' '. __('ago via','wp-timeline').' '.get_the_author(); ?>
		                 	</small>
		                 </div>
		            </div>
		        </li>
		    <?php endforeach;  
		    	wp_reset_postdata(); ?>
		</ul>
	    <?php
    	else:
			get_template_part( 'content', 'none' );
		endif;
	?>
</div>

