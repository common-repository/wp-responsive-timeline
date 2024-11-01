<?php
class WP_TIMELINE_META{
	protected static $instance = null;
	
	protected $color_classes;

	public function __construct(){
		$this->color_classes = array(
			array(
				'value' => 'warning',
				'title'	=> 'Pastel orange',
				'color' => '#f8b14a',
			),
			array(
				'value' => 'success',
				'title'	=> 'Java',
				'color' => '#1ccdcf',
			),
			array(
				'value' => 'danger',
				'title'	=> 'Fire engine red',
				'color' => '#CE2020',
			),
			array(
				'value' => 'primary',
				'title'	=> 'Light pastel purple',
				'color' => '#b29cdc',
			),
			array(
				'value' => 'info',
				'title'	=> 'Deep sky blue',
				'color' => '#00a7ff',
			)
		);

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
		$post_types = apply_filters( 'wp-timeline-cpt', array('wp-timeline') ); 
		
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'wp-timeline-attributes',
				__( 'Timeline Attributes', 'wp-timeline' ),
				array( $this, 'render_timeline_box' ),
				$post_type,
				'side',
				'high'
			);
		}
	}

	public function render_timeline_box( $post ) {
		wp_nonce_field( 'timeline_attribute_box', 'timeline_attribute_box_nonce' );

		$current_color_class = get_post_meta( $post->ID, 'timeline_color_class', true );

		$color_classes = apply_filters( 'wp-timeline-colors', $this->color_classes);

		$output  = '<table>';
		$output .= '<th><label for="timeline-color">'.__('Color','wp-timeline').'</label></th>';
		$output .= '<td><select name="timeline_color" id="timeline-color">';
		$output .= '<option value="">'.__('Select Color','wp-timeline').'</option>';
		
		foreach($color_classes as $color){
			$output .= '<option value="'.$color['value'].'" '.( ($current_color_class == $color['value'])? 'selected':'').' data-color="'.$color['color'].'">'.$color['title'].'</option>';
		}
		$output .= '</select></td>';
		$output .= '</table>';

		echo $output;
	}

	public function save( $post_id ) {
		if ( ! isset( $_POST['timeline_attribute_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['timeline_attribute_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'timeline_attribute_box' ) )
			return $post_id;

		$timeline_color = sanitize_text_field( $_POST['timeline_color'] );
		update_post_meta( $post_id, 'timeline_color_class', $timeline_color );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}