<?php

class Test_Customizer extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		global $wp_customize;

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();
		$GLOBALS['wp_customize']->register_controls();

		require_once get_parent_theme_file_path( 'includes/classes/customizer/class-range-control.php' );
		require_once get_parent_theme_file_path( 'includes/classes/customizer/class-switcher-control.php' );

		Go\Customizer\setup();

	}

	function tearDown() {

		parent::tearDown();

		global $wp_customize;

		$wp_customize = null;

	}

	/**
	 * Test register_control_types is hooked correctly
	 */
	function test_hooked_register_control_types() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_control_types' ),
			'customize_register is not attached to Go\Customizer\register_control_types. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test default_controls is hooked correctly
	 */
	function test_hooked_default_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\default_controls' ),
			'customize_register is not attached to Go\Customizer\default_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_logo_controls is hooked correctly
	 */
	function test_hooked_register_logo_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_logo_controls' ),
			'customize_register is not attached to Go\Customizer\register_logo_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_color_controls is hooked correctly
	 */
	function test_hooked_register_color_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_color_controls' ),
			'customize_register is not attached to Go\Customizer\register_color_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_global_controls is hooked correctly
	 */
	function test_hooked_register_global_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_global_controls' ),
			'customize_register is not attached to Go\Customizer\register_global_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_header_controls is hooked correctly
	 */
	function test_hooked_register_header_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_header_controls' ),
			'customize_register is not attached to Go\Customizer\register_header_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_footer_controls is hooked correctly
	 */
	function test_hooked_register_footer_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_footer_controls' ),
			'customize_register is not attached to Go\Customizer\register_footer_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test register_social_controls is hooked correctly
	 */
	function test_hooked_register_social_controls() {

		$this->assertEquals(
			10,
			has_action( 'customize_register', 'Go\Customizer\register_social_controls' ),
			'customize_register is not attached to Go\Customizer\register_social_controls. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test customize_preview_init is hooked correctly to customize_preview_init
	 */
	function test_hooked_customize_preview_init() {

		$this->assertEquals(
			10,
			has_action( 'customize_preview_init', 'Go\Customizer\customize_preview_init' ),
			'customize_preview_init is not attached to Go\Customizer\customize_preview_init. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test customize_preview_init is hooked correctly to customize_controls_enqueue_scripts
	 */
	function test_hooked_scripts_customize_preview_init() {

		$this->assertEquals(
			10,
			has_action( 'customize_controls_enqueue_scripts', 'Go\Customizer\customize_preview_init' ),
			'customize_controls_enqueue_scripts is not attached to Go\Customizer\customize_preview_init. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test enqueue_controls_assets is hooked correctly
	 */
	function test_hooked_enqueue_controls_assets() {

		$this->assertEquals(
			10,
			has_action( 'customize_preview_init', 'Go\Customizer\enqueue_controls_assets' ),
			'customize_preview_init is not attached to Go\Customizer\enqueue_controls_assets. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the controls are registered correctly
	 */
	function test_register_control_types_color_scheme_control() {

		$manager    = new WP_Customize_Manager();
		$reflection = new ReflectionClass( $manager );
		$instance   = $reflection->getProperty( 'registered_control_types' );

		$instance->setAccessible( true );

		Go\Customizer\register_control_types( $manager );

		$expected = [
			'Go\Customizer\Switcher_Control',
			'Go\Customizer\Range_Control',
		];

		$this->assertEquals( $expected, $instance->getValue( $manager ) );

	}

	/**
	 * Test the navigation placeholder does not register when not in the customizer
	 */
	function test_wp_nav_fallback_non_customizer() {

		$GLOBALS['wp_customize']->stop_previewing_theme();

		$this->assertNull( Go\Customizer\wp_nav_fallback( [] ) );

		$GLOBALS['wp_customize']->start_previewing_theme();

	}

	/**
	 * Test the registered placeholder navigation outputs correctly
	 */
	function test_wp_nav_fallback() {

		$this->expectOutputRegex( '/Please assign a menu to the Primary menu location/' );

		Go\Customizer\wp_nav_fallback( [
			'theme_location'                   => 'primary',
			'customize_preview_nav_menus_args' => [
				'args_hmac' => '123',
			],
		] );

	}

	/**
	 * Test the registered placeholder navigation outputs correctly
	 */
	function test_wp_nav_register_fallback() {

		$this->assertEquals(
			[
				'theme_location' => 'primary',
				'customize_preview_nav_menus_args' => [
					'args_hmac' => '123',
				],
				'fallback_cb'    => 'Go\Customizer\wp_nav_fallback',
			],
			Go\Customizer\wp_nav_register_fallback( [
				'theme_location' => 'primary',
				'customize_preview_nav_menus_args' => [
					'args_hmac' => '123',
				],
			] )
		);

	}

	/**
	 * Test the blogname transport is set properly
	 */
	function test_default_controls_blogname_transport() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$this->assertEquals( 'postMessage', $GLOBALS['wp_customize']->get_setting( 'blogname' )->transport );

	}

	/**
	 * Test the blogdescription transport is set properly
	 */
	function test_default_controls_blogdescription_transport() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$this->assertEquals( 'postMessage', $GLOBALS['wp_customize']->get_setting( 'blogdescription' )->transport );

	}

	/**
	 * Test the custom_logo transport is set properly
	 */
	function test_default_controls_custom_logo_transport() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$this->assertEquals( 'postMessage', $GLOBALS['wp_customize']->get_setting( 'custom_logo' )->transport );

	}

	/**
	 * Test the blogname partial is exported
	 */
	function test_default_controls_blogname_partial() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$GLOBALS['wp_customize']->selective_refresh->export_preview_data();

		$this->expectOutputRegex( '/_customizePartialRefreshExports =(.*?)"blogname":{"settings":\["blogname"\],"primarySetting":"blogname","selector":".header__titles","type":"default","fallbackRefresh":true,"containerInclusive":false}/' );

	}

	/**
	 * Test the blogdescription partial is exported
	 */
	function test_default_controls_blogdescription_partial() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$GLOBALS['wp_customize']->selective_refresh->export_preview_data();

		$this->expectOutputRegex( '/_customizePartialRefreshExports =(.*?)"blogdescription":{"settings":\["blogdescription"\],"primarySetting":"blogdescription","selector":".header__titles","type":"default","fallbackRefresh":true,"containerInclusive":false}/' );

	}

	/**
	 * Test the custom_logo partial is exported
	 */
	function test_default_controls_custom_logo_partial() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$GLOBALS['wp_customize']->selective_refresh->export_preview_data();

		$this->expectOutputRegex( '/_customizePartialRefreshExports =(.*?)"custom_logo":{"settings":\["custom_logo"\],"primarySetting":"custom_logo","selector":".header__titles","type":"default","fallbackRefresh":true,"containerInclusive":false}/' );

	}

	/**
	 * Test the background_image section is removed
	 */
	function test_default_controls_remove_background_image() {

		Go\Customizer\default_controls( $GLOBALS['wp_customize'] );

		$this->assertNull( $GLOBALS['wp_customize']->get_section( 'background_image' ) );

	}

	/**
	 * Test the scripts are enqueued on customize_preview_init
	 */
	function test_customize_preview_init() {

		Go\Customizer\customize_preview_init();

		$this->assertTrue(
			wp_script_is( 'go-customize-preview' ),
			'go-customize-preview script is not enqueued'
		);

	}

	/**
	 * Test the block editor assets data is localized
	 */
	function test_customize_preview_init_go_customize_preview_localized_data() {

		Go\Customizer\customize_preview_init();

		global $wp_scripts;

		$this->assertContains( 'var GoPreviewData = {"design_styles"', $wp_scripts->registered['go-customize-preview']->extra['data'] );

	}

	/**
	 * Test the control assets are enqueued
	 */
	function test_enqueue_controls_assets() {

		Go\Customizer\enqueue_controls_assets();

		$script_handles = [
			'go-customize-controls',
		];

		$style_handles = [
			'go-customize-style',
		];

		foreach ( $script_handles as $script_handle ) {

			if ( ! wp_script_is( $script_handle ) ) {

				$this->fail( "The script '${script_handle}' was not enqueued." );

			}
		}

		foreach ( $style_handles as $style_handle ) {

			if ( ! wp_style_is( $style_handle ) ) {

				$this->fail( "The style '${style_handle}' was not enqueued." );

			}
		}

		$this->assertTrue( true );

	}

	/**
	 * Test color scheme choices return as expected
	 */
	function test_get_color_schemes_as_choices() {

		$expected_color_scheme_keys = [
			'traditional-one',
			'traditional-two',
			'traditional-three',
			'traditional-four',
			'modern-one',
			'modern-two',
			'modern-three',
			'modern-four',
			'trendy-one',
			'trendy-two',
			'trendy-three',
			'trendy-four',
			'welcoming-one',
			'welcoming-two',
			'welcoming-three',
			'welcoming-four',
			'playful-one',
			'playful-two',
			'playful-three',
			'playful-four',
		];

		$this->assertEquals( $expected_color_scheme_keys, array_keys( Go\Customizer\get_color_schemes_as_choices() ) );

	}

	/**
	 * Test color scheme choices return as expected after being filtered
	 */
	function test_get_color_schemes_as_choices_filtered() {

		add_filter( 'go_design_styles', function( $default_design_styles ) {

			unset( $default_design_styles['traditional']['color_schemes']['one'] );

			return $default_design_styles;

		} );

		$expected_color_scheme_keys = [
			'traditional-two',
			'traditional-three',
			'traditional-four',
			'modern-one',
			'modern-two',
			'modern-three',
			'modern-four',
			'trendy-one',
			'trendy-two',
			'trendy-three',
			'trendy-four',
			'welcoming-one',
			'welcoming-two',
			'welcoming-three',
			'welcoming-four',
			'playful-one',
			'playful-two',
			'playful-three',
			'playful-four',
		];

		$this->assertEquals( $expected_color_scheme_keys, array_keys( Go\Customizer\get_color_schemes_as_choices() ) );

	}

	/**
	 * Test the logo_width settings are registered
	 */
	function test_register_logo_controls_logo_width_setting() {

		Go\Customizer\register_logo_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'logo_width' ) );

	}

	/**
	 * Test the logo_width controls are registered
	 */
	function test_register_logo_controls_logo_width_control() {

		Go\Customizer\register_logo_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'logo_width' ) );

	}

	/**
	 * Test the logo_width_mobile settings are registered
	 */
	function test_register_logo_controls_logo_width_mobile_setting() {

		Go\Customizer\register_logo_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'logo_width_mobile' ) );

	}

	/**
	 * Test the logo_width_mobile controls are registered
	 */
	function test_register_logo_controls_logo_width_mobile_control() {

		Go\Customizer\register_logo_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'logo_width_mobile' ) );

	}

	/**
	 * Test the go_site_settings section is registered
	 */
	function test_register_global_controls_go_site_settings_section() {

		Go\Customizer\register_global_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_section( 'go_site_settings' ) );

	}

	/**
	 * Test the page_titles setting is registered
	 */
	function test_register_global_controls_page_titles_setting() {

		Go\Customizer\register_global_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'page_titles' ) );

	}

	/**
	 * Test the show_page_title_checkbox control is registered
	 */
	function test_register_global_controls_show_page_title_checkbox_control() {

		Go\Customizer\register_global_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'show_page_title_checkbox' ) );

	}

	/**
	 * Test the copyright setting is registered
	 */
	function test_register_global_controls_copyright_setting() {

		Go\Customizer\register_global_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'copyright' ) );

	}

	/**
	 * Test the copyright_control control is registered
	 */
	function test_register_global_controls_copyright_control() {

		Go\Customizer\register_global_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'copyright_control' ) );

	}

	/**
	 * Test the design_style setting is registered
	 */
	function test_register_color_controls_design_style_setting() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'design_style' ) );

	}

	/**
	 * Test the design_style_control control is registered
	 */
	function test_register_color_controls_design_style_control() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'design_style_control' ) );

	}

	/**
	 * Test the color_scheme setting is registered
	 */
	function test_register_color_controls_color_scheme_setting() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'color_scheme' ) );

	}

	/**
	 * Test the color_scheme_control control is registered
	 */
	function test_register_color_controls_color_scheme_control() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'color_scheme_control' ) );

	}

	/**
	 * Test the primary_color setting is registered
	 */
	function test_register_color_controls_primary_color_setting() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'primary_color' ) );

	}

	/**
	 * Test the primary_color_control control is registered
	 */
	function test_register_color_controls_primary_color_control() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'primary_color_control' ) );

	}

	/**
	 * Test the secondary_color setting is registered
	 */
	function test_register_color_controls_secondary_color_setting() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'secondary_color' ) );

	}

	/**
	 * Test the secondary_color_control control is registered
	 */
	function test_register_color_controls_secondary_color_control() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'secondary_color_control' ) );

	}

	/**
	 * Test the tertiary_color setting is registered
	 */
	function test_register_color_controls_tertiary_color_setting() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'tertiary_color' ) );

	}

	/**
	 * Test the tertiary_color_control control is registered
	 */
	function test_register_color_controls_tertiary_color_control() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'tertiary_color_control' ) );

	}

	/**
	 * Test the go_header_settings section is registered
	 */
	function test_register_header_controls_go_site_settings_section() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_section( 'go_header_settings' ) );

	}

	/**
	 * Test the header_variation setting is registered
	 */
	function test_register_header_controls_header_variation_setting() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'header_variation' ) );

	}

	/**
	 * Test the header_variation_control control is registered
	 */
	function test_register_header_controls_header_variation_control() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'header_variation_control' ) );

	}

	/**
	 * Test the header_background_color setting is registered
	 */
	function test_register_header_controls_header_background_color_setting() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'header_background_color' ) );

	}

	/**
	 * Test the header_background_color_control control is registered
	 */
	function test_register_header_controls_header_background_color_control() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'header_background_color_control' ) );

	}

	/**
	 * Test the header_text_color setting is registered
	 */
	function test_register_header_controls_header_text_color_setting() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'header_text_color' ) );

	}

	/**
	 * Test the header_text_color_control control is registered
	 */
	function test_register_header_controls_header_text_color_control() {

		Go\Customizer\register_header_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'header_text_color_control' ) );

	}

	/**
	 * Test the go_footer_settings section is registered
	 */
	function test_register_footer_controls_go_footer_settings_section() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_section( 'go_footer_settings' ) );

	}

	/**
	 * Test the footer_variation setting is registered
	 */
	function test_register_footer_controls_footer_variation_setting() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'footer_variation' ) );

	}

	/**
	 * Test the footer_variation_control control is registered
	 */
	function test_register_footer_controls_footer_variation_control() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'footer_variation_control' ) );

	}

	/**
	 * Test the footer_background_color setting is registered
	 */
	function test_register_footer_controls_footer_background_color_setting() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'footer_background_color' ) );

	}

	/**
	 * Test the footer_background_color_control control is registered
	 */
	function test_register_footer_controls_footer_background_color_control() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'footer_background_color_control' ) );

	}

	/**
	 * Test the footer_heading_color setting is registered
	 */
	function test_register_footer_controls_footer_heading_color_setting() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'footer_heading_color' ) );

	}

	/**
	 * Test the footer_heading_color control is registered
	 */
	function test_register_footer_controls_footer_heading_color_control() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'footer_heading_color' ) );

	}

	/**
	 * Test the footer_text_color setting is registered
	 */
	function test_register_footer_controls_footer_text_color_setting() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'footer_text_color' ) );

	}

	/**
	 * Test the footer_text_color control is registered
	 */
	function test_register_footer_controls_footer_text_color_control() {

		Go\Customizer\register_footer_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'footer_text_color' ) );

	}

	/**
	 * Test the go_social_media section is registered
	 */
	function test_register_social_controls_go_social_media_section() {

		Go\Customizer\register_social_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_section( 'go_social_media' ) );

	}

	/**
	 * Test the social_icon_x setting and controls are registered
	 */
	function test_register_social_controls_social_icon_x_setting_and_controls() {

		Go\Customizer\register_social_controls( $GLOBALS['wp_customize'] );

		$networks = [
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
			'pinterest',
		];

		foreach ( $networks as $social_network ) {

			if ( is_null( $GLOBALS['wp_customize']->get_setting( "social_icon_${social_network}" ) ) ) {

				$this->fail( "social_icon_${social_network} customizer setting was not registered" );

			}

			if ( is_null( $GLOBALS['wp_customize']->get_control( "social_icon_${social_network}_control" ) ) ) {

				$this->fail( "social_icon_${social_network}_control customizer control was not registered" );

			}
		}

		$this->assertTrue( true );

	}

	/**
	 * Test the social_icon_color setting is registered
	 */
	function test_register_social_controls_social_icon_color_setting() {

		Go\Customizer\register_social_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_setting( 'social_icon_color' ) );

	}

	/**
	 * Test the social_icon_color control is registered
	 */
	function test_register_social_controls_social_icon_color_control() {

		Go\Customizer\register_social_controls( $GLOBALS['wp_customize'] );

		$this->assertNotNull( $GLOBALS['wp_customize']->get_control( 'social_icon_color' ) );

	}

	/**
	 * Test sanitizing a radio option returns as expected when an invalid option is specified
	 */
	function test_sanitize_radio_invalid_choice() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$customize_setting = new WP_Customize_Setting( $GLOBALS['wp_customize'], 'design_style' );

		$this->assertEquals( '', Go\Customizer\sanitize_radio( 'invalid-option', $customize_setting ) );

	}

	/**
	 * Test sanitizing a radio option returns as expected when an valid option is specified
	 */
	function test_sanitize_radio_valid_choice() {

		Go\Customizer\register_color_controls( $GLOBALS['wp_customize'] );

		$customize_setting = new WP_Customize_Setting( $GLOBALS['wp_customize'], 'design_style' );

		$this->assertEquals( 'playful', Go\Customizer\sanitize_radio( 'playful', $customize_setting ) );

	}

	/**
	 * Test the inline CSS outputs as intended with default values
	 */
	function test_inline_css_defaults() {

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		$expected_strings = [
			'--theme-color-primary',
			'--theme-color-secondary',
			'--theme-color-tertiary',
			'--theme-color-body-bg',
			'--theme-site-logo--width',
			'--theme-site-logo--width-mobile',
		];

		foreach ( $expected_strings as $expected_string ) {

			if ( false === strpos( $inline_css, $expected_string ) ) {

				$this->fail( "${expected_string} was not found in the output of Go\Customizer\inline_css()" );

			}
		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs --theme-header--bg when a header background is used
	 */
	function test_inline_css_header_background() {

		set_theme_mod( 'header_background_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		if ( false === strpos( $inline_css, '--theme-header--bg' ) ) {

			$this->fail( "--theme-header--bg was not found in the output of Go\Customizer\inline_css() after setting header_background_color" );

		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs the proper definitions when a header text color is used
	 */
	function test_inline_css_header_text_color() {

		set_theme_mod( 'header_text_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		$expected_strings = [
			'--theme-site-nav--color',
			'--theme-site-description--color',
			'--theme-site-title--color',
			'--theme-search-toggle--color',
			'--theme-search-submit--bg',
		];

		foreach ( $expected_strings as $expected_string ) {

			if ( false === strpos( $inline_css, $expected_string ) ) {

				$this->fail( "${expected_string} was not found in the output of Go\Customizer\inline_css() after setting header_text_color" );

			}
		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs --theme-footer--bg when a footer background is used
	 */
	function test_inline_css_footer_background() {

		set_theme_mod( 'footer_background_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		if ( false === strpos( $inline_css, '--theme-footer--bg' ) ) {

			$this->fail( "--theme-footer--bg was not found in the output of Go\Customizer\inline_css() after setting footer_background_color" );

		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs --theme-footer-heading--color when a footer background is used
	 */
	function test_inline_css_footer_heading_color() {

		set_theme_mod( 'footer_heading_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		if ( false === strpos( $inline_css, '--theme-footer-heading--color' ) ) {

			$this->fail( "--theme-footer-heading--color was not found in the output of Go\Customizer\inline_css() after setting footer_heading_color" );

		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs proper definitions when a footer text color is used
	 */
	function test_inline_css_footer_text_color() {

		set_theme_mod( 'footer_text_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		$expected_strings = [
			'--theme-footer--color',
			'--theme-footer-nav--color',
		];

		foreach ( $expected_strings as $expected_string ) {

			if ( false === strpos( $inline_css, $expected_string ) ) {

				$this->fail( "${expected_string} was not found in the output of Go\Customizer\inline_css() after setting footer_text_color" );

			}
		}

		$this->assertTrue( true );

	}

	/**
	 * Test the inline CSS outputs --theme-footer-heading--color when a footer background is used
	 */
	function test_inline_css_social_icon_color() {

		set_theme_mod( 'social_icon_color', '#fafafa' );

		ob_start();
		Go\Customizer\inline_css();
		$inline_css = ob_get_clean();

		if ( false === strpos( $inline_css, '--theme-social--color' ) ) {

			$this->fail( "--theme-social--color was not found in the output of Go\Customizer\inline_css() after setting social_icon_color" );

		}

		$this->assertTrue( true );

	}
}
