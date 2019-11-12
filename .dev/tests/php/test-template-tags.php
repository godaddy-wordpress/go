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
	 * Test the selected color palette returns correct data - primary
	 */
	public function test_get_palette_color_primary() {

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
				'one'   => '#122538',
				'two'   => '#212121',
				'three' => '#242611',
				'four'  => '#05212d',
			],
			'modern'      => [
				'one'   => '#455a64',
				'two'   => '#ec407a',
				'three' => '#5c6bc0',
				'four'  => '#26a69a',
			],
			'trendy'      => [
				'one'   => '#4d0859',
				'two'   => '#003c68',
				'three' => '#02493b',
				'four'  => '#cc224f',
			],
			'welcoming'   => [
				'one'   => '#01332e',
				'two'   => '#01133d',
				'three' => '#3f2404',
				'four'  => '#2b226b',
			],
			'playful'     => [
				'one'   => '#ecb43d',
				'two'   => '#40896e',
				'three' => '#6b0369',
				'four'  => '#d691c1',
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
				'one'   => '#f8f8f8',
				'two'   => '#f3f1f0',
				'three' => '#f9f2ef',
				'four'  => '#f9f4ef',
			],
			'modern'      => [
				'one'   => '#eceff1',
				'two'   => '#fce4ec',
				'three' => '#e8eaf6',
				'four'  => '#e0f2f1',
			],
			'trendy'      => [
				'one'   => '#ded9e2',
				'two'   => '#c0c9d0',
				'three' => '#b4c6af',
				'four'  => '#e5dede',
			],
			'welcoming'   => [
				'one'   => '#c9c9c9',
				'two'   => '#c9c9c9',
				'three' => '#c9c9c9',
				'four'  => '#c9c9c9',
			],
			'playful'     => [
				'one'   => '#f7fbff',
				'two'   => '#fff7f7',
				'three' => '#f2f9f7',
				'four'  => '#f7feff',
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
				'one'   => '#ffffff',
				'two'   => '#ffffff',
				'three' => '#ffffff',
				'four'  => '#ffffff',
			],
			'modern'      => [
				'one'   => '#ffffff',
				'two'   => '#ffffff',
				'three' => '#ffffff',
				'four'  => '#ffffff',
			],
			'trendy'      => [
				'one'   => '#ffffff',
				'two'   => '#ffffff',
				'three' => '#ffffff',
				'four'  => '#ffffff',
			],
			'welcoming'   => [
				'one'   => '#eeeeee',
				'two'   => '#eeeeee',
				'three' => '#eeeeee',
				'four'  => '#eeeeee',
			],
			'playful'     => [
				'one'   => '#ffffff',
				'two'   => '#ffffff',
				'three' => '#ffffff',
				'four'  => '#ffffff',
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
				'one'   => '#000000',
				'two'   => '#000000',
				'three' => '#000000',
				'four'  => '#000000',
			],
			'welcoming'   => [
				'one'   => null,
				'two'   => null,
				'three' => null,
				'four'  => null,
			],
			'playful'     => [
				'one'   => '#3f46ae',
				'two'   => '#eb616a',
				'three' => '#3c896d',
				'four'  => '#117495',
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
				'one'   => '#ffffff',
				'two'   => '#ffffff',
				'three' => '#ffffff',
				'four'  => '#ffffff',
			],
			'playful'     => [
				'one'   => '#3f46ae',
				'two'   => '#eb616a',
				'three' => '#3c896d',
				'four'  => '#117495',
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

		$this->assertEquals( '#B4D455', Go\get_palette_color( 'header_background' ) );

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
}
