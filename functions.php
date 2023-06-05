<?php
/**
 * Go functions and definitions
 *
 * @package Go
 */

// Load deactivation modal.
define( 'GO_VERSION', '2.0.0' );
define( 'GO_PLUGIN_DIR', get_template_directory( __FILE__ ) );
define( 'GO_PLUGIN_URL', get_template_directory_uri( __FILE__ ) );
require_once get_parent_theme_file_path( 'includes/class-go-theme-deactivation.php' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function go_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_editor_style( 'style.css' );

	// Disable CoBlocks Site Design controls.
	delete_option( 'coblocks_site_design_controls_enabled' );
}

add_action( 'after_theme_setup', 'go_theme_setup' );

/**
 * Enqueue theme styles.
 */
function go_theme_styles() {
	wp_enqueue_style(
		'style',
		get_stylesheet_uri(),
		array(),
		GO_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'go_theme_styles' );

// Migration process.
if ( isset( $_GET['migrate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
	require_once get_parent_theme_file_path( '/includes/class-classic-conversion.php' );

	$go_conversion = Go\Classic_Conversion::get_instance();
	$go_conversion->set_base_path(
		get_parent_theme_file_path( '/functions.php' )
	);

	// Convert classic menus to block based menus.
	$go_conversion->convert_nav_menus();

	// Convert theme mods to user global styles.
	$go_conversion->apply_global_styles();

	// Apply customizations to block templates.
	$go_conversion->apply_template_customizations(
		$go_conversion->get_block_templates( '/templates' )
	);

	// Apply customizations to block template parts.
	$go_conversion->apply_template_part_customizations(
		$go_conversion->get_block_templates( '/parts' )
	);
}
