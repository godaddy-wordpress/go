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

	add_filter( 'body_class', $n( 'amp_body_class' ) );

}

/**
 * Append amp to the body classes.
 *
 * @param array $classes Body classes array.
 *
 * @return array Filtered body classes array.
 */
function amp_body_class( $classes ) {

	if ( ! is_amp() ) {

		return $classes;

	}

	$classes[] = 'amp';

	return $classes;

}

// phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter -- Parameters are coming from a hook.
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

	if ( ! is_amp() || 'primary' !== $args->theme_location || ! in_array( 'menu-item-has-children', $item->classes, true ) ) {

		return $item_output;

	}

	$expanded = in_array( 'current-menu-ancestor', $item->classes, true );

	static $nav_menu_item_number = 0;
	$nav_menu_item_number++;
	$expanded_state_id = 'navMenuItemExpanded' . $nav_menu_item_number;

	$item_output .= sprintf(
		'<amp-state id="%s">
			<script type="application/json">%s</script>
		</amp-state>',
		esc_attr( $expanded_state_id ),
		wp_json_encode( $expanded )
	);

	$dropdown_button = sprintf(
		'<button class="dropdown-toggle%1$s" [class]="%2$s" aria-expanded="%3$s" [aria-expanded]="%4$s" on="%5$s">
			<span class="screen-reader-text" [text]="%6$s">%7$s</span>
		</button>',
		esc_attr( $expanded ? ' toggled-on' : '' ),
		esc_attr(
			sprintf(
				"%s + ( $expanded_state_id ? %s : '' )",
				wp_json_encode( 'dropdown-toggle' ),
				wp_json_encode( ' toggled-on' )
			)
		),
		esc_attr( wp_json_encode( $expanded ) ),
		esc_attr( "$expanded_state_id ? 'true' : 'false'" ),
		esc_attr( "tap:AMP.setState( { $expanded_state_id: ! $expanded_state_id } )" ),
		esc_attr(
			sprintf(
				"$expanded_state_id ? %s : %s",
				wp_json_encode( __( 'collapse child menu', 'go' ) ),
				wp_json_encode( __( 'expand child menu', 'go' ) )
			)
		),
		esc_html( $expanded ? __( 'collapse child menu', 'go' ) : __( 'expand child menu', 'go' ) )
	);

	return $dropdown_button . $item_output;

}
// phpcs:enable Generic.CodeAnalysis.UnusedFunctionParameter

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

	/**
	 * Filter whether or not this is an AMP request.
	 *
	 * @var bool
	 */
	return (bool) apply_filters( 'go_is_amp', ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) );

}
