<?php

class Test_Title_Meta extends WP_UnitTestCase {

	private $post_id;

	function setUp() {

		parent::setUp();

		$alpha_tag = wp_insert_term(
			'Alpha',
			'post_tag',
			[
				'description'=> 'First test tag.',
				'slug'       => 'alpha',
			]
		);

		$beta_tag = wp_insert_term(
			'Beta',
			'post_tag',
			[
				'description'=> 'Second test tag.',
				'slug'       => 'beta',
			]
		);

		$this->post_id = $this->factory->post->create(
			[
				'post_title' => 'Test Title Meta',
				'tags_input' => [
					$alpha_tag['term_id'],
					$beta_tag['term_id'],
				],
			]
		);

		global $post;

		$post = get_post( $this->post_id );

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test the post_meta() returns proper data
	 */
	public function test_metabox_build_function() {

        ob_start();
		Go\Title_Meta\page_title_build_metabox( $post->ID );
		$page_title = ob_get_clean();

		$this->assertEmpty( $page_title );

	}

}
