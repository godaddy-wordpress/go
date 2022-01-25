<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package Go\Core
 */

namespace Go\Core;

use function Go\hex_to_hsl;
use function Go\load_inline_svg;
use function Go\AMP\is_amp;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme', $n( 'development_environment' ) );
	add_action( 'after_setup_theme', $n( 'i18n' ) );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'admin_init', $n( 'editor_styles' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'enqueue_block_editor_assets', $n( 'block_editor_assets' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_print_footer_scripts', $n( 'skip_link_focus_fix' ) );
	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );
	add_filter( 'body_class', $n( 'body_classes' ) );
	add_filter( 'nav_menu_item_title', $n( 'add_dropdown_icons' ), 10, 4 );
	add_filter( 'go_page_title_args', $n( 'filter_page_titles' ) );
	add_filter( 'comment_form_defaults', $n( 'comment_form_reply_title' ) );
	add_filter( 'the_content_more_link', $n( 'read_more_tag' ) );
	add_filter( 'get_custom_logo_image_attributes', $n( 'custom_logo_alt_text' ), PHP_INT_MAX, 2 );

}

/**
 * Check if this is an install is a local development environment
 */
function development_environment() {

	if ( is_readable( get_template_directory() . '/.dev/assets/development-environment.php' ) ) {

		require_once get_template_directory() . '/.dev/assets/development-environment.php';

	}

}

/**
 * Makes Theme available for translation.
 *
 * Translations can be added to the /languages directory.
 * If you're building a theme based on Go, change the
 * filename of '/languages/go.pot' to the name of your project.
 *
 * @return void
 */
function i18n() {

	load_theme_textdomain( 'go', get_template_directory() . '/languages' );

}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @codeCoverageIgnore
 */
function theme_setup() {

	// Filters the theme content width global; intended to be overruled from themes.
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = (int) apply_filters( 'go_content_width', 660 );

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
		array(
			'primary'  => esc_html__( 'Primary', 'go' ),
			'footer-1' => esc_html__( 'Footer Menu #1', 'go' ),
			'footer-2' => esc_html__( 'Footer Menu #2', 'go' ),
			'footer-3' => esc_html__( 'Footer Menu #3', 'go' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
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

	// Add support for custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => \Go\get_palette_color( 'background', 'HEX' ),
		)
	);

	// Indicate that the theme works well in both Standard and Transitional template modes of the AMP plugin.
	add_theme_support(
		'amp',
		array(
			// The `paired` flag means that the theme retains logic to be fully functional when AMP is disabled.
			'paired' => true,
		)
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

	// Add support for experimental link colors.
	add_theme_support( 'experimental-link-color' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html_x( 'Small', 'font size option label', 'go' ),
				'shortName' => esc_html_x( 'S', 'abbreviation of the font size option label', 'go' ),
				'size'      => 17,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html_x( 'Medium', 'font size option label', 'go' ),
				'shortName' => esc_html_x( 'M', 'abbreviation of the font size option label', 'go' ),
				'size'      => 21,
				'slug'      => 'medium',
			),
			array(
				'name'      => esc_html_x( 'Large', 'font size option label', 'go' ),
				'shortName' => esc_html_x( 'L', 'abbreviation of the font size option label', 'go' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html_x( 'Huge', 'font size option label', 'go' ),
				'shortName' => esc_html_x( 'XL', 'abbreviation of the font size option label', 'go' ),
				'size'      => 30,
				'slug'      => 'huge',
			),
		)
	);

	$design_style = get_design_style();

	if ( $design_style ) {
		$color_palette = array(
			array(
				'name'  => esc_html_x( 'Primary', 'name of the first color palette selection', 'go' ),
				'slug'  => 'primary',
				'color' => \Go\get_palette_color( 'primary' ),
			),
			array(
				'name'  => esc_html_x( 'Secondary', 'name of the second color palette selection', 'go' ),
				'slug'  => 'secondary',
				'color' => \Go\get_palette_color( 'secondary' ),
			),
			array(
				'name'  => esc_html_x( 'Tertiary', 'name of the third color palette selection', 'go' ),
				'slug'  => 'tertiary',
				'color' => \Go\get_palette_color( 'tertiary' ),
			),
			array(
				'name'  => esc_html_x( 'Quaternary', 'name of the fourth color palette selection', 'go' ),
				'slug'  => 'quaternary',
				'color' => '#ffffff',
			),
		);

		add_theme_support( 'editor-color-palette', $color_palette );

		$primary_color    = \Go\get_palette_color( 'primary', 'RGB' );
		$secondary_color  = \Go\get_palette_color( 'secondary', 'RGB' );
		$tertiary_color   = \Go\get_palette_color( 'tertiary', 'RGB' );
		$background_color = \Go\get_palette_color( 'background', 'RGB' );

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => __( 'Primary to Secondary', 'go' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $secondary_color ) . ' 100%)',
					'slug'     => 'primary-to-secondary',
				),
				array(
					'name'     => __( 'Primary to Tertiary', 'go' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $tertiary_color ) . ' 100%)',
					'slug'     => 'primary-to-tertiary',
				),
				array(
					'name'     => __( 'Primary to Background', 'go' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $background_color ) . ' 100%)',
					'slug'     => 'primary-to-background',
				),
				array(
					'name'     => __( 'Secondary to Tertiary', 'go' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $secondary_color ) . ' 0%, ' . esc_attr( $background_color ) . ' 100%)',
					'slug'     => 'secondary-to-tertiary',
				),
			)
		);

	}

	// Enable custom padding controls.
	add_theme_support( 'custom-spacing' );

}

/**
 * Enqueue the correct font(s) for the given design style.
 */
function fonts_url() {
	/**
	 * Filter to disable Google fonts from loading on the site.
	 *
	 * @var bool
	 */
	$use_google_fonts = apply_filters( 'go_use_google_fonts', true );

	$design_style = get_design_style();

	if ( ! $use_google_fonts || ! isset( $design_style['fonts'] ) ) {

		return;

	}

	$cur_fonts = get_theme_mod( 'fonts', $design_style['fonts'] );

	$design_styles = get_available_design_styles();

	$fonts = array();

	foreach ( $cur_fonts as $font => $font_weights ) {

		$fonts[] = sprintf( '%1$s:%2$s', str_replace( array( '_heading', '_body' ), '', $font ), implode( ',', $font_weights ) );

	}

	if ( is_customize_preview() ) {

		$fonts = array();

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
			array(
				'family'  => rawurlencode( implode( '|', $fonts ) ),
				'subset'  => rawurlencode( 'latin,latin-ext' ),
				'display' => 'swap',
			),
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

	// This file provides our Customizer setup, not template partials.
	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once get_parent_theme_file_path( 'includes/customizer.php' );

	wp_enqueue_script(
		'go-block-filters',
		wp_unslash( get_theme_file_uri( 'dist/js/admin/block-filters.js' ) ),
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components' ),
		GO_VERSION,
		true
	);

	ob_start();

	\Go\Customizer\inline_css();

	$styles = ob_get_clean();

	wp_localize_script(
		'go-block-filters',
		'GoBlockFilters',
		array(
			'inlineStyles'   => str_replace( ':root', '.editor-styles-wrapper', $styles ),
			'showPageTitles' => (bool) get_theme_mod( 'page_titles', true ),
		)
	);

}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	// Short-circuit in AMP responses since custom scripts are not valid (unless refactored to use amp-script).
	if ( is_amp() ) {

		return;

	}

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'go-frontend',
		get_theme_file_uri( "dist/js/frontend{$suffix}.js" ),
		array(),
		GO_VERSION,
		true
	);

	wp_localize_script(
		'go-frontend',
		'goFrontend',
		array(
			'openMenuOnHover' => (bool) get_theme_mod( 'open_menu_on_hover', true ),
			'isMobile'        => (bool) wp_is_mobile(),
		)
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
	$rtl    = ! is_rtl() ? '' : '-rtl';

	// Enqueue  shared editor styles.
	add_editor_style(
		"dist/css/style-editor{$rtl}{$suffix}.css"
	);

	// Enqueue design style editor styles.
	$design_style = get_design_style();

	if ( $design_style && isset( $design_style['editor_style'] ) ) {
		add_editor_style(
			$design_style['editor_style']
		);
	}

	$fonts_url = fonts_url();

	if ( ! empty( $fonts_url ) ) {

		// Enqueue fonts into the editor.
		add_editor_style( $fonts_url );

	}

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	$suffix    = SCRIPT_DEBUG ? '' : '.min';
	$rtl       = ! is_rtl() ? '' : '-rtl';
	$fonts_url = fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style(
			'go-fonts',
			$fonts_url,
			array(),
			GO_VERSION,
			'all'
		);

		add_filter( 'wp_resource_hints', __NAMESPACE__ . '\google_fonts_resource_hints', 10, 2 );
		add_filter( 'style_loader_tag', __NAMESPACE__ . '\google_fonts_style_loader_tag', 10, 4 );
	}

	wp_enqueue_style(
		'go-style',
		get_theme_file_uri( "dist/css/style-shared{$rtl}{$suffix}.css" ),
		array(),
		GO_VERSION
	);

	$design_style = get_design_style();

	if ( $design_style ) {
		wp_enqueue_style(
			'go-design-style-' . $design_style['slug'],
			$design_style['url'],
			array( 'go-style' ),
			GO_VERSION
		);
	}

}

/**
 * Technique to prevent render blocking scripts.
 *
 * @param string $tag The link tag for the enqueued style.
 * @param string $handle The style's registered handle.
 * @param string $href The stylesheet's source URL.
 * @param string $media The stylesheet's media attribute.
 * @return string $tag
 */
function google_fonts_style_loader_tag( $tag, $handle, $href, $media ) {
	if ( 'go-fonts' !== $handle ) {
		return $tag;
	}

	// Remove once core supports preload natively.
	$tag = "<link rel='preload' as='style' href='$href' />\n" . $tag;

	$tag = str_replace( array( "media=\"$media\"", "media='$media'" ), 'media="print" onload="this.media=\'all\'"', $tag );

	// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
	$tag .= "\n<noscript><link rel=\"stylesheet\" href=\"$href\" /></noscript>";

	return $tag;
}

/**
 * Add preconnect to Google Fonts domain.
 * Once preload is included in WordPress core let's add it here.
 * Ref: https://core.trac.wordpress.org/ticket/42438.
 *
 * @param array  $urls Array of resources and their attributes, or URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for, e.g. 'preconnect' or 'prerender'.
 * @return array $urls
 */
function google_fonts_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => true,
		);
	}

	return $urls;
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
	if ( is_amp() ) {
		// This is part of AMP. See <https://github.com/ampproject/amphtml/issues/18671>.
		return;
	}
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

	// Add class for the current footer variation.
	if ( get_theme_mod( 'sticky_header', false ) ) {
		$classes[] = 'has-sticky-header';
	}

	// Add class when no primary navigation is set.
	if ( ! has_nav_menu( 'primary' ) ) {
		$classes[] = 'has-no-primary-menu';
	}

	// Add class when there is not a footer menu.
	if ( ! has_nav_menu( 'footer-1' ) ) {
		$classes[] = 'has-no-footer-menu';
	}

	// Add class when a page or post has comments.
	if ( is_singular() && comments_open() ) {
		$classes[] = 'has-comments-open';
	}

	if ( get_theme_mod( 'header_background_color', false ) ) {
		$classes[] = 'has-header-background';
	}

	if ( get_theme_mod( 'footer_background_color', false ) ) {
		$classes[] = 'has-footer-background';
	}

	if ( get_theme_mod( 'page_titles', true ) ) {
		$classes[] = 'has-page-titles';
	}

	if ( has_post_thumbnail() && ( is_singular( 'post' ) || is_singular( 'page' ) ) ) {
		$classes[] = 'has-featured-image';
	}

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	$woocommerce_blocks = array(
		'woocommerce/featured-product',
		'woocommerce/handpicked-products',
		'woocommerce/product-best-sellers',
		'woocommerce/product-category',
		'woocommerce/product-new',
		'woocommerce/product-on-sale',
		'woocommerce/product-top-rated',
		'woocommerce/products-by-attribute',
	);

	// Add class if page contains any WooCommerce blocks.
	if ( array_filter( array_map( 'has_block', $woocommerce_blocks ) ) ) {
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
	return (string) apply_filters( 'go_default_design_style', 'traditional' );

}

/**
 * Returns the avaliable design styles.
 *
 * @return array
 */
function get_available_design_styles() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';
	$rtl    = ! is_rtl() ? '' : '-rtl';

	$default_design_styles = array(
		'traditional' => array(
			'slug'           => 'traditional',
			'label'          => _x( 'Traditional', 'design style name', 'go' ),
			'url'            => get_theme_file_uri( "dist/css/design-styles/style-traditional{$rtl}{$suffix}.css" ),
			'editor_style'   => "dist/css/design-styles/style-traditional-editor{$rtl}{$suffix}.css",
			'color_schemes'  => array(
				'one'   => array(
					'label'      => _x( 'Apricot', 'color palette name', 'go' ),
					'primary'    => '#c76919',
					'secondary'  => '#122538',
					'tertiary'   => '#f8f8f8',
					'background' => '#ffffff',
				),
				'two'   => array(
					'label'      => _x( 'Emerald', 'color palette name', 'go' ),
					'primary'    => '#165153',
					'secondary'  => '#212121',
					'tertiary'   => '#f3f1f0',
					'background' => '#ffffff',
				),
				'three' => array(
					'label'      => _x( 'Brick', 'color palette name', 'go' ),
					'primary'    => '#87200e',
					'secondary'  => '#242611',
					'tertiary'   => '#f9f2ef',
					'background' => '#ffffff',
				),
				'four'  => array(
					'label'      => _x( 'Bronze', 'color palette name', 'go' ),
					'primary'    => '#a88548',
					'secondary'  => '#05212d',
					'tertiary'   => '#f9f4ef',
					'background' => '#ffffff',
				),
			),
			'fonts'          => array(
				'Crimson Text' => array(
					'400',
					'400i',
					'700',
					'700i',
				),
				'Nunito Sans'  => array(
					'400',
					'400i',
					'600',
					'700',
				),
			),
			'font_size'      => '1.05rem',
			'type_ratio'     => '1.275',
			'viewport_basis' => '900',
		),
		'modern'      => array(
			'slug'           => 'modern',
			'label'          => _x( 'Modern', 'design style name', 'go' ),
			'url'            => get_theme_file_uri( "dist/css/design-styles/style-modern{$rtl}{$suffix}.css" ),
			'editor_style'   => "dist/css/design-styles/style-modern-editor{$rtl}{$suffix}.css",
			'color_schemes'  => array(
				'one'   => array(
					'label'      => _x( 'Shade', 'color palette name', 'go' ),
					'primary'    => '#000000',
					'secondary'  => '#455a64',
					'tertiary'   => '#eceff1',
					'background' => '#ffffff',
				),
				'two'   => array(
					'label'      => _x( 'Blush', 'color palette name', 'go' ),
					'primary'    => '#c2185b',
					'secondary'  => '#ec407a',
					'tertiary'   => '#fce4ec',
					'background' => '#ffffff',
				),
				'three' => array(
					'label'      => _x( 'Indigo', 'color palette name', 'go' ),
					'primary'    => '#303f9f',
					'secondary'  => '#5c6bc0',
					'tertiary'   => '#e8eaf6',
					'background' => '#ffffff',
				),
				'four'  => array(
					'label'      => _x( 'Pacific', 'color palette name', 'go' ),
					'primary'    => '#00796b',
					'secondary'  => '#26a69a',
					'tertiary'   => '#e0f2f1',
					'background' => '#ffffff',
				),
			),
			'fonts'          => array(
				'Heebo'      => array(
					'800',
					'400',
				),
				'Fira Code'  => array(
					'400',
					'400i',
					'700',
				),
				'Montserrat' => array(
					'400',
					'700',
				),
			),
			'font_size'      => '0.85rem',
			'type_ratio'     => '1.3',
			'viewport_basis' => '950',
		),
		'trendy'      => array(
			'slug'           => 'trendy',
			'label'          => _x( 'Trendy', 'design style name', 'go' ),
			'url'            => get_theme_file_uri( "dist/css/design-styles/style-trendy{$rtl}{$suffix}.css" ),
			'editor_style'   => "dist/css/design-styles/style-trendy-editor{$rtl}{$suffix}.css",
			'color_schemes'  => array(
				'one'   => array(
					'label'             => _x( 'Plum', 'color palette name', 'go' ),
					'primary'           => '#000000',
					'secondary'         => '#4d0859',
					'tertiary'          => '#ded9e2',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				),

				'two'   => array(
					'label'             => _x( 'Steel', 'color palette name', 'go' ),
					'primary'           => '#000000',
					'secondary'         => '#003c68',
					'tertiary'          => '#c0c9d0',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				),
				'three' => array(
					'label'             => _x( 'Avocado', 'color palette name', 'go' ),
					'primary'           => '#000000',
					'secondary'         => '#02493b',
					'tertiary'          => '#b4c6af',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				),
				'four'  => array(
					'label'             => _x( 'Champagne', 'color palette name', 'go' ),
					'primary'           => '#000000',
					'secondary'         => '#cc224f',
					'tertiary'          => '#e5dede',
					'background'        => '#ffffff',
					'footer_background' => '#000000',
				),
			),
			'fonts'          => array(
				'Trocchi'         => array(
					'400',
					'600',
				),
				'Noto Sans'       => array(
					'400',
					'400i',
					'700',
				),
				'Source Code Pro' => array(
					'400',
					'700',
				),
			),
			'font_size'      => '1.1rem',
			'type_ratio'     => '1.2',
			'viewport_basis' => '850',
		),
		'welcoming'   => array(
			'slug'           => 'welcoming',
			'label'          => _x( 'Welcoming', 'design style name', 'go' ),
			'url'            => get_theme_file_uri( "dist/css/design-styles/style-welcoming{$rtl}{$suffix}.css" ),
			'editor_style'   => "dist/css/design-styles/style-welcoming-editor{$rtl}{$suffix}.css",
			'color_schemes'  => array(
				'one'   => array(
					'label'             => _x( 'Forest', 'color palette name', 'go' ),
					'primary'           => '#165144',
					'secondary'         => '#01332e',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				),
				'two'   => array(
					'label'             => _x( 'Spruce', 'color palette name', 'go' ),
					'primary'           => '#233a6b',
					'secondary'         => '#01133d',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				),
				'three' => array(
					'label'             => _x( 'Mocha', 'color palette name', 'go' ),
					'primary'           => '#5b3f20',
					'secondary'         => '#3f2404',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				),
				'four'  => array(
					'label'             => _x( 'Lavender', 'color palette name', 'go' ),
					'primary'           => '#443a82',
					'secondary'         => '#2b226b',
					'tertiary'          => '#c9c9c9',
					'background'        => '#eeeeee',
					'header_background' => '#ffffff',
				),
			),
			'fonts'          => array(
				'Work Sans' => array(
					'300',
					'700',
				),
				'Karla'     => array(
					'400',
					'400i',
					'700',
				),
			),
			'font_size'      => '1rem',
			'type_ratio'     => '1.235',
			'viewport_basis' => '750',
		),
		'playful'     => array(
			'slug'           => 'playful',
			'label'          => _x( 'Playful', 'design style name', 'go' ),
			'url'            => get_theme_file_uri( "dist/css/design-styles/style-playful{$rtl}{$suffix}.css" ),
			'editor_style'   => "dist/css/design-styles/style-playful-editor{$rtl}{$suffix}.css",
			'color_schemes'  => array(
				'one'   => array(
					'label'             => _x( 'Frolic', 'color palette name', 'go' ),
					'primary'           => '#3f46ae',
					'secondary'         => '#ecb43d',
					'tertiary'          => '#f7fbff',
					'background'        => '#ffffff',
					'header_background' => '#3f46ae',
					'header_text'       => '#fafafa',
					'footer_background' => '#3f46ae',
				),
				'two'   => array(
					'label'             => _x( 'Coral', 'color palette name', 'go' ),
					'primary'           => '#e06b6d',
					'secondary'         => '#40896e',
					'tertiary'          => '#fff7f7',
					'background'        => '#ffffff',
					'header_background' => '#eb616a',
					'header_text'       => '#fafafa',
					'footer_background' => '#eb616a',
				),
				'three' => array(
					'label'             => _x( 'Organic', 'color palette name', 'go' ),
					'primary'           => '#3c896d',
					'secondary'         => '#6b0369',
					'tertiary'          => '#f2f9f7',
					'background'        => '#ffffff',
					'header_background' => '#3c896d',
					'header_text'       => '#fafafa',
					'footer_background' => '#3c896d',
				),
				'four'  => array(
					'label'             => _x( 'Berry', 'color palette name', 'go' ),
					'primary'           => '#117495',
					'secondary'         => '#d691c1',
					'tertiary'          => '#f7feff',
					'background'        => '#ffffff',
					'header_background' => '#117495',
					'header_text'       => '#fafafa',
					'footer_background' => '#117495',
				),
			),
			'fonts'          => array(
				'Poppins'   => array(
					'600',
				),
				'Quicksand' => array(
					'400',
					'600',
				),
			),
			'font_size'      => '1.1rem',
			'type_ratio'     => '1.215',
			'viewport_basis' => '950',
		),
	);

	/**
	 * Filters the supported design styles.
	 *
	 * @since 0.1.0
	 *
	 * @param array $design_styles Array containings the supported design styles,
	 * where the index is the slug of design style and value an array of options that sets up the design styles.
	 */
	$supported_design_styles = (array) apply_filters( 'go_design_styles', $default_design_styles );

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
	return (string) apply_filters( 'go_default_header', 'header-1' );

}

/**
 * Returns the avaliable header variations.
 *
 * @return array
 */
function get_available_header_variations() {
	$default_header_variations = array(
		'header-1' => array(
			'label'         => esc_html_x( 'Header 1', 'name of the first header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-1.svg' ),
		),
		'header-2' => array(
			'label'         => esc_html_x( 'Header 2', 'name of the second header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-2.svg' ),
		),
		'header-3' => array(
			'label'         => esc_html_x( 'Header 3', 'name of the third header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-3.svg' ),
		),
		'header-4' => array(
			'label'         => esc_html_x( 'Header 4', 'name of the fourth header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-4.svg' ),
		),
		'header-5' => array(
			'label'         => esc_html_x( 'Header 5', 'name of the fourth header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-5.svg' ),
		),
		'header-6' => array(
			'label'         => esc_html_x( 'Header 6', 'name of the fourth header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-6.svg' ),
		),
		'header-7' => array(
			'label'         => esc_html_x( 'Header 7', 'name of the fourth header variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/header-7.svg' ),
		),
	);

	/**
	 * Filters the supported header variations.
	 *
	 * @since 0.1.0
	 *
	 * @param array $header_variations Array containings the supported header variations,
	 * where the index is the slug of header variation and the value an array of options that sets up the header variation.
	 */
	$supported_header_variations = (array) apply_filters( 'go_header_variations', $default_header_variations );

	return $supported_header_variations;

}

/**
 * Returns the avaliable footer variations.
 *
 * @return array
 */
function get_available_footer_variations() {
	$default_footer_variations = array(
		'footer-1' => array(
			'label'         => esc_html_x( 'Footer 1', 'name of the first footer variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-1.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '1' );
			},
		),
		'footer-2' => array(
			'label'         => esc_html_x( 'Footer 2', 'name of the second footer variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-2.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '2' );
			},
		),
		'footer-3' => array(
			'label'         => esc_html_x( 'Footer 3', 'name of the third footer variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-3.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '3' );
			},
		),
		'footer-4' => array(
			'label'         => esc_html_x( 'Footer 4', 'name of the fourth footer variation option', 'go' ),
			'preview_image' => get_theme_file_uri( 'dist/images/admin/footer-4.svg' ),
			'partial'       => function() {
				return get_template_part( 'partials/footers/footer', '4' );
			},
		),
	);

	/**
	 * Filters the supported header variations.
	 *
	 * @since 0.1.0
	 *
	 * @param array $footer_variations Array containings the supported header variations,
	 * where the index is the slug of header variation and the value an array of options that sets up the header variation.
	 */
	$supported_footer_variations = (array) apply_filters( 'go_footer_variations', $default_footer_variations );

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
	return (string) apply_filters( 'go_default_footer_variation', 'footer-1' );

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
	return (string) apply_filters( 'go_default_copyright', get_bloginfo( 'name' ) );

}

/**
 * Returns the supported social icons.
 *
 * @return array
 */
function get_available_social_icons() {
	$social_icons = array(
		'facebook'  => array(
			'label'       => esc_html__( 'Facebook', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/facebook.svg' ),
			'placeholder' => 'https://facebook.com/user',
		),
		'twitter'   => array(
			'label'       => esc_html__( 'Twitter', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/twitter.svg' ),
			'placeholder' => 'https://twitter.com/user',
		),
		'instagram' => array(
			'label'       => esc_html__( 'Instagram', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/instagram.svg' ),
			'placeholder' => 'https://instagram.com/user',
		),
		'linkedin'  => array(
			'label'       => esc_html__( 'LinkedIn', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/linkedin.svg' ),
			'placeholder' => 'https://linkedin.com/in/user',
		),
		'xing'      => array(
			'label'       => esc_html__( 'Xing', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/xing.svg' ),
			'placeholder' => 'https://www.xing.com/profile/user',
		),
		'pinterest' => array(
			'label'       => esc_html__( 'Pinterest', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/pinterest.svg' ),
			'placeholder' => 'https://pinterest.com/user',
		),
		'youtube'   => array(
			'label'       => esc_html__( 'YouTube', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/youtube.svg' ),
			'placeholder' => 'https://youtube.com/user',
		),
		'spotify'   => array(
			'label'       => esc_html__( 'Spotify', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/spotify.svg' ),
			'placeholder' => 'https://open.spotify.com/user/user',
		),
		'github'    => array(
			'label'       => esc_html__( 'GitHub', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/github.svg' ),
			'placeholder' => 'https://github.com/user',
		),
		'tiktok'    => array(
			'label'       => esc_html__( 'TikTok', 'go' ),
			'icon'        => get_theme_file_path( 'dist/images/social/tiktok.svg' ),
			'placeholder' => 'https://www.tiktok.com/@user',
		),
	);

	/**
	 * Filters the supported social icons.
	 *
	 * @since 0.1.0
	 *
	 * @param array $social_icons Array containings the supported social icons.
	 */
	return (array) apply_filters( 'go_avaliable_social_icons', $social_icons );

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
	return (array) apply_filters( 'go_color_schemes', $design_style['color_schemes'], $design_style );

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
	return (string) apply_filters( 'go_default_color_scheme', 'one' );

}

/**
 * Returns the default viewport basis.
 *
 * @return string
 */
function get_default_viewport_basis() {

	$design_style = get_theme_mod( 'design_style', get_default_design_style() );

	$supported_design_styles = get_available_design_styles();

	if ( in_array( $design_style, array_keys( $supported_design_styles ), true ) ) {

		return $supported_design_styles[ $design_style ]['viewport_basis'];

	}

	return false;
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

	ob_start();

	load_inline_svg( 'arrow-down.svg' );

	$icon = ob_get_clean();

	// Only add class to 'top level' items on the 'primary' menu.
	if ( 'primary' === $args->theme_location && 0 === $depth ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . $icon;
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

		$args['title'] = esc_html__( "That page can't be found", 'go' );

	}

	if ( is_archive() ) {

		$args['custom'] = true;
		$args['title']  = sprintf(
			'<h1 class="post__title m-0 text-center">%s</h1>',
			get_the_archive_title()
		);

	}

	if ( is_search() ) {

		$args['title'] = sprintf(
			/* translators: Search query term(s). */
			esc_html__( 'Search for: %s', 'go' ),
			esc_html( get_search_query() )
		);

		global $wp_query;

		if ( 0 === $wp_query->found_posts ) {

			$args['title'] = esc_html__( 'Nothing Found', 'go' );

		}
	}

	return $args;

}

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

/**
 * Add the image alt text to the custom logo.
 *
 * @param  array $custom_logo_attr Array of custom logo attributes.
 * @param  int   $custom_logo_id   The custom logo image ID.
 *
 * @return array Array of altered custom logo attributes.
 */
function custom_logo_alt_text( $custom_logo_attr, $custom_logo_id ) {

	$alt_text = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );

	$custom_logo_attr['alt'] = $alt_text ? $alt_text : get_bloginfo( 'name' );

	return $custom_logo_attr;

}
