<?php
class WP_TIMELINE{
	protected static $instance = null;
	
	public function __construct(){
		add_action('init',array(__CLASS__,'generate_timeline_page'));
	}

	public static function generate_timeline_page(){
		$labels = array(
			'name'                  => _x( 'Timeline', 'Post Type General Name', 'wp-timeline' ),
			'singular_name'         => _x( 'Timeline', 'Post Type Singular Name', 'wp-timeline' ),
			'menu_name'             => __( 'Timeline', 'wp-timeline' ),
			'name_admin_bar'        => __( 'Post Type', 'wp-timeline' ),
			'parent_item_colon'     => __( 'Parent Timeline:', 'wp-timeline' ),
			'all_items'             => __( 'Timelines', 'wp-timeline' ),
			'add_new_item'          => __( 'Add New Timeline', 'wp-timeline' ),
			'add_new'               => __( 'Add New', 'wp-timeline' ),
			'new_item'              => __( 'New Timeline', 'wp-timeline' ),
			'edit_item'             => __( 'Edit Timeline', 'wp-timeline' ),
			'update_item'           => __( 'Update Timeline', 'wp-timeline' ),
			'view_item'             => __( 'View Timeline', 'wp-timeline' ),
			'search_items'          => __( 'Search Timeline', 'wp-timeline' ),
			'not_found'             => __( 'Not found', 'wp-timeline' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-timeline' ),
			'items_list'            => __( 'Timelines list', 'wp-timeline' ),
			'items_list_navigation' => __( 'Timeline list navigation', 'wp-timeline' ),
			'filter_items_list'     => __( 'Filter Timelines list', 'wp-timeline' ),
		);

		$rewrite = array(
			'slug'                  => 'timeline',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
						
		$args = array(
			'label'                 => __( 'Timeline', 'wp-timeline' ),
			'description'           => __( 'Timelinepress Timelines', 'wp-timeline' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'comments' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'               => $rewrite
		);

		register_post_type( 'wp-timeline', $args );
	}
	
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}