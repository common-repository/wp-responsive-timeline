<?php
class WP_TIMELINE_SCRIPTS{
	protected static $instance = null;
	
	protected $available_templates;

	protected $selected_template;

	public function __construct(){
		$this->available_templates = array( 'vertical' );
		$this->selected_template = 'vertical';

		add_action('admin_enqueue_scripts',array($this,'load_admin_script') );
		add_action('wp_enqueue_scripts',array($this,'load_frontend_script') );
	}

	public function load_admin_script(){

		wp_enqueue_script( 'wpt-admin-script', WPTIMELINE_URL.'/assets/js/admin.js', array('jquery-ui-selectmenu'),'1.0', true );
		wp_enqueue_style( 'wpt-admin-style', WPTIMELINE_URL.'/assets/css/admin.css');
	}


	public function load_frontend_script(){
		wp_enqueue_style( 'wpt-'.$this->selected_template.'-style', WPTIMELINE_URL.'/assets/css/template-'.$this->selected_template.'.css');
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}