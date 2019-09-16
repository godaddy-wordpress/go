<?php
/**
 * WooCommerce Setup
 *
 * @package Go\WooCommerce
 */

namespace Go\WooCommerce;

use function Go\load_inline_svg;

/**
 * Set up WooCommerce hooks
 *
 * @return void
 */
function setup() {

	if ( ! class_exists( 'WooCommerce' ) ) {

		return;

	}

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );

	add_action( 'woocommerce_cart_is_empty', $n( 'empty_cart_message' ), 10 );

}

/**
 * Render a custom WooCommerce empty cart notice
 *
 * @return mixed Markup for empty cart notice.
 */
function empty_cart_message() {

	printf(
		'<div class="max-w-base m-0 px m-auto text-center">
			<div class="cart-empty-icon">
				<div class="svg__wrapper">
					<a href="%1$s">%2$s</a>
				</div>
			</div>
			<p class="cart-empty">%3$s</p>
		</div>',
		esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ),
		wp_kses(
			load_inline_svg( 'woocommerce/empty-cart.svg' ),
			array_merge(
				wp_kses_allowed_html( 'post' ),
				[
					'svg'  => [
						'width'   => true,
						'role'    => true,
						'height'  => true,
						'fill'    => true,
						'xmlns'   => true,
						'viewbox' => true,
					],
					'path' => [
						'd'    => true,
						'fill' => true,
					],
					'g'    => [
						'd'    => true,
						'fill' => true,
					],
				]
			)
		),
		esc_html( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'go' ) ) )
	);

}
