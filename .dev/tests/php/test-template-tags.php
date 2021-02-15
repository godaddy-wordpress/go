<?php

class Test_Template_Tags extends WP_UnitTestCase {

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
				'post_title' => 'Test Post Meta',
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
	public function test_post_meta() {

		$this->expectOutputRegex( '/<ul class="post__meta list-reset">/' );

		Go\post_meta( $this->post_id );

	}

	/**
	 * Test the post_meta() returns null when a custom meta key is passed
	 */
	public function test_post_meta_only_custom_meta() {

		add_filter( 'go_post_meta_location_single_top', function( $meta ) {

			return [ 'custom_meta' ];

		} );

		$this->assertNull( Go\post_meta( $this->post_id ) );

	}

	/**
	 * Test the post_meta() returns null when the meta array is empty
	 */
	public function test_post_meta_empty_meta_array() {

		add_filter( 'go_post_meta_location_single_top', function( $meta ) {

			return [];

		} );

		$this->assertNull( Go\post_meta( $this->post_id ) );

	}

	/**
	 * Test the post_meta() returns null when an empty key exists in the meta array
	 */
	public function test_post_meta_empty_meta_key() {

		add_filter( 'go_post_meta_location_single_top', function( $meta ) {

			return [ 'empty' ];

		} );

		$this->assertNull( Go\post_meta( $this->post_id ) );

	}

	/**
	 * Test get_post_meta() returns null when no post ID is specified
	 */
	public function test_get_post_meta_no_post_id() {

		$this->assertNull( Go\get_post_meta() );

	}

	/**
	 * Test get_post_meta() returns null when a disallowed post type is attempted
	 */
	public function test_get_post_meta_no_post_id_disallowed_post_type() {

		add_filter( 'go_disallowed_post_types_for_meta_output', function( $disallowed_post_types ) {

			$disallowed_post_types[] = 'post';

			return $disallowed_post_types;

		} );

		$this->assertNull( Go\get_post_meta( $this->post_id ) );

	}

	/**
	 * Test get_post_meta() returns expected top location data
	 */
	public function test_get_post_meta_top_location() {

		$this->assertRegexp( '/<ul class="post__meta list-reset">/', Go\get_post_meta( $this->post_id ) );

	}

	/**
	 * Test get_post_meta() returns expected single-bottom location data
	 */
	public function test_get_post_meta_bottom_location() {

		$this->assertRegexp( '/<ul class="post__meta list-reset">/', Go\get_post_meta( $this->post_id, 'single-bottom' ) );

	}

	/**
	 * Test get_post_meta() runs the go_start_of_post_meta_list action
	 */
	public function test_get_post_meta_go_start_of_post_meta_list_action() {

		Go\get_post_meta( $this->post_id, 'single-bottom' );

		$this->assertEquals( 1, did_action( 'go_start_of_post_meta_list' ) );

	}

	/**
	 * Test get_post_meta() outputs the categories
	 */
	public function test_get_post_meta_categories() {

		$alpha_tag = wp_insert_term(
			'Alpha',
			'category',
			[
				'description'=> 'First test category.',
				'slug'       => 'alpha',
			]
		);

		$test_post = array(
			'ID'            => $this->post_id,
			'post_category' => [ $alpha_tag['term_id'] ],
		);

		wp_update_post( $test_post );

		add_filter( 'go_post_meta_location_single_bottom', function( $tags ) {

			$tags[] = 'categories';

			return $tags;

		} );

		$this->assertRegexp( '/<li class="post-categories meta-wrapper">/', Go\get_post_meta( $this->post_id, 'single-bottom' ) );

	}

	/**
	 * Test get_post_meta() outputs the sticky meta
	 */
	public function test_get_post_meta_sticky() {

		update_option( 'sticky_posts', [ $this->post_id ] );

		add_filter( 'go_post_meta_location_single_bottom', function( $tags ) {

			$tags[] = 'sticky';

			return $tags;

		} );

		$this->assertRegexp( '/<li class="post-sticky meta-wrapper">/', Go\get_post_meta( $this->post_id, 'single-bottom' ) );

	}

	/**
	 * Test get_post_meta() runs the go_end_of_post_meta_list action
	 */
	public function test_get_post_meta_go_end_of_post_meta_list_action() {

		Go\get_post_meta( $this->post_id );

		$this->assertEquals( 1, did_action( 'go_end_of_post_meta_list' ) );

	}

	/**
	 * Test that we can add custom html to the allowed list of copyright kses
	 */
	public function test_get_copyright_kses_html_filter() {

		add_filter( 'go_copyright_kses_html', function( $html ) {

			$html['p'] = [
				'class' => [],
			];

			return $html;

		} );

		$expected = [
			'div'  => [
				'class' => [],
			],
			'span' => [
				'class' => [],
			],
			'a'    => [
				'href'  => [],
				'class' => [],
			],
			'p'    => [
				'class' => [],
			],
		];

		$this->assertEquals( $expected, Go\get_copyright_kses_html() );

	}

	/**
	 * Test the selected color palette returns correct data - primary
	 */
	public function test_get_palette_color_primary() {

		$expected_primary_colors = [
			'traditional' => [
				'one'   => 'rgb(199,105,25)',
				'two'   => 'rgb(22,81,83)',
				'three' => 'rgb(135,32,14)',
				'four'  => 'rgb(168,133,72)',
			],
			'modern'      => [
				'one'   => 'rgb(0,0,0)',
				'two'   => 'rgb(194,24,91)',
				'three' => 'rgb(48,63,159)',
				'four'  => 'rgb(0,121,107)',
			],
			'trendy'      => [
				'one'   => 'rgb(0,0,0)',
				'two'   => 'rgb(0,0,0)',
				'three' => 'rgb(0,0,0)',
				'four'  => 'rgb(0,0,0)',
			],
			'welcoming'   => [
				'one'   => 'rgb(22,81,68)',
				'two'   => 'rgb(35,58,107)',
				'three' => 'rgb(91,63,32)',
				'four'  => 'rgb(68,58,130)',
			],
			'playful'     => [
				'one'   => 'rgb(63,70,174)',
				'two'   => 'rgb(224,107,109)',
				'three' => 'rgb(60,137,109)',
				'four'  => 'rgb(17,116,149)',
			],
		];

		$theme_primary_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_primary_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'primary' );

			}

		}

		$this->assertEquals(
			$expected_primary_colors,
			$theme_primary_colors,
			'The design_style and color_scheme primary colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - secondary
	 */
	public function test_get_palette_color_secondary() {

		$expected_secondary_colors = [
			'traditional' => [
				'one'   => 'rgb(18,37,56)',
				'two'   => 'rgb(33,33,33)',
				'three' => 'rgb(36,38,17)',
				'four'  => 'rgb(5,33,45)',
			],
			'modern'      => [
				'one'   => 'rgb(69,90,100)',
				'two'   => 'rgb(236,64,122)',
				'three' => 'rgb(92,107,192)',
				'four'  => 'rgb(38,166,154)',
			],
			'trendy'      => [
				'one'   => 'rgb(77,8,89)',
				'two'   => 'rgb(0,60,104)',
				'three' => 'rgb(2,73,59)',
				'four'  => 'rgb(204,34,79)',
			],
			'welcoming'   => [
				'one'   => 'rgb(1,51,46)',
				'two'   => 'rgb(1,19,61)',
				'three' => 'rgb(63,36,4)',
				'four'  => 'rgb(43,34,107)',
			],
			'playful'     => [
				'one'   => 'rgb(236,180,61)',
				'two'   => 'rgb(64,137,110)',
				'three' => 'rgb(107,3,105)',
				'four'  => 'rgb(214,145,193)',
			],
		];

		$theme_secondary_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_secondary_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'secondary' );

			}

		}

		$this->assertEquals(
			$expected_secondary_colors,
			$theme_secondary_colors,
			'The design_style and color_scheme secondary colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - tertiary
	 */
	public function test_get_palette_color_tertiary() {

		$expected_tertiary_colors = [
			'traditional' => [
				'one'   => 'rgb(248,248,248)',
				'two'   => 'rgb(243,241,240)',
				'three' => 'rgb(249,242,239)',
				'four'  => 'rgb(249,244,239)',
			],
			'modern'      => [
				'one'   => 'rgb(236,239,241)',
				'two'   => 'rgb(252,228,236)',
				'three' => 'rgb(232,234,246)',
				'four'  => 'rgb(224,242,241)',
			],
			'trendy'      => [
				'one'   => 'rgb(222,217,226)',
				'two'   => 'rgb(192,201,208)',
				'three' => 'rgb(180,198,175)',
				'four'  => 'rgb(229,222,222)',
			],
			'welcoming'   => [
				'one'   => 'rgb(201,201,201)',
				'two'   => 'rgb(201,201,201)',
				'three' => 'rgb(201,201,201)',
				'four'  => 'rgb(201,201,201)',
			],
			'playful'     => [
				'one'   => 'rgb(247,251,255)',
				'two'   => 'rgb(255,247,247)',
				'three' => 'rgb(242,249,247)',
				'four'  => 'rgb(247,254,255)',
			],
		];

		$theme_tertiary_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_tertiary_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'tertiary' );

			}

		}

		$this->assertEquals(
			$expected_tertiary_colors,
			$theme_tertiary_colors,
			'The design_style and color_scheme tertiary colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - background
	 */
	public function test_get_palette_color_background() {

		$expected_background_colors = [
			'traditional' => [
				'one'   => 'rgb(255,255,255)',
				'two'   => 'rgb(255,255,255)',
				'three' => 'rgb(255,255,255)',
				'four'  => 'rgb(255,255,255)',
			],
			'modern'      => [
				'one'   => 'rgb(255,255,255)',
				'two'   => 'rgb(255,255,255)',
				'three' => 'rgb(255,255,255)',
				'four'  => 'rgb(255,255,255)',
			],
			'trendy'      => [
				'one'   => 'rgb(255,255,255)',
				'two'   => 'rgb(255,255,255)',
				'three' => 'rgb(255,255,255)',
				'four'  => 'rgb(255,255,255)',
			],
			'welcoming'   => [
				'one'   => 'rgb(238,238,238)',
				'two'   => 'rgb(238,238,238)',
				'three' => 'rgb(238,238,238)',
				'four'  => 'rgb(238,238,238)',
			],
			'playful'     => [
				'one'   => 'rgb(255,255,255)',
				'two'   => 'rgb(255,255,255)',
				'three' => 'rgb(255,255,255)',
				'four'  => 'rgb(255,255,255)',
			],
		];

		$theme_background_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_background_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'background' );

			}

		}

		$this->assertEquals(
			$expected_background_colors,
			$theme_background_colors,
			'The design_style and color_scheme background colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - footer_background
	 */
	public function test_get_palette_color_footer_background() {

		$expected_footer_background_colors = [
			'traditional' => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'modern'      => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'trendy'      => [
				'one'   => 'rgb(0,0,0)',
				'two'   => 'rgb(0,0,0)',
				'three' => 'rgb(0,0,0)',
				'four'  => 'rgb(0,0,0)',
			],
			'welcoming'   => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'playful'     => [
				'one'   => 'rgb(63,70,174)',
				'two'   => 'rgb(235,97,106)',
				'three' => 'rgb(60,137,109)',
				'four'  => 'rgb(17,116,149)',
			],
		];

		$theme_footer_background_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_footer_background_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'footer_background' );

			}

		}

		$this->assertEquals(
			$expected_footer_background_colors,
			$theme_footer_background_colors,
			'The design_style and color_scheme footer_background colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - header_background
	 */
	public function test_get_palette_color_header_background() {

		$expected_header_background_colors = [
			'traditional' => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'modern'      => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'trendy'      => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'welcoming'   => [
				'one'   => 'rgb(255,255,255)',
				'two'   => 'rgb(255,255,255)',
				'three' => 'rgb(255,255,255)',
				'four'  => 'rgb(255,255,255)',
			],
			'playful'     => [
				'one'   => 'rgb(63,70,174)',
				'two'   => 'rgb(235,97,106)',
				'three' => 'rgb(60,137,109)',
				'four'  => 'rgb(17,116,149)',
			],
		];

		$theme_header_background_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_header_background_colors[ $design_style ][ $color_scheme_number ] = Go\get_palette_color( 'header_background' );

			}

		}

		$this->assertEquals(
			$expected_header_background_colors,
			$theme_header_background_colors,
			'The design_style and color_scheme header_background colors do not match what is expected'
		);

	}

	/**
	 * Test the selected color palette returns correct data - color override
	 */
	public function test_get_palette_color_color_override() {

		set_theme_mod( 'header_background_color', '#B4D455' );

		$this->assertEquals( 'rgb(180,212,85)', Go\get_palette_color( 'header_background' ) );

	}

	/**
	 * Test the selected color palette returns correct data - color override
	 */
	public function test_get_palette_color_HSL() {

		$this->assertEquals(
			[
				'28.0',
				'78.0',
				'44.0',
			],
			Go\get_palette_color( 'primary', 'HSL' )
		);

	}

	/**
	 * Test that the default color palette returns as expected
	 */
	public function test_get_default_palette_color_primary() {

		$expected_primary_colors = [
			'traditional' => [
				'one'   => '#c76919',
				'two'   => '#165153',
				'three' => '#87200e',
				'four'  => '#a88548',
			],
			'modern'      => [
				'one'   => '#000000',
				'two'   => '#c2185b',
				'three' => '#303f9f',
				'four'  => '#00796b',
			],
			'trendy'      => [
				'one'   => '#000000',
				'two'   => '#000000',
				'three' => '#000000',
				'four'  => '#000000',
			],
			'welcoming'   => [
				'one'   => '#165144',
				'two'   => '#233a6b',
				'three' => '#5b3f20',
				'four'  => '#443a82',
			],
			'playful'     => [
				'one'   => '#3f46ae',
				'two'   => '#e06b6d',
				'three' => '#3c896d',
				'four'  => '#117495',
			],
		];

		$theme_primary_colors = [];

		foreach ( Go\Core\get_available_design_styles() as $design_style => $data ) {

			set_theme_mod( 'design_style', $design_style );

			foreach ( $data['color_schemes'] as $color_scheme_number => $colors ) {

				set_theme_mod( 'color_scheme', $color_scheme_number );

				$theme_primary_colors[ $design_style ][ $color_scheme_number ] = Go\get_default_palette_color( 'primary' );

			}

		}

		$this->assertEquals(
			$expected_primary_colors,
			$theme_primary_colors,
			'The design_style and color_scheme primary colors do not match what is expected'
		);

	}

	/**
	 * Test that the default color palette color falls back to the previous
	 * color when the color scheme selected is filtered out or not set
	 */
	public function test_get_default_palette_color_empty_colors() {

		add_filter( 'go_color_schemes', function( $color_schemes, $design_style ) {

			unset( $color_schemes['one'] );

			return $color_schemes;

		}, 10, 2 );

		$this->assertEquals(
			'#165153',
			Go\get_default_palette_color( 'primary' )
		);

	}

	/**
	 * Test that the default color palette returns as the expected HSL array
	 */
	public function test_get_default_palette_color_hsl() {

		$this->assertEquals(
			[
				'28.0',
				'78.0',
				'44.0',
			],
			Go\get_default_palette_color( 'primary', 'HSL' )
		);

	}

	/**
	 * Test that passing a empty HEX value returns an array with three empty strings
	 */
	public function test_hex_to_hsl_empty() {

		$this->assertEquals( [ '', '', '' ], Go\hex_to_hsl( '' ) );

	}

	/**
	 * Test that passing a HEX value returns a valid HSL value
	 */
	public function test_hex_to_hsl() {

		$this->assertEquals(
			[
				'75.0',
				'60.0',
				'58.0',
			],
			Go\hex_to_hsl( '#B4D455' )
		);

	}

	/**
	 * Test that the value returns correctly when the delta calculates to 0
	 */
	public function test_hex_to_hsl_delta_zero() {

		$this->assertEquals(
			[
				'0.0',
				'0.0',
				'0.0',
			],
			Go\hex_to_hsl( '#000000' )
		);

	}

	/**
	 * Test that the value returns correctly when the delta doesn't meet a condition
	 */
	public function test_hex_to_hsl_delta_else() {

		$this->assertEquals(
			[
				'210.0',
				'65.0',
				'20.0',
			],
			Go\hex_to_hsl( '#123456' )
		);

	}

	/**
	 * Test that the value returns correctly when the delta doesn't meet a condition
	 */
	public function test_hex_to_hsl_h_less_than_zero() {

		$this->assertEquals(
			[
				'335.0',
				'81.0',
				'46.0',
			],
			Go\hex_to_hsl( '#d61765' )
		);

	}

	/**
	 * Test that hex_to_hsl returns a string properly
	 */
	public function test_hex_to_hsl_string() {

		$this->assertEquals(
			'335, 81%, 46%',
			Go\hex_to_hsl( '#d61765', true )
		);

	}

	/**
	 * Test that passing a empty HEX value returns false.
	 */
	public function test_hex_to_rgb_empty() {

		$this->assertEquals( false, Go\hex_to_rgb( '' ) );

	}

	/**
	 * Test that passing a color of invali length returns the default primary color.
	 */
	public function test_hex_to_rgb_invalid_length() {

		$this->assertEquals( '#c76919', Go\hex_to_rgb( '#1234567' ) );

	}

	/**
	 * Test that passing a HEX value of with six string length.
	 */
	public function test_hex_to_rgb_length_six() {

		$this->assertEquals( 'rgb(199,105,25)', Go\hex_to_rgb( '#c76919' ) );

	}

	/**
	 * Test that passing a HEX value of with three string length.
	 */
	public function test_hex_to_rgb_length_three() {

		$this->assertEquals( 'rgb(204,119,102)', Go\hex_to_rgb( '#c76' ) );

	}

	/**
	 * Test that passing a HEX value of with three string length.
	 */
	public function test_hex_to_rgb_with_opacity() {

		$this->assertEquals( 'rgba(199,105,25,0.8)', Go\hex_to_rgb( '#c76919', '0.8' ) );

	}

	/**
	 * Test that passing a HEX value of with three string length.
	 */
	public function test_hex_to_rgb_with_opacity_greater_than_one() {

		$this->assertEquals( 'rgba(199,105,25,1)', Go\hex_to_rgb( '#c76919', '2' ) );

	}

	/**
	 * Test that has_header_background returns null when no header_background is set in the color_scheme
	 */
	public function test_has_header_background_null() {

		$this->assertNull( Go\has_header_background() );

	}

	/**
	 * Test that has_header_background returns the correct class when header_background is set in the color_scheme
	 */
	public function test_has_header_background() {

		set_theme_mod( 'design_style', 'welcoming' );

		$this->assertEquals( 'has-background', Go\has_header_background() );

	}

	/**
	 * Test the footer variations when ! is_customize_preview()
	 */
	public function test_footer_variation_no_preview() {

		register_nav_menus(
			array(
				'primary'  => esc_html__( 'Primary', 'go' ),
				'footer-1' => esc_html__( 'Footer Menu #1', 'go' ),
				'footer-2' => esc_html__( 'Footer Menu #2', 'go' ),
				'footer-3' => esc_html__( 'Footer Menu #3', 'go' ),
			)
		);

		add_filter( 'wp_nav_menu_args', function( $args ) {
			$args['theme_location']                                = 'footer';
			$args['customize_preview_nav_menus_args']['args_hmac'] = '123';
			return $args;
		} );

		$this->expectOutputRegex( '/Test Blog/' );

		Go\footer_variation();

	}

	/**
	 * Test the footer variations when is_customize_preview()
	 */
	public function test_footer_variation_in_preview() {

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		register_nav_menus(
			array(
				'primary'  => esc_html__( 'Primary', 'go' ),
				'footer-1' => esc_html__( 'Footer Menu #1', 'go' ),
				'footer-2' => esc_html__( 'Footer Menu #2', 'go' ),
				'footer-3' => esc_html__( 'Footer Menu #3', 'go' ),
			)
		);

		global $wp_customize;

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();

		add_filter( 'wp_nav_menu_args', function( $args ) {
			$args['theme_location']                                = 'primary';
			$args['customize_preview_nav_menus_args']['args_hmac'] = '123';
			return $args;
		} );

		Go\footer_variation();

		$this->expectOutputRegex( '/Please assign a menu to the Primary menu location/' );

	}

	/**
	 * Test the current design style does not receive a footer background class
	 */
	public function test_has_footer_background_none() {

		$this->assertNull( Go\has_footer_background() );

	}

	/**
	 * Test the current design style does not receive a footer background class
	 */
	public function test_has_footer_background() {

		set_theme_mod( 'design_style', 'playful' );

		$this->assertEquals( 'has-background', Go\has_footer_background() );

	}

	/**
	 * Test the current design style does not receive a footer background class
	 */
	public function test_copyright() {

		$this->expectOutputRegex( '/Test Blog/' );

		Go\copyright();

	}

	/**
	 * Test the current design style does not receive a footer background class
	 */
	public function test_copyright_custom_text() {

		set_theme_mod( 'copyright', 'This is custom copyright text' );

		$this->expectOutputRegex( '/This is custom copyright text/' );

		Go\copyright();

	}

	/**
	 * Test that the page titles do not render when page_titles theme mod false
	 */
	public function test_page_title_disabled() {

		global $wp_customize;

		$wp_customize = null;

		set_theme_mod( 'page_titles', false );

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertEquals( '', $page_title );

	}

	/**
	 * Test that the page titles render correctly when the custom arg is set to true
	 */
	public function test_page_title_custom_title() {

		add_filter( 'go_page_title_args', function( $args ) {

			$args['custom'] = true;
			$args['title']  = 'My Custom Title';

			return $args;

		} );

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertRegexp( '/My Custom Title/', $page_title );

	}

	/**
	 * Test that the page titles return empty when $args['title'] is empty
	 */
	public function test_page_title_empty_title() {

		add_filter( 'go_page_title_args', function( $args ) {

			$args['title']  = '';

			return $args;

		} );

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertEmpty( $page_title );

	}

	/**
	 * Test any custom classes get appended to the page title element
	 */
	public function test_page_title_classes() {

		add_filter( 'go_page_title_args', function( $args ) {

			$args['atts']['class'] .= ' custom-class';

			return $args;

		} );

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertRegexp( '/custom-class/', $page_title );

	}

	/**
	 * Test the page does not show up on the front page of the site
	 */
	public function test_page_title_front_page() {

		$front_page_id = $this->factory->post->create(
			[
				'post_title'   => 'Front Page',
				'post_content' => 'This is the front page of my site.',
			]
		);

		update_option( 'page_on_front', $front_page_id );
		update_option( 'show_on_front', 'page' );

		global $post, $wp_query;

		$post = get_post( $front_page_id );

		$wp_query                 = new WP_Query( [ 'page_id' => $front_page_id ] );
		$wp_query->queried_object = $post;
		$wp_query->is_page        = true;
		$wp_query->is_single      = true;

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertEmpty( $page_title );

		wp_reset_query();

	}

	/**
	 * Test the page title renders correctly
	 */
	public function test_page_title() {

		ob_start();
		Go\page_title();
		$page_title = ob_get_clean();

		$this->assertRegexp( '/<header class="page-header entry-header m-auto px "><h1 class="post__title m-0 text-center">Test Post Meta<\/h1><\/header>/', $page_title );

	}

	/**
	 * Test WooCommerce content wraper classes are not added when WooCommerce is not active
	 */
	public function test_content_wrapper_class_no_woo_cart() {

		ob_start();
		Go\content_wrapper_class();
		$content_wrapper_class = ob_get_clean();

		$this->assertEmpty( $content_wrapper_class );

	}

	/**
	 * Test that the WooCommerce class does not run when WooCommerce is not active
	 *
	 * Note: Tests woocommerce.php setup when no WooCommerce is active
	 *       This must be run here, and not in test-woocommerce.php because after
	 *       this point WooCommerce is loaded.
	 */
	function test_woocommerce_setup_no_woocommerce() {

		Go\WooCommerce\setup();

		$this->assertFalse(
			has_action( 'woocommerce_cart_is_empty', 'Go\WooCommerce\wc_empty_cart_message' ),
			'woocommerce_cart_is_empty looks to be attached to Go\WooCommerce\wc_empty_cart_message. It should not be.'
		);

	}

	/**
	 * Test that has_social_icons returns true when social icons are set
	 */
	public function test_has_social_icons() {

		set_theme_mod( 'social_icon_facebook', 'https://www.facebook.com/custom' );

		$this->assertTrue( Go\has_social_icons() );

	}

	/**
	 * Test that has_social_icons returns false when no social icons are set
	 */
	public function test_has_no_social_icons() {

		$this->assertFalse( Go\has_social_icons() );

	}

	/**
	 * Test the post_meta() returns proper data facebook icon data
	 */
	public function test_social_icons_facebook() {

		set_theme_mod( 'social_icon_facebook', 'https://www.facebook.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.facebook.com\/custom" aria-label="Open Facebook in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data twitter icon data
	 */
	public function test_social_icons_twitter() {

		set_theme_mod( 'social_icon_twitter', 'https://www.twitter.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.twitter.com\/custom" aria-label="Open Twitter in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data instagram icon data
	 */
	public function test_social_icons_instagram() {

		set_theme_mod( 'social_icon_instagram', 'https://www.instagram.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.instagram.com\/custom" aria-label="Open Instagram in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data linkedin icon data
	 */
	public function test_social_icons_linkedin() {

		set_theme_mod( 'social_icon_linkedin', 'https://www.linkedin.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.linkedin.com\/custom" aria-label="Open LinkedIn in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data pinterest icon data
	 */
	public function test_social_icons_pinterest() {

		set_theme_mod( 'social_icon_pinterest', 'https://www.pinterest.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.pinterest.com\/custom" aria-label="Open Pinterest in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data youtube icon data
	 */
	public function test_social_icons_youtube() {

		set_theme_mod( 'social_icon_youtube', 'https://www.youtube.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.youtube.com\/custom" aria-label="Open YouTube in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the post_meta() returns proper data github icon data
	 */
	public function test_social_icons_github() {

		set_theme_mod( 'social_icon_github', 'https://www.github.com/custom' );

		$this->expectOutputRegex( '/<a class="social-icons__icon" href="https:\/\/www.github.com\/custom" aria-label="Open GitHub in a new tab" rel="noopener noreferrer" target="_blank">/' );

		Go\social_icons( [] );

	}

	/**
	 * Test the site branding renders properly
	 */
	public function test_display_site_branding() {

		$this->expectOutputRegex( '/<div class="header__titles lg:flex items-center" itemscope itemtype="http:\/\/schema.org\/Organization"><a class="display-inline-block no-underline" href="http:\/\/example.org\/" itemprop="url"><span class="site-title">Test Blog<\/span><\/a><span class="site-description display-none sm:display-block relative text-sm">Just another WordPress site<\/span><\/div>/' );

		Go\display_site_branding();

	}

	/**
	 * Test the site branding renders properly
	 */
	public function test_site_branding() {

		$this->expectOutputRegex( '/<a class="display-inline-block no-underline" href="http:\/\/example.org\/" itemprop="url"><span class="site-title">Test Blog<\/span><\/a><span class="site-description display-none sm:display-block relative text-sm">Just another WordPress site<\/span>/' );

		Go\site_branding();

	}

	/**
	 * Test the site branding renders properly with a custom logo
	 */
	public function test_site_branding_custom_logo() {

		$post_id = $this->factory->post->create(
			[
				'post_title' => 'Body Classes Test Post',
			]
		);

		$featured_image_id = media_sideload_image( 'https://raw.githubusercontent.com/godaddy-wordpress/go/master/screenshot.png', $post_id, '', 'id' );

		set_theme_mod( 'custom_logo', $featured_image_id );

		$this->expectOutputRegex( '/<a href="http:\/\/example.org\/" class="custom-logo-link" rel="home">(<img)([^<]*|[^>]*)(.*\/>)<\/a>/' );

		Go\site_branding();

	}

	/**
	 * Test navigation_toggle markup is as expected
	 */
	public function test_navigation_toggle() {

		$this->expectOutputRegex( '/<div class="header__nav-toggle">\\n[\n\r\s]+<button\\n[\n\r\s]+id="nav-toggle"\\n[\n\r\s]+class="nav-toggle"\\n[\n\r\s]+type="button"\\n[\n\r\s]+aria-controls="header__navigation"\\n[\n\r\s]+>\\n[\n\r\s]+<div class="nav-toggle-icon">\\n[\n\r\s]+(<svg)([^<]*|[^>]*)(.*<\/svg>)\\n[\n\r\s]+<\/div>\\n[\n\r\s]+<div class="nav-toggle-icon nav-toggle-icon--close">\\n[\n\r\s]+(<svg)([^<]*|[^>]*)(.*<\/svg>)\\n[\n\r\s]+<\/div>\\n[\n\r\s]+<span class="screen-reader-text">Menu<\/span>\\n[\n\r\s]+<\/button>/' );

		Go\navigation_toggle();

	}

	/**
	 * Test navigation_toggle amp-state element is rendered as expected
	 */
	public function test_navigation_toggle_amp_state_element() {

		add_filter( 'go_is_amp', '__return_true' );

		$this->expectOutputRegex( '/<amp-state id="mainNavMenuExpanded">/' );

		Go\navigation_toggle();

	}

	/**
	 * Test navigation_toggle markup is as expected
	 */
	public function test_navigation_toggle_amp_atts() {

		add_filter( 'go_is_amp', '__return_true' );

		$this->expectOutputRegex( '/on="tap:AMP\.setState\( { mainNavMenuExpanded[0-9]*: ! mainNavMenuExpanded[0-9]* } \)"/' );

		Go\navigation_toggle();

	}

	/**
	 * Test search_toggle markup is as expected
	 */
	public function test_search_toggle() {

		$this->expectOutputRegex( '/<button\\n[\n\r\s]+id="header__search-toggle"\\n[\n\r\s]+class="header__search-toggle"\\n[\n\r\s]+data-toggle-target=".search-modal"\\n[\n\r\s]+data-set-focus=".search-modal .search-form__input"\\n[\n\r\s]+type="button"\\n[\n\r\s]+aria-controls="js-site-search"\\n[\n\r\s]+>\\n[\n\r\s]+<div class="search-toggle-icon">\\n[\n\r\s]+(<svg)([^<]*|[^>]*)(.*<\/svg>)(.*)\\n[\n\r\s]+<\/div>\\n[\n\r\s]+<span class="screen-reader-text">Search Toggle<\/span>\\n[\n\r\s]+<\/button>/' );

		Go\search_toggle();

	}

	/**
	 * Test search_toggle markup renders the AMP attributes as expected
	 */
	public function test_search_toggle_amp_atts() {

		add_filter( 'go_is_amp', '__return_true' );

		$this->expectOutputRegex( '/on="tap:AMP\.setState\( { searchModalActive: ! searchModalActive } \)"/' );

		Go\search_toggle();

	}

	/**
	 * Test load_inline_svg markup is as expected
	 */
	public function test_load_inline_svg() {

		$this->expectOutputRegex( '/(<svg)([^<]*|[^>]*)(.*<\/svg>)/' );

		Go\load_inline_svg( 'cart.svg' );

	}

	/**
	 * Test load_inline_svg markup is as expected - invalid icon should return empty
	 */
	public function test_load_inline_svg_invalid_icon() {

		ob_start();
		Go\load_inline_svg( 'test-icon.svg' );
		$icon = ob_get_clean();

		$this->assertEmpty( $icon );

	}

	/**
	 * Test load_inline_svg markup is as expected - trendy search.svg
	 */
	public function test_load_inline_svg_trendy_search() {

		set_theme_mod( 'design_style', 'trendy' );

		$this->expectOutputRegex( '/<svg role="img" viewBox="0 0 20 20" xmlns="http:\/\/www.w3.org\/2000\/svg"><path d="m18.0553691 9.08577774c0-4.92630404-4.02005-8.94635404-8.94635408-8.94635404-4.92630404 0-8.96959132 4.02005-8.96959132 8.94635404 0 4.92630406 4.02005 8.94635406 8.94635404 8.94635406 2.13783006 0 4.08976186-.7435931 5.64665986-1.9984064l3.8109144 3.8109145 1.3245252-1.3245252-3.8341518-3.7876771c1.2548133-1.5336607 2.0216437-3.5088298 2.0216437-5.64665986zm-8.96959136 7.11060866c-3.90386358 0-7.08737138-3.1835078-7.08737138-7.08737138s3.1835078-7.08737138 7.08737138-7.08737138c3.90386356 0 7.08737136 3.1835078 7.08737136 7.08737138s-3.1602705 7.08737138-7.08737136 7.08737138z" \/><\/svg>/' );

		Go\load_inline_svg( 'search.svg' );

	}
}
