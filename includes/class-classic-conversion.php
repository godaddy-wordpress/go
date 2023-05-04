<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package Go
 */

namespace Go;

use WP_Theme_JSON;

/**
 * This class handles the conversion of the classic theme to the block based theme.
 */
class Classic_Conversion {
	/**
	 * The current globally available instance (if any).
	 *
	 * @var static
	 */
	protected static $instance;

	/**
	 * The base path for the theme.
	 *
	 * @var string
	 */
	protected $base_path;

	/**
	 * The new navigation locations.
	 *
	 * @var array
	 */
	protected $nav_menu_locations;

	/**
	 * Get the globally available instance.
	 *
	 * @return static
	 */
	public static function get_instance() {
		if ( \is_null( static::$instance ) ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Register the path bindings based on the main functions file.
	 *
	 * @param string $functions_file The full path to the main functions file.
	 */
	public function set_base_path( $functions_file ) {
		$this->base_path = trailingslashit( dirname( $functions_file ) );
	}


	/**
	 * Get the base path of the theme.
	 *
	 * @param string $path path from the root.
	 *
	 * @return string
	 */
	public function base_path( $path = '' ) {
		return rtrim( $this->base_path, DIRECTORY_SEPARATOR ) . ( '' !== $path ? DIRECTORY_SEPARATOR . ltrim( $path, DIRECTORY_SEPARATOR ) : '' );
	}

	/**
	 * Determines if a post exists based on name and type.
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 * @see https://github.com/WordPress/WordPress/blob/6.2-branch/wp-admin/includes/post.php#L787-L845
	 *
	 * @param string $name   Post name.
	 * @param string $type    Optional. Post type.
	 *
	 * @return int Post ID if post exists, 0 otherwise.
	 */
	public function post_exists( $name, $type ) {
		global $wpdb;

		$post_name = wp_unslash( sanitize_post_field( 'post_name', $name, 0, 'db' ) );
		$post_type = wp_unslash( sanitize_post_field( 'post_type', $type, 0, 'db' ) );

		$query = "SELECT ID FROM $wpdb->posts WHERE 1=1";
		$args  = array();

		$query .= ' AND post_name = %s';
		$args[] = $post_name;

		$query .= ' AND post_type = %s';
		$args[] = $post_type;

		return (int) $wpdb->get_var( $wpdb->prepare( $query, $args ) ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Ignoring since we are preparing the query.
	}

	/**
	 * Get the block templates from a given path.
	 *
	 * @param string $path path from the root.
	 *
	 * @return array the template files
	 */
	public function get_block_templates( $path = 'templates' ) {
		return glob( $this->base_path( $path ) . '/*.html' );
	}

	/**
	 * Apply customizations to block templates.
	 *
	 * @param array $template_files array of template files.
	 *
	 * @return bool true if successful
	 */
	public function apply_template_customizations( $template_files ) {
		return array_walk( $template_files, array( $this, 'save_template_customizations' ), 'wp_template' );
	}

	/**
	 * Apply customizations to block template parts.
	 *
	 * @param array $template_files array of template files.
	 *
	 * @return bool true if successful
	 */
	public function apply_template_part_customizations( $template_files ) {
		return array_walk( $template_files, array( $this, 'save_template_customizations' ), 'wp_template_part' );
	}

	/**
	 * Apply customizations to block templates and if they have changed, insert
	 * a new wp_template post to override the default template.
	 *
	 * @param string $template_file path to template file.
	 * @param int    $index index of template file in array.
	 * @param string $type wp_template or wp_template_part.
	 */
	public function save_template_customizations( $template_file, $index, $type = 'wp_template' ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		$template_contents = file_get_contents( $template_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- Retrieving a local file with file_get_contents is fine here.

		$new_contents = array_reduce(
			array(
				array( $this, 'migrate_navigation_locations' ),
				array( $this, 'make_header_sticky' ),
				array( $this, 'migrate_header_variations' ),
				array( $this, 'migrate_footer_variations' ),
				array( $this, 'migrate_social_links' ),
				array( $this, 'migrate_header_colors' ),
				array( $this, 'migrate_footer_colors' ),
				array( $this, 'hide_site_title' ),
				array( $this, 'hide_site_tagline' ),
			),
			function( $carry, $callback ) use ( $template_file ) {
				return $callback( $carry, $template_file );
			},
			$template_contents
		);

		// If template has changed, insert new wp_template post to override the default template.
		if ( $new_contents !== $template_contents ) {
			$template_data = array(
				'post_name'   => basename( $template_file, '.html' ),
				'post_type'   => $type,
				'post_status' => 'publish',
				'tax_input'   => array(
					'wp_theme'              => array( 'go' ),
					'wp_template_part_area' => array_filter(
						array(
							strpos( $template_file, 'header' ) !== false ? 'header' : null,
							strpos( $template_file, 'footer' ) !== false ? 'footer' : null,
						)
					),
				),
			);

			$template_data['ID'] = $this->post_exists( $template_data['post_name'], $template_data['post_type'] );

			// Replace numbers with words in title.
			$template_data['post_title'] = str_replace(
				array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '0' ),
				array( 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'zero' ),
				$template_data['post_name']
			);

			// Format as title case.
			$template_data['post_title'] = ucwords( str_replace( '-', ' ', $template_data['post_title'] ) );

			$template_data['post_content'] = $new_contents;
			wp_insert_post( array_filter( $template_data ) );
		}
	}


	/**
	 * Get the value of a theme mod.
	 *
	 * @param string $name The name of the theme mod.
	 *
	 * @return mixed The value of the theme mod or null if it doesn't exist.
	 */
	public function get_theme_mod( $name ) {
		return get_option( 'theme_mods_go' )[ $name ] ?? null;
	}

	/**
	 * Migrate navigation locations from theme_mods to wp_navigation post.
	 *
	 * The core navigation block provides
	 * `block_core_navigation_maybe_use_classic_menu_fallback` as a way to
	 * migrate. However, this function does not allow us to specify which menu
	 * to migrate. We need to be able to migrate only the menus that are
	 * assigned to a location.
	 *
	 * @see https://github.com/WordPress/gutenberg/blob/wp/6.2/packages/block-library/src/navigation/index.php#L327-L365
	 */
	public function convert_nav_menus() {
		$nav_menu_locations = $this->get_theme_mod( 'nav_menu_locations' );

		if ( ! is_array( $nav_menu_locations ) ) {
			return;
		}

		array_walk(
			$nav_menu_locations,
			function( $nav_menu_id, $nav_menu_loc ) {
				// See if we have a classic menu.
				$classic_nav_menu = wp_get_nav_menu_object( $nav_menu_id );

				if ( ! $classic_nav_menu ) {
					return;
				}

				// If we have a classic menu then convert it to blocks.
				$classic_nav_menu_blocks = block_core_navigation_get_classic_menu_fallback_blocks( $classic_nav_menu );

				// Create a new navigation menu from the classic menu.
				$new_nav_menu_id = wp_insert_post(
					array(
						'ID'           => $this->post_exists( $classic_nav_menu->slug, 'wp_navigation' ),
						'post_content' => $classic_nav_menu_blocks,
						'post_title'   => ucwords( str_replace( '-', ' ', $classic_nav_menu->slug ) ), // Format as title case.
						'post_name'    => $classic_nav_menu->slug,
						'post_status'  => 'publish',
						'post_type'    => 'wp_navigation',
					),
				);

				$this->nav_menu_locations[ $nav_menu_loc ] = $new_nav_menu_id;
			}
		);
	}

	/**
	 * Migrate the navigation locations to the new navigation block.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 *
	 * @return string The post content.
	 */
	public function migrate_navigation_locations( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		if ( ! is_array( $this->nav_menu_locations ) ) {
			return $post_content;
		}

		// Check if the template has a navigation block.
		if ( empty( preg_match_all( '/<!-- wp:navigation \X+?\/-->/', $post_content, $matches ) ) ) {
			return $post_content;
		}

		// Loop through the navigation blocks and add the ref attribute.
		array_map(
			function( $content_match ) use ( &$post_content ) {
				$parsed_block = parse_blocks( $content_match )[0];

				// Clear the inner blocks and content.
				$parsed_block['innerBlocks']  = array();
				$parsed_block['innerHTML']    = '';
				$parsed_block['innerContent'] = array();

				// Add the ref attribute if the location matches.
				foreach ( $this->nav_menu_locations as $location => $menu_id ) {
					if ( false !== strpos( $parsed_block['attrs']['className'], $location ) ) {
						$parsed_block['attrs']['ref'] = $menu_id;
					}
				}

				$replace = serialize_block( $parsed_block );

				$post_content = str_replace( $content_match, $replace, $post_content );
			},
			$matches[0]
		);

		// Remove the column block if the location doesn't have a menu.
		if ( preg_match( '/<!-- wp:columns \X+?<!-- \/wp:columns -->/', $post_content, $columns_match ) ) {
			$columns_block = parse_blocks( $columns_match[0] )[0];
			$column_blocks = array_map( 'serialize_block', $columns_block['innerBlocks'] );

			$missing_nav_locations = array_diff(
				array( 'primary', 'footer-1', 'footer-2', 'footer-3' ),
				array_keys( $this->nav_menu_locations ),
			);

			// Loop through the column blocks and remove the column block if it contains a missing nav location.
			foreach ( $column_blocks as $column_block ) {
				$should_remove = ! empty(
					array_filter(
						$missing_nav_locations,
						function( $missing_nav_location ) use ( $column_block ) {
							if ( false !== strpos( $column_block, "nav-loc-$missing_nav_location" ) ) {
								return true;
							}

							return false;
						}
					)
				);

				if ( $should_remove ) {
					$post_content = str_replace( $column_block, '', $post_content );
				}
			}
		}

		// Setup the navigation headings with the correct names.
		if ( ! empty( $this->nav_menu_locations ) && preg_match_all( '/Primary<\/h5>/', $post_content, $nav_headings_match ) ) {
			$menu_names = array();
			foreach ( $this->nav_menu_locations as $location => $menu_id ) {
				if ( 'primary' === $location ) {
					continue;
				}
				$menu_names[] = wp_get_nav_menu_name( $location );
			}
			if ( empty( $menu_names ) ) {
				return $post_content;
			}
			$count        = 0;
			$post_content = preg_replace_callback(
				'/Primary/',
				function ( $v ) use ( $menu_names, &$count ) {
					return $menu_names[ $count++ ];
				},
				$post_content
			);
		}

		return $post_content;
	}

	/**
	 * Migrate the header variations to the new header block.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 *
	 * @return string The post content.
	 */
	public function migrate_header_variations( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		$header_variation = $this->get_theme_mod( 'header_variation' );
		return empty( $header_variation )
			? $post_content
			: $this->migrate_template_parts( 'header-1', $header_variation, $post_content );
	}

	/**
	 * Migrate the footer variations to the new footer block.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 *
	 * @return string The post content.
	 */
	public function migrate_footer_variations( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		$footer_variation = $this->get_theme_mod( 'footer_variation' );
		return empty( $footer_variation )
			? $post_content
			: $this->migrate_template_parts( 'footer-1', $footer_variation, $post_content );
	}

	/**
	 * Search and replace a template part slug from post content.
	 *
	 * @param string $search_slug The slug to search for.
	 * @param string $replace_slug The slug to replace with.
	 * @param string $post_content The post content.
	 *
	 * @return string The modified post content.
	 */
	public function migrate_template_parts( $search_slug, $replace_slug, $post_content ) {
		$search_block = array(
			'blockName'    => 'core/template-part',
			'attrs'        => array(
				'slug'  => $search_slug,
				'theme' => 'go',
			),
			'innerContent' => array(),
		);

		$replace_block                  = $search_block;
		$replace_block['attrs']['slug'] = $replace_slug;

		return str_replace(
			serialize_block( $search_block ),
			serialize_block( $replace_block ),
			$post_content
		);
	}

	/**
	 * Replace the social links block with new social links.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 */
	public function migrate_social_links( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		if ( ! preg_match( '/(<!-- wp:social-links \X+<ul[^>]+>)(<\/ul>\X+\/wp:social-links -->)/m', $post_content, $matches ) ) {
			return $post_content;
		}

		$search_block = $matches[0];

		$wrapper_open  = $matches[1];
		$wrapper_close = $matches[2];

		// Migrate social_icon_color to iconColor attribute.
		$social_icon_color = $this->get_theme_mod( 'social_icon_color' );

		if ( $social_icon_color ) {
			$wrapper_open = preg_replace(
				'/"iconColor":"[^"]+"/',
				sprintf( '"iconColor":"%s"', esc_attr( $social_icon_color ) ),
				$wrapper_open
			);

			$wrapper_open = preg_replace(
				'/"iconColorValue":"[^"]+"/',
				sprintf( '"iconColorValue":"%s"', esc_attr( $social_icon_color ) ),
				$wrapper_open
			);
		}

		// The supported social icons.
		$social_icons = array(
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
			'xing',
			'pinterest',
			'youtube',
			'spotify',
			'github',
			'tiktok',
			'mastodon',
		);

		// Create the social link blocks.
		$social_link_blocks = array_map(
			function( $icon ) {
				$url = $this->get_theme_mod( 'social_icon_' . $icon );

				return empty( $url ) ? null : array(
					'blockName'    => 'core/social-link',
					'attrs'        => array(
						'url'     => $url,
						'service' => $icon,
					),
					'innerContent' => array(),
				);
			},
			$social_icons
		);

		// Replace the social links block with the new block.
		return str_replace(
			$search_block,
			$wrapper_open . serialize_blocks( array_filter( $social_link_blocks ) ) . $wrapper_close,
			$post_content
		);
	}


	/**
	 * Migrate the header text and background colors to the new wrapper group.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 */
	public function migrate_header_colors( $post_content, $template_file ) {
		if ( strpos( $template_file, 'header' ) === false ) {
			return $post_content;
		}

		return $this->migrate_wrapper_group_colors(
			$post_content,
			$this->get_theme_mod( 'header_text_color' ),
			$this->get_theme_mod( 'header_background_color' )
		);
	}

	/**
	 * Migrate the footer text and background colors to the new wrapper group.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 */
	public function migrate_footer_colors( $post_content, $template_file ) {
		if ( strpos( $template_file, 'footer' ) === false ) {
			return $post_content;
		}

		return $this->migrate_wrapper_group_colors(
			$post_content,
			$this->get_theme_mod( 'footer_text_color' ),
			$this->get_theme_mod( 'footer_background_color' )
		);
	}

	/**
	 * Migrate the text and background colors to the new wrapper group.
	 *
	 * @param string $post_content The post content.
	 * @param string $text_color The text color.
	 * @param string $background_color The background color.
	 */
	public function migrate_wrapper_group_colors( $post_content, $text_color, $background_color ) {
		$parsed_blocks = parse_blocks( $post_content );
		$target_block  = $parsed_blocks[0];

		// Bail if the first block is not a group.
		if ( empty( $target_block ) || 'core/group' !== $target_block['blockName'] ) {
			return $post_content;
		}

		// Migrate the background color.
		if ( ! empty( $background_color ) ) {
			unset( $target_block['attrs']['backgroundColor'] );
			$target_block['attrs']['style']['color']['background'] = $background_color;

			$search  = array(
				' has-base-background-color ',
				'style="',
			);
			$replace = array(
				' ',
				sprintf( 'style="background-color:%s;', esc_attr( $background_color ) ),
			);

			$target_block['innerHTML']       = str_replace( $search, $replace, $target_block['innerHTML'] );
			$target_block['innerContent'][0] = str_replace( $search, $replace, $target_block['innerContent'][0] );
		}

		// Migrate the text color.
		if ( ! empty( $text_color ) ) {
			unset( $target_block['attrs']['textColor'] );
			$target_block['attrs']['style']['elements']['link']['color']['text'] = $text_color;
			$target_block['attrs']['style']['color']['text']                     = $text_color;

			$search  = array(
				' has-contrast-color ',
				'style="',
			);
			$replace = array(
				' ',
				sprintf( 'style="color:%s;', esc_attr( $text_color ) ),
			);

			$target_block['innerHTML']       = str_replace( $search, $replace, $target_block['innerHTML'] );
			$target_block['innerContent'][0] = str_replace( $search, $replace, $target_block['innerContent'][0] );
		}

		// Replace the first block with the new one.
		return serialize_blocks( array( $target_block ) );
	}

	/**
	 * Make the header sticky.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 */
	public function make_header_sticky( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		if ( ! $this->get_theme_mod( 'sticky_header' ) ) {
			return $post_content;
		}

		return str_replace(
			'<!-- wp:template-part {"slug":"header-1","theme":"go"} /-->',
			'<!-- wp:group {"style":{"position":{"type":"sticky","top":"0px"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group"><!-- wp:template-part {"slug":"header-3","theme":"go"} /--></div>
			<!-- /wp:group -->',
			$post_content
		);
	}

	/**
	 * Hide the site title.
	 *
	 * @param string $post_content The post content.
	 * @param strint $template_file The template file.
	 */
	public function hide_site_title( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		if ( ! $this->get_theme_mod( 'hide_site_title' ) ) {
			return $post_content;
		}

		return preg_replace( '/<!-- wp:site-title \X+?\/-->/', '', $post_content );
	}

	/**
	 * Hide the site tagline.
	 *
	 * @param string $post_content The post content.
	 * @param string $template_file The template file.
	 */
	public function hide_site_tagline( $post_content, $template_file ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
		if ( ! $this->get_theme_mod( 'hide_site_tagline' ) ) {
			return $post_content;
		}

		return preg_replace( '/<!-- wp:site-tagline \X+?\/-->/', '', $post_content );
	}

	/**
	 * Apply design style customizations to the user's global styles.
	 */
	public function apply_global_styles() {
		$design_style = $this->get_theme_mod( 'design_style' ) ?? 'traditional';

		// Used as a reference for default values.
		$theme_json_data = 'traditional' === $design_style
			? wp_json_file_decode( $this->base_path( 'theme.json' ), array( 'associative' => true ) )
			: wp_json_file_decode( $this->base_path( '/styles/' . $design_style . '.json' ), array( 'associative' => true ) );

		$theme_json = new WP_Theme_JSON( $theme_json_data, 'theme' );

		// This will become the customized global styles.
		$user_json_data = 'traditional' === $design_style
			? array( 'version' => WP_Theme_JSON::LATEST_SCHEMA )
			: $theme_json->get_raw_data();

		$user_json = new WP_Theme_JSON( $user_json_data, 'user' );

		// This will become the customized palette.
		$palette_json_data = array(
			'version'  => WP_Theme_JSON::LATEST_SCHEMA,
			'settings' => array(
				'color' => array(
					'palette' => array(
						array(
							'color' => $theme_json->get_data()['settings']['color']['palette'][0]['color'],
							'name'  => 'Base',
							'slug'  => 'base',
						),
						array(
							'color' => $theme_json->get_data()['settings']['color']['palette'][1]['color'],
							'name'  => 'Contrast',
							'slug'  => 'contrast',
						),
						array(
							'color' => $this->get_theme_mod( 'primary_color' ) ?? $theme_json->get_data()['settings']['color']['palette'][2]['color'],
							'name'  => 'Primary',
							'slug'  => 'primary',
						),
						array(
							'color' => $this->get_theme_mod( 'secondary_color' ) ?? $theme_json->get_data()['settings']['color']['palette'][3]['color'],
							'name'  => 'Secondary',
							'slug'  => 'secondary',
						),
						array(
							'color' => $this->get_theme_mod( 'tertiary_color' ) ?? $theme_json->get_data()['settings']['color']['palette'][4]['color'],
							'name'  => 'Tertiary',
							'slug'  => 'tertiary',
						),
					),
				),
			),
		);

		$color_palette_json = new WP_Theme_JSON( $palette_json_data, 'user' );

		// Put it all together.
		$user_json->merge( $color_palette_json );

		$global_theme_json = array_merge(
			$user_json->get_data(),
			array(
				'version'                     => WP_Theme_JSON::LATEST_SCHEMA,
				'isGlobalStylesUserThemeJSON' => true,
			)
		);

		// Setup Templates.
		$template_data = array(
			'post_name'   => 'wp-global-styles-go',
			'post_type'   => 'wp_global_styles',
			'post_status' => 'publish',
			'tax_input'   => array( 'wp_theme' => array( 'go' ) ),
		);

		$template_data['ID'] = $this->post_exists( $template_data['post_name'], $template_data['post_type'] );

		$template_data['post_title']   = 'Custom Styles';
		$template_data['post_content'] = wp_json_encode( $global_theme_json );
		wp_insert_post( array_filter( $template_data ) );
	}
}
