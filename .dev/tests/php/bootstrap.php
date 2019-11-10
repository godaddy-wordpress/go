<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {

	$_tests_dir = '/tmp/wordpress-tests-lib';

}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {

	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL;

	exit( 1 );

}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Registers theme
 */
function _register_theme() {

	$theme_dir     = dirname( dirname( dirname( __DIR__ ) ) );
	$current_theme = basename( $theme_dir );
	$theme_root    = dirname( $theme_dir );

	add_filter( 'theme_root', function() use ( $theme_root ) {

		return $theme_root;

	} );

	register_theme_directory( $theme_root );

	add_filter( 'pre_option_template', function() use ( $current_theme ) {

		return $current_theme;

	} );

	add_filter( 'pre_option_stylesheet', function() use ( $current_theme ) {

		return $current_theme;

	} );

	$symlink = '/tmp/wordpress/wp-content/themes/go';

	if ( ! file_exists( $symlink ) ) {

		shell_exec( "ln -s ${theme_dir} ${symlink}" );

	}

	// $plugins_to_active = [
	// 	'coblocks/class-coblocks.php',
	// 	'woocommerce/woocommerce.php',
	// ];

	// update_option( 'active_plugins', $plugins_to_active );

}
tests_add_filter( 'muplugins_loaded', '_register_theme' );


// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
