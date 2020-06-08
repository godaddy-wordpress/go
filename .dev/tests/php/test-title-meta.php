<?php

class Test_Title_Meta extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		Go\Title_Meta\setup();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test hide_page_title is hooked correctly
	 */
	function test_hooked_hide_page_title() {

		$this->assertEquals(
			10,
			has_action( 'go_page_title_args', 'Go\Title_Meta\hide_page_title' ),
			'Go\Title_Meta\hide_page_title is not attached to go_page_title_args. It might also have the wrong priority (validated priority: 10)'
		);

	}


	/**
	 * Test hide_page_title has no effect when on non-pages.
	 */
	function test_hide_page_title_non_page() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Post',
				'post_type'  => 'post'
			]
		);

		$test_data = [
			'title' => 'Page Title',
		];

		global $wp_query;

		$wp_query->post = get_post( $page_id );

		$this->assertEquals( $test_data, Go\Title_Meta\hide_page_title( $test_data ) );

	}

	/**
	 * Test hide_page_title has no effect when on non-pages.
	 */
	function test_hide_page_title_callback() {

		$post_title_visible = $this->factory->post->create(
			[
				'post_title' => 'Show Post title',
				'post_type'  => 'post'
			]
		);

		update_post_meta( $post_title_visible, 'hide_page_title', 'enabled' );

		$post_title_hidden = $this->factory->post->create(
			[
				'post_title' => 'Hide Post title',
				'post_type'  => 'post'
			]
		);

		update_post_meta( $post_title_hidden, 'hide_page_title', 'disabled' );

		$post_title_invalid_status = $this->factory->post->create(
			[
				'post_title' => 'Invalid Status Hide Post title',
				'post_type'  => 'post'
			]
		);

		update_post_meta( $post_title_invalid_status, 'hide_page_title', 'invalid-type' );

		$test_data = [
			get_post_meta( $post_title_visible, 'hide_page_title', true ),
			get_post_meta( $post_title_hidden, 'hide_page_title', true ),
			get_post_meta( $post_title_invalid_status, 'hide_page_title', true ),
		];

		$this->assertEquals( $test_data, [ 'enabled', 'disabled', '' ] );

	}

	/**
	 * Test hide_page_title does not remove the title value when on pages where _hide_page_title is false.
	 * (visible page titles)
	 */
	function test_hide_page_title_page_visible() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		update_post_meta( $page_id, 'hide_page_title', 'disabled' );

		$test_data = [
			'title' => 'Page Title',
		];

		global $wp_query;

		$wp_query->post        = get_post( $page_id );
		$wp_query->is_singular = true;

		$this->assertEquals( $test_data, Go\Title_Meta\hide_page_title( $test_data ) );

	}

	/**
	 * Test hide_page_title removes the title value on pages where hide_page_title is true.
	 * (hidden page titles)
	 */
	function test_hide_page_title_page_hidden() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		update_post_meta( $page_id, 'hide_page_title', 'enabled' );

		$test_data = [
			'title' => 'Page Title',
		];

		global $post, $wp_query;

		$post_obj = get_post( $page_id );

		$post                  = $post_obj;
		$wp_query->post        = $post_obj;
		$wp_query->is_singular = true;

		$this->assertEquals( [ 'title' => '' ], Go\Title_Meta\hide_page_title( $test_data ) );

	}

}
