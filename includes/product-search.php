<?php
/**
 * AJAX product search REST endpoint for the Go theme.
 *
 * Exposes `/wp-json/go/v1/product-search` that returns lightweight product
 * suggestions (id, title, permalink, price HTML, thumbnail) for a search
 * term. The frontend live-search component (assets/shared/js/frontend/
 * components/product-search.js) consumes this endpoint to render a
 * dropdown of matches as the user types in any element marked with the
 * CSS class `js-go-product-search`.
 *
 * Only active when WooCommerce is loaded.
 *
 * @package Go\Product_Search
 */

namespace Go\Product_Search;

/**
 * Max products returned per search.
 */
const RESULT_LIMIT = 8;

/**
 * Hook setup.
 *
 * @return void
 */
function setup() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	add_action( 'rest_api_init', __NAMESPACE__ . '\\register_routes' );
}

/**
 * Register the REST route.
 *
 * @return void
 */
function register_routes() {

	register_rest_route(
		'go/v1',
		'/product-search',
		array(
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'args'                => array(
				'q'        => array(
					'type'              => 'string',
					'required'          => true,
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => __NAMESPACE__ . '\\validate_query',
				),
				'category' => array(
					'type'              => 'integer',
					'required'          => false,
					'sanitize_callback' => 'absint',
				),
			),
			'callback'            => __NAMESPACE__ . '\\handle_search',
		)
	);
}

/**
 * Require a query of at least two visible characters so we do not run a
 * full-table scan for every keystroke.
 *
 * @param mixed $value Submitted value.
 * @return bool
 */
function validate_query( $value ) {
	return is_string( $value ) && 2 <= mb_strlen( trim( $value ) );
}

/**
 * Handle the search request.
 *
 * @param \WP_REST_Request $request REST request.
 * @return \WP_REST_Response
 */
function handle_search( $request ) {

	$query    = trim( (string) $request->get_param( 'q' ) );
	$category = (int) $request->get_param( 'category' );

	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'posts_per_page'      => RESULT_LIMIT,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		's'                   => $query,
		'tax_query'           => array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
				'operator' => 'NOT IN',
			),
		),
	);

	if ( 0 < $category ) {
		$args['tax_query'][] = array(
			'taxonomy'         => 'product_cat',
			'field'            => 'term_id',
			'terms'            => array( $category ),
			'include_children' => true,
		);
	}

	$results = array();
	$wp_query = new \WP_Query( $args );

	if ( $wp_query->have_posts() ) {
		foreach ( $wp_query->posts as $post ) {
			$product = function_exists( 'wc_get_product' ) ? wc_get_product( $post->ID ) : null;

			if ( ! $product ) {
				continue;
			}

			$thumb_id  = (int) get_post_thumbnail_id( $post->ID );
			$thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'woocommerce_thumbnail' ) : wc_placeholder_img_src( 'woocommerce_thumbnail' );

			$results[] = array(
				'id'         => (int) $post->ID,
				'title'      => wp_strip_all_tags( get_the_title( $post ) ),
				'url'        => get_permalink( $post ),
				'price_html' => $product->get_price_html(),
				'on_sale'    => $product->is_on_sale(),
				'in_stock'   => $product->is_in_stock(),
				'thumbnail'  => $thumb_url ? $thumb_url : '',
			);
		}
	}

	return rest_ensure_response(
		array(
			'query'   => $query,
			'count'   => count( $results ),
			'results' => $results,
		)
	);
}

setup();
