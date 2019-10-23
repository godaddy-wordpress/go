<?php
/**
 * Custom template tags for this theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * @package Go\Template_Tags
 */

namespace Go;

use function Go\Core\get_available_color_schemes;

/**
 * Return the Post Meta.
 *
 * @param int    $post_id The ID of the post for which the post meta should be output.
 * @param string $location Which post meta location to output.
 */
function post_meta( $post_id = null, $location = 'top' ) {

	echo get_post_meta( $post_id, $location ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in get_post_meta().

}

/**
 * Get the post meta.
 *
 * @param int    $post_id The iD of the post.
 * @param string $location The location where the meta is shown.
 */
function get_post_meta( $post_id = null, $location = 'top' ) {

	// Require post ID.
	if ( ! $post_id ) {
		return;
	}

	$page_template = get_page_template_slug( $post_id );

	// Check whether the post type is allowed to output post meta.
	$disallowed_post_types = apply_filters( 'go_disallowed_post_types_for_meta_output', array( 'page' ) );
	if ( in_array( get_post_type( $post_id ), $disallowed_post_types, true ) ) {
		return;
	}

	$post_meta_wrapper_classes = '';
	$post_meta_classes         = '';

	// Get the post meta settings for the location specified.
	if ( 'top' === $location ) {

		$post_meta                 = apply_filters(
			'go_post_meta_location_single_top',
			array(
				'author',
				'post-date',
				'comments',
				'sticky',
			)
		);
		$post_meta_wrapper_classes = ' post__meta--single post__meta--top';

	} elseif ( 'single-bottom' === $location ) {

		$post_meta                 = apply_filters(
			'go_post_meta_location_single_bottom',
			array(
				'tags',
			)
		);
		$post_meta_wrapper_classes = ' post__meta--single post__meta--single-bottom';

	}

	// If the post meta setting has the value 'empty', it's explicitly empty and the default post meta shouldn't be output.
	if ( $post_meta && ! in_array( 'empty', $post_meta, true ) ) {

		// Make sure we don't output an empty container.
		$has_meta = false;

		global $post;
		$the_post = get_post( $post_id );
		setup_postdata( $the_post );

		ob_start();

		?>

		<div class="post__meta--wrapper<?php echo esc_attr( $post_meta_wrapper_classes ); ?>">

			<ul class="post__meta list-reset<?php echo esc_attr( $post_meta_classes ); ?>">

				<?php

				// Allow output of additional meta items to be added by child themes and plugins.
				do_action( 'go_start_of_post_meta_list', $post_meta, $post_id );

				// Author.
				if ( in_array( 'author', $post_meta, true ) ) {

					$has_meta = true;
					?>
					<li class="post-author meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php esc_html_e( 'Post author', 'go' ); ?></span>
							<?php load_inline_svg( 'author.svg' ); ?>
						</span>
						<span class="meta-text">
							<?php
							// Translators: %s = the author name.
							printf( esc_html_x( 'By %s', '%s = author name', 'go' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'nickname' ) ) . '</a>' );
							?>
						</span>
					</li>
					<?php

				}

				// Post date.
				if ( in_array( 'post-date', $post_meta, true ) ) {
					$has_meta = true;

					?>
					<li class="post-date">
						<a class="meta-wrapper" href="<?php the_permalink(); ?>">
							<span class="meta-icon">
								<span class="screen-reader-text"><?php esc_html_e( 'Post date', 'go' ); ?></span>
								<?php load_inline_svg( 'calendar.svg' ); ?>
							</span>
							<span class="meta-text">
								<?php
								echo wp_kses(
									sprintf(
										'<time datetime="%1$s">%2$s</time>',
										esc_attr( get_the_date( DATE_W3C ) ),
										esc_html( get_the_date() )
									),
									array_merge(
										wp_kses_allowed_html( 'post' ),
										[
											'time' => [
												'datetime' => true,
											],
										]
									)
								);
								?>
							</span>
						</a>
					</li>
					<?php

				}

				// Categories.
				if ( in_array( 'categories', $post_meta, true ) && has_category() ) {

					$has_meta = true;
					?>
					<li class="post-categories meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'go' ); ?></span>
							<?php load_inline_svg( 'categories.svg' ); ?>
						</span>
						<span class="meta-text">
							<?php esc_html_e( 'In', 'go' ); ?> <?php the_category( ', ' ); ?>
						</span>
					</li>
					<?php

				}

				// Tags.
				if ( in_array( 'tags', $post_meta, true ) && has_tag() ) {

					$has_meta = true;
					?>
					<li class="post-tags meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php esc_html_e( 'Tags', 'go' ); ?></span>
							<?php load_inline_svg( 'tags.svg' ); ?>
						</span>
						<span class="meta-text">
							<?php the_tags( '', ', ', '' ); ?>
						</span>
					</li>
					<?php

				}

				// Comments link.
				if ( in_array( 'comments', $post_meta, true ) && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

					$has_meta = true;
					?>
					<li class="post-comment-link meta-wrapper">
						<span class="meta-icon">
							<?php load_inline_svg( 'comments.svg' ); ?>
						</span>
						<span class="meta-text">
							<?php comments_popup_link(); ?>
						</span>
					</li>
					<?php

				}

				// Sticky.
				if ( in_array( 'sticky', $post_meta, true ) && is_sticky() ) {

					$has_meta = true;
					?>
					<li class="post-sticky meta-wrapper">
						<span class="meta-icon">
							<?php load_inline_svg( 'bookmark.svg' ); ?>
						</span>
						<span class="meta-text">
							<?php esc_html_e( 'Featured', 'go' ); ?>
						</span>
					</li>
					<?php

				}

				// Allow output of additional post meta types to be added by child themes and plugins.
				do_action( 'go_end_of_post_meta_list', $post_meta, $post_id );
				?>

			</ul>

		</div>

		<?php

		wp_reset_postdata();

		$meta_output = ob_get_clean();

		// If there is meta to output, return it.
		if ( $has_meta && $meta_output ) {

			return $meta_output;

		}
	}
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
	$default         = \Go\Core\get_default_color_scheme();
	$color_scheme    = get_theme_mod( 'color_scheme', $default );
	$override_colors = [
		'primary'           => 'primary_color',
		'secondary'         => 'secondary_color',
		'tertiary'          => 'tertiary_color',
		'background'        => 'background_color',
		'header_background' => 'header_background_color',
		'footer_background' => 'footer_background_color',
	];

	$color_override = get_theme_mod( $override_colors[ $color ] );

	$avaliable_color_schemes = get_available_color_schemes();

	$the_color = '';

	if ( $color_scheme && isset( $avaliable_color_schemes[ $color_scheme ] ) && isset( $avaliable_color_schemes[ $color_scheme ][ $color ] ) ) {
		$the_color = $avaliable_color_schemes[ $color_scheme ][ $color ];
	}

	if ( $color_override ) {
		$the_color = $color_override;
	}

	if ( ! empty( $the_color ) ) {
			// Ensure we have a hash mark at the beginning of the hex value.
		$the_color = '#' . ltrim( $the_color, '#' );

		if ( 'HSL' === $format ) {
			return hex_to_hsl( $the_color );
		}
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
	$default                 = \Go\Core\get_default_color_scheme();
	$color_scheme            = get_theme_mod( 'color_scheme', $default );
	$avaliable_color_schemes = get_available_color_schemes();

	$the_color = '';

	if ( $color_scheme && empty( $avaliable_color_schemes[ $color_scheme ] ) ) {
		$color_scheme_keys = array_keys( $avaliable_color_schemes );
		$color_scheme      = array_shift( $color_scheme_keys );
	}

	if ( $color_scheme && isset( $avaliable_color_schemes[ $color_scheme ] ) && isset( $avaliable_color_schemes[ $color_scheme ][ $color ] ) ) {
		$the_color = $avaliable_color_schemes[ $color_scheme ][ $color ];
	}

	if ( ! empty( $the_color ) ) {
		if ( 'HSL' === $format ) {
			return hex_to_hsl( $the_color );
		}
	}

	return $the_color;
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
 * Returns whether there is a footer background or not.
 *
 * @return boolean
 */
function has_header_background() {

	$background_color = get_palette_color( 'header_background' );

	if ( $background_color ) {
		return 'has-background';
	}
}

/**
 * Includes the selected footer varation
 *
 * @return void
 */
function footer_variation() {
	$variations         = \Go\Core\get_available_footer_variations();
	$selected_variation = \Go\Core\get_footer_variation();

	if ( is_customize_preview() ) {
		foreach ( $variations as $variation ) {
			call_user_func( $variation['partial'] );
		}
	} elseif ( $selected_variation ) {
		call_user_func( $selected_variation['partial'] );
	}
}

/**
 * Returns whether there is a footer background or not.
 *
 * @return boolean
 */
function has_footer_background() {

	$background_color = get_palette_color( 'footer_background' );

	if ( $background_color ) {
		return 'has-background';
	}
}

/**
 * Displays the footer copyright text.
 *
 * @param array $args {
 *   Optional. An array of arguments.
 *
 *   @type string $class The div class. Default is .site-info
 * }
 *
 * @return void
 */
function copyright( $args = [] ) {

	$args = wp_parse_args(
		$args,
		[
			'class' => 'site-info',
		]
	);

	$year      = sprintf( '&copy; %s&nbsp;', esc_html( date( 'Y' ) ) );
	$copyright = get_theme_mod( 'copyright', \Go\Core\get_default_copyright() );

	$html = [
		'div'  => [
			'class' => [],
		],
		'span' => [
			'class' => [],
		],
		'a'    => [
			'href'  => [],
			'class' => [],
		],
	];
	?>

	<div class="<?php echo esc_attr( $args['class'] ); ?>">

		<?php echo esc_html( $year ); ?>

		<?php if ( $copyright || is_customize_preview() ) : ?>
			<span class="copyright">
				<?php echo wp_kses( $copyright, $html ); ?>
			</span>
		<?php endif; ?>

		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '' );
		}
		?>

	</div>

	<?php
}

/**
 * Display the page title markup
 *
 * @since 0.1.0
 *
 * @return mixed Markup for the page title
 */
function page_title() {

	if (
		! is_customize_preview() && ( is_front_page() || ( ! get_theme_mod( 'page_titles', true ) && ! is_404() && ! is_search() && ! is_archive() ) )
	) {

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
		'go_page_title_args',
		[
			'title'   => get_the_title(),
			'wrapper' => 'h1',
			'atts'    => [
				'class' => 'post__title m-0 text-center',
			],
			'custom'  => false,
		]
	);

	/**
	 * When $args['custom'] is true, this function will short circuit and output
	 * the value of $args['title']
	 */
	if ( $args['custom'] ) {

		echo wp_kses_post( $args['title'] );

		return;

	}

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
		'<header class="page-header entry-header m-auto px %1$s">%2$s</header>',
		is_customize_preview() ? ( get_theme_mod( 'page_titles', true ) ? '' : ' display-none' ) : '',
		wp_kses(
			$html,
			[
				$args['wrapper'] => $args['atts'],
			]
		)
	);

}

/**
 * Output the content wrapper class
 *
 * @param string $class Class names.
 */
function content_wrapper_class( $class = '' ) {

	if (
		( function_exists( 'is_cart' ) && is_cart() ) ||
		( function_exists( 'is_checkout' ) && is_checkout() )
	) {

		$class .= ' max-w-wide w-full m-auto px';

	}

	echo esc_attr( $class );

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
		$social_icons = \Go\Core\get_social_icons();
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

	$social_icons     = \Go\Core\get_social_icons();
	$has_social_cions = has_social_icons( $social_icons );

	if ( ! $has_social_cions && ! is_customize_preview() ) {
		return;
	}

	?>
	<ul class="<?php echo esc_attr( $args['class'] ); ?>">
		<?php foreach ( $social_icons as $key => $social_icon ) : ?>

			<?php $visibility = empty( $social_icon['url'] ) ? ' display-none' : null; ?>

			<?php if ( ! empty( $social_icon['url'] ) || is_customize_preview() ) : ?>
				<li class="<?php echo esc_attr( sprintf( $args['li_class'], $key ) ) . esc_attr( $visibility ); ?>">
					<a class="social-icons__icon" href="<?php echo esc_url( $social_icon['url'] ); ?>" aria-label="<?php echo esc_attr( $social_icon['label'] ); ?>" rel="noopener noreferrer">
						<?php
						// Including SVGs, not template files.
						// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
						include $social_icon['icon'];
						?>
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
	echo '<div class="header__titles sm:flex items-center" itemscope itemtype="http://schema.org/Organization">';
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
			echo '<a class="inline-block no-underline" href="' . esc_url( home_url( '/' ) ) . '" itemprop="url">';
			printf(
				'<%1$s class="site-title">' . esc_html( $blog_name ) . '</%1$s>',
				( is_front_page() && ! did_action( 'get_footer' ) ) ? 'h1' : 'span'
			);
			echo '</a>';
		}

		if ( true === $args['description'] && ! empty( $blog_description ) ) :
			echo '<span class="site-description display-block relative text-sm">' . esc_html( $blog_description ) . '</span>';
		endif;
	}
}

/**
 * Display the navigation toggle button.
 *
 * @return void
 */
function navigation_toggle() {
	echo '<div class="header__nav-toggle">';
	echo '<button id="js-nav-toggle" class="nav-toggle" type="button" aria-controls="header__navigation">';
		echo '<div class="nav-toggle-icon">';
			load_inline_svg( 'menu.svg' );
		echo '</div>';
		echo '<div class="nav-toggle-icon nav-toggle-icon--close">';
			load_inline_svg( 'close.svg' );
		echo '</div>';
		echo '<span class="screen-reader-text">' . esc_html__( 'Menu', 'go' ) . '</span>';
	echo '</button>';
	echo '</div>';
}

/**
 * Display the header search toggle button.
 *
 * @return void
 */
function search_toggle() {

	ob_start();

	load_inline_svg( 'search.svg' );

	$search_icon = ob_get_clean();

	printf(
		'<button id="header__search-toggle" class="header__search-toggle" type="button" aria-controls="js-site-search">
			%1$s
			<span class="screen-reader-text">%2$s</span>
		</button>',
		wp_kses(
			$search_icon,
			array_merge(
				wp_kses_allowed_html( 'post' ),
				[
					'svg'  => [
						'width'   => true,
						'role'    => true,
						'height'  => true,
						'fill'    => true,
						'xmlns'   => true,
						'viewbox' => true,
					],
					'path' => [
						'd'    => true,
						'fill' => true,
					],
					'g'    => [
						'd'    => true,
						'fill' => true,
					],
				]
			)
		),
		esc_html__( 'Search Toggle', 'go' )
	);

}

/**
 * Output an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return void
 */
function load_inline_svg( $filename ) {

	$design_style = Core\get_design_style();

	ob_start();

	locate_template(
		[
			sprintf(
				'dist/images/design-styles/%1$s/%2$s',
				sanitize_title( $design_style['label'] ),
				$filename
			),
			"dist/images/{$filename}",
		],
		true,
		false
	);

	echo wp_kses(
		ob_get_clean(),
		array_merge(
			wp_kses_allowed_html( 'post' ),
			[
				'svg'  => [
					'role'    => true,
					'width'   => true,
					'height'  => true,
					'fill'    => true,
					'xmlns'   => true,
					'viewbox' => true,
				],
				'path' => [
					'd'              => true,
					'fill'           => true,
					'fill-rule'      => true,
					'stroke'         => true,
					'stroke-width'   => true,
					'stroke-linecap' => true,
				],
				'g'    => [
					'd'    => true,
					'fill' => true,
				],
			]
		)
	);

}
