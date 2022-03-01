<?php
/**
 * WooCommerce Setup
 *
 * @package Go\WooCommerce
 */

namespace Go\Deactivation;

/**
 * Set up WooCommerce hooks
 *
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'admin_footer-themes.php', $n( 'admin_go_deactivation_modal' ) );

	add_filter( 'admin_enqueue_scripts', $n( 'enqueue_scripts' ) );

}

/**
 * Register meta.
 *
 * @param string $hook_suffix The current admin page.
 */
function enqueue_scripts( $hook_suffix ) {

	if ( 'themes.php' !== $hook_suffix ) {

		return;

	}

	$suffix = SCRIPT_DEBUG ? '' : '.min';
	$rtl    = ! is_rtl() ? '' : '-rtl';

	// Enqueue modal script.
	wp_enqueue_script(
		'go-theme-deactivation',
		wp_unslash( get_theme_file_uri( "dist/js/admin/deactivation{$suffix}.js" ) ),
		array(),
		GO_VERSION,
		true
	);

	$wpnux_export_data = json_decode( get_option( 'wpnux_export_data', '[]' ), true );

	// Pass data.
	wp_localize_script(
		'go-theme-deactivation',
		'goThemeDeactivateData',
		array(
			'containerClass' => 'go-theme-deactivate-modal',
			'hostname'       => gethostname(),
			'domain'         => site_url(),
			'goThemeVersion' => GO_VERSION,
			'wpVersion'      => $GLOBALS['wp_version'],
			'wpOptions'      => array(
				'persona' => isset( $wpnux_export_data['_meta']['persona'] ) ? $wpnux_export_data['_meta']['persona'] : null,
				'skill'   => isset( $wpnux_export_data['_meta']['skill'] ) ? $wpnux_export_data['_meta']['skill'] : null,
			),
		)
	);

	wp_enqueue_style(
		'go-theme-deactivation',
		get_theme_file_uri( "dist/css/admin/style-deactivate-modal{$rtl}{$suffix}.css" ),
		array(),
		GO_VERSION
	);

}

/**
 * Add Go Theme Deactivation Modal backdrop to the DOM.
 */
function admin_go_deactivation_modal() {

	?>

	<div id="<?php echo esc_attr( 'go-theme-deactivate-modal' ); ?>"></div>

	<?php

}
