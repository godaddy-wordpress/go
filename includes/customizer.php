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
	add_action( 'customize_register', $n( 'register_global_controls' ) );
	add_action( 'customize_register', $n( 'register_header_controls' ) );
	add_action( 'customize_register', $n( 'register_footer_controls' ) );
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

	$wp_customize->register_control_type( Switcher_Control::class );
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
 * Register the Global Controls within Customize.
 *
 * @param \WP_Customize_Manager $wp_customize The customize manager object.
 *
 * @return void
 */
function register_global_controls( \WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_panel(
		'maverick_global_settings',
		[
			'title'       => esc_html__( 'Global Settings', 'maverick' ),
			'description' => esc_html__( 'Global Settings for the theme.', 'maverick' ),
			'priority'    => 50,
		]
	);

	$wp_customize->add_section(
		'maverick_design_style_section',
		[
			'title'      => esc_html__( 'Design Styles', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_global_settings',
		]
	);

	$wp_customize->add_setting(
		'maverick_design_style',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => \Maverick\Core\get_default_design_style(),
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'maverick_design_style_control',
			[
				'label'       => esc_html__( 'Design Style', 'maverick' ),
				'description' => esc_html__( 'Choose one of the supported design styles.', 'maverick' ),
				'section'     => 'maverick_design_style_section',
				'settings'    => 'maverick_design_style',
				'choices'     => \Maverick\Core\get_available_design_styles(),
			]
		)
	);

	$wp_customize->add_section(
		'color_schemes_section',
		[
			'title' => esc_html__( 'Color Scheme', 'maverick' ),
		]
	);

	$wp_customize->add_setting(
		'color_scheme',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
			'default'    => 'one',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'maverick_color_scheme_control',
			[
				'label'         => esc_html__( 'Color Schemes', 'maverick' ),
				'description'   => esc_html__( 'Choose one of the supported color schemes', 'maverick' ),
				'section'       => 'color_schemes_section',
				'settings'      => 'color_scheme',
				'choices'       => \Maverick\Core\get_available_color_schemes(),
				'switcher_type' => 'color-scheme',
			]
		)
	);

	$wp_customize->add_setting(
		'primary_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
			'default'    => \Maverick\get_default_palette_color( 'primary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_control',
			[
				'label'    => esc_html__( 'Primary', 'maverick' ),
				'section'  => 'color_schemes_section',
				'settings' => 'primary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'secondary_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
			'default'    => \Maverick\get_default_palette_color( 'secondary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color_control',
			[
				'label'    => esc_html__( 'Secondary', 'maverick' ),
				'section'  => 'color_schemes_section',
				'settings' => 'secondary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'tertiary_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
			'default'    => \Maverick\get_default_palette_color( 'tertiary' ),
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'tertiary_color_control',
			[
				'label'    => esc_html__( 'Tertiary', 'maverick' ),
				'section'  => 'color_schemes_section',
				'settings' => 'tertiary_color',
			]
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
		'maverick_header_settings',
		[
			'title'    => esc_html__( 'Header', 'maverick' ),
			'priority' => 70,
		]
	);

	$wp_customize->add_setting(
		'header_variation',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => \Maverick\Core\get_default_header_variation(),
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'header_variation',
			[
				'label'    => esc_html__( 'Header Variation', 'maverick' ),
				'section'  => 'maverick_header_settings',
				'settings' => 'header_variation',
				'choices'  => \Maverick\Core\get_available_header_variations(),
			]
		)
	);

	$wp_customize->add_setting(
		'header_background_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
			// 'default'    => '',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'maverick_header_background_color_contorl',
			[
				'label'    => esc_html__( 'Background Color', 'maverick' ),
				'section'  => 'maverick_header_settings',
				'settings' => 'header_background_color',
			]
		)
	);

	$wp_customize->add_setting(
		'maverick_header_text_color_setting',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'maverick_header_text_color_control',
			[
				'label'    => esc_html__( 'Text Color', 'maverick' ),
				'section'  => 'maverick_header_settings',
				'settings' => 'maverick_header_text_color_setting',
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

	$wp_customize->add_panel(
		'maverick_footer_settings',
		[
			'title'       => esc_html__( 'Footer Settings', 'maverick' ),
			'description' => esc_html__( 'Customize the Footer of your site.', 'maverick' ),
			'priority'    => 80,
		]
	);

	$wp_customize->add_section(
		'maverick_footer_variation_section',
		[
			'title'      => esc_html__( 'Footer Variations', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_footer_settings',
		]
	);

	$wp_customize->add_setting(
		'footer_variation',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => \Maverick\Core\get_default_footer_variation(),
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'footer_variation',
			[
				'label'       => esc_html__( 'Footer Variation', 'maverick' ),
				'description' => esc_html__( 'Choose one of the supported footer variations.', 'maverick' ),
				'section'     => 'maverick_footer_variation_section',
				'settings'    => 'footer_variation',
				'choices'     => \Maverick\Core\get_available_footer_variations(),
			]
		)
	);

	$wp_customize->add_section(
		'maverick_footer_text_section',
		[
			'title'      => esc_html__( 'Footer Text', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_footer_settings',
		]
	);

	$wp_customize->add_setting(
		'maverick_footer_blurb_text_setting',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => \Maverick\Core\get_default_footer_blurb_text(),
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'maverick_footer_blurb_text_control',
		[
			'label'       => esc_html__( 'Blurb Text', 'maverick' ),
			'description' => esc_html__( 'The footer blurb text. It is only used on a few variations', 'maverick' ),
			'section'     => 'maverick_footer_text_section',
			'settings'    => 'maverick_footer_blurb_text_setting',
			'type'        => 'textarea',
		]
	);

	$wp_customize->add_setting(
		'maverick_footer_copy_text_setting',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => \Maverick\Core\get_default_footer_copy_text(),
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'maverick_footer_copyright_text_control',
		[
			'label'       => esc_html__( 'Copyright Text', 'maverick' ),
			'description' => esc_html__( 'The footer Copyright Text.', 'maverick' ),
			'section'     => 'maverick_footer_text_section',
			'settings'    => 'maverick_footer_copy_text_setting',
			'type'        => 'text',
		]
	);

	$wp_customize->add_section(
		'footer_social_section',
		[
			'title'      => esc_html__( 'Social Icons', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_footer_settings',
		]
	);

	$social_icons = \Maverick\Core\get_available_social_icons();

	foreach ( $social_icons as $key => $social_icon ) {
		$wp_customize->add_setting(
			sprintf( 'footer_social_%s_setting', $key ),
			[
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default'    => '',
				'transport'  => 'postMessage',
			]
		);

		$wp_customize->add_control(
			sprintf( 'footer_social_%s_control', $key ),
			[
				'label'       => $social_icon['label'],
				'description' => $social_icon['description'],
				'section'     => 'footer_social_section',
				'settings'    => sprintf( 'footer_social_%s_setting', $key ),
				'type'        => 'text',
			]
		);
	}

	$wp_customize->add_section(
		'maverick_footer_colors_section',
		[
			'title'      => esc_html__( 'Footer Colors', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_footer_settings',
		]
	);

	$wp_customize->add_setting(
		'footer_heading_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => '',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_heading_color',
			[
				'label'    => esc_html__( 'Heading Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'footer_heading_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_text_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => '',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			[
				'label'    => esc_html__( 'Text Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'footer_text_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_background_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => '',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			[
				'label'    => esc_html__( 'Background Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'footer_background_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_social_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default'    => '',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_color',
			[
				'label'    => esc_html__( 'Social Icons Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'footer_social_color',
			]
		)
	);

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$settings_footer_partial = [ 'maverick_footer_copy_text_setting', 'maverick_footer_blurb_text_setting' ];

	foreach ( $social_icons as $key => $social_icon ) {
		$settings_footer_partial[] = sprintf( 'footer_social_%s_setting', $key );
	}
}

/**
 * Generates the inline CSS from the Customizer settings
 *
 * @return void
 */
function inline_css() {

	//Color palette.
	$primary_color   = get_palette_color( 'primary', 'HSL' );
	$secondary_color = get_palette_color( 'secondary', 'HSL' );
	$tertiary_color  = get_palette_color( 'tertiary', 'HSL' );

	//Customizer colors.
	$header_background    = hex_to_hsl( get_theme_mod( 'header_background_color', false ), true );
	$header_text_color    = hex_to_hsl( get_theme_mod( 'maverick_header_text_color_setting', false ), true );
	$footer_text_color    = hex_to_hsl( get_theme_mod( 'footer_text_color', false ), true );
	$footer_heading_color = hex_to_hsl( get_theme_mod( 'footer_heading_color', false ), true );
	$footer_background    = hex_to_hsl( get_theme_mod( 'footer_background_color', false ), true );
	$footer_social_color  = hex_to_hsl( get_theme_mod( 'footer_social_color', false ), true );
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

				<?php if ( $footer_social_color ) : ?>
					--theme-social--color: <?php echo esc_attr( $footer_social_color ); ?>;
				<?php endif; ?>
			}
		</style>
	<?php
}
