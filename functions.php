<?php
/**
 * WP Theme constants and setup functions
 *
 * @package Maverick
 */

// Useful global constants.
define( 'MAVERICK_VERSION', '0.2.0' );
define( 'MAVERICK_TEMPLATE_URL', get_template_directory_uri() );
define( 'MAVERICK_PATH', get_template_directory() . '/' );
define( 'MAVERICK_INC', MAVERICK_PATH . 'includes/' );

require_once MAVERICK_INC . 'core.php';
require_once MAVERICK_INC . 'tgm.php';
require_once MAVERICK_INC . 'customizer.php';
require_once MAVERICK_INC . 'template-tags.php';
require_once MAVERICK_INC . 'pluggable.php';

// Run the setup functions.
Maverick\Core\setup();
Maverick\TGM\setup();
Maverick\Customizer\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for the the new wp_body_open() function that was added in 5.2
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
