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
	 * Test page_title_add_metaboxes is hooked correctly
	 */
	function test_hooked_page_title_add_metaboxes() {

		$this->assertEquals(
			10,
			has_action( 'add_meta_boxes', 'Go\Title_Meta\page_title_add_metaboxes' ),
			'Go\Title_Meta\page_title_add_metaboxes is not attached to add_meta_boxes. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test save_page_title_metabox_data is hooked correctly
	 */
	function test_hooked_page_title_metabox_data() {

		$this->assertEquals(
			10,
			has_action( 'save_post', 'Go\Title_Meta\save_page_title_metabox_data' ),
			'Go\Title_Meta\save_page_title_metabox_data is not attached to save_post. It might also have the wrong priority (validated priority: 10)'
		);

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
	 * Test page_title_add_metaboxes registers the metabox.
	 */
	function test_page_title_metabox() {

		Go\Title_Meta\page_title_add_metaboxes();

		global $wp_meta_boxes;

		$this->assertTrue( array_key_exists( 'page_title_checkbox', $wp_meta_boxes['page']['side']['high'] ) );

	}

	/**
	 * Test page_title_build_metabox renders the correct markup.
	 */
	function test_page_title_build_metabox() {

		global $pagenow;

		$pagenow = 'post-new.php';

		Go\Title_Meta\page_title_build_metabox();

		$this->expectOutputRegex( '/<input type="hidden" id="page_title_metabox_nonce" name="page_title_metabox_nonce" value="[0-9a-zA-Z]+" \/><input type="hidden" name="_wp_http_referer" value="" \/>\s<div class="hide-page-title-meta">\\n[\n\r\s]+<p>\\n[\n\r\s]+<input type="checkbox" id="hide-page-title-checkbox" name="hide-page-title" value="on" \/>\\n[\n\r\s]+<label for="hide-page-title-checkbox">Hide page title<\/label>\\n[\n\r\s]+<\/p>\\n[\n\r\s]+<\/div>\n/' );

	}

	/**
	 * Test page_title_build_metabox renders the correct markup when it's checked.
	 */
	function test_page_title_build_metabox_checked() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Page with Hidden Title',
				'post_type'  => 'page'
			]
		);

		update_post_meta( $page_id, '_hide_page_title', true );

		global $pagenow, $post;

		$pagenow = 'post.php';
		$post    = get_post( $page_id );

		Go\Title_Meta\page_title_build_metabox();

		$this->expectOutputRegex( '/<input type="hidden" id="page_title_metabox_nonce" name="page_title_metabox_nonce" value="[0-9a-zA-Z]+" \/><input type="hidden" name="_wp_http_referer" value="" \/>\s<div class="hide-page-title-meta">\\n[\n\r\s]+<p>\\n[\n\r\s]+<input type="checkbox" id="hide-page-title-checkbox" name="hide-page-title" value="on" checked=\'checked\' \/>\\n[\n\r\s]+<label for="hide-page-title-checkbox">Hide page title<\/label>\\n[\n\r\s]+<\/p>\\n[\n\r\s]+<\/div>\n/' );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data does not save
	 * when no nonce is specified
	 */
	function test_save_page_title_metabox_data_no_nonce() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		Go\Title_Meta\save_page_title_metabox_data( $page_id );

		$this->assertEmpty( get_post_meta( $page_id, '_hide_page_title', true ) );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data does not save
	 * when an invalid nonce is specified
	 */
	function test_save_page_title_metabox_data_invalid_nonce() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		$_POST['page_title_metabox_nonce'] = '12345';

		Go\Title_Meta\save_page_title_metabox_data( $page_id );

		$this->assertEmpty( get_post_meta( $page_id, '_hide_page_title', true ) );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data properly, unchecked
	 */
	function test_save_page_title_metabox_data_unchecked() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		$_POST['page_title_metabox_nonce'] = wp_create_nonce( 'go-hide-page-title' );

		Go\Title_Meta\save_page_title_metabox_data( $page_id );

		$this->assertEmpty( get_post_meta( $page_id, '_hide_page_title', true ) );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data properly, checked
	 */
	function test_save_page_title_metabox_data_checked() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		$_POST['page_title_metabox_nonce'] = wp_create_nonce( 'go-hide-page-title' );
		$_POST['hide-page-title']          = true;

		Go\Title_Meta\save_page_title_metabox_data( $page_id );

		$this->assertEquals( 1, get_post_meta( $page_id, '_hide_page_title', true ) );

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

		update_post_meta( $page_id, '_hide_page_title', false );

		$test_data = [
			'title' => 'Page Title',
		];

		global $wp_query;

		$wp_query->post        = get_post( $page_id );
		$wp_query->is_singular = true;

		$this->assertEquals( $test_data, Go\Title_Meta\hide_page_title( $test_data ) );

	}

	/**
	 * Test hide_page_title removes the title value on pages where _hide_page_title is true.
	 * (hidden page titles)
	 */
	function test_hide_page_title_page_hidden() {

		$page_id = $this->factory->post->create(
			[
				'post_title' => 'Custom Page',
				'post_type'  => 'page'
			]
		);

		update_post_meta( $page_id, '_hide_page_title', true );

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
