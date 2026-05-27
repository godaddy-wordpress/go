<?php
/**
 * Mega-menu support for the primary navigation.
 *
 * Editors flag a top-level menu item as a mega menu by adding the CSS class
 * `go-mega` to the menu item in Appearance > Menus. The matching custom
 * Walker renders that branch as a full-width, multi-column flyout that
 * shows its child items grouped by their parent.
 *
 * @package Go\Mega_Menu
 */

namespace Go\Mega_Menu;

/**
 * Marker CSS class an editor adds to a top-level menu item to opt it in.
 */
const TRIGGER_CLASS = 'go-mega';

/**
 * Hook setup.
 *
 * @return void
 */
function setup() {
	add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\\inject_walker' );
	add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\\flag_branch_classes', 10, 4 );
	add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\\add_trigger_attributes', 10, 4 );
}

/**
 * Use the mega-menu walker for the primary nav so child items can be
 * laid out in a multi-column panel.
 *
 * @param array $args Menu args.
 * @return array
 */
function inject_walker( $args ) {

	if ( isset( $args['theme_location'] ) && 'primary' === $args['theme_location'] ) {
		$args['walker'] = new Walker();
	}

	return $args;
}

/**
 * Flag descendants of a mega-menu trigger so the walker / CSS can target
 * the whole branch without callers having to add the class to every
 * child item by hand.
 *
 * @param string[] $classes CSS classes.
 * @param \WP_Post $item    Menu item.
 * @param object   $args    Menu args.
 * @param int      $depth   Item depth.
 * @return string[]
 */
function flag_branch_classes( $classes, $item, $args, $depth ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $classes;
	}

	if ( in_array( TRIGGER_CLASS, $classes, true ) && 0 === (int) $depth ) {
		$classes[] = 'menu-item-has-mega';
	}

	return $classes;
}

/**
 * Add accessibility hooks (aria-haspopup, aria-expanded) to top-level
 * mega-menu trigger links so the toggle has discoverable semantics for
 * assistive tech.
 *
 * @param array    $atts   Link attributes.
 * @param \WP_Post $item   Menu item.
 * @param object   $args   Menu args.
 * @param int      $depth  Item depth.
 * @return array
 */
function add_trigger_attributes( $atts, $item, $args, $depth ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $atts;
	}

	if ( 0 !== (int) $depth ) {
		return $atts;
	}

	$classes = is_array( $item->classes ) ? $item->classes : array();

	if ( ! in_array( TRIGGER_CLASS, $classes, true ) ) {
		return $atts;
	}

	$atts['aria-haspopup'] = 'true';
	$atts['aria-expanded'] = 'false';
	$atts['data-go-mega']  = 'trigger';

	return $atts;
}

// phpcs:disable Universal.Files.SeparateFunctionsFromOO.Mixed -- Walker is tiny and only consumed by inject_walker(); splitting it out adds an indirection without making the code easier to follow.
/**
 * Custom walker. Wraps each mega-menu submenu (depth 1) in an extra
 * container that the SCSS uses to flip from a normal dropdown to a
 * full-width multi-column panel.
 */
class Walker extends \Walker_Nav_Menu {

	/**
	 * Start the list before the elements are added.
	 *
	 * @param string $output Used to append additional content.
	 * @param int    $depth  Depth of the menu item.
	 * @param array  $args   Menu args.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		if ( 0 === $depth ) {
			$output .= "\n{$indent}<div class=\"go-mega__panel\" data-go-mega=\"panel\" hidden>\n";
			$output .= "{$indent}\t<ul class=\"go-mega__columns sub-menu\">\n";
			return;
		}

		$output .= "\n{$indent}<ul class=\"sub-menu\">\n";
	}

	/**
	 * End the list after the elements are added.
	 *
	 * @param string $output Used to append additional content.
	 * @param int    $depth  Depth of the menu item.
	 * @param array  $args   Menu args.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		if ( 0 === $depth ) {
			$output .= "{$indent}\t</ul>\n";
			$output .= "{$indent}</div>\n";
			return;
		}

		$output .= "{$indent}</ul>\n";
	}
}
// phpcs:enable Universal.Files.SeparateFunctionsFromOO.Mixed

setup();
