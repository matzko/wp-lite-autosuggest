<?php

class WP_Lite_Autosuggest_Control
{
	public function __construct()
	{
	}
}

function load_wp_lite_autosuggest()
{
	global $wp_lite_autosuggest;
	$wp_lite_autosuggest = new WP_Lite_Autosuggest_Control;
}

add_action( 'plugins_loaded', 'load_wp_lite_autosuggest' );
// eof
