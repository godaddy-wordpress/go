<?php
/**
 * Customizer setup
 *
 * @package Go\TGM
 */

namespace Go\Customizer;

use function Go\get_palette_color;
use function Go\hex_to_hsl;

/**
 * Set up Customizer hooks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'customize_register', $n( 'register_control_types' ) );
	add_action( 'customize_register', $n( 'default_controls' ) );
	add_action( 'customize_register', $n( 'register_site_title_controls' ) );
	add_action( 'customize_register', $n( 'register_logo_controls' ) );
	add_action( 'customize_register', $n( 'register_color_controls' ) );
	add_action( 'customize_register', $n( 'register_global_controls' ) );
	add_action( 'customize_register', $n( 'register_header_controls' ) );
	add_action( 'customize_register', $n( 'register_footer_controls' ) );
	add_action( 'customize_register', $n( 'register_social_controls' ) );
	add_action( 'customize_register', $n( 'register_menu_controls' ) );
	add_action( 'customize_register', $n( 'rename_panels' ) );
	add_action( 'customize_preview_init', $n( 'customize_preview_init' ) );
	add_action( 'customize_controls_enqueue_scripts', $n( 'customize_preview_init' ) );
	add_action( 'customize_preview_init', $n( 'enqueue_controls_assets' ) );

	add_action( 'wp_head', $n( 'inline_css' ) );
	add_action( 'wp_nav_menu_args', $n( 'wp_nav_register_fallback' ) );
}

/**
 * Register our custom control types.
 *
 * @param \WP_Customize_Manager $wp_customize The customizer object.
 *
 * @return void
 */
function register_control_types( \WP_Customize_Manager $wp_customize ) {
	// This file is a class for our Customizer switcher control, not template partials.
	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once get_parent_theme_file_path( 'includes/classes/customizer/class-switcher-control.php' );

	// This file is a class for our Customizer range control, not template partials.
	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once get_parent_theme_file_path( 'includes/classes/customizer/class-range-control.php' );

	// This file is a class for our Customizer range control, not template partials.
	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once get_parent_theme_file_path( 'includes/classes/customizer/class-title-control.php' );

	$wp_customize->register_control_type( Switcher_Control::class );
	$wp_customize->register_control_type( Range_Control::class );
	$wp_customize->register_control_type( Title_Control::class );
}

/**
 * Display a placeholder in the customizer if a menu has not been assigned,
 *
 * @param array $args Array of nav menu arguments.
 */
function wp_nav_fallback( $args ) {
	if ( ! is_customize_preview() ) {
		return;
	}

	$registered_nav_menus = get_registered_nav_menus();

	$menu_slug   = $args['theme_location'];
	$instance_id = $args['customize_preview_nav_menus_args']['args_hmac'];
	$attributes  = '';

	$attrs = array(
		'data-customize-partial-id'                => 'nav_menu_instance[' . esc_attr( $instance_id ) . ']',
		'data-customize-partial-type'              => 'nav_menu_instance',
		'data-customize-partial-placement-context' => wp_json_encode( $args['customize_preview_nav_menus_args'] ),
	);

	$attributes = implode(
		' ',
		array_map(
			function( $key, $value ) {
				return sprintf( '%s="%s"', $key, esc_attr( $value ) );
			},
			array_keys( $attrs ),
			$attrs
		)
	);

	printf(
		'<p class="u-informational" %1$s id="menu-primary-navigation">
			%2$s
		</p>',
		$attributes, // @codingStandardsIgnoreLine
		esc_html(
			sprintf(
				/* translators: %s is the registered nav menu name */
				__( 'Please assign a menu to the %s menu location', 'go' ),
				$registered_nav_menus[ $menu_slug ]
			)
		)
	);

}

/**
 * Filter the arguments used to display a navigation menu to add our own fallback callback.
 *
 * @param array $args Array of wp_nav_menu() arguments.
 */
function wp_nav_register_fallback( $args ) {
	$args['fallback_cb'] = __NAMESPACE__ . '\\wp_nav_fallback';
	return $args;
}

/**
 * Tweaks the default customizer controls.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function default_controls( \WP_Customize_Manager $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport     = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.header__titles',
				'render_callback' => '\\Go\\site_branding',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.header__titles',
				'render_callback' => '\\Go\\site_branding',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'custom_logo',
			array(
				'selector'        => '.header__titles',
				'render_callback' => '\\Go\\site_branding',
			)
		);
	}

	$wp_customize->remove_section( 'background_image' );
}

/**
 * Enqueues the preview js for the customizer.
 *
 * @return void
 */
function customize_preview_init() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'go-customize-preview',
		get_theme_file_uri( "dist/js/admin/customize-preview{$suffix}.js" ),
		array( 'jquery', 'wp-autop' ),
		GO_VERSION,
		true
	);

	wp_localize_script(
		'go-customize-preview',
		'GoPreviewData',
		array(
			'design_styles'       => \Go\Core\get_available_design_styles(),
			'selectedDesignStyle' => get_theme_mod( 'design_style', \Go\Core\get_default_design_style() ),
			'socialIcons'         => array_keys( \Go\Core\get_available_social_icons() ),
		)
	);
}

/**
 * Enqueues the necessary controls assets
 *
 * @return void
 */
function enqueue_controls_assets() {

	$suffix = SCRIPT_DEBUG ? '' : '.min';
	$rtl    = ! is_rtl() ? '' : '-rtl';

	wp_enqueue_script(
		'go-customize-controls',
		get_theme_file_uri( "dist/js/admin/customize-controls{$suffix}.js" ),
		array( 'jquery', 'wp-color-picker' ),
		GO_VERSION,
		true
	);

	$color_scheme            = str_replace( get_theme_mod( 'design_style' ) . '-', '', get_theme_mod( 'color_scheme', \Go\Core\get_default_color_scheme() ) );
	$avaliable_color_schemes = \Go\Core\get_available_color_schemes();
	$color_scheme_colors     = array();

	if ( $color_scheme && ! empty( $avaliable_color_schemes[ $color_scheme ] ) ) {

		if ( ! empty( $avaliable_color_schemes[ $color_scheme ]['label'] ) ) {

			unset( $avaliable_color_schemes[ $color_scheme ]['label'] );

		}

		$color_scheme_colors = $avaliable_color_schemes[ $color_scheme ];

	}

	wp_localize_script(
		'go-customize-controls',
		'goCustomizerControls',
		array(
			'availableDesignStyles' => \Go\Core\get_available_design_styles(),
			'activeColorScheme'     => array_values( $color_scheme_colors ),
		)
	);

	wp_enqueue_style(
		'go-customize-style',
		get_theme_file_uri( "dist/css/admin/style-customize{$rtl}{$suffix}.css" ),
		array(),
		GO_VERSION
	);
}

/**
 * Returns all available color schemes for all design styles
 * in an array for use in the Customizer control.
 *
 * @return array
 */
function get_color_schemes_as_choices() {
	$design_styles = \Go\Core\get_available_design_styles();
	$color_schemes = array();

	array_walk(
		$design_styles,
		function( $style_data, $design_style ) use ( &$color_schemes ) {
			array_walk(
				$style_data['color_schemes'],
				function( $data, $name ) use ( $design_style, &$color_schemes ) {
					$color_schemes[ "${design_style}-${name}" ] = $data;
				}
			);
		}
	);

	return $color_schemes;
}

/**
 * Register the Site Title and Tagline controls.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_site_title_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->get_control( 'blogdescription' )->priority = 11;

	$wp_customize->add_setting(
		'hide_site_title',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'hide_site_title_checkbox',
		array(
			'label'       => esc_html__( 'Hide Site Title', 'go' ),
			'description' => esc_html__( 'Prevent the site title from appearing in the header area.', 'go' ),
			'section'     => 'title_tagline',
			'settings'    => 'hide_site_title',
			'priority'    => 10,
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'hide_site_tagline',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'hide_site_tagline_checkbox',
		array(
			'label'       => esc_html__( 'Hide Tagline', 'go' ),
			'description' => esc_html__( 'Prevent the site tagline from appearing in the header area.', 'go' ),
			'section'     => 'title_tagline',
			'settings'    => 'hide_site_tagline',
			'priority'    => 12,
			'type'        => 'checkbox',
		)
	);

}

/**
 * Register the Logo Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_logo_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_setting(
		'logo_width',
		array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Range_Control(
			$wp_customize,
			'logo_width',
			array(
				'default'     => 100,
				'type'        => 'go_range_control',
				'label'       => esc_html__( 'Width', 'go' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'logo_width_mobile',
		array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Range_Control(
			$wp_customize,
			'logo_width_mobile',
			array(
				'default'     => 100,
				'type'        => 'go_range_control',
				'label'       => esc_html__( 'Mobile Width', 'go' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);
}

/**
 * Register the Global Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_global_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section(
		'go_site_settings',
		array(
			'title'    => esc_html__( 'Site Settings', 'go' ),
			'priority' => 100,
		)
	);

	$wp_customize->add_setting(
		'page_titles',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'show_page_title_checkbox',
		array(
			'label'       => esc_html__( 'Page Titles', 'go' ),
			'description' => esc_html__( 'Display page titles on individual pages that are not individually opted-out.', 'go' ),
			'section'     => 'go_site_settings',
			'settings'    => 'page_titles',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'blog_excerpt',
		array(
			'default'           => false,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'blog_excerpt_checkbox',
		array(
			'label'       => esc_html__( 'Blog Excerpt', 'go' ),
			'description' => esc_html__( 'Use post excerpts on the blog page.', 'go' ),
			'section'     => 'go_site_settings',
			'settings'    => 'blog_excerpt',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'copyright',
		array(
			'default'           => \Go\Core\get_default_copyright(),
			'transport'         => 'postMessage',
			'sanitize_callback' => __NAMESPACE__ . '\\copyright_kses_html',
		)
	);

	$wp_customize->add_control(
		'copyright_control',
		array(
			'label'    => esc_html__( 'Copyright Text', 'go' ),
			'section'  => 'go_site_settings',
			'settings' => 'copyright',
			'type'     => 'text',
		)
	);
}

/**
 * Callback to retreive the copyright kses HTML
 *
 * @param string $input Input value.

 * @return string Filtered $input value.
 */
function copyright_kses_html( $input ) {

	return wp_kses( $input, \Go\get_copyright_kses_html() );

}

/**
 * Register the Global Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_color_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_setting(
		'design_style',
		array(
			'default'           => \Go\Core\get_default_design_style(),
			'transport'         => 'postMessage',
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'design_style_control',
		array(
			'label'       => esc_html__( 'Design Style', 'go' ),
			'description' => esc_html__( 'Choose a style, select a color scheme and customize colors to personalize your site.', 'go' ),
			'section'     => 'colors',
			'settings'    => 'design_style',
			'type'        => 'radio',
			'choices'     => wp_list_pluck( \Go\Core\get_available_design_styles(), 'label' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'color_scheme',
		array(
			'transport'         => 'postMessage',
			'default'           => \Go\Core\get_default_color_scheme(),
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_radio',
		)
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'color_scheme_control',
			array(
				'label'         => esc_html__( 'Color scheme', 'go' ),
				'section'       => 'colors',
				'settings'      => 'color_scheme',
				'choices'       => get_color_schemes_as_choices(),
				'switcher_type' => 'color-scheme',
				'priority'      => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'primary_color',
		array(
			'transport'         => 'postMessage',
			'default'           => \Go\get_default_palette_color( 'primary' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_control',
			array(
				'label'    => esc_html__( 'Primary', 'go' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'transport'         => 'postMessage',
			'default'           => \Go\get_default_palette_color( 'secondary' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color_control',
			array(
				'label'    => esc_html__( 'Secondary', 'go' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'tertiary_color',
		array(
			'transport'         => 'postMessage',
			'default'           => \Go\get_default_palette_color( 'tertiary' ),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'tertiary_color_control',
			array(
				'label'    => esc_html__( 'Tertiary', 'go' ),
				'section'  => 'colors',
				'settings' => 'tertiary_color',
				'priority' => 1,
			)
		)
	);

	// Header colors.
	$wp_customize->add_setting(
		'title_header_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Title_Control(
			$wp_customize,
			'title_header_colors',
			array(
				'type'        => 'go_title',
				'label'       => esc_html__( 'Header Colors', 'go' ),
				'description' => __( 'Customize colors within the site header.', 'go' ),
				'section'     => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'header_background_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => \Go\get_default_palette_color( 'header_background' ),
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label'    => esc_html__( 'Background', 'go' ),
				'section'  => 'colors',
				'settings' => 'header_background_color',
			)
		)
	);

	$wp_customize->add_setting(
		'header_text_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color',
			array(
				'label'    => esc_html__( 'Foreground', 'go' ),
				'section'  => 'colors',
				'settings' => 'header_text_color',
			)
		)
	);

	// Footer colors.
	$wp_customize->add_setting(
		'title_footer_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Title_Control(
			$wp_customize,
			'title_footer_colors',
			array(
				'type'        => 'go_title',
				'label'       => esc_html__( 'Footer Colors', 'go' ),
				'description' => __( 'Customize colors within the site footer.', 'go' ),
				'section'     => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => \Go\get_default_palette_color( 'footer_background' ),
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label'    => esc_html__( 'Background', 'go' ),
				'section'  => 'colors',
				'settings' => 'footer_background_color',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'    => esc_html__( 'Foreground', 'go' ),
				'section'  => 'colors',
				'settings' => 'footer_text_color',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_heading_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_heading_color',
			array(
				'label'    => esc_html__( 'Heading', 'go' ),
				'section'  => 'colors',
				'settings' => 'footer_heading_color',
			)
		)
	);

	$wp_customize->add_setting(
		'social_icon_color',
		array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'social_icon_color',
			array(
				'label'    => esc_html__( 'Social Icon', 'go' ),
				'section'  => 'colors',
				'settings' => 'social_icon_color',
			)
		)
	);

	// Footer colors.
	$wp_customize->add_setting(
		'title_site_styles',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Title_Control(
			$wp_customize,
			'title_site_styles',
			array(
				'type'        => 'go_title',
				'label'       => esc_html__( 'Additional Design Controls', 'go' ),
				'description' => __( 'Customize additional design settings.', 'go' ),
				'section'     => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'viewport_basis',
		array(
			'default'           => \Go\Core\get_default_viewport_basis(),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'viewport_basis',
		array(
			'default'     => \Go\Core\get_default_viewport_basis(),
			'type'        => 'range',
			'label'       => esc_html__( 'Site Spacing', 'go' ),
			'section'     => 'colors',
			'input_attrs' => array(
				'min'  => 500,
				'max'  => 2250,
				'step' => 1,
			),
		)
	);

}

/**
 * Register the Header Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_header_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section(
		'go_header_settings',
		array(
			'title'    => esc_html__( 'Header', 'go' ),
			'priority' => 70,
		)
	);

	$wp_customize->add_setting(
		'header_variation',
		array(
			'default'           => \Go\Core\get_default_header_variation(),
			'transport'         => 'refresh',
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_radio',
		)
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'header_variation_control',
			array(
				'label'       => esc_html__( 'Header', 'go' ),
				'description' => esc_html__( 'Choose a header for every page on your site, then style it with the selectors below.', 'go' ),
				'section'     => 'go_header_settings',
				'settings'    => 'header_variation',
				'choices'     => \Go\Core\get_available_header_variations(),
			)
		)
	);

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color_control_alt',
			array(
				'label'    => esc_html__( 'Background', 'go' ),
				'section'  => 'go_header_settings',
				'settings' => 'header_background_color',
			)
		)
	);

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color_control_alt',
			array(
				'label'    => esc_html__( 'Foreground', 'go' ),
				'section'  => 'go_header_settings',
				'settings' => 'header_text_color',
			)
		)
	);

	$wp_customize->add_setting(
		'sticky_header',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'sticky_header_checkbox',
		array(
			'label'       => esc_html__( 'Sticky Header', 'go' ),
			'description' => esc_html__( 'Set the header to sticky, so that it follows as users scroll.', 'go' ),
			'section'     => 'go_header_settings',
			'settings'    => 'sticky_header',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'remove_search',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'remove_search_checkbox',
		array(
			'label'       => esc_html__( 'Remove Search', 'go' ),
			'description' => esc_html__( 'Remove the search icon from the header.', 'go' ),
			'section'     => 'go_header_settings',
			'settings'    => 'remove_search',
			'type'        => 'checkbox',
		)
	);
}

/**
 * Register the Footer Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_footer_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section(
		'go_footer_settings',
		array(
			'title'    => esc_html__( 'Footer', 'go' ),
			'priority' => 90,
		)
	);

	$wp_customize->add_setting(
		'footer_variation',
		array(
			'default'           => \Go\Core\get_default_footer_variation(),
			'transport'         => 'postMessage',
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_radio',
		)
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'footer_variation_control',
			array(
				'label'       => esc_html__( 'Footer', 'go' ),
				'description' => esc_html__( 'Choose a footer for every page on your site, then style it with the selectors below.', 'go' ),
				'section'     => 'go_footer_settings',
				'settings'    => 'footer_variation',
				'choices'     => \Go\Core\get_available_footer_variations(),
			)
		)
	);

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color_control_alt',
			array(
				'label'    => esc_html__( 'Background', 'go' ),
				'section'  => 'go_footer_settings',
				'settings' => 'footer_background_color',
			)
		)
	);

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color_alt',
			array(
				'label'    => esc_html__( 'Foreground', 'go' ),
				'section'  => 'go_footer_settings',
				'settings' => 'footer_text_color',
			)
		)
	);

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_heading_color_alt',
			array(
				'label'    => esc_html__( 'Heading', 'go' ),
				'section'  => 'go_footer_settings',
				'settings' => 'footer_heading_color',
			)
		)
	);
}

/**
 * Register the Logo Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_social_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section(
		'go_social_media',
		array(
			'title'       => esc_html__( 'Social', 'go' ),
			'description' => esc_html__( 'Add social media account links to apply social icons on the site footer.', 'go' ),
			'priority'    => 90,
		)
	);

	$social_icons = \Go\Core\get_available_social_icons();

	foreach ( $social_icons as $key => $social_icon ) {
		$wp_customize->add_setting(
			sprintf( 'social_icon_%s', $key ),
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			sprintf( 'social_icon_%s_control', $key ),
			array(
				'label'       => $social_icon['label'],
				'section'     => 'go_social_media',
				'settings'    => sprintf( 'social_icon_%s', $key ),
				'type'        => 'url',
				'input_attrs' => array(
					'placeholder' => esc_url( $social_icon['placeholder'] ),
				),
			)
		);
	}

	// Alternate color control.
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'social_icon_color_alt',
			array(
				'label'    => esc_html__( 'Social icon', 'go' ),
				'section'  => 'go_social_media',
				'settings' => 'social_icon_color',
			)
		)
	);
}

/**
 * Register the menu within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_menu_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section(
		'go_menu_behavior',
		array(
			'title' => __( 'Menu Behavior', 'go' ),
			'panel' => 'nav_menus',
		)
	);

	$wp_customize->add_setting(
		'open_menu_on_hover',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'open_menu_on_hover',
		array(
			'label'       => __( 'Show sub menus on hover.', 'go' ),
			'description' => esc_html__( 'Show sub menu items on hover.', 'go' ),
			'section'     => 'go_menu_behavior',
			'settings'    => 'open_menu_on_hover',
			'type'        => 'checkbox',
		)
	);

}

/**
 * Rename customizer panels.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function rename_panels( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->get_section( 'colors' )->title = __( 'Site Design', 'go' );

}

/**
 * Sanitize a radio field setting from the customizer.
 *
 * @param string $value   The radio field value being saved.
 * @param string $setting The name of the setting being saved.
 *
 * @return string
 */
function sanitize_radio( $value, $setting ) {

	$input = sanitize_title( $value );

	$choices = $setting->manager->get_control( $setting->id . '_control' )->choices;

	return array_key_exists( $input, $choices ) ? $input : $setting->default;

}

/**
 * Generates the inline CSS from the Customizer settings
 *
 * @return void
 */
function inline_css() {

	// Color palette.
	$primary_color    = get_palette_color( 'primary', 'HSL' );
	$secondary_color  = get_palette_color( 'secondary', 'HSL' );
	$tertiary_color   = get_palette_color( 'tertiary', 'HSL' );
	$background_color = get_palette_color( 'background', 'HSL' );

	// Customizer colors.
	$header_background    = get_palette_color( 'header_background', 'HSL' );
	$header_text_color    = hex_to_hsl( get_theme_mod( 'header_text_color', false ), true );
	$footer_text_color    = hex_to_hsl( get_theme_mod( 'footer_text_color', false ), true );
	$footer_heading_color = hex_to_hsl( get_theme_mod( 'footer_heading_color', false ), true );
	$footer_background    = get_palette_color( 'footer_background', 'HSL' );
	$social_icon_color    = hex_to_hsl( get_theme_mod( 'social_icon_color', false ), true );

	// Site logo width.
	$logo_width        = get_theme_mod( 'logo_width', '100' );
	$logo_width_mobile = get_theme_mod( 'logo_width_mobile', '100' );

	// Spacing.
	$viewport_basis = get_theme_mod( 'viewport_basis', '1100' );

	// Fonts.
	$fonts = get_theme_mod( 'fonts', array() );

	if ( ! empty( $fonts ) ) {

		list( $font_headings, $font_body ) = array_keys( $fonts );

		$font_headings = str_replace( '_heading', '', $font_headings );
		$font_body     = str_replace( '_body', '', $font_body );

		list(
			$font_heading_weights,
			$font_body_weights
		) = array_values( $fonts );

	}

	$font_size  = get_theme_mod( 'font_size' );
	$type_ratio = get_theme_mod( 'type_ratio' );
	?>
		<style>
			:root {
				--go--color--white: hsl(0, 0%, 100%);
				<?php if ( $primary_color ) : ?>
					--go--color--primary: hsl(<?php echo esc_attr( $primary_color[0] ) . ', ' . esc_attr( $primary_color[1] ) . '%, ' . esc_attr( $primary_color[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $secondary_color ) : ?>
					--go--color--secondary: hsl(<?php echo esc_attr( $secondary_color[0] ) . ', ' . esc_attr( $secondary_color[1] ) . '%, ' . esc_attr( $secondary_color[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $tertiary_color ) : ?>
					--go--color--tertiary: hsl(<?php echo esc_attr( $tertiary_color[0] ) . ', ' . esc_attr( $tertiary_color[1] ) . '%, ' . esc_attr( $tertiary_color[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $background_color ) : ?>
					--go--color--background: hsl(<?php echo esc_attr( $background_color[0] ) . ', ' . esc_attr( $background_color[1] ) . '%, ' . esc_attr( $background_color[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $header_background ) : ?>
					--go-header--color--background: hsl(<?php echo esc_attr( $header_background[0] ) . ', ' . esc_attr( $header_background[1] ) . '%, ' . esc_attr( $header_background[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $header_text_color ) : ?>
					--go-site-title--color--text: hsl(<?php echo esc_attr( $header_text_color ); ?>);
					--go-site-description--color--text: hsl(<?php echo esc_attr( $header_text_color ); ?>);
					--go-navigation--color--text: hsl(<?php echo esc_attr( $header_text_color ); ?>);
					--go-search-toggle--color--text: hsl(<?php echo esc_attr( $header_text_color ); ?>);
					--go-search-button--color--background: hsl(<?php echo esc_attr( $header_text_color ); ?>);
				<?php endif; ?>

				<?php if ( $footer_background ) : ?>
					--go-footer--color--background: hsl(<?php echo esc_attr( $footer_background[0] ) . ', ' . esc_attr( $footer_background[1] ) . '%, ' . esc_attr( $footer_background[2] ) . '%'; ?>);
				<?php endif; ?>

				<?php if ( $footer_heading_color ) : ?>
					--go-footer-heading--color--text: hsl(<?php echo esc_attr( $footer_heading_color ); ?>);
				<?php endif; ?>

				<?php if ( $footer_text_color ) : ?>
					--go-footer--color--text: hsl(<?php echo esc_attr( $footer_text_color ); ?>);
					--go-footer-navigation--color--text: hsl(<?php echo esc_attr( $footer_text_color ); ?>);
				<?php endif; ?>

				<?php if ( $social_icon_color ) : ?>
					--go-social--color--text: hsl(<?php echo esc_attr( $social_icon_color ); ?>);
				<?php endif; ?>

				<?php if ( $logo_width ) : ?>
					--go-logo--max-width: <?php echo esc_attr( $logo_width ); ?>px;
				<?php endif; ?>

				<?php if ( $logo_width_mobile ) : ?>
					--go-logo-mobile--max-width: <?php echo esc_attr( $logo_width_mobile ); ?>px;
				<?php endif; ?>

				<?php if ( $viewport_basis ) : ?>
					--go--viewport-basis: <?php echo esc_attr( $viewport_basis ); ?>;
				<?php endif; ?>

				<?php if ( isset( $font_headings, $font_body ) ) : ?>
					--go-heading--font-family: <?php echo esc_attr( $font_headings ); ?>;
					--go--font-family: <?php echo esc_attr( $font_body ); ?>;
				<?php endif; ?>

				<?php if ( $font_size ) : ?>
					--go--font-size: <?php echo esc_attr( $font_size ); ?>;
				<?php endif; ?>

				<?php if ( $type_ratio ) : ?>
					--go--type-ratio: <?php echo esc_attr( $type_ratio ); ?>;
				<?php endif; ?>

				<?php if ( ! empty( $font_heading_weights ) ) : ?>
					--go-heading--font-weight: <?php echo esc_attr( $font_heading_weights[0] ); ?>;
				<?php endif; ?>

				<?php if ( ! empty( $font_body_weights ) ) : ?>
					--go--font-weight: <?php echo esc_attr( $font_body_weights[0] ); ?>;
				<?php endif; ?>
			}

			.has-primary-to-secondary-gradient-background {
				background: -webkit-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--secondary) 100%);
				background: -o-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--secondary) 100%);
				background: linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--secondary) 100%);
			}

			.has-primary-to-tertiary-gradient-background {
				background: -webkit-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--tertiary) 100%);
				background: -o-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--tertiary) 100%);
				background: linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--tertiary) 100%);
			}

			.has-primary-to-background-gradient-background {
				background: -webkit-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--background) 100%);
				background: -o-linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--background) 100%);
				background: linear-gradient(135deg, var(--go--color--primary) 0%, var(--go--color--background) 100%);
			}

			.has-secondary-to-tertiary-gradient-background {
				background: -webkit-linear-gradient(135deg, var(--go--color--secondary) 0%, var(--go--color--tertiary) 100%);
				background: -o-linear-gradient(135deg, var(--go--color--secondary) 0%, var(--go--color--tertiary) 100%);
				background: linear-gradient(135deg, var(--go--color--secondary) 0%, var(--go--color--tertiary) 100%);
			}
		</style>
	<?php
}
