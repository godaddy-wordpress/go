<?php

class Test_Core extends WP_UnitTestCase {

	function setUp() {

		parent::setUp();

		Go\Core\setup();

	}

	function tearDown() {

		parent::tearDown();

	}

	/**
	 * Test the hooked i18n.
	 */
	function testHookedi18n() {

		$this->assertEquals(
			10,
			has_action( 'after_setup_theme', 'Go\Core\i18n' ),
			'after_setup_theme is not attached to Go\Core\i18n. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked theme_setup.
	 */
	function testHookedThemeSetup() {

		$this->assertEquals(
			10,
			has_action( 'after_setup_theme', 'Go\Core\theme_setup' ),
			'after_setup_theme is not attached to Go\Core\theme_setup. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked editor_styles.
	 */
	function testHookedEditorStyles() {

		$this->assertEquals(
			10,
			has_action( 'admin_init', 'Go\Core\editor_styles' ),
			'admin_init is not attached to Go\Core\editor_styles. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked styles.
	 */
	function testHookedStyles() {

		$this->assertEquals(
			10,
			has_action( 'wp_enqueue_scripts', 'Go\Core\styles' ),
			'wp_enqueue_scripts is not attached to Go\Core\styles. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked block_editor_assets.
	 */
	function testHookedBlockEditorAssets() {

		$this->assertEquals(
			10,
			has_action( 'enqueue_block_editor_assets', 'Go\Core\block_editor_assets' ),
			'enqueue_block_editor_assets is not attached to Go\Core\block_editor_assets. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked scripts.
	 */
	function testHookedScripts() {

		$this->assertEquals(
			10,
			has_action( 'wp_enqueue_scripts', 'Go\Core\scripts' ),
			'wp_enqueue_scripts is not attached to Go\Core\scripts. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked skip_link_focus_fix.
	 */
	function testHookedSkipLinkFocusText() {

		$this->assertEquals(
			10,
			has_action( 'wp_print_footer_scripts', 'Go\Core\skip_link_focus_fix' ),
			'wp_print_footer_scripts is not attached to Go\Core\skip_link_focus_fix. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked script_loader_tag.
	 */
	function testHookedScriptLoaderTag() {

		$this->assertEquals(
			10,
			has_action( 'script_loader_tag', 'Go\Core\script_loader_tag' ),
			'script_loader_tag is not attached to Go\Core\script_loader_tag. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked body_classes.
	 */
	function testHookedBodyClass() {

		$this->assertEquals(
			10,
			has_action( 'body_class', 'Go\Core\body_classes' ),
			'body_class is not attached to Go\Core\body_classes. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked add_dropdown_icons.
	 */
	function testHookedAddDropdownIcons() {

		$this->assertEquals(
			10,
			has_action( 'nav_menu_item_title', 'Go\Core\add_dropdown_icons' ),
			'nav_menu_item_title is not attached to Go\Core\add_dropdown_icons. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked filter_page_titles.
	 */
	function testHookedFilterPageTitles() {

		$this->assertEquals(
			10,
			has_action( 'go_page_title_args', 'Go\Core\filter_page_titles' ),
			'go_page_title_args is not attached to Go\Core\filter_page_titles. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test the hooked comment_form_reply_title.
	 */
	function testHookedCommentFormReplyTitle() {

		$this->assertEquals(
			10,
			has_action( 'comment_form_defaults', 'Go\Core\comment_form_reply_title' ),
			'comment_form_defaults is not attached to Go\Core\comment_form_reply_title. It might also have the wrong priority (validated priority: 10)'
		);

	}

	/**
	 * Test that the text domain was loaded
	 */
	function testTextDomain() {

		if ( ! file_exists( get_template_directory() . '/languages/es_ES.mo' ) ) {

			copy( dirname( __FILE__ ) . '/assets/es_ES.mo', get_template_directory() . '/languages/es_ES.mo' );

		}

		add_filter( 'locale', function() {

			return 'es_ES';

		} );

		Go\Core\i18n();

		$this->assertTrue( is_textdomain_loaded( 'go' ) );

		if ( file_exists( get_template_directory() . '/languages/es_ES.mo' ) ) {

			unlink( get_template_directory() . '/languages/es_ES.mo' );

		}

		// Unset the text domain so the remaining tests run in English
		global $l10n;
		unset( $l10n['go'] );

	}

	/**
	 * Test the global content width is set
	 */
	function testGlobalContentWidth() {

		$this->assertEquals( $GLOBALS['content_width'], 660 );

	}

	/**
	 * Test the theme support
	 */
	function testThemeSupports() {

		$has_support = true;

		$theme_supports = [
			'automatic-feed-links',
			'title-tag',
			'post-thumbnails',
			// 'html5',
			'custom-logo',
			'custom-background',
			'woocommerce',
			'wc-product-gallery-slider',
			'wc-product-gallery-lightbox',
			'wc-product-gallery-zoom',
			'responsive-embeds',
			'align-wide',
			'editor-styles',
			'wp-block-styles',
			'editor-font-sizes',
			'automatic-feed-links',
			'editor-color-palette',
		];

		foreach ( $theme_supports as $support ) {

			if ( current_theme_supports( $support ) ) {

				continue;

			}

			$this->fail( "Theme lacks support for ${support}" );

		}

		$this->assertTrue( true );

	}

	/**
	 * Test fonts_url returns the expected value
	 */
	function testFontsUrl() {

		unset( $GLOBALS['wp_customize'] );

		$expected  = 'https://fonts.googleapis.com/css?family=Crimson Text:400,400i,700,700i|Nunito Sans:400,400i,600,700&subset=latin,latin-ext';
		$fonts_url = Go\Core\fonts_url();

		$this->assertEquals( $expected, urldecode( $fonts_url ) );

	}

	/**
	 * Test fonts_url returns null when the design style is missing
	 */
	function testFontsUrlMissingDesignStyle() {

		add_filter( 'go_design_styles', function( $default_design_styles ) {

			unset( $default_design_styles[ Go\Core\get_default_design_style() ] );

			return $default_design_styles;

		} );

		$this->assertEquals( null, urldecode( Go\Core\fonts_url() ) );

	}

	/**
	 * Test fonts_url returns null when the design style fonts are missing from
	 * Go\Core\get_available_design_styles()
	 */
	function testFontsUrlDesignStyleMissingFonts() {

		add_filter( 'go_design_styles', function( $default_design_styles ) {

			unset( $default_design_styles[ Go\Core\get_default_design_style() ]['fonts'] );

			return $default_design_styles;

		} );

		$this->assertEquals( null, urldecode( Go\Core\fonts_url() ) );

	}

	/**
	 * Test fonts_url returns all font URLs when in the customizer
	 */
	function testFontsUrlCustomizer() {

		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

		$GLOBALS['wp_customize'] = new WP_Customize_Manager();
		$GLOBALS['wp_customize']->setup_theme();

		$theme_fonts = [
			'Crimson Text'   => [
				'400',
				'400i',
				'700',
				'700i',
			],
			'Nunito Sans'    => [
				'400',
				'400i',
				'600',
				'700',
			],
			'Montserrat'      => [
				'400',
				'700',
			],
			'Fira Code'       => [
				'400',
				'400i',
				'700',
			],
			'Heebo'           => [
				'400',
				'800',
			],
			'Trocchi'         => [
				'400',
				'600',
			],
			'Noto Sans'       => [
				'400',
				'400i',
				'700',
			],
			'Source Code Pro' => [
				'400',
				'700',
			],
			'Work Sans'       => [
				'300',
				'700',
			],
			'Karla'           => [
				'400',
				'400i',
				'700',
			],
			'Quicksand'       => [
				'400',
				'600',
			],
			'Poppins'         => [
				'700',
			],
		];

		$fonts = [];

		foreach ( $theme_fonts as $font => $font_weights ) {

			$fonts[] = sprintf( '%1$s:%2$s', $font, implode( ',', $font_weights ) );

		}

		$expected = esc_url_raw(
			add_query_arg(
				[
					'family' => rawurlencode( implode( '|', $fonts ) ),
					'subset' => rawurlencode( 'latin,latin-ext' ),
				],
				'https://fonts.googleapis.com/css'
			)
		);

		$this->assertEquals( urldecode( $expected ), urldecode( Go\Core\fonts_url() ) );

	}

	/**
	 * Test fonts_url returns proper fonts, after unsetting one
	 */
	function testFontsUrlCustomizerDesignStyleNoFonts() {

		add_filter( 'go_design_styles', function( $default_design_styles ) {

			unset( $default_design_styles['modern']['fonts'] );

			return $default_design_styles;

		} );

		$this->assertNotContains( 'Montserrat', Go\Core\fonts_url() );

	}

	/**
	 * Test the block editor assets enqueue properly
	 */
	function testBlockEditorAssets() {

		Go\Core\block_editor_assets();

		$this->assertTrue( wp_script_is( 'go-block-filters' ) );

	}

	/**
	 * Test the block editor assets data is localized
	 */
	function testBlockEditorAssetsLocalizedData() {

		global $wp_scripts;

		$this->assertContains( 'var GoBlockFilters = {"inlineStyles"', $wp_scripts->registered['go-block-filters']->extra['data'] );

	}

	/**
	 * Test the scripts are enqueued
	 */
	function testScripts() {

		$post_id = $this->factory->post->create(
			[
				'post_title' => 'Test Post',
			]
		);

		global $wp_query;

		$wp_query->post        = get_post( $post_id );
		$wp_query->is_singular = true;

		$GLOBALS['post'] = $wp_query->post;

		Go\Core\scripts();

		$this->assertTrue(
			wp_script_is( 'go-frontend' ),
			'go-frontend script is not enqueued.'
		);

	}

	/**
	 * Test the scripts are enqueued
	 */
	function testScriptsSingular() {

		global $wp_scripts;

		$this->assertArrayHasKey( 'comment-reply', $wp_scripts->registered );

	}

	/**
	 * Test the scripts data is localized
	 */
	function testScriptsLocalizedData() {

		global $wp_scripts;

		$this->assertEquals( 'var GoText = {"searchLabel":"Expand search field"};', $wp_scripts->registered['go-frontend']->extra['data'] );

	}

	/**
	 * Test the editor styles are enqueued
	 */
	function testEditorStylesStyleEditor() {

		set_current_screen( 'dashboard' );

		Go\Core\editor_styles();

		global $editor_styles;

		$this->assertTrue( in_array( 'dist/css/style-editor.min.css', $editor_styles, true ) );

	}

	/**
	 * Test the editor design styles are enqueued
	 */
	function testEditorStylesDesignStyles() {

		global $editor_styles;

		$this->assertTrue( in_array( 'dist/css/design-styles/style-traditional-editor.min.css', $editor_styles, true ) );

	}

	/**
	 * Test the editor design styles are enqueued
	 */
	function testEditorStylesDesignStylesModern() {

		set_theme_mod( 'design_style', 'modern' );

		Go\Core\editor_styles();

		global $editor_styles;

		$this->assertTrue( in_array( 'dist/css/design-styles/style-modern-editor.min.css', $editor_styles, true ) );

		set_theme_mod( 'design_style', 'traditional' );

	}

	/**
	 * Test the editor fonts are enqueued
	 */
	function testEditorStylesFonts() {

		global $editor_styles;

		$this->assertTrue( in_array( Go\Core\fonts_url(), $editor_styles, true ) );

	}

	/**
	 * Test the styles are enqueued
	 */
	function testStyles() {

		Go\Core\styles();

		global $wp_styles;

		$this->assertArrayHasKey( 'go-style', $wp_styles->registered );

	}

	/**
	 * Test the design styles are enqueued
	 */
	function testStylesDesignStyle() {

		global $wp_styles;

		$this->assertArrayHasKey( 'go-design-style-traditional', $wp_styles->registered );
	}

	/**
	 * Test the fonts are enqueued
	 */
	function testStylesFonts() {

		global $wp_styles;

		$this->assertArrayHasKey( 'go-fonts', $wp_styles->registered );
	}

	/**
	 * Test the skip link focus script tag outputs
	 */
	function testSkipLinkFocus() {

		ob_start();
		Go\Core\skip_link_focus_fix();

		$this->assertContains( '(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);', ob_get_clean() );

	}

	/**
	 * Test the script loader tag
	 */
	function testScriptLoaderTag() {

		$this->assertEquals( '<script></script>', Go\Core\script_loader_tag( '<script></script>', 'go-frontend' ) );

	}

	/**
	 * Test the script loader tag returns proper with a non-registered handle
	 */
	function testScriptLoaderTagNonMatchingScriptExecutionValue() {

		global $wp_scripts;

		$wp_scripts->registered['go-frontend']->extra['script_execution'] = 'onload';

		$this->assertEquals( '<script></script>', Go\Core\script_loader_tag( '<script></script>', 'go-frontend' ) );

	}

	/**
	 * Test the script loader tag returns correct with script_execution data
	 */
	function testScriptLoaderTagScriptExecution() {

		global $wp_scripts;

		$wp_scripts->registered['go-frontend']->extra['script_execution'] = 'async';

		$this->assertEquals( '<script async></script>', Go\Core\script_loader_tag( '<script></script>', 'go-frontend' ) );

	}

	/**
	 * Test the script loader tag returns null when the script is a dependency of another
	 */
	function testScriptLoaderTagScriptExecutionDependency() {

		global $wp_scripts;

		$wp_scripts->registered['go-frontend']->deps[] = 'go-frontend';

		$this->assertEquals( '<script></script>', Go\Core\script_loader_tag( '<script></script>', 'go-frontend' ) );

	}

	/**
	 * Test the body classes are correct
	 */
	function testBodyClasses() {

		set_theme_mod( 'header_background_color', '#fafafa' );
		set_theme_mod( 'footer_background_color', '#fafafa' );

		$classes = Go\Core\body_classes( [] );

		$expecting_classes = [
			'is-style-traditional',
			'has-header-1',
			'has-footer-1',
			'has-no-footer-menu',
			'has-header-background',
			'has-footer-background',
			'has-page-titles',
			'hfeed',
		];

		$this->assertEquals( $expecting_classes, $classes );

		set_theme_mod( 'header_background_color', false );
		set_theme_mod( 'footer_background_color', false );

	}

	/**
	 * Test the body classes are correct on singular pages
	 */
	function testBodyClassesSingular() {

		$post_id = $this->factory->post->create(
			[
				'post_title' => 'Body Classes Test Post',
			]
		);

		$featured_image_id = media_sideload_image( 'https://raw.githubusercontent.com/godaddy-wordpress/go/master/screenshot.png', $post_id, '', 'id' );

		set_post_thumbnail( $post_id, $featured_image_id );

		global $wp_query;

		$wp_query->post        = get_post( $post_id );
		$wp_query->is_singular = true;

		$GLOBALS['post'] = $wp_query->post;

		$classes = Go\Core\body_classes( [] );

		$expecting_classes = [
			'is-style-traditional',
			'has-header-1',
			'has-footer-1',
			'has-no-footer-menu',
			'has-comments-open',
			'has-page-titles',
			'has-featured-image',
			'singular',
		];

		$this->assertEquals( $expecting_classes, $classes );

	}

	/**
	 * Test the body classes are correct when content contains WooCommerce block
	 */
	function testBodyClassesSingularWooBlock() {

		$post_id = $this->factory->post->create(
			[
				'post_title'   => 'Body Classes Test Post',
				'post_content' => '<!-- wp:woocommerce/handpicked-products -->'
			]
		);

		$featured_image_id = media_sideload_image( 'https://raw.githubusercontent.com/godaddy-wordpress/go/master/screenshot.png', $post_id, '', 'id' );

		set_post_thumbnail( $post_id, $featured_image_id );

		global $wp_query;

		$wp_query->post        = get_post( $post_id );
		$wp_query->is_singular = true;

		$GLOBALS['post'] = $wp_query->post;

		$this->assertTrue( in_array( 'woocommerce-page', Go\Core\body_classes( [] ), true ) );

	}

	/**
	 * Test the default design style returns correctly
	 */
	function testGetDefaultDesignStyle() {

		$this->assertEquals( 'traditional', Go\Core\get_default_design_style() );

	}

	/**
	 * Test the default design style filter works as expected
	 */
	function testGetDefaultDesignStyleFilter() {

		add_filter( 'go_default_design_style', function( $style ) {
			return 'playful';
		} );

		$this->assertEquals( 'playful', Go\Core\get_default_design_style() );

	}

	/**
	 * Test retreiving the available design styles
	 */
	function testGetAvailableDesignStyles() {

		$expected_styles = [
			'traditional',
			'modern',
			'trendy',
			'welcoming',
			'playful',
		];

		$this->assertEquals( $expected_styles, array_keys( Go\Core\get_available_design_styles() ) );

	}

	/**
	 * Test retreiving the available design styles after being filtered
	 */
	function testGetAvailableDesignStylesFilter() {

		add_filter( 'go_design_styles', function( $default_design_styles ) {

			unset( $default_design_styles['trendy'] );

			return $default_design_styles;

		} );

		$this->assertFalse( array_key_exists( 'trendy', Go\Core\get_available_design_styles() ) );

	}

	/**
	 * Test retreiving the current design style functions properly
	 */
	function testGetDesignStyle() {

		$design_style = Go\Core\get_design_style();

		$this->assertTrue( is_array( $design_style ) && 'Traditional' === $design_style['label'] );

	}

	/**
	 * Test retreiving an invalid design style returns false
	 */
	function testGetInvalidDesignStyle() {

		set_theme_mod( 'design_style', 'invalid-style' );

		$this->assertFalse( Go\Core\get_design_style() );

		set_theme_mod( 'design_style', Go\Core\get_default_design_style() );

	}

	/**
	 * Test retreiving the header variation returns the correct data
	 */
	function testGetDefaultHeaderVariation() {

		$this->assertEquals( 'header-1', Go\Core\get_default_header_variation() );

	}

	/**
	 * Test retreiving the header variation returns the correct data after being filtered
	 */
	function testGetDefaultHeaderVariationFilter() {

		add_filter( 'go_default_header', function() {

			return 'header-2';

		} );

		$this->assertEquals( 'header-2', Go\Core\get_default_header_variation() );

	}

	/**
	 * Test the available header variations
	 */
	function testGetAvailableHeaderVariations() {

		$expected_headers = [
			'header-1',
			'header-2',
			'header-3',
			'header-4',
		];

		$this->assertEquals( $expected_headers, array_keys( Go\Core\get_available_header_variations() ) );

	}

	/**
	 * Test the available header variations filter
	 */
	function testGetAvailableHeaderVariationsFilter() {

		add_filter( 'go_header_variations', function( $default_header_variations ) {

			unset( $default_header_variations['header-3'] );

			return $default_header_variations;

		} );

		$expected_headers = [
			'header-1',
			'header-2',
			'header-4',
		];

		$this->assertEquals( $expected_headers, array_keys( Go\Core\get_available_header_variations() ) );

	}

	/**
	 * Test the available footer variations
	 */
	function testGetAvailableFooterVariations() {

		$expected_footers = [
			'footer-1',
			'footer-2',
			'footer-3',
			'footer-4',
		];

		$this->assertEquals( $expected_footers, array_keys( Go\Core\get_available_footer_variations() ) );

	}

	/**
	 * Test the available footer variations filter
	 */
	function testGetAvailableFooterVariationsFilter() {

		add_filter( 'go_footer_variations', function( $default_footer_variations ) {

			unset( $default_footer_variations['footer-3'] );

			return $default_footer_variations;

		} );

		$expected_footers = [
			'footer-1',
			'footer-2',
			'footer-4',
		];

		$this->assertEquals( $expected_footers, array_keys( Go\Core\get_available_footer_variations() ) );

	}

	/**
	 * Test retreiving the footer variation returns the correct data
	 */
	function testGetDefaultFooterVariation() {

		$this->assertEquals( 'footer-1', Go\Core\get_default_footer_variation() );

	}

	/**
	 * Test retreiving the footer variation returns the correct data after being filtered
	 */
	function testGetDefaultFooterVariationFilter() {

		add_filter( 'go_default_footer_variation', function() {

			return 'footer-2';

		} );

		$this->assertEquals( 'footer-2', Go\Core\get_default_footer_variation() );

	}

	/**
	 * Test retreiving the footer variation
	 */
	function testGetFooterVariation() {

		$footer_variation = Go\Core\get_footer_variation();

		$this->assertEquals( 'Footer 1', $footer_variation['label'] );

	}

	/**
	 * Test retreiving an invalid footer
	 */
	function testGetInvalidFooterVariation() {

		set_theme_mod( 'footer_variation', 'invalid-footer' );

		$this->assertFalse( Go\Core\get_footer_variation() );

		set_theme_mod( 'footer_variation', Go\Core\get_default_footer_variation() );

	}

	/**
	 * Test retreiving the copyright text
	 */
	function testGetDefaultCopyright() {

		$this->assertEquals( 'WordPress Theme by GoDaddy', Go\Core\get_default_copyright() );

	}

	/**
	 * Test retreiving the filtered copyright text
	 */
	function testGetFilteredDefaultCopyright() {

		add_filter( 'go_default_copyright', function() {

			return 'WordPress Theme by some Developer';

		} );

		$this->assertEquals( 'WordPress Theme by some Developer', Go\Core\get_default_copyright() );

	}

	/**
	 * Test retreiving the social icons
	 */
	function testGetAvailableSocialIcons() {

		$social_icons = [
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
			'pinterest',
		];

		$this->assertEquals( $social_icons, array_keys( Go\Core\get_available_social_icons() ) );

	}

	/**
	 * Test filtering the social icons
	 */
	function testGetAvailableSocialIconsFilter() {

		$test_data = [
			'label'       => 'Test',
			'icon'        => 'icon',
			'placeholder' => 'placeholder',
		];

		add_filter( 'go_avaliable_social_icons', function( $social_icons ) use( $test_data ) {

			$social_icons['test'] = $test_data;

			return $social_icons;

		} );

		$social_icons = Go\Core\get_available_social_icons();

		$this->assertEquals( $test_data, $social_icons['test'] );

	}

	/**
	 * Test retreiving the social icons
	 */
	function testGetSocialIcons() {

		set_theme_mod( 'social_icon_facebook', 'https://www.facebook.com/custom' );

		$social_icons = Go\Core\get_social_icons();

		$this->assertEquals( 'https://www.facebook.com/custom', $social_icons['facebook']['url'] );

		remove_theme_mod( 'social_icon_facebook' );

	}

	/**
	 * Test retreiving the color schemes
	 */
	function testGetColorSchemes() {

		$this->assertEquals( [ 'one', 'two', 'three', 'four' ], array_keys( Go\Core\get_available_color_schemes() ) );

	}

	/**
	 * Test filtering the color schemes
	 */
	function testGetColorSchemesFilter() {

		add_filter( 'go_color_schemes', function( $color_scheme, $design_styl ) {

			unset( $color_scheme['one'] );

			return $color_scheme;

		}, 10, 2 );

		$this->assertEquals( [ 'two', 'three', 'four' ], array_keys( Go\Core\get_available_color_schemes() ) );

	}

	/**
	 * Test retreiving the default color scheme
	 */
	function testGetDefaultScheme() {

		$this->assertEquals( 'one', Go\Core\get_default_color_scheme() );

	}

	/**
	 * Test filtering the default color scheme
	 */
	function testGetDefaultSchemeFilter() {

		add_filter( 'go_default_color_scheme', function() {

			return 'three';

		} );

		$this->assertEquals( 'three', Go\Core\get_default_color_scheme() );

	}

	/**
	 * Test adding an icon to dropdown items in the nav
	 */
	function testAddDropdownIcons() {

		$item          = new stdClass();
		$item->classes = [ 'menu-item-has-children' ];

		$args                 = new stdClass();
		$args->theme_location = 'primary';

		$title = Go\Core\add_dropdown_icons( 'Title', $item, $args, 0 );

		$this->assertEquals( 'Title<svg role="img" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="square" /></svg>', trim( $title ) );

	}

	/**
	 * Test no icon is added to non-toplevel items
	 */
	function testAddDropdownIconsNonTopLevel() {

		$item          = new stdClass();
		$item->classes = [ 'menu-item' ];

		$args                 = new stdClass();
		$args->theme_location = 'primary';

		$title = Go\Core\add_dropdown_icons( 'Title', $item, $args, 0 );

		$this->assertEquals( 'Title', trim( $title ) );

	}

	/**
	 * Test no icon is added to non-primary menus
	 */
	function testAddDropdownIconsNonPrimary() {

		$item          = new stdClass();
		$item->classes = [ 'menu-item-has-children' ];

		$args                 = new stdClass();
		$args->theme_location = 'secondary';

		$title = Go\Core\add_dropdown_icons( 'Title', $item, $args, 0 );

		$this->assertEquals( 'Title', trim( $title ) );

	}

	/**
	 * Test comment title arguments
	 */
	function testCommentFormReplyTitle() {

		$expected_args = [
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		];

		$this->assertEquals( $expected_args, Go\Core\comment_form_reply_title( [] ) );

	}

	/**
	 * Test page title returns as expected when is_home()
	 */
	function testFilterPageTitlesHome() {

		$post_id = $this->factory->post->create(
			[
				'post_title' => 'Home Page',
			]
		);

		update_option( 'page_on_front', $post_id );
    update_option( 'show_on_front', 'page' );

		global $wp_query;

		$wp_query->post    = get_post( $post_id );
		$wp_query->is_home = true;

		$GLOBALS['post'] = $wp_query->post;

		$this->assertEquals( [ 'title' => 'Home Page' ], Go\Core\filter_page_titles( [] ) );

	}

	/**
	 * Test page title returns as expected when is_404()
	 */
	function testFilterPageTitles404() {

		global $wp_query;

		$wp_query->is_404 = true;

		$this->assertEquals( [ 'title' => 'That page can&#039;t be found' ], Go\Core\filter_page_titles( [] ) );

	}

	/**
	 * Test page title returns as expected when is_archive()
	 */
	function testFilterPageTitlesArchive() {

		global $wp_query;

		$wp_query->is_archive = true;

		$expected_args = [
			'title'  => '<h1 class="post__title m-0 text-center">Archives</h1>',
			'custom' => true,
		];

		$this->assertEquals( $expected_args, Go\Core\filter_page_titles( [] ) );

	}

	/**
	 * Test page title returns as expected for when is_search() and posts are found
	 */
	function testFilterPageTitlesSearchPostsFound() {

		global $wp_query;

		$wp_query->is_search       = true;
		$wp_query->query['s']      = 'Search Query';
		$wp_query->query_vars['s'] = 'Search Query';
		$wp_query->found_posts     = 5;

		$this->assertEquals( [ 'title' => 'Search for: Search Query' ], Go\Core\filter_page_titles( [] ) );

	}

	/**
	 * Test page title returns as expected for when is_search() and no posts are found
	 */
	function testFilterPageTitlesSearchNoPostsFound() {

		global $wp_query;

		$wp_query->is_search   = true;
		$wp_query->s           = 'Search Query';
		$wp_query->found_posts = 0;

		$this->assertEquals( [ 'title' => 'Nothing Found' ], Go\Core\filter_page_titles( [] ) );

	}
}
