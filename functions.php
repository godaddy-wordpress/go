<?php
/**
 * WP Theme constants and setup functions
 *
 * @package Maverick
 */

// Useful global constants.
define( 'MAVERICK_VERSION', '0.2.0' );
define( 'MAVERICK_TEMPLATE_URL', get_template_directory_uri() );

require_once get_parent_theme_file_path( '/includes/core.php' );
require_once get_parent_theme_file_path( '/includes/tgm.php' );
require_once get_parent_theme_file_path( '/includes/customizer.php' );
require_once get_parent_theme_file_path( '/includes/template-tags.php' );
require_once get_parent_theme_file_path( '/includes/pluggable.php' );

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
