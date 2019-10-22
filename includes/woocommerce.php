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

	add_action( 'woocommerce_before_shop_loop', $n( 'sorting_wrapper' ), 9 );

	add_action( 'woocommerce_after_shop_loop', $n( 'sorting_wrapper' ), 9 );

	add_action( 'woocommerce_after_shop_loop', $n( 'sorting_wrapper_close' ), 31 );

	add_action( 'woocommerce_before_shop_loop', $n( 'sorting_wrapper_close' ), 31 );

	add_action( 'woocommerce_before_single_product', $n( 'single_product_header' ), 5 );

	add_filter( 'woocommerce_breadcrumb_home_url', $n( 'breadcrumb_home_url' ) );

	add_filter( 'woocommerce_product_description_heading', '__return_null' );

	add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

	add_filter( 'wp_nav_menu_args', $n( 'filter_nav_menus' ) );

	add_filter( 'woocommerce_add_to_cart_fragments', __NAMESPACE__ . '\\go_cart_fragments', PHP_INT_MAX );

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
 * Enable the WooCommerce menu item
 *
 * @param  array $args Menu arguments.
 *
 * @return array Menu arguments array.
 */
function filter_nav_menus( $args ) {

	if ( is_admin() || 'primary' !== $args['theme_location'] || ! should_show_woo_cart_item() ) {

		return $args;

	}

	add_filter( 'wp_get_nav_menu_items', __NAMESPACE__ . '\\woocommerce_menu_cart', 20, 2 );

	return $args;

}

/**
 * Append a cart icon and a slideout menu
 *
 * @param  array  $items Navigation menu items.
 * @param  object $menu  Navigation menu object.
 *
 * @return array Filtered nav menu items.
 */
function woocommerce_menu_cart( $items, $menu ) {

	remove_filter( current_filter(), __FUNCTION__, 20, 2 );

	$items[] = go_cart_menu_object();

	return $items;

}

/**
 * Simple helper function for make menu item objects
 *
 * @return stdClass
 */
function go_cart_menu_object() {

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
	 * Filters the cart menu item text.
	 *
	 * @since NEXT
	 *
	 * @param string Text for the cart menu item.
	 */
	$cart_text = (string) apply_filters(
		'go_menu_cart_text',
		sprintf(
			'%1$s (<span class="item-count">%2$d</span>)',
			$icon,
			$woocommerce->cart->get_cart_contents_count()
		)
	);

	if ( empty( $cart_text ) ) {

		$cart_text = sprintf(
			'%1$s (%2$d)',
			$icon,
			$woocommerce->cart->get_cart_contents_count()
		);

	}

	$item                   = new \stdClass();
	$item->ID               = 'go-woo-cart';
	$item->db_id            = $item->ID;
	$item->title            = $cart_text;
	$item->url              = esc_url( $cart_url );
	$item->menu_order       = PHP_INT_MAX;
	$item->menu_item_parent = 0;
	$item->post_parent      = 0;
	$item->type             = 'cart';
	$item->object           = 'cart';
	$item->object_id        = '';
	$item->classes          = [];
	$item->target           = '';
	$item->attr_title       = '';
	$item->description      = '';
	$item->xfn              = '';
	$item->status           = '';

	return $item;

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

	$fragments['span.item-count'] = '<span class="item-count">' . $woocommerce->cart->get_cart_contents_count() . '</span>';

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
