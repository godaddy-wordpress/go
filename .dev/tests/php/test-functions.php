<?php

class Test_Functions extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test that the Go Theme is active.
	 */
	function testActiveTheme() {

		$this->assertEquals( 'go', get_template() );

	}

	/**
	 * Test that the Go Theme is active.
	 */
	function testVersionDefined() {

		$this->assertEquals( '1.2.1', GO_VERSION );

	}

	/**
	 * Test that the Go Theme is active.
	 */
	function testBodyOpen() {

		wp_body_open();

		$this->assertEquals( 1, did_action( 'wp_body_open' ) );

	}
}
