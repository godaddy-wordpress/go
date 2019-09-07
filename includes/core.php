<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package Maverick\Core
 */

namespace Maverick\Core;

use function Maverick\hex_to_hsl;
use function Maverick\load_inline_svg;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme', $n( 'i18n' ) );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'admin_init', $n( 'editor_styles' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'enqueue_block_editor_assets', $n( 'block_editor_assets' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_head', $n( 'js_detection' ), 0 );
	add_action( 'wp_print_footer_scripts', $n( 'skip_link_focus_fix' ) );
	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );
	add_filter( 'body_class', $n( 'body_classes' ) );
	add_filter( 'nav_menu_item_title', $n( 'add_dropdown_icons' ), 10, 4 );
	add_filter( 'maverick_page_title_args', $n( 'filter_page_titles' ) );
	add_filter( 'comment_form_defaults', $n( 'comment_form_reply_title' ) );

}

/**
 * Makes Theme available for translation.
 *
 * Translations can be added to the /languages directory.
 * If you're building a theme based on "godaddy", change the
 * filename of '/languages/maverick.pot' to the name of your project.
 *
 * @return void
 */
function i18n() {

	load_theme_textdomain( 'maverick', get_template_directory() . '/languages' );

}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {

	/**
	 * Filters the theme content width global.
	 *
	 * @since 1.0.0
	 *
	 * @param integer $content_width The default content width for the theme.
	 */
	$GLOBALS['content_width'] = apply_filters( 'maverick_content_width', 980 );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in up to four locations.
	register_nav_menus(
		[
			'primary'  => esc_html__( 'Primary', 'maverick' ),
			'footer-1' => esc_html__( 'Footer Menu #1', 'maverick' ),
			'footer-2' => esc_html__( 'Footer Menu #2', 'maverick' ),
			'footer-3' => esc_html__( 'Footer Menu #3', 'maverick' ),
		]
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		[
			'height'      => 190,
			'width'       => 190,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);

	// Add support for custom background color.
	add_theme_support(
		'custom-background',
		[
			'default-color' => \Maverick\get_palette_color( 'background' ),
		]
	);

	// Add support for WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-zoom' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for core block styles.
	add_theme_support( 'wp-block-styles' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		[
			[
				'name'      => esc_html__( 'Small', 'maverick' ),
				'shortName' => esc_html__( 'S', 'maverick' ),
				'size'      => 17,
				'slug'      => 'small',
			],
			[
				'name'      => esc_html__( 'Medium', 'maverick' ),
				'shortName' => esc_html__( 'M', 'maverick' ),
				'size'      => 21,
				'slug'      => 'medium',
			],
			[
				'name'      => esc_html__( 'Large', 'maverick' ),
				'shortName' => esc_html__( 'L', 'maverick' ),
				'size'      => 24,
				'slug'      => 'large',
			],
			[
				'name'      => esc_html__( 'Huge', 'maverick' ),
				'shortName' => esc_html__( 'XL', 'maverick' ),
				'size'      => 30,
				'slug'      => 'huge',
			],
		]
	);

	$design_style = get_design_style();

	if ( $design_style ) {
		$color_palette = [
			[
				'name'  => esc_html__( 'Primary', 'maverick' ),
				'slug'  => 'primary',
				'color' => \Maverick\get_palette_color( 'primary' ),
			],
			[
				'name'  => esc_html__( 'Secondary', 'maverick' ),
				'slug'  => 'secondary',
				'color' => \Maverick\get_palette_color( 'secondary' ),
			],
			[
				'name'  => esc_html__( 'Tertiary', 'maverick' ),
				'slug'  => 'tertiary',
				'color' => \Maverick\get_palette_color( 'tertiary' ),
			],
			[
				'name'  => esc_html__( 'Quaternary', 'maverick' ),
				'slug'  => 'quaternary',
				'color' => '#ffffff',
			],
		];

		add_theme_support( 'editor-color-palette', $color_palette );
	}

}

/**
 * Enqueue the correct font(s) for the given design style.
 */
function fonts_url() {

	$design_style = get_design_style();

	if ( ! $design_style ) {

		return;

	}

	$design_styles = get_available_design_styles();
	$design_style  = sanitize_title( $design_style['label'] );

	if ( ! isset( $design_styles[ $design_style ] ) || ! isset( $design_styles[ $design_style ]['fonts'] ) ) {

		return;

	}

	$fonts = [];

	foreach ( $design_styles[ $design_style ]['fonts'] as $font => $font_weights ) {

		$fonts[] = sprintf( '%1$s:%2$s', $font, implode( ',', $font_weights ) );

	}

	if ( is_customize_preview() ) {

		$fonts = [];

		foreach ( $design_styles as $design_style => $data ) {

			if ( ! isset( $data['fonts'] ) ) {

				continue;

			}

			foreach ( $data['fonts'] as $font => $font_weights ) {

				$fonts[] = sprintf( '%1$s:%2$s', $font, implode( ',', $font_weights ) );

			}
		}
	}

	return esc_url_raw(
		add_query_arg(
			[
				'family' => rawurlencode( implode( '|', $fonts ) ),
				'subset' => rawurlencode( 'latin,latin-ext' ),
			],
			'https://fonts.googleapis.com/css'
		)
	);

}

/**
 * Enqueue block editor assets.
 *
 * @return void
 */
function block_editor_assets() {

	require_once get_parent_theme_file_path( 'includes/customizer.php' );

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'maverick-block-filters',
		get_theme_file_uri( "dist/js/admin/block-filters{$suffix}.js" ),
		[ 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
		MAVERICK_VERSION,
		true
	);

	ob_start();

	\Maverick\Customizer\inline_css();

	$styles = ob_get_clean();

	wp_localize_script(
		'maverick-block-filters',
		'MaverickBlockFilters',
		[
			'inlineStyles' => $styles,
		]
	);

}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'maverick-frontend',
		get_theme_file_uri( "dist/js/frontend{$suffix}.js" ),
		[],
		MAVERICK_VERSION,
		true
	);

	wp_localize_script(
		'maverick-frontend',
		'MaverickText',
		[
			'searchLabel' => esc_html__( 'Expand search field', 'maverick' ),
		]
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

/**
 * Enqueues the editor styles.
 *
 * @return void
 */
function editor_styles() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	// Enqueue  shared editor styles.
	add_editor_style(
		"dist/css/style-editor{$suffix}.css"
	);

	// Enqueue design style editor styles.
	$design_style = get_design_style();

	if ( $design_style && isset( $design_style['editor_style'] ) ) {
		add_editor_style(
			$design_style['editor_style']
		);
	}

	// Enqueue fonts into the editor.
	add_editor_style( fonts_url() );

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style(
		'maverick-style',
		get_theme_file_uri( "dist/css/style-shared{$suffix}.css" ),
		[ 'maverick-fonts' ],
		MAVERICK_VERSION
	);

	$design_style = get_design_style();

	if ( $design_style ) {
		wp_enqueue_style(
			'maverick-design-style-' . sanitize_title( $design_style['label'] ),
			$design_style['url'],
			[ 'maverick-style' ],
			MAVERICK_VERSION
		);
	}

	wp_enqueue_style(
		'maverick-fonts',
		fonts_url(),
		[],
		MAVERICK_VERSION
	);

}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @return void
 */
function js_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}

/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function script_loader_tag( $tag, $handle ) {
	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag;
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;

}

/**
 * Add classes to body element.
 *
 * @param string|array $classes Classes to be added to body.
 * @return array
 */
function body_classes( $classes ) {

	$design_style     = get_theme_mod( 'design_style', get_default_design_style() );
	$footer_variation = get_theme_mod( 'footer_variation', get_default_footer_variation() );
	$header_variation = get_theme_mod( 'header_variation', get_default_header_variation() );

	// Add class for the current design style.
	if ( $design_style ) {
		$classes[] = sprintf( 'is-style-%s', esc_attr( $design_style ) );
	}

	// Add class for the current header variation.
	if ( $header_variation ) {
		$classes[] = sprintf( 'has-%s', esc_attr( $header_variation ) );
	}

	// Add class for the current footer variation.
	if ( $footer_variation ) {
		$classes[] = sprintf( 'has-%s', esc_attr( $footer_variation ) );
	}

	// Add class when there is not a footer menu.
	if ( ! has_nav_menu( 'footer-1' ) ) {
		$classes[] = 'has-no-footer-menu';
	}

	// Add class when a page or post has comments.
	if ( is_singular() && comments_open() ) {
		$classes[] = 'has-comments-open';
	}

	if ( get_theme_mod( 'footer_background_color', false ) ) {
		$classes[] = 'has-footer-background';
	}

	if ( get_theme_mod( 'page_titles', true ) ) {
		$classes[] = 'has-page-titles';
	}

	if ( has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	// Add class whenever a WooCommerce block is added to a page.
	if (
		has_block( 'woocommerce/handpicked-products' )
		|| has_block( 'woocommerce/product-best-sellers' )
		|| has_block( 'woocommerce/product-category' )
		|| has_block( 'woocommerce/product-new' )
		|| has_block( 'woocommerce/product-on-sale' )
		|| has_block( 'woocommerce/product-top-rated' )
		|| has_block( 'woocommerce/products-by-attribute' )
		|| has_block( 'woocommerce/featured-product' )
	) {
		$classes[] = 'woocommerce-page';
	}

	return $classes;

}

/**
 * Returns the default design style
 *
 * @return string
 */
function get_default_design_style() {
	/**
	 * Filters the default design style.
	 *
	 * @since 0.1.0
	 *
	 * @param array $default_design_style The slug of the default design style.
	 */
	return apply_filters( 'maverick_default_design_style', 'modern' );

}

/**
 * Returns the avaliable design styles.
 *
 * @return array
 */
function get_available_design_styles() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	$default_design_styles = [
		'modern'      => [
			'label'         => esc_html__( 'Modern', 'maverick' ),
			'url'           => get_theme_file_uri( "dist/css/design-styles/style-modern{$suffix}.css" ),
			'editor_style'  => "dist/css/design-styles/style-modern-editor{$suffix}.css",
			'color_schemes' => [
				'one'   => [
					'label'      => esc_html__( 'Shade', 'maverick' ),
					'primary'    => '#000a12',
					'secondary'  => '#455a64',
					'tertiary'   => '#eceff1',
					'background' => '#ffffff',
				],
				'two'   => [
					'label'      => esc_html__( 'Blush', 'maverick' ),
					'primary'    => '#c2185b', // 700
					'secondary'  => '#ec407a', // 400
					'tertiary'   => '#fce4ec', // 100
					'background' => '#ffffff',
				],
				'three' => [
					'label'      => esc_html__( 'Indigo', 'maverick' ),
					'primary'    => '#303f9f', // 700
					'secondary'  => '#5c6bc0', // 400
					'tertiary'   => '#e8eaf6', // 100
					'background' => '#ffffff',
				],
				'four'  => [
					'label'      => esc_html__( 'Pacific', 'maverick' ),
					'primary'    => '#00796b', // 700
					'secondary'  => '#26a69a', // 400
					'tertiary'   => '#e0f2f1', // 100
					'background' => '#ffffff',
				],
			],
			'fonts'         => [
				'Montserrat'    => [
					'400',
					'700',
				],
				'IBM Plex Mono' => [
					'400',
					'400i',
					'700',
				],
				'Heebo'         => [
					'400',
					'700',
				],
			],
		],
		'traditional' => [
			'label'         => esc_html__( 'Traditional', 'maverick' ),
			'url'           => get_theme_file_uri( "dist/css/design-styles/style-traditional{$suffix}.css" ),
			'editor_style'  => "dist/css/design-styles/style-traditional-editor{$suffix}.css",
			'color_schemes' => [
				'one'   => [
					'label'      => esc_html__( 'Apricot', 'maverick' ),
					'primary'    => '#c76919',
					'secondary'  => '#122538',
					'tertiary'   => '#f8f8f8',
					'background' => '#ffffff',
				],
				'two'   => [
					'label'      => esc_html__( 'Emerald', 'maverick' ),
					'primary'    => '#165153',
					'secondary'  => '#212121',
					'tertiary'   => '#f3f1f0',
					'background' => '#ffffff',
				],
				'three' => [
					'label'      => esc_html__( 'Brick', 'maverick' ),
					'primary'    => '#87200e',
					'secondary'  => '#242611',
					'tertiary'   => '#f9f2ef',
					'background' => '#ffffff',
				],
				'four'  => [
					'label'      => esc_html__( 'Bronze', 'maverick' ),
					'primary'    => '#a88548',
					'secondary'  => '#05212d',
					'tertiary'   => '#f9f4ef',
					'background' => '#ffffff',
				],
			],
			'fonts'         => [
				'Crimson Text' => [
					'400',
					'400i',
					'700',
					'700i',
				],
				'Nunito Sans'  => [
					'400',
					'400i',
					'600',
					'700',
				],
			],
		],
		'trendy'      => [
			'label'         => esc_html__( 'Trendy', 'maverick' ),
			'url'           => get_theme_file_uri( "dist/css/design-styles/style-trendy{$suffix}.css" ),
			'editor_style'  => "dist/css/design-styles/style-trendy-editor{$suffix}.css",
			'color_schemes' => [
				'one'   => [
					'label'             => esc_html__( 'Plum', 'maverick' ),
					'primary'           => '#000000',
					'secondary'         => '#4d0859',
					'tertiary'          => '#ded9e2',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				],

				'two'   => [
					'label'             => esc_html__( 'Steel', 'maverick' ),
					'primary'           => '#000000',
					'secondary'         => '#003c68',
					'tertiary'          => '#c0c9d0',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				],
				'three' => [
					'label'             => esc_html__( 'Avocado', 'maverick' ),
					'primary'           => '#000000',
					'secondary'         => '#02493b',
					'tertiary'          => '#b4c6af',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				],
				'four'  => [
					'label'             => esc_html__( 'Champagne', 'maverick' ),
					'primary'           => '#000000',
					'secondary'         => '#cc224f',
					'tertiary'          => '#e5dede',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				],
			],
			'fonts'         => [
				'Trocchi'    => [
					'400',
				],
				'Open Sans'  => [
					'400',
					'400i',
					'700',
				],
				'Montserrat' => [
					'400',
					'700',
				],
			],
		],
		'welcoming'   => [
			'label'         => esc_html__( 'Welcoming', 'maverick' ),
			'url'           => get_theme_file_uri( "dist/css/design-styles/style-welcoming{$suffix}.css" ),
			'editor_style'  => "dist/css/design-styles/style-welcoming-editor{$suffix}.css",
			'color_schemes' => [
				'one'   => [
					'label'             => esc_html__( 'Forest', 'maverick' ),
					'primary'           => '#165144',
					'secondary'         => '#01332e',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				],
				'two'   => [
					'label'             => esc_html__( 'Spruce', 'maverick' ),
					'primary'           => '#233a6b',
					'secondary'         => '#01133d',
					'tertiary'          => '#c9c9c9',
					'background'        => '#ffffff',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				],
				'three' => [
					'label'             => esc_html__( 'Mocha', 'maverick' ),
					'primary'           => '#5b3f20',
					'secondary'         => '#3f2404',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				],
				'four'  => [
					'label'             => esc_html__( 'Lavender', 'maverick' ),
					'primary'           => '#443a82',
					'secondary'         => '#2b226b',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				],
			],
			'fonts'         => [
				'Work Sans'  => [
					'300',
				],
				'Karla'      => [
					'400',
					'400i',
					'700',
				],
				'Hepta Slab' => [
					'600',
				],
			],
		],
		'playful'     => [
			'label'         => esc_html__( 'Playful', 'maverick' ),
			'url'           => get_theme_file_uri( "dist/css/design-styles/style-playful{$suffix}.css" ),
			'editor_style'  => "dist/css/design-styles/style-playful-editor{$suffix}.css",
			'color_schemes' => [
				'one'   => [
					'label'             => esc_html__( 'Frolic', 'maverick' ),
					'primary'           => '#3f46ae',
					'secondary'         => '#ecb43d',
					'tertiary'          => '#f7fbff',
					'background'        => '#ffffff',
					'header_background' => '#3f46ae',
					'footer_background' => '#3f46ae',
				],
				'two'   => [
					'label'             => esc_html__( 'Coral', 'maverick' ),
					'primary'           => '#e06b6d',
					'secondary'         => '#40896e',
					'tertiary'          => '#fff7f7',
					'background'        => '#ffffff',
					'header_background' => '#eb616a',
					'footer_background' => '#eb616a',
				],
				'three' => [
					'label'             => esc_html__( 'Organic', 'maverick' ),
					'primary'           => '#3c896d',
					'secondary'         => '#6b0369',
					'tertiary'          => '#f2f9f7',
					'background'        => '#ffffff',
					'header_background' => '#3c896d',
					'footer_background' => '#3c896d',
				],
				'four'  => [
					'label'             => esc_html__( 'Berry', 'maverick' ),
					'primary'           => '#117495',
					'secondary'         => '#d691c1',
					'tertiary'          => '#f7feff',
					'background'        => '#ffffff',
					'header_background' => '#117495',
					'footer_background' => '#117495',
				],
			],
			'fonts'         => [
				'Quicksand' => [
					'400',
					'600',
				],
				'Poppins'   => [
					'700',
				],
			],
		],
	];
	/**
	 * Filters the supported design styles.
	 *
	 * @since 0.1.0
	 *
	 * @param array $design_styles Array containings the supported design styles,
	 * where the index is the slug of design style and value an array of options that sets up the design styles.
	 */
	$supported_design_styles = apply_filters( 'maverick_design_styles', $default_design_styles );

	return $supported_design_styles;

}

/**
 * Returns the current design style.
 *
 * @return array
 */
function get_design_style() {
	$design_style = get_theme_mod( 'design_style', get_default_design_style() );

	$supported_design_styles = get_available_design_styles();

	if ( in_array( $design_style, array_keys( $supported_design_styles ), true ) ) {
		return $supported_design_styles[ $design_style ];
	}

	return false;

}

/**
 * Returns the default header variation.
 *
 * @return string
 */
function get_default_header_variation() {
	/**
	 * Filters the default header variation.
	 *
	 * @since 0.1.0
	 *
	 * @param array $default_header_variation The slug of the default header variation.
	 */
	return apply_filters( 'maverick_default_header', 'header-1' );

}

/**
 * Returns the avaliable header variations.
 *
 * @return array
 */
function get_available_header_variations() {
	$default_header_variations = [
		'header-1' => [
			'label'         => esc_html__( 'Header 1', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-1.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '1' );
			},
		],
		'header-2' => [
			'label'         => esc_html__( 'Header 2', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-2.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '2' );
			},
		],
		'header-3' => [
			'label'         => esc_html__( 'Header 3', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-3.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '3' );
			},
		],
		'header-4' => [
			'label'         => esc_html__( 'Header 4', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-4.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '4' );
			},
		],
	];

	/**
	 * Filters the supported header variations.
	 *
	 * @since 0.1.0
	 *
	 * @param array $header_variations Array containings the supported header variations,
	 * where the index is the slug of header variation and the value an array of options that sets up the header variation.
	 */
	$supported_header_variations = apply_filters( 'header_variations', $default_header_variations );

	return $supported_header_variations;

}

/**
 * Returns the current header variation.
 *
 * @return array
 */
function get_header_variation() {
	$selected_variation = get_theme_mod( 'header_variation', get_default_header_variation() );

	$supported_header_variations = get_available_header_variations();

	if ( in_array( $selected_variation, array_keys( $supported_header_variations ), true ) ) {
		return $supported_header_variations[ $selected_variation ];
	}

	return false;

}

/**
 * Returns the avaliable footer variations.
 *
 * @return array
 */
function get_available_footer_variations() {
	$default_footer_variations = [
		'footer-1' => [
			'label'         => esc_html__( 'Footer 1', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-1.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '1' );
			},
		],
		'footer-2' => [
			'label'         => esc_html__( 'Footer 2', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-2.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '2' );
			},
		],
		'footer-3' => [
			'label'         => esc_html__( 'Footer 3', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-3.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '3' );
			},
		],
		'footer-4' => [
			'label'         => esc_html__( 'Footer 4', 'maverick' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-4.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '4' );
			},
		],
	];

	/**
	 * Filters the supported header variations.
	 *
	 * @since 0.1.0
	 *
	 * @param array $footer_variations Array containings the supported header variations,
	 * where the index is the slug of header variation and the value an array of options that sets up the header variation.
	 */
	$supported_footer_variations = apply_filters( 'maverick_footer_variations', $default_footer_variations );

	return $supported_footer_variations;

}

/**
 * Returns the default design style
 *
 * @return string
 */
function get_default_footer_variation() {
	/**
	 * Filters the default footer variation.
	 *
	 * @since 0.1.0
	 *
	 * @param array $default_footer_variation The slug of the default footer variation.
	 */
	return apply_filters( 'maverick_default_footer_variation', 'footer-1' );

}

/**
 * Returns the current footer variation.
 *
 * @return array
 */
function get_footer_variation() {
	$selected_variation = get_theme_mod( 'footer_variation', get_default_footer_variation() );

	$supported_header_variations = get_available_footer_variations();

	if ( in_array( $selected_variation, array_keys( $supported_header_variations ), true ) ) {
		return $supported_header_variations[ $selected_variation ];
	}

	return false;

}

/**
 * Returns the default value for footer copyright text.
 *
 * @return string
 */
function get_default_copyright() {
	/**
	 * Filters the default copyright text.
	 *
	 * @since 0.1.0
	 *
	 * @param string $copyright The default text for copyright.
	 */
	/* translators: the theme author */
	return apply_filters( 'maverick_default_copyright', sprintf( esc_html__( 'WordPress Theme by %s', 'maverick' ), 'GoDaddy' ) );

}

/**
 * Returns the supported social icons.
 *
 * @return array
 */
function get_available_social_icons() {
	$social_icons = [
		'facebook'  => [
			'label'       => esc_html__( 'Facebook', 'maverick' ),
			'icon'        => get_theme_file_path( 'dist/images/social/facebook.svg' ),
			'placeholder' => 'https://facebook.com/user',
		],
		'twitter'   => [
			'label'       => esc_html__( 'Twitter', 'maverick' ),
			'icon'        => get_theme_file_path( 'dist/images/social/twitter.svg' ),
			'placeholder' => 'https://twitter.com/user',
		],
		'instagram' => [
			'label'       => esc_html__( 'Instagram', 'maverick' ),
			'icon'        => get_theme_file_path( 'dist/images/social/instagram.svg' ),
			'placeholder' => 'https://instagram.com/user',
		],
		'linkedin'  => [
			'label'       => esc_html__( 'LinkedIn', 'maverick' ),
			'icon'        => get_theme_file_path( 'dist/images/social/linkedin.svg' ),
			'placeholder' => 'https://linkedin.com/in/user',
		],
		'pinterest' => [
			'label'       => esc_html__( 'Pinterest', 'maverick' ),
			'icon'        => get_theme_file_path( 'dist/images/social/pinterest.svg' ),
			'placeholder' => 'https://pinterest.com/user',
		],
	];

	/**
	 * Filters the supported social icons.
	 *
	 * @since 0.1.0
	 *
	 * @param array $social_icons Array containings the supported social icons.
	 */
	return apply_filters( 'maverick_avaliable_social_icons', $social_icons );

}

/**
 * Returns the social icons data
 *
 * @return array
 */
function get_social_icons() {
	$social_icons = get_available_social_icons();

	foreach ( $social_icons as $key => &$social_icon ) {
		$social_icon['url'] = get_theme_mod( sprintf( 'social_icon_%s', $key ), '' );
	}

	return $social_icons;

}

/**
 * Returns the avaliable color schemes
 *
 * @return array
 */
function get_available_color_schemes() {
	$design_style = get_design_style();

	/**
	 * Filters the avaliable color schemes
	 *
	 * @since 0.1.0
	 *
	 * @param array $color_schemes The array containing the color schemes
	 * @param array $design_style  The full design style object
	 */
	return apply_filters( 'maverick_color_schemes', $design_style['color_schemes'], $design_style );

}

/**
 * Returns the default color scheme
 *
 * @return string
 */
function get_default_color_scheme() {
	/**
	 * Filters the default color scheme.
	 *
	 * @param array $default_color_scheme The slug of the default color scheme.
	 */
	return apply_filters( 'maverick_default_color_scheme', 'one' );

}

/**
 * Add a dropdown icon to top-level menu items
 *
 * @param string $title The menu item's title.
 * @param object $item  The current menu item.
 * @param object $args  An object of wp_nav_menu() arguments.
 * @param int    $depth Depth of menu item (used for padding).
 *
 * Add a dropdown icon to top-level menu items.
 */
function add_dropdown_icons( $title, $item, $args, $depth ) {

	// Only add class to 'top level' items on the 'primary' menu.
	if ( 'primary' === $args->theme_location && 0 === $depth ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . load_inline_svg( 'arrow-down.svg' ); // phpcs:ignore;
			}
		}
	}

	return $title;

}

/**
 * Alter the reply title to an <h2> element. a11y fix.
 *
 * @param array $args Default arguments and form fields to override.
 *
 * @return $args Comment form arguments.
 */
function comment_form_reply_title( $args ) {

	$args['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
	$args['title_reply_after']  = '</h2>';

	return $args;

}

/**
 * Filter the page titles
 *
 * @param array $args Page title arguments.
 *
 * @return $args Filtered page title arguments.
 */
function filter_page_titles( $args ) {

	if ( is_home() ) {

		$args['title'] = get_the_title( get_option( 'page_for_posts', true ) );

	}

	if ( is_404() ) {

		$args['title'] = esc_html__( "That page can't be found", 'maverick' );

	}

	if ( is_archive() ) {

		$args['title'] = get_the_archive_title();

	}

	if ( is_search() ) {

		$args['title'] = sprintf(
			/* translators: Search query term(s). */
			esc_html__( 'Search for: %s', 'maverick' ),
			esc_html( get_search_query() )
		);

		global $wp_query;

		if ( 0 === $wp_query->found_posts ) {

			$args['title'] = esc_html__( 'Nothing Found', 'maverick' );

		}
	}

	return $args;

}
