<?php

require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/vendor/autoload.php';

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {

	$_tests_dir = '/tmp/wordpress-tests-lib';

}

require_once $_tests_dir . '/includes/functions.php';
require $_tests_dir . '/includes/bootstrap.php';
