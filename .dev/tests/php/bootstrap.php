<?php

// Require dependencies.
require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/vendor/wp-phpunit/wp-phpunit/__loaded.php';
require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php';

// If we're running in WP's build directory, ensure that WP knows that, too.
if ( 'build' === getenv( 'LOCAL_DIR' ) ) {
	define( 'WP_RUN_CORE_TESTS', true );
}

// Determine the tests directory (from a WP dev checkout).
// Try the WP_TESTS_DIR environment variable first.
$_tests_dir = getenv( 'WP_TESTS_DIR' );

// Next, try the WP_PHPUNIT composer package if we're inside wp-env.
if ( ! $_tests_dir && 'tests-mysql' === getenv( 'WORDPRESS_DB_HOST' ) ) {
	$_tests_dir = getenv( 'WP_PHPUNIT__DIR' );
}

// See if we're installed inside an existing WP dev instance.
if ( ! $_tests_dir ) {
	$_try_tests_dir = dirname( __FILE__ ) . '/../../../../../tests/phpunit';
	if ( file_exists( $_try_tests_dir . '/includes/functions.php' ) ) {
		$_tests_dir = $_try_tests_dir;
	}
}
// Fallback.
if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run .dev/bin/install-wp-tests.sh ?" . PHP_EOL; // WPCS: XSS ok.
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

	update_option( 'active_plugins', [ 'coblocks/class-coblocks.php' ] );

}
tests_add_filter( 'muplugins_loaded', '_register_theme' );

/**
 * Install WooCommerce
 */
tests_add_filter( 'setup_theme', function() {
	include '/var/www/html/wp-content/plugins/woocommerce/woocommerce.php';
	// Clean existing install first.
	define( 'WP_UNINSTALL_PLUGIN', true );
	define( 'WC_REMOVE_ALL_DATA', true );
	include '/var/www/html/wp-content/plugins/woocommerce/uninstall.php';
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
