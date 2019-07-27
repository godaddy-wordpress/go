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
	add_action( 'wp_head', $n( 'css_variables' ), 0 );
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
		'maverick-customizer-controls',
		MAVERICK_TEMPLATE_URL . '/dist/css/admin/customize-controls-styles.css',
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
		'maverick_color_schemes_section',
		[
			'title'       => esc_html__( 'Color Schemes', 'maverick' ),
			'description' => esc_html__( 'The color schames varies based on the design style, so if you change a design style, you need to save and refresh the customizer', 'maverick' ),
			'capability'  => 'edit_theme_options',
			'panel'       => 'maverick_global_settings',
		]
	);

	$wp_customize->add_setting(
		'maverick_alternative_colors',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'maverick_alternative_colors_checkbox',
		[
			'label'       => esc_html__( 'Use alternative colors', 'maverick' ),
			'description' => esc_html__( 'Check this option to change colors of the design style.', 'maverick' ),
			'section'     => 'maverick_color_schemes_section',
			'settings'    => 'maverick_alternative_colors',
			'type'        => 'checkbox',
		]
	);

	$wp_customize->add_setting(
		'maverick_color_schemes',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new Switcher_Control(
			$wp_customize,
			'maverick_color_scheme_control',
			[
				'label'         => esc_html__( 'Color Schemes', 'maverick' ),
				'description'   => esc_html__( 'Choose one of the supported color schemes', 'maverick' ),
				'section'       => 'maverick_color_schemes_section',
				'settings'      => 'maverick_color_schemes',
				'choices'       => \Maverick\Core\get_available_color_schemes(),
				'switcher_type' => 'color-scheme',
			]
		)
	);

	$wp_customize->add_setting(
		'maverick_color_schemes_override',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'maverick_color_schemes_checkbox_override',
		[
			'label'       => esc_html__( 'Use custom colors', 'maverick' ),
			'description' => esc_html__( 'Check this option to set custom primary and secondary colors', 'maverick' ),
			'section'     => 'maverick_color_schemes_section',
			'settings'    => 'maverick_color_schemes_override',
			'type'        => 'checkbox',
		]
	);

	$wp_customize->add_setting(
		'maverick_custom_primary_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'maverick_custom_primary_color_control',
			[
				'label'       => esc_html__( 'Primary Color', 'maverick' ),
				'description' => esc_html__( 'Override the primary color', 'maverick' ),
				'section'     => 'maverick_color_schemes_section',
				'settings'    => 'maverick_custom_primary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'maverick_custom_secondary_color',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'maverick_custom_secondary_color_control',
			[
				'label'       => esc_html__( 'Secondary Color', 'maverick' ),
				'description' => esc_html__( 'Override the secondary color', 'maverick' ),
				'section'     => 'maverick_color_schemes_section',
				'settings'    => 'maverick_custom_secondary_color',
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

	$wp_customize->add_panel(
		'maverick_header_settings',
		[
			'title'       => esc_html__( 'Header Settings', 'maverick' ),
			'description' => esc_html__( 'Customize the header of your site.', 'maverick' ),
			'priority'    => 70,
		]
	);

	$wp_customize->add_section(
		'maverick_header_variation_section',
		[
			'title'      => esc_html__( 'Header Variations', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_header_settings',
		]
	);

	$wp_customize->add_setting(
		'maverick_header_variation_setting',
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
			'maverick_header_variation_control',
			[
				'label'       => esc_html__( 'Header Variation', 'maverick' ),
				'description' => esc_html__( 'Choose one of the supported header variations.', 'maverick' ),
				'section'     => 'maverick_header_variation_section',
				'settings'    => 'maverick_header_variation_setting',
				'choices'     => \Maverick\Core\get_available_header_variations(),
			]
		)
	);

	$wp_customize->add_section(
		'maverick_header_colors_section',
		[
			'title'       => esc_html__( 'Header Colors', 'maverick' ),
			'description' => esc_html__( 'Here you can customize the colors of the header. Be mindfull of the combination of colors you choose.', 'maverick' ),
			'capability'  => 'edit_theme_options',
			'panel'       => 'maverick_header_settings',
		]
	);

	$wp_customize->add_setting(
		'maverick_header_background_color_setting',
		[
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'maverick_header_background_color_contorl',
			[
				'label'       => esc_html__( 'Background Color', 'maverick' ),
				'description' => esc_html__( 'Override the design style background color.', 'maverick' ),
				'section'     => 'maverick_header_colors_section',
				'settings'    => 'maverick_header_background_color_setting',
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
				'label'       => esc_html__( 'Text Color', 'maverick' ),
				'description' => esc_html__( 'Override the design style text color.', 'maverick' ),
				'section'     => 'maverick_header_colors_section',
				'settings'    => 'maverick_header_text_color_setting',
			]
		)
	);

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'header_variation',
		[
			'selector'        => '#js-header-variation',
			'settings'        => [ 'maverick_header_variation_setting' ],
			'render_callback' => function() {
				ob_start();
				\Maverick\header_variation();
				$content = ob_get_contents();
				ob_end_clean();
				return $content;
			},
		]
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
		'maverick_footer_variation_setting',
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
			'maverick_footer_variation_control',
			[
				'label'       => esc_html__( 'Footer Variation', 'maverick' ),
				'description' => esc_html__( 'Choose one of the supported footer variations.', 'maverick' ),
				'section'     => 'maverick_footer_variation_section',
				'settings'    => 'maverick_footer_variation_setting',
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
		'maverick_footer_social_section',
		[
			'title'      => esc_html__( 'Social Icons', 'maverick' ),
			'capability' => 'edit_theme_options',
			'panel'      => 'maverick_footer_settings',
		]
	);

	$social_icons = \Maverick\Core\get_available_social_icons();

	foreach ( $social_icons as $key => $social_icon ) {
		$wp_customize->add_setting(
			sprintf( 'maverick_footer_social_%s_setting', $key ),
			[
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default'    => '',
				'transport'  => 'postMessage',
			]
		);

		$wp_customize->add_control(
			sprintf( 'maverick_footer_social_%s_control', $key ),
			[
				'label'       => $social_icon['label'],
				'description' => $social_icon['description'],
				'section'     => 'maverick_footer_social_section',
				'settings'    => sprintf( 'maverick_footer_social_%s_setting', $key ),
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
		'maverick_footer_text_color_setting',
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
			'maverick_footer_text_color_setting',
			[
				'label'    => esc_html__( 'Text Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'maverick_footer_text_color_setting',
			]
		)
	);

	$wp_customize->add_setting(
		'maverick_footer_background_color_setting',
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
			'maverick_footer_background_color_setting',
			[
				'label'    => esc_html__( 'Background Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'maverick_footer_background_color_setting',
			]
		)
	);

	$wp_customize->add_setting(
		'maverick_footer_social_icons_color_setting',
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
			'maverick_footer_social_icons_color_setting',
			[
				'label'    => esc_html__( 'Social Icons Color', 'maverick' ),
				'section'  => 'maverick_footer_colors_section',
				'settings' => 'maverick_footer_social_icons_color_setting',
			]
		)
	);

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$settings_footer_partial = [ 'maverick_footer_variation_setting', 'maverick_footer_copy_text_setting', 'maverick_footer_blurb_text_setting' ];

	foreach ( $social_icons as $key => $social_icon ) {
		$settings_footer_partial[] = sprintf( 'maverick_footer_social_%s_setting', $key );
	}

	$wp_customize->selective_refresh->add_partial(
		'footer_variation',
		[
			'selector'        => '#js-footer-variation',
			'settings'        => $settings_footer_partial,
			'render_callback' => function() {
				ob_start();
				\Maverick\footer_variation();
				$content = ob_get_contents();
				ob_end_clean();
				return $content;
			},
		]
	);
}

/**
 * Generates overrides for the CSS variables
 *
 * @return void
 */
function css_variables() {
	$alternative_colors = get_theme_mod( 'maverick_alternative_colors', false );
	$primary_color      = get_palette_color( 'primary', 'HSL' );
	$secondary_color    = get_palette_color( 'secondary', 'HSL' );

	?>

	<!-- Maverick CSS variable overrides -->
	<style>
		<?php if ( $alternative_colors && false !== $primary_color ) : ?>
			:root {
				--USER-PRIMARY-HUE: <?php echo esc_attr( $primary_color[0] ); ?>;
				--USER-PRIMARY-SATURATION: <?php echo esc_attr( $primary_color[1] ); ?>;
				--USER-PRIMARY-LIGHTNESS: <?php echo esc_attr( $primary_color[2] ); ?>;
				--USER-COLOR-PRIMARY: <?php echo esc_attr( $primary_color[0] ) . ', ' . esc_attr( $primary_color[1] ) . '%, ' . esc_attr( $primary_color[2] ) . '%'; ?>;
			}
		<?php endif; ?>

		<?php if ( $alternative_colors && false !== $secondary_color ) : ?>
			:root {
				--USER-ACCENT-HUE: <?php echo esc_attr( $secondary_color[0] ); ?>;
				--USER-ACCENT-SATURATION: <?php echo esc_attr( $secondary_color[1] ); ?>;
				--USER-ACCENT-LIGHTNESS: <?php echo esc_attr( $secondary_color[2] ); ?>;
				--USER-COLOR-SECONDARY: <?php echo esc_attr( $secondary_color[0] ) . ', ' . esc_attr( $secondary_color[1] ) . '%, ' . esc_attr( $secondary_color[2] ) . '%'; ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}

/**
 * Generates the inline CSS from the Customizer settings
 *
 * @return void
 */
function inline_css() {
	$header_background   = get_theme_mod( 'maverick_header_background_color_setting', false );
	$header_text_color   = get_theme_mod( 'maverick_header_text_color_setting', false );
	$footer_text_color   = get_theme_mod( 'maverick_footer_text_color_setting', false );
	$footer_background   = get_theme_mod( 'maverick_footer_background_color_setting', false );
	$footer_social_color = get_theme_mod( 'maverick_footer_social_icons_color_setting', false );
	?>
		<!-- Maverick Customizer Overrides -->
		<style>
			<?php if ( false !== $header_background ) : ?>
				.site-header {
					background-color: <?php echo esc_attr( $header_background ); ?>;
				}
			<?php endif; ?>

			<?php if ( false !== $header_text_color ) : ?>
				.c-site-navigation {
					--theme-primary-menu-link-color: <?php echo esc_attr( $header_text_color ); ?>;
				}
				.c-site-branding {
					--theme-site-branding-text-color: <?php echo esc_attr( $header_text_color ); ?>;
					--theme-link-color: <?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif; ?>

			/* The inline CSS will need to be updated as the footer variations are built. */
			<?php if ( false !== $footer_background ) : ?>
				#colophon {
					background: <?php echo esc_attr( $footer_background ); ?>;
				}
			<?php endif; ?>

			<?php if ( false !== $footer_text_color ) : ?>
				#colophon,
				#colophon a {
					color: <?php echo esc_attr( $footer_text_color ); ?>;
				}
			<?php endif; ?>

			<?php if ( false !== $footer_social_color ) : ?>
				#colophon .social-icons a {
					color: <?php echo esc_attr( $footer_social_color ); ?>;
				}
			<?php endif; ?>
		</style>
	<?php
}
