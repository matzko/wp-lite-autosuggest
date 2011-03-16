<?php
/*
Plugin Name: WordPress Lite Autosuggest
Plugin URI:
Description: Provide a lightweight autosuggest tool for WordPress.
Version: 1.0
Author: Austin Matzko
Author URI: http://austinmatzko.com

Copyright 2011 Austin Matzko

*/

if ( version_compare( PHP_VERSION, '5.2.0') >= 0 ) {

	require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'wp-lite-autosuggest.php';
	
} else {
	
	function wp_lite_autosuggest_php_version_message()
	{
		?>
		<div id="wp-lite-autosuggest-warning" class="updated fade error">
			<p>
				<?php 
				printf(
					__('<strong>ERROR</strong>: Your WordPress site is using an outdated version of PHP, %s.  Version 5.2 of PHP is required to use the WP Lite Autosuggest plugin. Please ask your host to update.', 'wp-lite-autosuggest'),
					PHP_VERSION
				);
				?>
			</p>
		</div>
		<?php
	}

	add_action('admin_notices', 'wp_lite_autosuggest_php_version_message');
}

function wp_lite_autosuggest_init_event()
{
	load_plugin_textdomain('wp-lite-autosuggest', null, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'l10n');
}

add_action('init', 'wp_lite_autosuggest_init_event');
