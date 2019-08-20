<?php
/**
 * Maverick functions and definitions
 *
 * @package Maverick
 */

/**
 * Theme constants.
 */
define( 'MAVERICK_VERSION', '0.2.0' );

/**
 * Core setup, hooks, and filters.
 */
require_once get_parent_theme_file_path( 'includes/core.php' );

/**
 * Customizer additions.
 */
require_once get_parent_theme_file_path( 'includes/customizer.php' );

/**
 * Custom template tags for the theme.
 */
require_once get_parent_theme_file_path( 'includes/template-tags.php' );

/**
 * Pluggable functions.
 */
require_once get_parent_theme_file_path( 'includes/pluggable.php' );

/**
 * TGMPA plugin activation.
 */
require_once get_parent_theme_file_path( 'includes/tgm.php' );

/**
 * Run setup functions.
 */
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
