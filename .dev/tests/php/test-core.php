<?php

class Test_Core extends WP_UnitTestCase {

	public static function wpSetUpBeforeClass( $factory ) {

		wp_set_current_user( $factory->user->create( [ 'role' => 'administrator' ] ) );

	}

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
}
