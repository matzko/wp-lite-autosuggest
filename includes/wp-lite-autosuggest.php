<?php

class WP_Lite_Autosuggest_Control
{
	public $model; 
	public function __construct()
	{
		$this->model = new WP_Lite_Autosuggest_Model;

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
		$query_obj = $this->model->build_query( $extras );	
		$query_obj->query = $query;
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
		return $query;
	}

	/**
	 * Perform a query using the query object.
	 *
	 * @param WP_Lite_Autosuggest_Query $qry The query object.
	 * @return WP_Lite_Autosuggest_Query_Results object.
	 */
	public function perform_query( WP_Lite_Autosuggest_Query $qry )
	{
		$results = new WP_Lite_Autosuggest_Query_Results; 

		$qry = apply_filters( 'wpl_autosuggest_query', $qry );
	}
}

/**
 * A query object
 */
class WP_Lite_Autosuggest_Query
{
	/**
	 * The text to search for
	 */
	public $query = '';

	/**
	 * Reflecting the type of query: 'post', 'term', 'user', or 'custom'
	 */
	public $query_type = 'post';
	public $post_types = array( 'post', 'page' );

	public function __construct()
	{

	}
}

class WP_Lite_Autosuggest_Query_Link
{
	public $url;
	public $excerpt;
	public $content;
	public $title;
}

/**
 * Iterate over WP_Lite_Autosuggest_Query_Link objects
 */
class WP_Lite_Autosuggest_Query_Results implements Iterator
{
	private $_objects;
	private $_position = 0;

	public function add_result( WP_Lite_Autosuggest_Query_Link $result )
	{
		$this->_objects[] = $result;
	}

	/**
	 * Iterator-required methods
	 */

	/**
	 * Return the current content object.
	 *
	 * @return result
	 */
	public function current()
	{
		return $this->_objects[$this->_position];
	}

	/**
	 * @return scalar
	 */
	public function key()
	{
		return $this->_position;
	}

	/**
	 * @return void 
	 */
	public function next()
	{
		$this->_position++;
	}

	/**
	 * @return void
	 */
	public function rewind()
	{
		$this->_position = 0;
	}

	/**
	 * @return boolean
	 */
	public function valid()
	{
		return ( isset($this->_objects[$this->_position]) && $this->_objects[$this->_position] instanceof WP_Lite_Autosuggest_Query_Link );
	}
	
	/**
	 * End required iterator methods
	 */
}

function load_wp_lite_autosuggest()
{
	global $wp_lite_autosuggest;
	$wp_lite_autosuggest = new WP_Lite_Autosuggest_Control;
}

add_action( 'plugins_loaded', 'load_wp_lite_autosuggest' );
// eof
