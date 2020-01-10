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
	$plugin_root   = dirname( dirname( $theme_dir ) ) . '/plugins/';

	add_filter( 'theme_root', function() use ( $theme_root ) {

		return $theme_root;

	} );

	add_filter( 'pre_option_template', function() use ( $current_theme ) {

		return $current_theme;

	} );

	add_filter( 'pre_option_stylesheet', function() use ( $current_theme ) {

		return $current_theme;

	} );

	$theme_symlink = '/tmp/wordpress/wp-content/themes/go';

	if ( ! file_exists( $theme_symlink ) ) {

		shell_exec( "ln -s ${theme_dir} ${theme_symlink}" );

	}

	$coblocks_symlink = '/tmp/wordpress/wp-content/plugins/coblocks';

	if ( ! file_exists( $coblocks_symlink ) ) {

		shell_exec( "ln -s ${plugin_root}/coblocks ${coblocks_symlink}" );

	}

	$woocommerce_symlink = '/tmp/wordpress/wp-content/plugins/woocommerce';

	if ( ! file_exists( $woocommerce_symlink ) ) {

		shell_exec( "ln -s ${plugin_root}/woocommerce ${woocommerce_symlink}" );

	}

	update_option( 'active_plugins', [ 'coblocks/class-coblocks.php' ] );

}
tests_add_filter( 'muplugins_loaded', '_register_theme' );

/**
 * Install WooCommerce
 */
tests_add_filter( 'setup_theme', function() {
	include '/tmp/wordpress/wp-content/plugins/woocommerce/woocommerce.php';
	// Clean existing install first.
	define( 'WP_UNINSTALL_PLUGIN', true );
	define( 'WC_REMOVE_ALL_DATA', true );
	include '/tmp/wordpress/wp-content/plugins/woocommerce/uninstall.php';
	WC_Install::install();
	// Reload capabilities after install, see https://core.trac.wordpress.org/ticket/28374
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		$GLOBALS['wp_roles']->reinit();
	} else {
		$GLOBALS['wp_roles'] = null; // WPCS: override ok.
		wp_roles();
	}
	echo esc_html( 'Installing WooCommerce...' . PHP_EOL );
} );


// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
