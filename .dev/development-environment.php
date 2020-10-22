<?php
/**
 * AMP Compatibility.
 *
 * @package Go\AMP
 */

namespace Go\Development_Environment;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {

		return;

	}

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	\Go\Development_Environment\log_error();

	add_filter( 'admin_notices', $n( 'development_environment_notice' ), PHP_INT_MAX, 4 );

}

/**
 * Log the error into the error log
 *
* @return void
 */
function log_error() {

	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {

		return;

	}

	error_log( // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		sprintf(
			/* translators: Placeholder is a link to the support document on GitHub. */
			__( 'Your installation of the Go theme is incomplete. If you installed the Go theme from GitHub, please refer to this document to set up your development environment: %1$s', 'go' ),
			'https://github.com/godaddy-wordpress/go/blob/master/docs/development-environment.md'
		)
	);

}
/**
 * Display an admin notice back to the user directing them to our development environment documentation
 *
 * @return mixed Markup for the admin notice.
 */
function development_environment_notice() {

	?>

	<div class="notice notice-error is-dismissible">
		<p>
			<?php
			printf(
				wp_kses(
					/* translators: Placeholder is a link to the support document on GitHub. */
					__( 'Your installation of the Go theme is incomplete. If you installed the Go theme from GitHub, please refer to <a href="%1$s" target="_blank" rel="noopener noreferrer">this document</a> to set up your development environment.', 'go' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				'https://github.com/godaddy-wordpress/go/blob/master/docs/development-environment.md'
			);
			?>
		</p>
	</div>

	<?php

}

\Go\Development_Environment\setup();
