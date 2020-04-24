<?php

class Test_Title_Meta extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

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

		$this->expectOutputRegex( '/<input type="hidden" id="page_title_metabox_nonce" name="page_title_metabox_nonce" value="[0-9a-zA-Z]+" \/><input type="hidden" name="_wp_http_referer" value="" \/>\s<div class="hide-page-title-meta">\\n[\n\r\s]+<p>\\n[\n\r\s]+<input type="checkbox" id="hide-page-title-checkbox" name="hide-page-title" value="on" \/>\\n[\n\r\s]+<label for="hide-page-title-checkbox">Hide page titles when published.<\/label>\\n[\n\r\s]+<\/p>\\n[\n\r\s]+<\/div>\n/' );

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

		$this->expectOutputRegex( '/<input type="hidden" id="page_title_metabox_nonce" name="page_title_metabox_nonce" value="[0-9a-zA-Z]+" \/><input type="hidden" name="_wp_http_referer" value="" \/>\s<div class="hide-page-title-meta">\\n[\n\r\s]+<p>\\n[\n\r\s]+<input type="checkbox" id="hide-page-title-checkbox" name="hide-page-title" value="on" checked=\'checked\' \/>\\n[\n\r\s]+<label for="hide-page-title-checkbox">Hide page titles when published.<\/label>\\n[\n\r\s]+<\/p>\\n[\n\r\s]+<\/div>\n/' );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data correctly (unchecked).
	 * @todo
	 */
	function test_save_page_title_metabox_data_unchecked() {

		$this->markTestSkipped( 'Test must be revisited.' );

	}

	/**
	 * Test save_page_title_metabox_data saves the metabox data correctly (checked).
	 * @todo
	 */
	function test_save_page_title_metabox_data_checked() {

		$this->markTestSkipped( 'Test must be revisited.' );

	}

	/**
	 * Test hide_page_title properly shows the page title when _hide_page_title is not true.
	 * @todo
	 */
	function test_hide_page_title_visible() {

		$this->markTestSkipped( 'Test must be revisited.' );

	}

	/**
	 * Test hide_page_title properly hides the page title when _hide_page_title is true.
	 * @todo
	 */
	function test_hide_page_title_hidden() {

		$this->markTestSkipped( 'Test must be revisited.' );

	}

}
