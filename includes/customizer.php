<?php
/**
 * Customizer setup
 *
 * @package Maverick\TGM
 */

namespace Maverick\Customizer;

use function Maverick\get_palette_color;
use function Maverick\hex_to_hsl;

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
	add_action( 'customize_register', $n( 'register_logo_controls' ) );
	add_action( 'customize_register', $n( 'register_color_controls' ) );
	add_action( 'customize_register', $n( 'register_global_controls' ) );
	add_action( 'customize_register', $n( 'register_header_controls' ) );
	add_action( 'customize_register', $n( 'register_footer_controls' ) );
	add_action( 'customize_register', $n( 'register_social_controls' ) );
	add_action( 'customize_preview_init', $n( 'customize_preview_init' ) );
	add_action( 'customize_controls_enqueue_scripts', $n( 'customize_preview_init' ) );
	add_action( 'customize_preview_init', $n( 'enqueue_controls_assets' ) );
	add_action( 'wp_head', $n( 'inline_css' ) );
}


/**
 * Register our custom control types.
 *
 * @param \WP_Customize_Manager $wp_customize The customizer object.
 *
 * @return void
 */
function register_control_types( \WP_Customize_Manager $wp_customize ) {
	// Load custom controls
	require_once MAVERICK_PATH . '/includes/classes/customizer/class-switcher-control.php';
	require_once MAVERICK_PATH . '/includes/classes/customizer/class-range-control.php';

	$wp_customize->register_control_type( Switcher_Control::class );
	$wp_customize->register_control_type( Range_Control::class );
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
			[
				'selector'        => '.site-branding',
				'render_callback' => '\\Maverick\\site_branding',
			]
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			[
				'selector'        => '.site-branding',
				'render_callback' => '\\Maverick\\site_branding',
			]
		);

		$wp_customize->selective_refresh->add_partial(
			'custom_logo',
			[
				'selector'        => '.site-branding',
				'render_callback' => '\\Maverick\\site_branding',
			]
		);
	}
}

/**
 * Enqueues the preview js for the customizer.
 *
 * @return void
 */
function customize_preview_init() {
	wp_enqueue_script(
		'maverick-customizer-preview',
		MAVERICK_TEMPLATE_URL . '/dist/js/admin/customize-preview.js',
		[ 'jquery', 'customize-preview', 'wp-autop' ],
		MAVERICK_VERSION
	);

	wp_localize_script(
		'maverick-customizer-preview',
		'MaverickPreviewData',
		[
			'design_styles' => \Maverick\Core\get_available_design_styles(),
		]
	);
}

/**
 * Enqueues the necessary controls assets
 *
 * @return void
 */
function enqueue_controls_assets() {
	wp_enqueue_script(
		'maverick-customizer-controls',
		MAVERICK_TEMPLATE_URL . '/dist/js/admin/customize-controls.js',
		[ 'jquery' ],
		MAVERICK_VERSION,
		true
	);

	wp_enqueue_style(
		'maverick-customizer-styles',
		MAVERICK_TEMPLATE_URL . '/dist/css/admin/customizer-styles.css',
		[],
		MAVERICK_VERSION
	);
}

/**
 * Returns all available color schemes for all design styles
 * in an array for use in the Customizer control.
 *
 * @return array
 */
function get_color_schemes_as_choices() {
	$design_styles = \Maverick\Core\get_available_design_styles();
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
				'type'        => 'maverick_range_control',
				'label'       => esc_html__( 'Width', 'maverick' ),
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
				'type'        => 'maverick_range_control',
				'label'       => esc_html__( 'Mobile Width', 'maverick' ),
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
function register_color_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_setting(
		'design_style',
		[
			'default'   => \Maverick\Core\get_default_design_style(),
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'design_style_control',
		[
			'label'       => esc_html__( 'Design Style', 'maverick' ),
			'description' => esc_html__( 'Choose a style, select a color scheme and customize colors to personalize your site.', 'maverick' ),
			'section'     => 'colors',
			'settings'    => 'design_style',
			'type'        => 'radio',
			'choices'     => wp_list_pluck( \Maverick\Core\get_available_design_styles(), 'label' ),
		]
	);

	$wp_customize->add_setting(
		'color_scheme',
		[
			'transport' => 'postMessage',
			'default'   => 'default',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'color_scheme_control',
			[
				'label'         => esc_html__( 'Color Scheme', 'maverick' ),
				'section'       => 'colors',
				'settings'      => 'color_scheme',
				'choices'       => get_color_schemes_as_choices(),
				'switcher_type' => 'color-scheme',
			]
		)
	);

	$wp_customize->add_setting(
		'primary_color',
		[
			'transport' => 'postMessage',
			'default'   => \Maverick\get_default_palette_color( 'primary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_control',
			[
				'label'    => esc_html__( 'Primary', 'maverick' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'secondary_color',
		[
			'transport' => 'postMessage',
			'default'   => \Maverick\get_default_palette_color( 'secondary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color_control',
			[
				'label'    => esc_html__( 'Secondary', 'maverick' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'tertiary_color',
		[
			'transport' => 'postMessage',
			'default'   => \Maverick\get_default_palette_color( 'tertiary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'tertiary_color_control',
			[
				'label'    => esc_html__( 'Tertiary', 'maverick' ),
				'section'  => 'colors',
				'settings' => 'tertiary_color',
			]
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
		'maverick_global_settings',
		[
			'title'    => esc_html__( 'Theme Settings', 'maverick' ),
			'priority' => 110,
		]
	);

	$wp_customize->add_setting(
		'footer_blurb_text_setting',
		[
			'default'   => \Maverick\Core\get_default_footer_blurb_text(),
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'footer_blurb_text_control',
		[
			'label'       => esc_html__( 'Blurb Text', 'maverick' ),
			'description' => esc_html__( 'The footer blurb text. It is only used on a few variations', 'maverick' ),
			'section'     => 'maverick_global_settings',
			'settings'    => 'footer_blurb_text_setting',
			'type'        => 'textarea',
		]
	);

	$wp_customize->add_setting(
		'footer_copy_text_setting',
		[
			'default'   => \Maverick\Core\get_default_footer_copy_text(),
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'footer_copyright_text_control',
		[
			'label'       => esc_html__( 'Copyright Text', 'maverick' ),
			'description' => esc_html__( 'The footer Copyright Text.', 'maverick' ),
			'section'     => 'maverick_global_settings',
			'settings'    => 'footer_copy_text_setting',
			'type'        => 'text',
		]
	);

	$wp_customize->add_setting(
		'page_titles',
		[
			'type'    => 'theme_mod',
			'default' => true,
		]
	);

	$wp_customize->add_control(
		'show_page_title_checkbox',
		[
			'label'       => esc_html__( 'Page Titles', 'maverick' ),
			'description' => esc_html__( 'Display page titles on individual pages.', 'maverick' ),
			'section'     => 'maverick_global_settings',
			'settings'    => 'page_titles',
			'type'        => 'checkbox',
		]
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
		'maverick_header_settings',
		[
			'title'    => esc_html__( 'Header', 'maverick' ),
			'priority' => 70,
		]
	);

	$wp_customize->add_setting(
		'header_variation',
		[
			'default'   => \Maverick\Core\get_default_header_variation(),
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'header_variation',
			[
				'label'       => esc_html__( 'Header', 'maverick' ),
				'description' => esc_html__( 'Choose a header for every page on your site, then style it with the selectors below.', 'maverick' ),
				'section'     => 'maverick_header_settings',
				'settings'    => 'header_variation',
				'choices'     => \Maverick\Core\get_available_header_variations(),
			]
		)
	);

	$wp_customize->add_setting(
		'header_background_color',
		[
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color_control',
			[
				'label'    => esc_html__( 'Background Color', 'maverick' ),
				'section'  => 'maverick_header_settings',
				'settings' => 'header_background_color',
			]
		)
	);

	$wp_customize->add_setting(
		'header_text_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color_control',
			[
				'label'    => esc_html__( 'Text Color', 'maverick' ),
				'section'  => 'maverick_header_settings',
				'settings' => 'header_text_color',
			]
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
		'maverick_footer_settings',
		[
			'title'    => esc_html__( 'Footer', 'maverick' ),
			'priority' => 90,
		]
	);

	$wp_customize->add_setting(
		'footer_variation',
		[
			'default'   => \Maverick\Core\get_default_footer_variation(),
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'footer_variation',
			[
				'label'       => esc_html__( 'Footer', 'maverick' ),
				'description' => esc_html__( 'Choose a footer for every page on your site, then style it with the selectors below.', 'maverick' ),
				'section'     => 'maverick_footer_settings',
				'settings'    => 'footer_variation',
				'choices'     => \Maverick\Core\get_available_footer_variations(),
			]
		)
	);

	$wp_customize->add_setting(
		'footer_heading_color',
		[
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_heading_color',
			[
				'label'    => esc_html__( 'Heading Color', 'maverick' ),
				'section'  => 'maverick_footer_settings',
				'settings' => 'footer_heading_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_background_color',
		[
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			[
				'label'    => esc_html__( 'Background Color', 'maverick' ),
				'section'  => 'maverick_footer_settings',
				'settings' => 'footer_background_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_text_color',
		[
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			[
				'label'    => esc_html__( 'Text Color', 'maverick' ),
				'section'  => 'maverick_footer_settings',
				'settings' => 'footer_text_color',
			]
		)
	);

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$settings_footer_partial = [ 'footer_copy_text_setting', 'footer_blurb_text_setting' ];
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
		'maverick_social_media',
		[
			'title'       => esc_html__( 'Social Media', 'maverick' ),
			'description' => 'Add social media account links to apply social icons to the footer of your site.',
			'priority'    => 100,
		]
	);

	$social_icons = \Maverick\Core\get_available_social_icons();

	foreach ( $social_icons as $key => $social_icon ) {
		$wp_customize->add_setting(
			sprintf( 'social_icon_%s', $key ),
			[
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			]
		);

		$wp_customize->add_control(
			sprintf( 'social_icon_%s_control', $key ),
			[
				'label'       => $social_icon['label'],
				'section'     => 'maverick_social_media',
				'settings'    => sprintf( 'social_icon_%s', $key ),
				'type'        => 'url',
				'input_attrs' => [
					'placeholder' => esc_url( $social_icon['placeholder'] ),
				],
			]
		);
	}

	$wp_customize->add_setting(
		'social_icon_color',
		[
			'transport' => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'social_icon_color',
			[
				'label'    => esc_html__( 'Icon Color', 'maverick' ),
				'section'  => 'maverick_social_media',
				'settings' => 'social_icon_color',
			]
		)
	);
}

/**
 * Generates the inline CSS from the Customizer settings
 *
 * @return void
 */
function inline_css() {

	// Color palette.
	$primary_color   = get_palette_color( 'primary', 'HSL' );
	$secondary_color = get_palette_color( 'secondary', 'HSL' );
	$tertiary_color  = get_palette_color( 'tertiary', 'HSL' );

	// Customizer colors.
	$header_background    = hex_to_hsl( get_theme_mod( 'header_background_color', false ), true );
	$header_text_color    = hex_to_hsl( get_theme_mod( 'header_text_color', false ), true );
	$footer_text_color    = hex_to_hsl( get_theme_mod( 'footer_text_color', false ), true );
	$footer_heading_color = hex_to_hsl( get_theme_mod( 'footer_heading_color', false ), true );
	$footer_background    = hex_to_hsl( get_theme_mod( 'footer_background_color', false ), true );
	$social_icon_color    = hex_to_hsl( get_theme_mod( 'social_icon_color', false ), true );

	// Site logo width
	$logo_width        = get_theme_mod( 'logo_width', '100' );
	$logo_width_mobile = get_theme_mod( 'logo_width_mobile', '100' );
	?>
		<!-- Variable Overrides -->
		<style>
			:root {
				/* Color Palette */
				<?php if ( $primary_color ) : ?>
					--theme-color-primary: <?php echo esc_attr( $primary_color[0] ) . ', ' . esc_attr( $primary_color[1] ) . '%, ' . esc_attr( $primary_color[2] ) . '%'; ?>;
				<?php endif; ?>

				<?php if ( $secondary_color ) : ?>
					--theme-color-secondary: <?php echo esc_attr( $secondary_color[0] ) . ', ' . esc_attr( $secondary_color[1] ) . '%, ' . esc_attr( $secondary_color[2] ) . '%'; ?>;
				<?php endif; ?>

				<?php if ( $tertiary_color ) : ?>
					--theme-color-tertiary: <?php echo esc_attr( $tertiary_color[0] ) . ', ' . esc_attr( $tertiary_color[1] ) . '%, ' . esc_attr( $tertiary_color[2] ) . '%'; ?>;
				<?php endif; ?>

				/* Header */
				<?php if ( $header_background ) : ?>
					--theme-header--bg: <?php echo esc_attr( $header_background ); ?>;
				<?php endif; ?>

				<?php if ( $header_text_color ) : ?>
					--theme-site-nav--color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-site-description--color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-site-title--color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-search-toggle--color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-site-nav--color-interactive: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-site-nav-toggle--color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-search-submit--bg: <?php echo esc_attr( $header_text_color ); ?>;
				<?php endif; ?>

				/* Footer */
				<?php if ( $footer_background ) : ?>
					--theme-footer--bg: <?php echo esc_attr( $footer_background ); ?>;
				<?php endif; ?>

				<?php if ( $footer_heading_color ) : ?>
					--theme-footer-heading--color: <?php echo esc_attr( $footer_heading_color ); ?>;
				<?php endif; ?>

				<?php if ( $footer_text_color ) : ?>
					--theme-footer--color: <?php echo esc_attr( $footer_text_color ); ?>;;
				<?php endif; ?>

				<?php if ( $social_icon_color ) : ?>
					--theme-social--color: <?php echo esc_attr( $social_icon_color ); ?>;
				<?php endif; ?>

				/* Site Logo */
				<?php if ( $logo_width ) : ?>
					--theme-site-logo--width: <?php echo esc_attr( $logo_width ); ?>px;
				<?php endif; ?>

				<?php if ( $logo_width_mobile ) : ?>
					--theme-site-logo--width-mobile: <?php echo esc_attr( $logo_width_mobile ); ?>px;
				<?php endif; ?>
			}
		</style>
	<?php
}
