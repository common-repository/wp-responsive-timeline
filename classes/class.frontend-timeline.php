<?php
class WP_TIMELINE_FRONTEND{
	protected static $instance = null;
	
	protected $available_templates;

	protected $selected_template;

	protected $post_types;

	public function __construct(){
		$this->available_templates = wpt_get_available_templates();
		$this->selected_template = wpt_get_current_template();

		$this->post_types = apply_filters( 'wp-timeline-cpt', array('wp-timeline') ); 

		add_filter( 'archive_template', array($this,'inject_timeline_template') );
	}

	public function inject_timeline_template($template){
		$post_type = get_post_type();
		
		if ( in_array( $post_type, $this->post_types ) ) {
			if ( !$template = locate_template( 'wp-timeline/timeline-'.$this->selected_template.'.php' ) ) {
			   $template =  WPTIMELINE_DIR . '/templates/timeline-'.$this->selected_template.'.php';
			}	
		}
		return $template;
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}