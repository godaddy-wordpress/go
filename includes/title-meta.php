<?php
/**
 * Page Title Meta setup
 *
 * @package Go\Title_Meta
 */

namespace Go\Title_Meta;

/**
 * Set up Title Meta hooks
 *
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_filter( 'go_page_title_args', $n( 'hide_page_title' ) );

	register_meta(
		'post',
		'hide_page_title',
		array(
			'sanitize_callback' => $n( 'hide_page_title_callback' ),
			'type'              => 'string',
			'description'       => __( 'Hide Page Title.', 'go' ),
			'show_in_rest'      => true,
			'single'            => true,
		)
	);

}

/**
 * Hide page title meta callback
 *
 * @param  string $status Hide page title status (eg: enable, disabled).
 *
 * @return string Whether or not the page title should be enabled or not.
 */
function hide_page_title_callback( $status ) {

	$status = strtolower( trim( $status ) );

	if ( ! in_array( $status, array( 'enabled', 'disabled' ), true ) ) {

		$status = '';

	}

	return $status;

}

/**
 * Hide page title box
 *
 * @param array $title_data The title data.
 *
 * @return array Filtered title data.
 */
function hide_page_title( $title_data ) {

	if ( is_singular( 'page' ) && 'enabled' === get_post_meta( get_the_ID(), 'hide_page_title', true ) ) {

		$title_data['title'] = '';

	}

	return $title_data;

}
