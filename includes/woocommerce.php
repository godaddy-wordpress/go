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

	add_filter( 'woocommerce_show_page_title', $n( 'page_title_visibility' ) );

	add_action( 'woocommerce_archive_description', $n( 'shop_title' ) );

	add_action( 'woocommerce_before_shop_loop', $n( 'sorting_wrapper' ), 9 );

	add_action( 'woocommerce_after_shop_loop', $n( 'sorting_wrapper' ), 9 );

	add_action( 'woocommerce_after_shop_loop', $n( 'sorting_wrapper_close' ), 31 );

	add_action( 'woocommerce_before_shop_loop', $n( 'sorting_wrapper_close' ), 31 );

	add_action( 'woocommerce_before_single_product', $n( 'single_product_header' ), 5 );

	add_filter( 'woocommerce_breadcrumb_home_url', $n( 'breadcrumb_home_url' ) );

	add_filter( 'woocommerce_product_description_heading', '__return_null' );

	add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

	add_filter( 'woocommerce_reset_variations_link', $n( 'reset_variations_link' ) );

	add_filter( 'woocommerce_add_to_cart_fragments', $n( 'go_cart_fragments' ), PHP_INT_MAX );

}

/**
 * Whether or not the WooCommerce cart icon is enabled.
 *
 * @return bool True when enabled, else false.
 */
function should_show_woo_cart_item() {

	/**
	 * Filter whether to display the WooCommerce cart menu item.
	 * Default: `true`
	 *
	 * @since NEXT
	 *
	 * @var bool
	*/
	return (bool) apply_filters( 'go_wc_show_cart_menu', true );

}

/**
 * Generate a WooCommerce cart link
 *
 * @return void
 */
function woocommerce_cart_link() {

	if ( ! class_exists( 'WooCommerce' ) ) {

		return;

	}

	if ( ! should_show_woo_cart_item() ) {

		return;

	}

	ob_start();
	load_inline_svg( 'cart.svg' );
	$icon = ob_get_clean();

	global $woocommerce;

	/**
	 * Filters the cart menu item URL.
	 *
	 * @since NEXT
	 *
	 * @param string URL to the WooCommerce cart page.
	 */
	$cart_url = (string) apply_filters( 'go_menu_cart_url', wc_get_cart_url() );

	/**
	 * Filters the cart menu item alt text.
	 *
	 * @since NEXT
	 *
	 * @param string Alt text for the cart menu item.
	 */
	$cart_alt_text = (string) apply_filters( 'go_menu_cart_alt', __( 'View cart', 'go' ) );

	/**
	 * Filters the cart menu item text.
	 *
	 * @since NEXT
	 *
	 * @param string Text for the cart menu item.
	 */
	$cart_text = (string) apply_filters(
		'go_menu_cart_text',
		sprintf(
			'%1$s <span class="item-count">%2$d</span>',
			$icon,
			$woocommerce->cart->get_cart_contents_count()
		)
	);

	if ( empty( $cart_text ) ) {

		$cart_text = sprintf(
			'%1$s %2$d',
			$icon,
			$woocommerce->cart->get_cart_contents_count()
		);

	}

	printf(
		'<a href="%1$s" class="header__cart-toggle" alt="%2$s" aria-label="%2$s">%3$s</a>',
		esc_url( $cart_url ),
		esc_html( $cart_alt_text ),
		$cart_text // @codingStandardsIgnoreLine
	);

}

/**
 * Filter the cart fragments to update the cart count.
 *
 * @param  array $fragments Array of elements to update via JS.
 *
 * @return array Filtered array of elements.
 */
function go_cart_fragments( $fragments ) {

	if ( ! should_show_woo_cart_item() ) {

		return $fragments;

	}

	global $woocommerce;

	$cart_count  = $woocommerce->cart->get_cart_contents_count();
	$count_class = ( $cart_count > 0 ) ? '' : ' count--zero';

	$fragments['span.item-count'] = sprintf(
		'<span class="item-count%1$s">%2$s</span>',
		esc_attr( $count_class ),
		esc_html( $cart_count )
	);

	return $fragments;

}

/**
 * Render a custom WooCommerce empty cart notice
 *
 * @return mixed Markup for empty cart notice.
 */
function empty_cart_message() {

	ob_start();
	load_inline_svg( 'empty-cart.svg' );
	$icon = ob_get_clean();

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
			$icon,
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

/**
 * Toggle the visibility of WooCommerce shop page titles
 *
 * @param bool $show_title Whether or not to display the WooCommerce page title.
 *
 * @return bool False when shop page, else true.
 */
function page_title_visibility( $show_title ) {

	return is_shop() ? false : $show_title;

}

/**
 * Output a custom WooCommerce shop page title
 *
 * @return mixed Markup for the shop page title
 */
function shop_title() {

	if ( ! is_shop() ) {

		return;

	}

	add_filter( 'go_page_title_args', __NAMESPACE__ . '\\shop_title_attributes' );

	\Go\page_title();

	remove_filter( 'go_page_title_args', __NAMESPACE__ . '\\shop_title_attributes' );

}

/**
 * Filter the WooCommerce shop page title attributes
 *
 * @param array $atts Title attributes.
 *
 * @return array Title attributes array
 */
function shop_title_attributes( $atts ) {

	$atts['title']         = woocommerce_page_title( false );
	$atts['atts']['class'] = 'page__title m-0 text-center';
	$atts['custom']        = false;

	return $atts;

}

/**
 * Output single product header
 *
 * @return mixed Markup for the single product header
 */
function single_product_header() {

	?>

	<div class="product-navigation-wrapper">
		<?php
			woocommerce_breadcrumb(
				[
					'delimiter' => '<span class="sep">&#47;</span>',
					'home'      => woocommerce_page_title( false ),
				]
			);
			single_product_pagination();
			single_product_back_to_shop();
		?>
	</div>

	<?php

}

/**
 * Add post pagination to WooCommerce products.
 */
function single_product_pagination() {

	ob_start();
	load_inline_svg( 'arrow-left.svg' );
	$arrow_left = ob_get_clean();

	ob_start();
	load_inline_svg( 'arrow-right.svg' );
	$arrow_right = ob_get_clean();

	the_post_navigation(
		[
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post: ', 'go' ) . ' %title</span>' . $arrow_left . '<span class="nav-title">' . esc_html__( 'Previous', 'go' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post:', 'go' ) . ' %title</span><span class="nav-title">' . esc_html__( 'Next', 'go' ) . '</span>' . $arrow_right,
		]
	);

}

/**
 * Add the "back to shop" link to the single products, if on mobile.
 */
function single_product_back_to_shop() {

	ob_start();
	load_inline_svg( 'arrow-left.svg' );
	$arrow_left = ob_get_clean();

	/**
	 * Filters the back to shop link URL.
	 *
	 * @since NEXT
	 *
	 * @param string URL to the WooCommerce shop page.
	 */
	$url = apply_filters( 'go_back_to_shop_url', get_permalink( wc_get_page_id( 'shop' ) ) );

	/**
	 * Filters the back to shop link text.
	 *
	 * @since NEXT
	 *
	 * @param string The text used in the back link.
	 */
	$text = apply_filters( 'go_back_to_shop_text', esc_html__( 'Back', 'go' ) );

	printf(
		'<a href="%s" class="back-to-shop">%s%s</a>',
		esc_url( $url ),
		$arrow_left, // @codingStandardsIgnoreLine
		esc_html( $text )
	);

}

/**
 * Set the URL of the first link in the breadcrumbs to the shop page
 *
 * @return string URL to the shop page
 */
function breadcrumb_home_url() {

	return get_permalink( wc_get_page_id( 'shop' ) );

}

/**
 * Sorting wrapper
 *
 * @return  void
 */
function sorting_wrapper() {

	echo '<div class="go-sorting">';

}

/**
 * Sorting wrapper close
 *
 * @return  void
 */
function sorting_wrapper_close() {

	echo '</div>';

}

/**
 * Update the reset variations link text
 *
 * @param string $link Variations link text.
 */
function reset_variations_link( $link ) {

	return sprintf(
		'<a class="reset_variations" href="#">%s</a>',
		esc_html__( 'Reset Selections', 'go' )
	);

}
