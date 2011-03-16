<?php

class WP_Lite_Autosuggest_Control
{
	public function __construct()
	{
		if ( ! function_exists( 'load_wp_json_rpc_api' ) ) {
			include_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'wp-json-rpc-api' . DIRECTORY_SEPARATOR . 'wp-json-rpc-api.php';
		}

		include_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'json-server-class.php';

		load_wp_json_rpc_api();
	}

	/**
	 * Get search results from query.
	 *
	 * @param string $query The search query.
	 * @param array $extras Optional. The submitted data in an associated array.
	 * @return The results.
	 */
	public function get_results_from_query( $query = '', $extras = array() )
	{
		
	}
}

class WP_Lite_Autosuggest_Model
{
	/**
	 * Create a query object from the submitted extra data.
	 *
	 * @param array $data The submitted data about this query.
	 * @return WP_Lite_Autosuggest_Query The query object reflecting this query.
	 */
	public function build_query( $data = array() )
	{
		$query = new WP_Lite_Autosuggest_Query;	
	}
}

/**
 * A query object
 */
class WP_Lite_Autosuggest_Query
{
	/**
	 * Reflecting the type of query: 'post', 'term', 'user', or 'custom'
	 */
	public $query_type = 'post';
	public $post_types = array( 'post', 'page' );

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
