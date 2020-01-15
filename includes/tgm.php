<?php
/**
 * TGM setup
 *
 * @package Go\TGM
 */

namespace Go\TGM;

// This file contains the TMGPA class for installing plugins, not template partials.
// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
require_once get_parent_theme_file_path( 'includes/classes/class-tgm-plugin-activation.php' );

/**
 * Set up TGM hooks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'tgmpa_register', $n( 'register_required_plugins' ) );
}

/**
 * Register the required plugins.
 *
 * @return void
 */
function register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'CoBlocks',
			'slug'     => 'coblocks',
			'required' => false,
		),
	);

	/**
	 * Filters the list of plugin depedencies.
	 *
	 * @since 0.1.0
	 *
	 * @param array $plugins Array containings the plugin dependencies in the TGM format.
	 */
	$plugins = (array) apply_filters( 'go_plugin_dependencies', $plugins );

	$config = array(
		'id'           => 'go',                    // Unique ID for hashing notices for multiple instances of TGMPA.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
