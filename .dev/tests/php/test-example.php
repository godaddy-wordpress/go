<?php

class Test_Theme extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		switch_theme( 'Go' );

	}

	/**
	 * Test that the Go Theme is active.
	 */
	function testActiveTheme() {

		$this->assertTrue( 'Go' === get_template() );

	}
}
