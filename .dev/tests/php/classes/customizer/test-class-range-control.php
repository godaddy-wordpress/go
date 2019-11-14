<?php

class Test_Class_Range_Control extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		global $wp_customize;

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();
		$GLOBALS['wp_customize']->register_controls();

		require_once get_parent_theme_file_path( 'includes/classes/customizer/class-range-control.php' );

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test the type property returns as expected
	 */
	function test_range_control_property_type() {

		$this->assertEquals( 'go_range_control', ( new Go\Customizer\Range_Control( $GLOBALS['wp_customize'], 'control-id' ) )->type );

	}

	/**
	 * Test that go-customize-controls is enqueued
	 */
	function test_range_control_enqueue_go_customizer_controls() {

		( new Go\Customizer\Range_Control( $GLOBALS['wp_customize'], 'control-id' ) )->enqueue();

		global $wp_scripts;

		$this->assertArrayHasKey( 'go-customize-controls', $wp_scripts->registered );

	}

	/**
	 * Test that go-customize-style is enqueued
	 */
	function test_range_control_enqueue_go_customizer_styles() {

		( new Go\Customizer\Range_Control( $GLOBALS['wp_customize'], 'control-id' ) )->enqueue();

		global $wp_styles;

		$this->assertArrayHasKey( 'go-customize-style', $wp_styles->registered );

	}

	/**
	 * Test that to_json returns as expected
	 */
	function test_range_control_to_json() {

		$GLOBALS['wp_customize']->add_setting(
			'logo_width_mobile',
			[
				'default'           => 100,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			]
		);

		$range_class = new Go\Customizer\Range_Control( $GLOBALS['wp_customize'], 'logo_width_mobile', [ 'settings' => 'logo_width_mobile' ] );

		$range_class->to_json();

		$this->assertEquals( '<li id="customize-control-logo_width_mobile" class="customize-control customize-control-go_range_control"></li>', $range_class->json['content'] );

	}

	/**
	 * Test that content_template returns expected markup
	 */
	function test_range_control_content_template() {

		$this->expectOutputRegex( '/<input type="range" data-input-type="range" class="range_control__track" value="{{ data.value }}" data-default-value="{{ data.defaultValue }}"  min="{{ data.input_attrs\[\'min\'] }}" max="{{ data.input_attrs\[\'max\'] }}" step="{{ data.input_attrs\[\'step\'] }}" {{{ data.link }}} \/>/' );

		$method = new ReflectionMethod( 'Go\Customizer\Range_Control', 'content_template' );
		$method->setAccessible( true );

		$method->invoke( new Go\Customizer\Range_Control( $GLOBALS['wp_customize'], 'control-id' ) );

	}
}
