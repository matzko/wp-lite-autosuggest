<?php

class WP_Lite_Autosuggest_Server extends WP_JSON_RPC_Server 
{
	public function __construct()
	{
		$this->methods['wpLiteAutosuggest.submitQuery'] = 'this:submitQuery';
	}

	public function submitQuery( $args = null )
	{
		global $wp_lite_autosuggest;

		if ( empty( $args->{'query'} ) ) {
			$response = new WP_Error(
				-32602, 
				__('Invalid method parameters: wpLiteAutosuggest.submitQuery requires that a query text be specified.', 'wp-lite-autosuggest')
			);
		} else {
			$results = $wp_lite_autosuggest->get_results_from_query( $args->{'query'} ); 
			if ( is_wp_error( $results ) ) {
				return $results;
			} else {
			}
		}

		return $response;
	}

}

function wp_lite_autosuggest_filter_json_server_classname( $server_class = '', $method = '' )
{
	switch( $method ) :
		case 'wpLiteAutosuggest.submitQuery' :
			$server_class = 'WP_Lite_Autosuggest_Server';
		break;
	endswitch;
	return $server_class;
}

add_filter('json_server_classname', 'wp_lite_autosuggest_filter_json_server_classname', 10, 2);
