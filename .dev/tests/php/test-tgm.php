<?php

class Test_TGM extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		Go\TGM\setup();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test register_required_plugins is hooked correctly
	 */
	function test_hooked_register_required_plugins() {

		$this->assertEquals(
			10,
			has_action( 'tgmpa_register', 'Go\TGM\register_required_plugins' ),
			'tgmpa_register is not attached to Go\TGM\register_required_plugins. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test that tgmpa actions run
	 */
	function test_register_required_plugins() {

		Go\TGM\register_required_plugins();

		$this->assertEquals( 1, did_action( 'tgmpa_init' ) );

	}

}
