<?php
/**
 * Plugin Name: Go Design Style Example
 * Plugin URI:
 * Description:
 * Author: GoDaddy
 * Version: 1.22.0
 * Text Domain:
 * Domain Path:
 * Tested up to: 5.6
 *
 * @package Go
 */

/**
 *  Add my Brutalist design style
 *
 * @since 0.1.0
 *
 * @param array $default_design_styles Array containings the supported design styles,
 * where the index is the slug of design style and value an array of options that sets up the design styles.
 */
function prefix_get_available_design_styles( $default_design_styles ) {

	$default_design_styles['brutalist'] = array(
		'slug'           => 'brutalist',
		'label'          => _x( 'Brutalist', 'design style name', 'go' ),
		'url'            => plugin_dir_url( __FILE__ ) . 'style-brutalist.css',
		'editor_style'   => plugin_dir_url( __FILE__ ) . 'style-brutalist.css',
		'color_schemes'  => array(
			'one' => array(
				'label'      => _x( 'Millennial', 'color palette name', 'go' ),
				'primary'    => '#0d00ff',
				'secondary'  => '#ccff04',
				'tertiary'   => '#f7ceff',
				'background' => '#ccff04',
			),
			'two' => array(
				'label'      => _x( 'Blush', 'color palette name', 'go' ),
				'primary'    => '#5501e6',
				'secondary'  => '#00fc75',
				'tertiary'   => '#f6ffd8',
				'background' => '#00fc75',
			),
		),
		'fonts'          => array(
			'Bungee'        => array(
				'400',
			),
			'IBM Plex Mono' => array(
				'400',
				'800',
			),
		),
		'viewport_basis' => '950',
	);

	return $default_design_styles;

}
add_filter( 'go_design_styles', 'prefix_get_available_design_styles' );
