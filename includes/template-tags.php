<?php
/**
 * Custom template tags for this theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with Godaddy in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 * Example: `tenup_function()`
 *
 * @package Maverick\Template_Tags
 */

namespace Maverick;

use function Maverick\Core\get_available_color_schemes;

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists( $dir . $path ) ) {
		$css_vars = file_get_contents( $dir . $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		preg_match_all( ' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

/**
 * Converts a hex RGB color to HSL
 *
 * @param string $hex The RGB color in hex format.
 * @param bool   $string_output Whether to return the HSL color in CSS format.
 *
 * @return array
 */
function hex_to_hsl( $hex, $string_output = false ) {
	if ( empty( $hex ) ) {
		return $string_output ? '' : [ '', '', '' ];
	}

	$hex = [ $hex[1] . $hex[2], $hex[3] . $hex[4], $hex[5] . $hex[6] ];
	$rgb = array_map(
		function( $part ) {
			return intval( hexdec( $part ) ) / 255.0;
		},
		$hex
	);

	$max   = max( $rgb );
	$min   = min( $rgb );
	$delta = $max - $min;
	$h     = 0;
	$s     = 0;
	$l     = 0;

	if ( 0.0 === $delta ) {
		$h = 0;
	} elseif ( $max === $rgb[0] ) {
		$h = fmod( ( $rgb[1] - $rgb[2] ) / $delta, 6 );
	} elseif ( $max === $rgb[1] ) {
		$h = ( $rgb[2] - $rgb[0] ) / $delta + 2;
	} else {
		$h = ( $rgb[0] - $rgb[1] ) / $delta + 4;
	}

	$h = round( $h * 60 );

	if ( 0 > $h ) {
		$h += 360;
	}

	$l = ( $max + $min ) / 2;
	$s = 0.0 === $delta ? 0.0 : $delta / ( 1 - abs( 2 * $l - 1 ) );
	$s = abs( round( $s * 100 ) );
	$l = abs( round( $l * 100 ) );

	if ( $string_output ) {
		return "{$h}, {$s}%, ${l}%";
	}

	return [ $h, $s, $l ];
}

/**
 * Includes the selected header varation
 *
 * @return void
 */
function header_variation() {
	$variations         = \Maverick\Core\get_available_header_variations();
	$selected_variation = \Maverick\Core\get_header_variation();

	if ( is_customize_preview() ) {
		foreach ( $variations as $variation ) {
			call_user_func( $variation['partial'] );
		}
	} elseif ( $selected_variation ) {
		call_user_func( $selected_variation['partial'] );
	}
}

/**
 * Includes the selected footer varation
 *
 * @return void
 */
function footer_variation() {
	$variations         = \Maverick\Core\get_available_footer_variations();
	$selected_variation = \Maverick\Core\get_footer_variation();

	if ( is_customize_preview() ) {
		foreach ( $variations as $variation ) {
			call_user_func( $variation['partial'] );
		}
	} elseif ( $selected_variation ) {
		call_user_func( $selected_variation['partial'] );
	}
}

/**
 * Returns the footer blurb text
 *
 * @return string
 */
function footer_blurb_text() {
	$blurb_text = get_theme_mod( 'maverick_footer_blurb_text_setting', \Maverick\Core\get_default_footer_blurb_text() );

	/**
	 * Filters the footer blurb text.
	 *
	 * @since 0.1.0
	 *
	 * @param string $footer_blurb_text The footer blurb text.
	 */
	return apply_filters( 'maverick_footer_blurb_text', wpautop( $blurb_text ) );
}

/**
 * Returns the footer blurb text
 *
 * @return string
 */
function footer_copy_text() {

	$year = sprintf( '&copy; %s&nbsp;', esc_html( date( 'Y' ) ) );

	$copy_text = get_theme_mod( 'maverick_footer_copy_text_setting', \Maverick\Core\get_default_footer_copy_text() );

	$copyright = $year . $copy_text;

	/**
	 * Filters the footer copy text.
	 *
	 * @since 0.1.0
	 *
	 * @param string $footer_blurb_text The footer blurb text.
	 */
	return apply_filters( 'maverick_footer_copy_text', $copyright );
}

/**
 * Returns whether there are social icons set or not.
 *
 * @return boolean
 */
function has_footer_background() {

	$background_color = get_theme_mod( 'footer_background_color', '' );

	if ( $background_color ) {
		return 'has-background';
	}
}

/**
 * Returns whether there are social icons set or not.
 *
 * @param array $social_icons the array of social icons.
 *
 * @return boolean
 */
function has_social_icons( $social_icons = null ) {
	if ( is_null( $social_icons ) ) {
		$social_icons = \Maverick\Core\get_social_icons();
	}

	return array_reduce(
		$social_icons,
		function( $previous, $social_icon ) {
			return $previous || ! empty( $social_icon['url'] );
		},
		false
	);
}

/**
 * Display the page title markup
 *
 * @since 0.1.0
 *
 * @return mixed Markup for the page title
 */
function maverick_page_title() {

	if ( is_front_page() || ! get_theme_mod( 'page_titles', true ) ) {

		return;

	}

	/**
	 * Filter the page title display args.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	$args = (array) apply_filters(
		'maverick_page_title_args',
		[
			'title'   => get_the_title(),
			'wrapper' => 'h1',
			'atts'    => [
				'class' => 'post__title max-w-base m-0 m-auto text-center',
			],
		]
	);

	if ( empty( $args['title'] ) ) {

		return;

	}

	$args['atts'] = empty( $args['atts'] ) ? [] : (array) $args['atts'];

	foreach ( $args['atts'] as $key => $value ) {

		$args['classes'][] = sprintf( '%s="%s"', sanitize_key( $key ), esc_attr( $value ) );

	}

	$html = esc_html( $args['title'] );

	if ( ! empty( $args['wrapper'] ) ) {

		$html = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			sanitize_key( $args['wrapper'] ),
			implode( ' ', $args['classes'] ),
			$html
		);

	}

	foreach ( array_keys( $args['atts'] ) as $index => $attribute ) {

		$args['atts'][ $attribute ] = [];

	}

	printf(
		'<header class="entry-header">%s</header>',
		wp_kses(
			$html,
			[
				$args['wrapper'] => $args['atts'],
			]
		)
	);

}

/**
 * Displays the social icons
 *
 * @param array $args {
 *   Optional. An array of arguments.
 *
 *   @type string $class The ul class. Default is .social-icons
 *   @type string $li_class The li class. Default is .social-icon-%s, where %s is the social icon slug.
 * }
 *
 * @return void
 */
function social_icons( $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'class'    => 'social-icons',
			'li_class' => 'display-inline-block social-icon-%s',
		]
	);

	$social_icons     = \Maverick\Core\get_social_icons();
	$has_social_cions = has_social_icons( $social_icons );

	if ( ! $has_social_cions && ! is_customize_preview() ) {
		return;
	}

	?>
	<ul class="js-maverick-social-icons <?php echo esc_attr( $args['class'] ); ?>">
		<?php foreach ( $social_icons as $key => $social_icon ) : ?>

			<?php $visibility = empty( $social_icon['url'] ) ? ' display-none' : null; ?>

			<?php if ( ! empty( $social_icon['url'] ) || is_customize_preview() ) : ?>
				<li class="<?php echo esc_attr( sprintf( $args['li_class'], $key ) ) . esc_attr( $visibility ); ?>">
					<a class="social-icons__icon" href="<?php echo esc_url( $social_icon['url'] ); ?>" aria-label="<?php echo esc_attr( $social_icon['label'] ); ?>" rel="noopener noreferrer">
						<?php echo file_get_contents( $social_icon['icon'] ); // phpcs:ignore ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Display the site branding section, which includes a logo
 * from Customizer (if set) or site title and description.
 *
 * @param array $args {
 *   Optional. An array of arguments.
 *
 *   @type boolean $description Whether to show the Site Description. Default is true.
 * }
 * @return void
 */
function display_site_branding( $args = [] ) {
	echo '<div class="site-branding sm:flex items-center" itemscope itemtype="http://schema.org/Organization">';
		site_branding( $args );
	echo '</div>';
}

/**
 * Render the site branding or the logo.
 *
 * @param array $args Optional arguments.
 *
 * @return void
 */
function site_branding( $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'description' => true,
		]
	);

	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} else {
		$blog_name        = get_bloginfo( 'name' );
		$blog_description = get_bloginfo( 'description' );

		if ( ! empty( $blog_name ) ) {
			echo '<a class="site-branding__link" href="' . esc_url( home_url( '/' ) ) . '" itemprop="url">';
			echo '<span class="site-branding__title">' . esc_html( $blog_name ) . '</span>';
			echo '</a>';
		}

		if ( true === $args['description'] && ! empty( $blog_description ) ) :
			echo '<span class="site-branding__description display-block relative text-sm">' . esc_html( $blog_description ) . '</span>';
		endif;
	}
}

/**
 * Display the navigation toggle button.
 *
 * @return void
 */
function navigation_toggle() {
	echo '<button id="js-site-navigation__toggle" class="site-navigation__toggle" type="button" aria-controls="js-primary-menu">';
		echo '<div class="site-navigation__toggle-icon">';
			echo '<div class="site-navigation__toggle-icon-inner"></div>';
		echo '</div>';
		echo '<span class="screen-reader-text">' . esc_html__( 'Menu', 'maverick' ) . '</span>';
	echo '</button>';
}

/**
 * Returns the color selected by the user.
 *
 * @param string $color  Which color to return.
 * @param string $format The format to return the color. RGB (default) or HSL (returns an array).
 *
 * @return string|array|bool A string with the RGB value or an array containing the HSL values.
 */
function get_palette_color( $color, $format = 'RBG' ) {
	$color_scheme    = get_theme_mod( 'color_scheme', 'default' );
	$override_colors = [
		'primary'   => 'primary_color',
		'secondary' => 'secondary_color',
		'tertiary'  => 'tertiary_color',
	];

	$color_override = get_theme_mod( $override_colors[ $color ] );

	$avaliable_color_schemes = get_available_color_schemes();

	$the_color = false;

	if ( $color_scheme && isset( $avaliable_color_schemes[ $color_scheme ] ) ) {
		$the_color = $avaliable_color_schemes[ $color_scheme ][ $color ];
	}

	if ( $color_override ) {
		$the_color = $color_override;
	}

	if ( 'HSL' === $format ) {
		return hex_to_hsl( $the_color );
	}

	return $the_color;
}

/**
 * Returns the default color for the active color scheme.
 *
 * @param string $color  Which color to return.
 * @param string $format The format to return the color. RGB (default) or HSL (returns an array).
 *
 * @return string|array|bool A string with the RGB value or an array containing the HSL values.
 */
function get_default_palette_color( $color, $format = 'RBG' ) {
	$color_scheme            = get_theme_mod( 'color_scheme', 'default' );
	$avaliable_color_schemes = get_available_color_schemes();

	$the_color = false;

	if ( $color_scheme && empty( $avaliable_color_schemes[ $color_scheme ] ) ) {
		$color_scheme_keys = array_keys( $avaliable_color_schemes );
		$color_scheme      = array_shift( $color_scheme_keys );
	}

	if ( $color_scheme && isset( $avaliable_color_schemes[ $color_scheme ] ) ) {
		$the_color = $avaliable_color_schemes[ $color_scheme ][ $color ];
	}

	if ( 'HSL' === $format ) {
		return hex_to_hsl( $the_color );
	}

	return $the_color;
}

/**
 * Load an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return string The content of the SVG you want to load.
 */
function load_inline_svg( $filename ) {

	// Add the path to your SVG directory inside your theme.
	$svg_path = 'dist/images/';

	// Check the SVG file exists
	if ( file_exists( MAVERICK_PATH . $svg_path . $filename ) ) {

		// Load and return the contents of the file
		return file_get_contents( MAVERICK_PATH . $svg_path . $filename );
	}

	// Return a blank string if we can't find the file.
	return '';
}
