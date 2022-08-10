<?php
/**
 * Go functions and definitions
 *
 * @package Go
 */

/**
 * Theme constants.
 */
define( 'GO_VERSION', '1.6.5' );
define( 'GO_PLUGIN_DIR', get_template_directory( __FILE__ ) );
define( 'GO_PLUGIN_URL', get_template_directory_uri( __FILE__ ) );

/**
 * AMPP setup, hooks, and filters.
 */
require_once get_parent_theme_file_path( 'includes/amp.php' );

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
 * Page Titles Meta functions.
 */
require_once get_parent_theme_file_path( 'includes/title-meta.php' );

/**
 * Go Deactivate Modal functions.
 */
require_once get_parent_theme_file_path( 'includes/classes/admin/class-go-theme-deactivation.php' );

/**
 * Layouts for the CoBlocks layout selector.
 */
foreach ( glob( get_parent_theme_file_path( 'partials/layouts/*.php' ) ) as $filename ) {
	require_once $filename;
}

/**
 * Run setup functions.
 */
Go\AMP\setup();
Go\Core\setup();
Go\TGM\setup();
Go\Customizer\setup();
Go\WooCommerce\setup();
Go\Title_Meta\setup();

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 */
	function wp_body_open() {
		// Triggered after the opening <body> tag.
		do_action( 'wp_body_open' );
	}
endif;
