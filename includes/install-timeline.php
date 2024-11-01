<?php

function install_wpt_timeline(){
	WP_TIMELINE::generate_timeline_page();
	flush_rewrite_rules();
}