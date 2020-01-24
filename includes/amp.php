<?php
/**
 * AMP Compatibility.
 *
 * @package Go\AMP
 */

namespace Go\AMP;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_filter( 'walker_nav_menu_start_el', $n( 'amp_nav_sub_menu_buttons' ), 10, 4 );

}

/**
 * Filter the HTML output of a nav menu item to add the AMP dropdown button to reveal the sub-menu.
 *
 * This is only used for AMP since in JS it is added via initMainNavigation() in navigation.js.
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of menu item. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 *
 * @return string Modified nav menu item HTML.
 */
function amp_nav_sub_menu_buttons( $item_output, $item, $depth, $args ) {

	if ( ! is_amp() || 'primary' !== $args->theme_location ) {

		return $item_output;

	}

	if ( ! in_array( 'menu-item-has-children', $item->classes, true ) ) {

		return $item_output;

	}

	$expanded = in_array( 'current-menu-ancestor', $item->classes, true );

	// Generate a unique state ID.
	static $nav_menu_item_number = 0;
	$nav_menu_item_number++;
	$expanded_state_id = 'navMenuItemExpanded' . $nav_menu_item_number;

	// Create new state for managing storing the whether the sub-menu is expanded.
	$item_output .= sprintf(
		'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
		esc_attr( $expanded_state_id ),
		wp_json_encode( $expanded )
	);

	/*
	* Create the toggle button which mutates the state and which has class and
	* aria-expanded attributes which react to the state changes.
	*/
	$dropdown_button  = '<button';
	$dropdown_class   = 'dropdown-toggle';
	$toggled_class    = 'toggled-on';
	$dropdown_button .= sprintf(
		' class="%s" [class]="%s"',
		esc_attr( $dropdown_class . ( $expanded ? " $toggled_class" : '' ) ),
		esc_attr( sprintf( "%s + ( $expanded_state_id ? %s : '' )", wp_json_encode( $dropdown_class ), wp_json_encode( " $toggled_class" ) ) )
	);

	$dropdown_button .= sprintf(
		' aria-expanded="%s" [aria-expanded]="%s"',
		esc_attr( wp_json_encode( $expanded ) ),
		esc_attr( "$expanded_state_id ? 'true' : 'false'" )
	);

	$dropdown_button .= sprintf(
		' on="%s"',
		esc_attr( "tap:AMP.setState( { $expanded_state_id: ! $expanded_state_id } )" )
	);

	$dropdown_button .= '>';

	// Let the screen reader text in the button also update based on the expanded state.
	$dropdown_button .= sprintf(
		'<span class="screen-reader-text" [text]="%s">%s</span>',
		esc_attr( sprintf( "$expanded_state_id ? %s : %s", wp_json_encode( __( 'collapse child menu', 'example' ) ), wp_json_encode( __( 'expand child menu', 'example' ) ) ) ),
		esc_html( $expanded ? __( 'collapse child menu', 'example' ) : __( 'expand child menu', 'example' ) )
	);

	$dropdown_button .= '</button>';

	$item_output .= $dropdown_button;

	return $item_output;

}

/**
 * Determine whether it is an AMP response.
 *
 * This function is used as a "Conditional Tag" in WordPress. It can only be used at the `wp` action or later.
 *
 * @link https://developer.wordpress.org/themes/references/list-of-conditional-tags/
 * @see is_amp_endpoint()
 *
 * @return bool Is AMP response.
 */
function is_amp() {

	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();

}
