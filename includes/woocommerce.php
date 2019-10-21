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

}

/**
 * Enable the WooCommerce menu item
 *
 * @param  array $args Menu arguments.
 *
 * @return array Menu arguments array.
 */
function filter_nav_menus( $args ) {

	/**
	 * Filter whether to display the WooCommerce cart menu item.
	 * Default: `true`
	 *
	 * @since NEXT
	 *
	 * @var bool
	*/
	$show_woo_cart_menu = (bool) apply_filters( 'go_wc_show_cart_menu', true );

	if ( is_admin() || 'primary' !== $args['theme_location'] || ! $show_woo_cart_menu ) {

		return $args;

	}

	add_filter( 'wp_get_nav_menu_items', __NAMESPACE__ . '\\woocommerce_menu_cart', 20, 2 );

	if ( is_cart() ) {

		return $args;

	}

	add_filter( 'wp_enqueue_scripts', __NAMESPACE__ . '\\woocommerce_menu_cart_scripts' );

	add_action( 'wp_footer', __NAMESPACE__ . '\\woocommerce_slideout_cart' );

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

	ob_start();
	load_inline_svg( 'shopping-bag.svg' );
	$bag = ob_get_clean();

	global $woocommerce;

	$cart_count = $woocommerce->cart->get_cart_contents_count();

	$items[] = _custom_nav_menu_item(
		sprintf(
			'<span class="cart-menu hover-out">
				%1$s
				<span class="count-holder">
					<span class="count">%2$s</span>
				</span>
			</span>',
			$bag,
			$cart_count
		),
		'#',
		100
	);

	return $items;

}

/**
 * Enqueue the menu cart scripts
 */
function woocommerce_menu_cart_scripts() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'go-woocommerce-menu-cart',
		get_theme_file_uri( "dist/js/shared/menu-cart{$suffix}.js" ),
		[ 'jquery' ],
		GO_VERSION,
		true
	);

}

/**
 * Render the markup for yhe WooCommerce slideout cart
 *
 * @return mixed Markup for the slideout cart.
 */
function woocommerce_slideout_cart() {

	global $woocommerce;

	$cart_count = $woocommerce->cart->get_cart_contents_count();

	?>

	<div id="site-overlay" class="site-overlay"></div>

	<div id="site-nav--cart" class="site-nav style--sidebar show-cart">

		<button id="site-close-handle" class="site-close-handle" aria-label="<?php esc_attr_e( 'Close sidebar', 'go' ); ?>" title="<?php esc_attr_e( 'Close sidebar', 'go' ); ?>">
			<span class="hamburger-menu active" aria-hidden="true">
				<span class="bar animate"></span>
			</span>
		</button>

		<div id="site-cart" class="site-nav-container" tabindex="-1">

			<div class="site-nav-container-last">

				<div class="site-cart-heading">

					<h6 class="title"><?php esc_html_e( 'Cart', 'go' ); ?></h6>

					<p class="subtitle">
						<?php
						printf(
							esc_html(
								/* translators: 1. Single integer value. (eg: 1 product in your cart). 2. Integer larger than 1. (eg: 5 products in your cart). */
								_n( '%s product in your cart', '%s products in your cart', $cart_count, 'go' )
							),
							esc_html( number_format_i18n( $cart_count ) )
						);
						?>
					</p>

				</div>

				<?php the_widget( 'WC_Widget_Cart', [], [ 'before_title' => '<h2 class="widgettitle screen-reader-text"">' ] ); ?>

			</div>

		</div>

	</div>

	<?php

}

/**
 * Simple helper function for make menu item objects
 *
 * @param string $title      Menu item title.
 * @param string $url        Menu item url.
 * @param int    $order      Where the item should appear in the menu.
 * @param int    $parent     Nav menu item's parent item.
 *
 * @return stdClass
 */
function _custom_nav_menu_item( $title, $url, $order, $parent = 0 ) {

	$item                   = new \stdClass();
	$item->ID               = 'go-woo-slideout';
	$item->db_id            = $item->ID;
	$item->title            = $title;
	$item->url              = $url;
	$item->menu_order       = $order;
	$item->menu_item_parent = $parent;
	$item->type             = 'custom';
	$item->object           = 'custom';
	$item->object_id        = '';
	$item->classes          = [ 'js-woo-slideout' ];
	$item->target           = '';
	$item->attr_title       = '';
	$item->description      = '';
	$item->xfn              = '';
	$item->status           = '';

	return $item;

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
			load_inline_svg( 'empty-cart.svg' ),
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
