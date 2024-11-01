<?php
	global $post_counter;

	$post_counter = 0;
	function wpt_get_timeline_class(){
		global $post;
		global $post_counter;

		$current_class = array();

		if( $post_counter%2 == 0 ){
			$current_class[] = "timeline-ordered";
		}else{
			$current_class[] = "timeline-inverted";
		}
		
		if( $post ){
			$current_class[] = get_post_meta( $post->ID, 'timeline_color_class', true );
		}else{
			$current_class[] = 'default';
		}
		$post_counter++;
		$class = implode(' ', $current_class);
		
		return $class;
	}

	function wpt_get_available_templates(){
		$templates = array(
			'vertical' 
		);

		return $templates;
	}

	function wpt_get_current_template(){
		return 'vertical';
	}


	function get_wprt_query($args){
		$posts = get_posts($args);
		return $posts;
	}