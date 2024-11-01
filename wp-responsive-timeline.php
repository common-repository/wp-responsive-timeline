<?php
/*
Plugin Name: WP Responsive Timeline
Description:  A plugin that displays a timeline in your site.
Plugin URI: http://wordpress.org/plugins/wp-responsive-timeline
Author: subedimadhu
Author URI: http://www.subedimadhukar.com.np/
Version: 2.0
License: GPL2
Text Domain: wp-timeline
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('WPTIMELINE_DIR', dirname( __FILE__ ) );
define('WPTIMELINE_URL', plugins_url('', __FILE__ ));

require_once WPTIMELINE_DIR.'/includes/install-timeline.php';

require_once WPTIMELINE_DIR.'/includes/wpt-functions.php';

require_once WPTIMELINE_DIR.'/classes/class.wp-timeline.php';
require_once WPTIMELINE_DIR.'/classes/class.timeline-meta.php';
require_once WPTIMELINE_DIR.'/classes/class.scripts.php';
require_once WPTIMELINE_DIR.'/classes/class.frontend-timeline.php';
require_once WPTIMELINE_DIR.'/classes/class.shortcode.php';

register_activation_hook( __FILE__, 'install_wpt_timeline' );

add_action( 'plugins_loaded', array('WP_TIMELINE', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_TIMELINE_META', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_TIMELINE_SCRIPTS', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_TIMELINE_FRONTEND', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_TIMELINE_SHORTCODE', 'get_instance' ) );