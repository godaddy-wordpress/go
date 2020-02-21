<?php

class Test_AMP extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		Go\AMP\setup();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test the hooked amp_nav_sub_menu_buttons
	 */
	function test_hooked_amp_nav_sub_menu_buttons() {

		$this->assertEquals(
			10,
			has_action( 'walker_nav_menu_start_el', 'Go\AMP\amp_nav_sub_menu_buttons' ),
			'walker_nav_menu_start_el is not attached to Go\AMP\amp_nav_sub_menu_buttons. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked amp_body_class
	 */
	function test_hooked_amp_body_class() {

		$this->assertEquals(
			10,
			has_action( 'body_class', 'Go\AMP\amp_body_class' ),
			'body_class is not attached to Go\AMP\amp_body_class. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test amp_body_class does not append amp when ! is_amp()
	 */
	function test_amp_body_class_non_amp() {

		$this->assertTrue( ! in_array( 'amp', get_body_class(), true ) );

	}

	/**
	 * Test amp_body_class appends amp when is_amp()
	 */
	function test_amp_body_class_amp() {

		add_filter( 'go_is_amp', '__return_true' );

		$this->assertTrue( in_array( 'amp', get_body_class(), true ) );

	}

	/**
	 * Test amp_nav_sub_menu_buttons returns original output when ! is_amp()
	 */
	function test_amp_nav_sub_menu_buttons_non_amp() {

		$nav_menu_item = $this->factory->post->create(
			[
				'post_title' => 'Nav Menu Item',
				'post_type'  => 'nav_menu_item'
			]
		);

		$output = Go\AMP\amp_nav_sub_menu_buttons( '<a href="http://example.org/blog/">Blog</a>', get_post( $nav_menu_item ), 1, new stdClass() );

		$this->assertEquals( '<a href="http://example.org/blog/">Blog</a>', $output );

	}

	/**
	 * Test amp_nav_sub_menu_buttons returns correct output when is_amp()
	 */
	function test_amp_nav_sub_menu_buttons_amp() {

		add_filter( 'go_is_amp', '__return_true' );

		$nav_menu_item = $this->factory->post->create(
			[
				'post_title' => 'Nav Menu Item',
				'post_type'  => 'nav_menu_item'
			]
		);

		$post = get_post( $nav_menu_item );
		$post->classes = [ 'menu-item-has-children' ];

		$menu_args = new stdClass();
		$menu_args->theme_location = 'primary';

		$output = Go\AMP\amp_nav_sub_menu_buttons( '<a href="http://example.org/blog/">Blog</a>', $post, 1, $menu_args );

		$this->assertRegexp( '/<button class="dropdown-toggle" \[class\]="&quot;dropdown-toggle&quot; \+ \( navMenuItemExpanded1 \? &quot; toggled-on&quot; : &#039;&#039; \)" aria-expanded="false" \[aria-expanded\]="navMenuItemExpanded1 \? &#039;true&#039; : &#039;false&#039;" on="tap:AMP\.setState\( { navMenuItemExpanded1: ! navMenuItemExpanded1 } \)">/', $output );

	}

	/**
	 * Test is_amp returns false
	 */
	function test_amp_is_false() {

		add_filter( 'go_is_amp', '__return_false' );

		$this->assertFalse( Go\AMP\is_amp() );

	}

	/**
	 * Test is_amp returns true
	 */
	function test_amp_is_true() {

		add_filter( 'go_is_amp', '__return_true' );

		$this->assertTrue( Go\AMP\is_amp() );

	}
}
