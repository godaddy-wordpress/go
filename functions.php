<?php
/**
 * Go functions and definitions
 *
 * @package Go
 */

/**
 * Theme constants.
 */
define( 'GO_VERSION', '0.2.0' );

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
 * WooCommerce functions.
 */
require_once get_parent_theme_file_path( 'includes/woocommerce.php' );

/**
 * Run setup functions.
 */
Go\Core\setup();
Go\TGM\setup();
Go\Customizer\setup();
Go\WooCommerce\setup();

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for the the new wp_body_open() function that was added in 5.2
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
