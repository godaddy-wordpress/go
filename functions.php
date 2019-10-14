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

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 */
	function wp_body_open() {
		// Triggered after the opening <body> tag.
		// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'wp_body_open' );
	}
endif;









if ( ! function_exists( 'go_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @return  void
	 */
	function go_sorting_wrapper() {
		echo '<div class="go-sorting">';
	}
}

if ( ! function_exists( 'go_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @return  void
	 */
	function go_sorting_wrapper_close() {
		echo '</div>';
	}
}

add_action( 'woocommerce_before_shop_loop', 'go_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop', 'go_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop', 'go_sorting_wrapper_close', 31 );
add_action( 'woocommerce_before_shop_loop', 'go_sorting_wrapper_close', 31 );
