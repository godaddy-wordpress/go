#!/usr/bin/env php
<?php

// Construct the iterator.
$it = new RecursiveDirectoryIterator( './woocommerce' );

// Loop through template files.
foreach ( new RecursiveIteratorIterator( $it ) as $file ) {

	if ( $file->getExtension() !== 'php' ) {

		continue;

	}

	$template_dir = str_replace( './woocommerce/', '', $file );

	$remote_template_contents = file_get_contents( sprintf( 'https://raw.githubusercontent.com/woocommerce/woocommerce/trunk/plugins/woocommerce/templates/%s', $template_dir ) );

	// Grab the version from the remote template.
	preg_match( '/(?:@version)\s*((?:[0-9]+\.?)+)/i', $remote_template_contents, $matches );

	if ( empty( $matches ) ) {

		printf( 'No versions found in remote template file: %s.' . PHP_EOL, $template );

		continue;

	}

	$current_woocommerce_template_version = $matches[1];

	$bundled_template_markup = file_get_contents( $file );

	// Grab the version from the bundled template.
	preg_match( '/(?:@version)\s*((?:[0-9]+\.?)+)/i', $bundled_template_markup, $matches );

	if ( empty( $matches ) ) {

		printf( 'No versions found in bundled template file: %s.' . PHP_EOL, $template_dir );

		continue;

	}

	$bundled_woocommerce_template_version = $matches[1];

	if ( version_compare( $current_woocommerce_template_version, $bundled_woocommerce_template_version, '=' ) ) {

		printf( 'Remote template and bundled template versions match: %s' . PHP_EOL, $template_dir );
		exit;

	}

	// Update the version in the template file.
	printf( 'Bundled template version is outdated (%1$s). Updating %2$s now.' . PHP_EOL, $bundled_woocommerce_template_version, $template_dir );

	$new_file_contents = str_replace( sprintf( '@version %s', $bundled_woocommerce_template_version ), sprintf( '@version %s', $current_woocommerce_template_version ), $bundled_template_markup );

	file_put_contents( $file, $new_file_contents );

	printf( sprintf( 'Updated %s.' . PHP_EOL, $template_dir ) );

}

print( 'Done.' . PHP_EOL );
exit;
