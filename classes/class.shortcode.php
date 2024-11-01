<?php
class WP_TIMELINE_SHORTCODE{
	protected static $instance = null;

	protected $selected_template;

	public function __construct(){

		$this->selected_template = wpt_get_current_template();

		add_shortcode( 'wp_timeline_post', array($this,'get_timeline_shortcode_template') );
	}

	public function get_timeline_shortcode_template($atts){
		$atts = shortcode_atts( array(
			'post_types' 		=> 'post',
			'posts_per_page'	=> -1,
			'post_status'      => 'publish'
		), $atts, 'wp_timeline_post' );

		$wprt_posts = get_wprt_query($atts);
		
		if ( !$template = locate_template( 'wp-timeline/timeline-'.$this->selected_template.'-shortcode.php' ) ) {
		   $template =  WPTIMELINE_DIR . '/templates/timeline-'.$this->selected_template.'-shortcode.php';
		}

		ob_start();
			require( $template );
			$output = ob_get_clean();
		ob_flush();

		return $output;
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}