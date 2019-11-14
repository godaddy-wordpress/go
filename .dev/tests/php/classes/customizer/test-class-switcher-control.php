<?php

class Test_Class_Switcher_Control extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		global $wp_customize;

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();
		$GLOBALS['wp_customize']->register_controls();

		require_once get_parent_theme_file_path( 'includes/classes/customizer/class-switcher-control.php' );

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test the switcher_type property returns as expected
	 */
	function test_switcher_control_property_switcher_type() {

		$switcher_class = new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id' );
		$reflection     = new ReflectionClass( $switcher_class );
		$property       = $reflection->getProperty( 'switcher_type' );

		$property->setAccessible( true );

		$this->assertEquals( 'default', $property->getValue( $switcher_class ) );

	}

	/**
	 * Test the type property returns as expected
	 */
	function test_switcher_control_property_type() {

		$this->assertEquals( 'go_switcher_control', ( new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id' ) )->type );

	}

	/**
	 * Test the type property returns as expected when a custom switcher_type is passed into the args
	 */
	function test_switcher_control_property_switcher_type_custom() {

		$switcher_class = new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id', [ 'switcher_type' => 'custom-switcher-type' ] );
		$reflection     = new ReflectionClass( $switcher_class );
		$property       = $reflection->getProperty( 'switcher_type' );

		$property->setAccessible( true );

		$this->assertEquals( 'custom-switcher-type', $property->getValue( $switcher_class ) );

	}

	/**
	 * Test that go-customize-controls is enqueued
	 */
	function test_switcher_control_enqueue_go_customizer_controls() {

		( new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id' ) )->enqueue();

		global $wp_scripts;

		$this->assertArrayHasKey( 'go-customize-controls', $wp_scripts->registered );

	}

	/**
	 * Test that go-customize-style is enqueued
	 */
	function test_switcher_control_enqueue_go_customizer_styles() {

		( new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id' ) )->enqueue();

		global $wp_styles;

		$this->assertArrayHasKey( 'go-customize-style', $wp_styles->registered );

	}

	/**
	 * Test that to_json returns as expected
	 */
	function test_switcher_control_to_json() {

		$GLOBALS['wp_customize']->add_setting(
			'color_scheme',
			[
				'transport' => 'postMessage',
				'default'   => 'one',
			]
		);

		$switcher_class = new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'default', [ 'settings' => 'color_scheme', ] );

		$switcher_class->to_json();

		$this->assertEquals( '<li id="customize-control-default" class="customize-control customize-control-go_switcher_control"></li>', $switcher_class->json['content'] );

	}

	/**
	 * Test that content_template returns expected markup
	 */
	function test_switcher_control_content_template() {

		$this->expectOutputRegex( '/<span class="color-scheme" style="background: linear-gradient\(to right, {{ c.primary }}, {{ c.primary }} 33.33%, {{ c.secondary }} 33.33%, {{ c.secondary }} 66.66%, {{ c.tertiary }} 66.66%, {{ c.tertiary }} 100%\);"><\/span>/' );

		$method = new ReflectionMethod( 'Go\Customizer\Switcher_Control', 'content_template' );
		$method->setAccessible( true );

		$method->invoke( new Go\Customizer\Switcher_Control( $GLOBALS['wp_customize'], 'control-id' ) );

	}
}
