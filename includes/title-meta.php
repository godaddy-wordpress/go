<?php
/**
 * Page Title Meta setup
 *
 * @package Go\Title_Meta
 */

namespace Go\Title_Meta;

/**
 * Set up Title Meta hooks
 *
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'add_meta_boxes', $n( 'page_title_add_metaboxes' ) );

	add_action( 'save_post', $n( 'save_page_title_metabox_data' ) );

	add_filter( 'go_page_title_args', $n( 'hide_page_title' ) );

}

/**
 * Add the page title metabox
 */
function page_title_add_metaboxes() {

	add_meta_box(
		'page_title_checkbox',
		__( 'Title visibility', 'go' ),
		'Go\Title_Meta\page_title_build_metabox',
		'page',
		'side',
		'high'
	);

}

/**
 * Build custom field meta box
 *
 * @return mixed Markup for the page title metabox.
 */
function page_title_build_metabox() {

	global $pagenow;

	$hide_page_title = ( 'post-new.php' === $pagenow ) ? ! get_theme_mod( 'page_titles', true ) : get_post_meta( get_the_ID(), '_hide_page_title', true );

	wp_nonce_field( 'go-hide-page-title', 'page_title_metabox_nonce' );

	?>
	<div class="hide-page-title-meta">
		<p>
			<input type="checkbox" id="hide-page-title-checkbox" name="hide-page-title" value="on"<?php checked( $hide_page_title, 1 ); ?> />
			<label for="hide-page-title-checkbox"><?php esc_html_e( 'Hide page titles when published.', 'go' ); ?></label>
		</p>
	</div>
	<?php

}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function save_page_title_metabox_data( $post_id ) {

	if ( ! isset( $_POST['page_title_metabox_nonce'] ) ) {

		return;

	}

	$page_title_metabox_nonce = filter_var( wp_unslash( $_POST['page_title_metabox_nonce'] ), FILTER_SANITIZE_STRING );

	if (
		! current_user_can( 'edit_post', $post_id ) ||
		! wp_verify_nonce( $page_title_metabox_nonce, 'go-hide-page-title' ) ||
		defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE
	) {

		return;

	}

	update_post_meta( $post_id, '_hide_page_title', isset( $_POST['hide-page-title'] ) );

}

/**
 * Hide page title box
 *
 * @param array $title_data The title data.
 *
 * @return array Filtered title data.
 */
function hide_page_title( $title_data ) {

	if ( is_singular( 'page' ) && get_post_meta( get_the_ID(), '_hide_page_title', true ) ) {

		$title_data['title'] = '';

	}

	return $title_data;

}
