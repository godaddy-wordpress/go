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

	add_action( 'init', $n( 'init' ) );
	add_action( 'after_setup_theme', $n( 'i18n' ) );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'admin_init', $n( 'editor_styles' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_head', $n( 'js_detection' ), 0 );
	add_action( 'wp_print_footer_scripts', $n( 'skip_link_focus_fix' ) );

	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );
	add_filter( 'body_class', $n( 'body_classes' ) );
	add_filter( 'body_class', $n( 'body_data' ), 999 );
	add_filter( 'nav_menu_item_title', $n( 'add_dropdown_icons' ), 10, 4 );
}

/**
 * Runs code on init hook
 *
 * @return void
 */
function init() {
	remove_post_type_support( 'page', 'thumbnail' );
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
	load_theme_textdomain( 'maverick', MAVERICK_PATH . '/languages' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {

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
		array(
			'height'      => 190,
			'width'       => 190,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	// add_theme_support( 'editor-styles' );

	// Add support for WooCommerce.
	add_theme_support( 'woocommerce' );

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
		$color_palette = array(
			array(
				'name'  => esc_html__( 'Primary', 'maverick' ),
				'slug'  => 'primary',
				'color' => \Maverick\get_palette_color( 'primary' ),
			),
			array(
				'name'  => esc_html__( 'Secondary', 'maverick' ),
				'slug'  => 'secondary',
				'color' => \Maverick\get_palette_color( 'secondary' ),
			),
			array(
				'name'  => esc_html__( 'Tertiary', 'maverick' ),
				'slug'  => 'tertiary',
				'color' => \Maverick\get_palette_color( 'tertiary' ),
			),
			array(
				'name'  => esc_html__( 'Quaternary', 'maverick' ),
				'slug'  => 'quaternary',
				'color' => '#ffffff',
			),
		);

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

		$fonts[] = sprintf( '%1$s: %2$s', $font, implode( ',', $font_weights ) );

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
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	wp_enqueue_script(
		'frontend',
		MAVERICK_TEMPLATE_URL . '/dist/js/frontend.js',
		[],
		MAVERICK_VERSION,
		true
	);

	wp_localize_script(
		'frontend',
		'MaverickText',
		[
			'searchLabel' => esc_html__( 'Expand search field', 'maverick' ),
		]
	);
}

/**
 * Enqueues the editor styles.
 *
 * @return void
 */
function editor_styles() {
	// Enqueue our shared Gutenberg editor styles.
	add_editor_style(
		'dist/css/editor-style.css'
	);

	$design_style = get_design_style();

	if ( $design_style && isset( $design_style['editor_style'] ) ) {
		add_editor_style(
			$design_style['editor_style']
		);
	}

	add_editor_style( fonts_url() );
}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	wp_enqueue_style(
		'maverick-fonts',
		fonts_url(),
		[],
		MAVERICK_VERSION
	);

	wp_enqueue_style(
		'styles',
		MAVERICK_TEMPLATE_URL . '/dist/css/shared-style.css',
		[ 'maverick-fonts' ],
		MAVERICK_VERSION
	);

	$design_style = get_design_style();

	if ( $design_style ) {
		wp_enqueue_style(
			'design-style',
			$design_style['url'],
			[ 'styles' ],
			MAVERICK_VERSION
		);
	}
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

	// Add class whenever a WooCommerce block is added to a page
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
 * Adds data attributes to the body based on Customizer entries.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_data( $classes ) {

	$design_style     = get_theme_mod( 'maverick_design_style', get_default_design_style() );
	$footer_variation = get_theme_mod( 'footer_variation', get_default_footer_variation() );
	$header_variation = get_theme_mod( 'header_variation', get_default_header_variation() );

	if ( $design_style ) {
		$classes[] = sprintf( '" data-style="%s"', esc_attr( $design_style ) );
	}

	if ( $header_variation ) {
		$classes[] = sprintf( 'data-header="%s"', esc_attr( $header_variation ) );
	}

	if ( $footer_variation ) {
		$classes[] = sprintf( 'data-footer="%s"', esc_attr( $footer_variation ) );
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
	$default_design_styles = [
		'modern'      => [
			'label'         => esc_html__( 'Modern', 'maverick' ),
			'url'           => MAVERICK_TEMPLATE_URL . '/dist/css/design-styles/modern.css',
			'editor_style'  => 'dist/css/design-styles/modern-editor.css',
			'color_schemes' => [
				'default' => [
					'label'           => esc_html__( 'Shade', 'maverick' ),
					'primary_color'   => '#1c1c1c',
					'secondary_color' => '#686868',
					'tertiary_color'  => '#cccccc',
				],
				'two'     => [
					'label'           => esc_html__( 'Blush', 'maverick' ),
					'primary_color'   => '#ef0254',
					'secondary_color' => '#ff5c8d',
					'tertiary_color'  => '#ffc1d1',
				],
				'three'   => [
					'label'           => esc_html__( 'Indigo', 'maverick' ),
					'primary_color'   => '#283593',
					'secondary_color' => '#5f5fc4',
					'tertiary_color'  => '#d1d9ff',
				],
				'four'    => [
					'label'           => esc_html__( 'Pacific', 'maverick' ),
					'primary_color'   => '#20534d',
					'secondary_color' => '#00bfa5',
					'tertiary_color'  => '#afebe5',
				],
			],
			'fonts'         => [
				'Montserrat'    => [
					'400',
					'400i',
					'700',
					'700i',
				],
				'IBM Plex Sans' => [
					'400',
					'400i',
					'700',
				],
			],
		],
		'traditional' => [
			'label'         => esc_html__( 'Traditional', 'maverick' ),
			'url'           => MAVERICK_TEMPLATE_URL . '/dist/css/design-styles/traditional.css',
			'editor_style'  => 'dist/css/design-styles/traditional-editor.css',
			'color_schemes' => [
				'default' => [
					'label'           => esc_html__( 'Light', 'maverick' ),
					'primary_color'   => '#c76919',
					'secondary_color' => '#a0510e',
					'tertiary_color'  => '#123456',
				],
				'two'     => [
					'label'           => esc_html__( 'Dark', 'maverick' ),
					'primary_color'   => '#3f5836',
					'secondary_color' => '#293922',
					'tertiary_color'  => '#123456',
				],
			],
		],
		'trendy'      => [
			'label'         => esc_html__( 'Trendy', 'maverick' ),
			'url'           => MAVERICK_TEMPLATE_URL . '/dist/css/design-styles/trendy.css',
			'editor_style'  => 'dist/css/design-styles/trendy-editor.css',
			'color_schemes' => [
				'default' => [
					'label'           => esc_html__( 'Light', 'maverick' ),
					'primary_color'   => '#fcfcfc',
					'secondary_color' => '#f3f0ed',
					'tertiary_color'  => '#123456',
				],
				'two'     => [
					'label'           => esc_html__( 'Dark', 'maverick' ),
					'primary_color'   => '#f1f4f4',
					'secondary_color' => '#ebeeee',
					'tertiary_color'  => '#123456',
				],
			],
		],
		'welcoming'   => [
			'label'         => esc_html__( 'Welcoming', 'maverick' ),
			'url'           => MAVERICK_TEMPLATE_URL . '/dist/css/design-styles/welcoming.css',
			'editor_style'  => 'dist/css/design-styles/welcoming-editor.css',
			'color_schemes' => [
				'default' => [
					'label'           => esc_html__( 'Light', 'maverick' ),
					'primary_color'   => '#02392f',
					'secondary_color' => '#f1f1f1',
					'tertiary_color'  => '#123456',
				],
				'two'     => [
					'label'           => esc_html__( 'Dark', 'maverick' ),
					'primary_color'   => '#49384d',
					'secondary_color' => '#f7f5e9',
					'tertiary_color'  => '#123456',
				],
			],
		],
		'playful'        => [
			'label'         => esc_html__( 'Playful', 'maverick' ),
			'url'           => MAVERICK_TEMPLATE_URL . '/dist/css/design-styles/play.css',
			'editor_style'  => 'dist/css/design-styles/play-editor.css',
			'color_schemes' => [
				'default' => [
					'label'           => esc_html__( 'Light', 'maverick' ),
					'primary_color'   => '#254e9c',
					'secondary_color' => '#fcae6e',
					'tertiary_color'  => '#123456',
				],
				'two'     => [
					'label'           => esc_html__( 'Dark', 'maverick' ),
					'primary_color'   => '#41b093',
					'secondary_color' => '#eecd94',
					'tertiary_color'  => '#123456',
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
	$design_style = get_theme_mod( 'maverick_design_style', get_default_design_style() );

	$supported_design_styles = get_available_design_styles();

	if ( in_array( $design_style, array_keys( $supported_design_styles ), true ) ) {
		return $supported_design_styles[ $design_style ];
	}

	return false;
}

/**
 * Returns the default design style
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
			'label'         => esc_html__( 'Logo + Nav + Search', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/header-1.svg',
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '1' );
			},
		],
		'header-2' => [
			'label'         => esc_html__( 'Nav + Logo', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/header-2.svg',
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '2' );
			},
		],
		'header-3' => [
			'label'         => esc_html__( 'Logo + Nav (Vertical)', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/header-3.svg',
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '3' );
			},
		],
		'header-4' => [
			'label'         => esc_html__( 'Search + Logo + Nav', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/header-4.svg',
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '4' );
			},
		],
		'header-5' => [
			'label'         => esc_html__( 'Nav + Logo + Search', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/header-5.svg',
			'partial'       => function() {
				return get_template_part( 'partials/headers/header', '5' );
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
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/footer-1.svg',
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '1' );
			},
		],
		'footer-2' => [
			'label'         => esc_html__( 'Footer 2', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/footer-2.svg',
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '2' );
			},
		],
		'footer-3' => [
			'label'         => esc_html__( 'Footer 3', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/footer-3.svg',
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '3' );
			},
		],
		'footer-4' => [
			'label'         => esc_html__( 'Footer 4', 'maverick' ),
			'preview_image' => MAVERICK_TEMPLATE_URL . '/assets/admin/images/footer-4.svg',
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
 * Returns the current header variation.
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
 * Returns the default value for footer blurb text
 *
 * @return string
 */
function get_default_footer_blurb_text() {
	/**
	 * Filters the default footer blurb text.
	 *
	 * @since 0.1.0
	 *
	 * @param string $default_footer_blurb_text The default text for footer blurb.
	 */
	return apply_filters( 'maverick_default_footer_blurb_text', 'Replace this with real informative text.' );
}

/**
 * Returns the default value for footer blurb text
 *
 * @return string
 */
function get_default_footer_copy_text() {
	/**
	 * Filters the default footer blurb text.
	 *
	 * @since 0.1.0
	 *
	 * @param string $default_footer_blurb_text The default text for footer blurb.
	 */
	return apply_filters( 'maverick_default_footer_copy_text', 'WordPress Theme by GoDaddy' );
}

/**
 * Returns the supported social icons.
 *
 * @return array
 */
function get_available_social_icons() {
	$social_icons = [
		'facebook'  => [
			'label'      => esc_html__( 'Facebook', 'maverick' ),
			'icon'       => MAVERICK_PATH . '/assets/shared/images/social/facebook.svg',
			'icon_class' => '',
		],
		'twitter'   => [
			'label'      => esc_html__( 'Twitter', 'maverick' ),
			'icon'       => MAVERICK_PATH . '/assets/shared/images/social/twitter.svg',
			'icon_class' => '',
		],
		'instagram' => [
			'label'      => esc_html__( 'Instagram', 'maverick' ),
			'icon'       => MAVERICK_PATH . '/assets/shared/images/social/instagram.svg',
			'icon_class' => '',
		],
		'linkedin'  => [
			'label'      => esc_html__( 'LinkedIn', 'maverick' ),
			'icon'       => MAVERICK_PATH . '/assets/shared/images/social/linkedin.svg',
			'icon_class' => '',
		],
		'pinterest' => [
			'label'      => esc_html__( 'Pinterest', 'maverick' ),
			'icon'       => MAVERICK_PATH . '/assets/shared/images/social/pinterest.svg',
			'icon_class' => '',
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
		$social_icon['url'] = get_theme_mod( sprintf( 'footer_social_%s', $key ), '' );
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
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $title  The menu item's title.
 * @param object $item   The current menu item.
 * @param object $args   An object of wp_nav_menu() arguments.
 * @param int    $depth  Depth of menu item. Used for padding.
 * Add a dropdown icon to top-level menu items
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
