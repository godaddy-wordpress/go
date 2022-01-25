<?php
/**
 * Go functions and definitions
 *
 * @package Go Child
 */

/**
 * Theme constants.
 */
define( 'GO_CHILD_VERSION', '1.0.0' );

/**
 * Theme scripts and styles.
 */
function go_child_scripts() {
    wp_enqueue_style(
        'go-child-style',
        get_stylesheet_uri(),
        array( 'go-style' ),
        GO_CHILD_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'go_child_scripts' );