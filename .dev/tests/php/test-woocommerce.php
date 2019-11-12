<?php

class Test_WooCommerce extends WP_UnitTestCase {

	private $woo;

	private $woo_cart;

	private $shop_page_id;

	function setUp() {

		parent::setUp();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Helper to initialize a WooCommerce session and cart
	 */
	private function initialize_woo_session() {

		set_current_screen( 'frontend' );

		if ( ! class_exists( 'WooCommerce' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/woocommerce.php';

		}

		if ( ! class_exists( 'WC_Install' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/class-wc-install.php';

		}

		if ( ! function_exists( 'wc_notice_count' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-notice-functions.php';

		}

		if ( ! function_exists( 'wc_get_cart_item_data_hash' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-cart-functions.php';

		}

		if ( ! function_exists( 'woocommerce_page_title' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-template-functions.php';

		}

		// install WC
		WC_Install::install();
		$GLOBALS['wp_roles'] = null;
		wp_roles();

		$this->shop_page_id = $this->factory->post->create(
			[
				'post_title'   => 'Shop Page',
				'post_type'    => 'page',
				'post_staus'   => 'publish',
			]
		);

		update_option( 'woocommerce_shop_page_id', $this->shop_page_id );

		global $woocommerce;

		// Setup the cart
		$woocommerce->cart = new WC_Cart();

		$this->woo      = $woocommerce;
		$this->woo_cart = $woocommerce->cart;

		// Initialize the session
		$woocommerce->init();
		$woocommerce->initialize_session();

	}

	/**
	 * Create a simple WooCommerce product
	 */
	private function create_simple_product() {

		$post_id = $this->factory->post->create(
			[
				'post_title'   => 'Simple Product',
				'post_type'    => 'product',
				'post_staus'   => 'publish',
				'post_content' => 'Product post content',
				'post_excerpt' => 'Product excerpt'
			]
		);

		wp_set_object_terms( $post_id, 'simple', 'product_type' );
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock');
		update_post_meta( $post_id, 'total_sales', '0' );
		update_post_meta( $post_id, '_downloadable', 'no' );
		update_post_meta( $post_id, '_virtual', 'yes' );
		update_post_meta( $post_id, '_regular_price', '' );
		update_post_meta( $post_id, '_sale_price', '' );
		update_post_meta( $post_id, '_purchase_note', '' );
		update_post_meta( $post_id, '_featured', 'no' );
		update_post_meta( $post_id, '_weight', '11' );
		update_post_meta( $post_id, '_length', '11' );
		update_post_meta( $post_id, '_width', '11' );
		update_post_meta( $post_id, '_height', '11' );
		update_post_meta( $post_id, '_sku', 'SKU11' );
		update_post_meta( $post_id, '_product_attributes', [] );
		update_post_meta( $post_id, '_sale_price_dates_from', '' );
		update_post_meta( $post_id, '_sale_price_dates_to', '' );
		update_post_meta( $post_id, '_price', '11.00' );
		update_post_meta( $post_id, '_sold_individually', '' );
		update_post_meta( $post_id, '_manage_stock', 'yes' );
		wc_update_product_stock( $post_id, 99, 'set' );
		update_post_meta( $post_id, '_backorders', 'no' );

		return $post_id;

	}

	/**
	 * Test that the WooCommerce class does not run when WooCommerce is not active
	 */
	function test_setup_no_woocommerce() {

		Go\WooCommerce\setup();

		$this->assertFalse(
			has_action( 'woocommerce_cart_is_empty', 'Go\WooCommerce\wc_empty_cart_message' ),
			'woocommerce_cart_is_empty looks to be attached to Go\WooCommerce\wc_empty_cart_message. It should not be.'
		);

	}

	/**
	 * Test that Go\WooCommerce\woocommerce_cart_link() returns null when WooCommerce is not active
	 */
	function test_woocommerce_cart_link_no_woocommerce() {

		$this->assertNull( Go\WooCommerce\woocommerce_cart_link() );

	}

	/**
	 * Test WooCommerce core function wc_empty_cart_message is unhooked
	 */
	function test_setup_removed_wc_empty_cart_message() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertFalse(
			has_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message' ),
			'woocommerce_cart_is_empty is attached to wc_empty_cart_message. It should not be.'
		);

	}

	/**
	 * Test Go\WooCommerce\empty_cart_message is hooked
	 */
	function test_setup_hooked_empty_cart_message() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_cart_is_empty', 'Go\WooCommerce\empty_cart_message' ),
			'woocommerce_cart_is_empty is not attached to Go\WooCommerce\empty_cart_message. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test Go\WooCommerce\page_title_visibility is hooked
	 */
	function test_setup_hooked_page_title_visibility() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_show_page_title', 'Go\WooCommerce\page_title_visibility' ),
			'woocommerce_show_page_title is not attached to Go\WooCommerce\page_title_visibility. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test Go\WooCommerce\shop_title is hooked
	 */
	function test_setup_hooked_shop_title() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_archive_description', 'Go\WooCommerce\shop_title' ),
			'woocommerce_archive_description is not attached to Go\WooCommerce\shop_title. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test Go\WooCommerce\sorting_wrapper is hooked before the shop loop
	 */
	function test_setup_hooked_sorting_wrapper_before_shop_loop() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			9,
			has_action( 'woocommerce_before_shop_loop', 'Go\WooCommerce\sorting_wrapper' ),
			'woocommerce_before_shop_loop is not attached to Go\WooCommerce\sorting_wrapper. It might also have the wrong priority (validated priority: 9)'
		);

	}

	/**
	 * Test Go\WooCommerce\sorting_wrapper is hooked after the shop loop
	 */
	function test_setup_hooked_sorting_wrapper_after_shop_loop() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			9,
			has_action( 'woocommerce_after_shop_loop', 'Go\WooCommerce\sorting_wrapper' ),
			'woocommerce_after_shop_loop is not attached to Go\WooCommerce\sorting_wrapper. It might also have the wrong priority (validated priority: 9)'
		);

	}

	/**
	 * Test Go\WooCommerce\sorting_wrapper_close is hooked after the shop loop
	 */
	function test_setup_hooked_sorting_wrapper_close_after_shop_loop() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			31,
			has_action( 'woocommerce_after_shop_loop', 'Go\WooCommerce\sorting_wrapper_close' ),
			'woocommerce_after_shop_loop is not attached to Go\WooCommerce\sorting_wrapper_close. It might also have the wrong priority (validated priority: 31)'
		);

	}

	/**
	 * Test Go\WooCommerce\sorting_wrapper_close is hooked before the shop loop
	 */
	function test_setup_hooked_sorting_wrapper_close_before_shop_loop() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			31,
			has_action( 'woocommerce_before_shop_loop', 'Go\WooCommerce\sorting_wrapper_close' ),
			'woocommerce_before_shop_loop is not attached to Go\WooCommerce\sorting_wrapper_close. It might also have the wrong priority (validated priority: 31)'
		);

	}

	/**
	 * Test Go\WooCommerce\single_product_header is hooked
	 */
	function test_setup_hooked_single_product_header() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			5,
			has_action( 'woocommerce_before_single_product', 'Go\WooCommerce\single_product_header' ),
			'woocommerce_before_single_product is not attached to Go\WooCommerce\single_product_header. It might also have the wrong priority (validated priority: 5)'
		);

	}

	/**
	 * Test Go\WooCommerce\breadcrumb_home_url is hooked
	 */
	function test_setup_hooked_breadcrumb_home_url() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_breadcrumb_home_url', 'Go\WooCommerce\breadcrumb_home_url' ),
			'woocommerce_breadcrumb_home_url is not attached to Go\WooCommerce\breadcrumb_home_url. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test that __return_null is hooked into woocommerce_product_description_heading
	 */
	function test_setup_hooked_product_description_heading_null() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_product_description_heading', '__return_null' ),
			'woocommerce_product_description_heading is not attached to __return_null. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test that __return_null is hooked into woocommerce_product_additional_information_heading
	 */
	function test_setup_hooked_product_additional_information_heading_null() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_product_additional_information_heading', '__return_null' ),
			'woocommerce_product_additional_information_heading is not attached to __return_null. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test reset_variations_link is hooked
	 */
	function test_setup_hooked_reset_variations_link() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			10,
			has_action( 'woocommerce_reset_variations_link', 'Go\WooCommerce\reset_variations_link' ),
			'woocommerce_reset_variations_link is not attached to Go\WooCommerce\reset_variations_link. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test go_cart_fragments is hooked
	 */
	function test_setup_hooked_go_cart_fragments() {

		$this->initialize_woo_session();

		Go\WooCommerce\setup();

		$this->assertEquals(
			PHP_INT_MAX,
			has_action( 'woocommerce_add_to_cart_fragments', 'Go\WooCommerce\go_cart_fragments' ),
			'woocommerce_add_to_cart_fragments is not attached to Go\WooCommerce\go_cart_fragments. It might also have the wrong priority (validated priority: PHP_INT_MAX)'
		);

	}

	/**
	 * Test the WooCommerce cart link does not render when go_wc_show_cart_menu is false
	 */
	function test_woocommerce_cart_link_disabled_woo_cart_link() {

		$this->initialize_woo_session();

		add_filter( 'go_wc_show_cart_menu', '__return_false' );

		$this->assertNull( Go\WooCommerce\woocommerce_cart_link() );

	}

	/**
	 * Test the WooCommerce cart link returns properly
	 */
	function test_woocommerce_cart_link() {

		$this->initialize_woo_session();

		Go\WooCommerce\woocommerce_cart_link();

		$this->expectOutputRegex( '/<a href="http:\/\/example.org" class="header__cart-toggle" alt="View cart" aria-label="View cart"><svg role="img" viewBox="0 0 24 24" height="24" width="24" xmlns="http:\/\/www.w3.org\/2000\/svg">/' );

	}

	/**
	 * Test the go_menu_cart_url filter works as intended
	 */
	function test_woocommerce_cart_link_go_menu_cart_url_filter() {

		$this->initialize_woo_session();

		add_filter( 'go_menu_cart_url', function() {
			return 'https://www.google.com';
		} );

		Go\WooCommerce\woocommerce_cart_link();

		$this->expectOutputRegex( '/<a href="https:\/\/www.google.com" class="header__cart-toggle" alt="View cart" aria-label="View cart"><svg role="img" viewBox="0 0 24 24" height="24" width="24" xmlns="http:\/\/www.w3.org\/2000\/svg">/' );

	}

	/**
	 * Test the go_menu_cart_alt filter works as intended
	 */
	function test_woocommerce_cart_link_go_menu_cart_alt_filter() {

		$this->initialize_woo_session();

		add_filter( 'go_menu_cart_alt', function() {
			return 'Alternate Text';
		} );

		Go\WooCommerce\woocommerce_cart_link();

		$this->expectOutputRegex( '/<a href="http:\/\/example.org" class="header__cart-toggle" alt="Alternate Text" aria-label="Alternate Text">/' );

	}

	/**
	 * Test the go_menu_cart_text filter works as intended
	 */
	function test_woocommerce_cart_link_go_menu_cart_text_filter() {

		$this->initialize_woo_session();

		add_filter( 'go_menu_cart_text', function() {
			return 'Custom Cart Text';
		} );

		Go\WooCommerce\woocommerce_cart_link();

		$this->expectOutputRegex( '/<a href="http:\/\/example.org" class="header__cart-toggle" alt="View cart" aria-label="View cart">Custom Cart Text<\/a>/' );

	}

	/**
	 * Test that Go\WooCommerce\woocommerce_cart_link() returns correct when no cart text is specified
	 */
	function test_woocommerce_cart_link_empty_cart_text() {

		$this->initialize_woo_session();

		add_filter( 'go_menu_cart_text', function() {
			return '';
		} );

		Go\WooCommerce\woocommerce_cart_link();

		$this->expectOutputRegex( '/<a href="http:\/\/example.org" class="header__cart-toggle" alt="View cart" aria-label="View cart"><svg role="img" viewBox="0 0 24 24" height="24" width="24" xmlns="http:\/\/www.w3.org\/2000\/svg">/' );

	}

	/**
	 * Test that WooCommerce Go cart fragments are not set when the cart is disabled
	 */
	function test_woocommerce_go_cart_fragments_cart_disabled() {

		add_filter( 'go_wc_show_cart_menu', '__return_false' );

		$this->assertEquals( [], Go\WooCommerce\go_cart_fragments( [] ) );

	}

	/**
	 * Test that WooCommerce Go cart fragments are set when the cart is enabled and 0 products in it
	 */
	function test_woocommerce_go_cart_fragments_cart_enabled_cart_zero() {

		$this->initialize_woo_session();

		$expected_fragments = [
			'span.item-count' => '<span class="item-count count--zero">0</span>',
		];

		$this->assertEquals( $expected_fragments, Go\WooCommerce\go_cart_fragments( [] ) );

	}

	/**
	 * Test that WooCommerce Go cart fragments are set when the cart is enabled and 3 products in it
	 */
	function test_woocommerce_go_cart_fragments_cart_enabled_cart_three() {

		$this->initialize_woo_session();

		$product_id = $this->create_simple_product();

		$this->woo->cart->add_to_cart( $product_id, 3 );

		$this->woo->cart->calculate_totals();

		$expected_fragments = [
			'.class'          => 'Text',
			'span.item-count' => '<span class="item-count">3</span>',
		];

		$this->assertEquals( $expected_fragments, Go\WooCommerce\go_cart_fragments( [ '.class' => 'Text' ] ) );

	}

	/**
	 * Test the empty cart message is set
	 */
	function test_woocommerce_empty_cart_message() {

		if ( ! function_exists( 'wc_get_page_permalink' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-page-functions.php';

		}

		Go\WooCommerce\empty_cart_message( [] );

		$this->expectOutputRegex( '/<a href="http:\/\/example.org"><svg viewBox="0 0 24 30">/' );

	}

	/**
	 * Test the woocommerce_return_to_shop_redirect filter works as intended
	 */
	function test_woocommerce_empty_cart_message_woocommerce_return_to_shop_redirect_filter() {

		if ( ! function_exists( 'wc_get_page_permalink' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-page-functions.php';

		}

		add_filter( 'woocommerce_return_to_shop_redirect', function() {
			return 'https://www.google.com';
		} );

		Go\WooCommerce\empty_cart_message( [] );

		$this->expectOutputRegex( '/<a href="https:\/\/google.com"><svg viewBox="0 0 24 30">/' );

	}

	/**
	 * Test the wc_empty_cart_message filter works as intended
	 */
	function test_woocommerce_empty_cart_message_wc_empty_cart_message_filter() {

		if ( ! function_exists( 'wc_get_page_permalink' ) ) {

			include WP_PLUGIN_DIR . '/woocommerce/includes/wc-page-functions.php';

		}

		add_filter( 'wc_empty_cart_message', function() {
			return 'Back to Store';
		} );

		Go\WooCommerce\empty_cart_message( [] );

		$this->expectOutputRegex( '/Back to Store/' );

	}

	/**
	 * Test the page title visibility is correct on non-shop pages
	 */
	function test_page_title_visibility_non_shop() {

		$this->initialize_woo_session();

		$this->assertTrue( Go\WooCommerce\page_title_visibility( true ) );

	}

	/**
	 * Test the page title visibility is correct on shop pages
	 */
	function test_page_title_visibility_shop() {

		$this->initialize_woo_session();

		global $wp_query;

		$wp_query->post_type               = 'product';
		$wp_query->query_vars['post_type'] = 'product';
		$wp_query->query_vars['wc_query']  = 'product_query';
		$wp_query->is_post_type_archive = 1;

		$this->assertFalse( Go\WooCommerce\page_title_visibility( true ) );

	}

	/**
	 * Test shop_title() returns null when ! is_shop()
	 */
	function test_shop_title_non_shop() {

		$this->initialize_woo_session();

		$this->assertNull( Go\WooCommerce\shop_title() );

	}

	/**
	 * Test shop_title() returns correct when is_shop()
	 */
	function test_shop_title_shop() {

		$this->initialize_woo_session();

		global $wp_query;

		$wp_query->post_type               = 'product';
		$wp_query->query_vars['post_type'] = 'product';
		$wp_query->query_vars['wc_query']  = 'product_query';
		$wp_query->queried_object          = get_post( $this->shop_page_id );
		$wp_query->is_post_type_archive    = 1;

		ob_start();
		Go\WooCommerce\shop_title( false );
		$shop_page_title = ob_get_clean();

		$this->assertEquals( '<header class="page-header entry-header m-auto px "><h1 class="page__title m-0 text-center">Shop Page</h1></header>', $shop_page_title );

	}
}
