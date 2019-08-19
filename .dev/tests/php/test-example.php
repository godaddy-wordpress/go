<?php

class Test_Theme extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		switch_theme( 'Maverick' );

	}

	/**
	 * Test that the Maverick Theme is active.
	 */
	function testActiveTheme() {

		$this->assertTrue( 'Maverick' === get_template() );

	}
}
