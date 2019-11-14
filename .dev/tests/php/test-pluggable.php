<?php

class Test_Pluggable extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test that go_comment() returns as expected for pingback comments type
	 */
	function test_go_comment_pingback() {

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		$post_id = $this->factory->post->create( [ 'post_title' => 'Test Post', ] );

		$comment_id = $this->factory->comment->create_object(
			[
				'comment_author'  => 'Zach Brennan',
				'comment_content' => 'This is my comment. Hello World!',
				'comment_post_ID' => $post_id,
				'comment_type'    => 'pingback',
			]
		);

		$comment_object = $this->factory->comment->get_object_by_id( $comment_id );

		$GLOBALS['comment'] = $comment_object;

		$this->expectOutputRegex( '/Pingback: Zach Brennan <span class="edit-link">/' );

		go_comment( $comment_object, [], 2 );

	}

	/**
	 * Test that go_comment() returns as expected for default comment type
	 */
	function test_go_comment_default() {

		$user_id = $this->factory->user->create( [ 'role' => 'administrator' ] );

		wp_set_current_user( $user_id );

		$post_id = $this->factory->post->create(
			[
				'post_author' => $user_id,
				'post_title'  => 'Test Post',
			]
		);

		$GLOBALS['post'] = get_post( $post_id );

		$comment_id = $this->factory->comment->create_object(
			[
				'comment_author'  => 'Zach Brennan',
				'comment_content' => 'This is my comment. Hello World!',
				'comment_post_ID' => $post_id,
			]
		);

		$comment_object = $this->factory->comment->get_object_by_id( $comment_id );

		$GLOBALS['comment'] = $comment_object;

		$this->expectOutputRegex( '/Pingback: Zach Brennan <span class="edit-link">/' );

		go_comment( $comment_object, [ 'max_depth' => 4 ], 2 );

		$this->expectOutputRegex( '/(?s)(?<=This is my comment\. Hello World!)(.*?)(?=Reply to Zach Brennan)/' );

	}
}
