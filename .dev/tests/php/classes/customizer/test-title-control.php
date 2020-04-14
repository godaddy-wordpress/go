<?php

class Test_Class_Title_Control extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		global $wp_customize;

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();
		$GLOBALS['wp_customize']->register_controls();

		require_once get_parent_theme_file_path( 'includes/classes/customizer/class-title-control.php' );

	}

	function tearDown() {

		parent::tearDown();

	}

	protected static function getMethod( $name ) {
		$class  = new ReflectionClass( 'Go\Customizer\Title_Control' );
		$method = $class->getMethod($name);
		$method->setAccessible(true);
		return $method;
	}

	/**
	 * Test the switcher_type property returns as expected
	 */
	function test_title_control_property_switcher_type() {

		$switcher_class = new Go\Customizer\Title_Control( $GLOBALS['wp_customize'], 'control-id' );
		$reflection     = new ReflectionClass( $switcher_class );
		$property       = $reflection->getProperty( 'switcher_type' );

		$property->setAccessible( true );

		$this->assertEquals( 'default', $property->getValue( $switcher_class ) );

	}

	/**
	 * Test the type property returns as expected
	 */
	function test_title_control_property_type() {

		$this->assertEquals( 'go_title', ( new Go\Customizer\Title_Control( $GLOBALS['wp_customize'], 'control-id' ) )->type );

	}

	/**
	 * Test render_content method exists
	 */
	function test_title_control_render_content_method() {

		$this->assertTrue( method_exists( new Go\Customizer\Title_Control( $GLOBALS['wp_customize'], 'control-id' ), 'render_content' ) );

	}

	/**
	 * Test content_template method returns expected markup
	 */
	function test_title_control_content_template() {

		$class  = new ReflectionClass( 'Go\Customizer\Title_Control' );
		$method = $class->getMethod( 'content_template' );

		$method->setAccessible( true );

		$this->expectOutputRegex( '/<# if \( data.label \) { #>\\n[\n\r\s]+<span class="customize-control-title">{{ data.label }}<\/span>\\n[\n\r\s]+<# } #>\\n[\n\r\s]+<# if \( data.description \) { #>\\n[\n\r\s]+<em>{{ data.description }}<\/em>\\n[\n\r\s]+<# } #>/' );

		$method->invokeArgs( new Go\Customizer\Title_Control( $GLOBALS['wp_customize'], 'control-id' ), [] );

	}
}
