<?php

class WP_Lite_Autosuggest_Control
{
	public function __construct()
	{
		if ( ! function_exists( 'load_wp_json_rpc_api' ) ) {
			include_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'wp-json-rpc-api' . DIRECTORY_SEPARATOR . 'wp-json-rpc-api.php';
		}

		load_wp_json_rpc_api();

		add_action( 'init', array($this, 'event_init' ) );
	}

	public function event_init()
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
