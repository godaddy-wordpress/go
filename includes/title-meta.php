<?php
/**
 * Page Title Meta setup
 *
 * @package Go\TitleMeta
 */

namespace Go\TitleMeta;

/**
 * Set up Title Meta hooks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'add_meta_boxes', $n( 'page_title_add_meta_boxes' ) );
	add_action( 'save_post', $n( 'page_title_meta_box_data' ) );
	add_action( 'wp_enqueue_scripts', $n( 'page_title_metabox_script' ) );

}

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function page_title_add_meta_boxes( $post ) {
	add_meta_box(
		'page_title_checkbox',
		__( 'Enable page title', 'go' ),
		'Go\TitleMeta\\page_title_build_metabox',
		'page',
		'side',
		'high'
	);

}


/**
 * Enqueue the metaboxes script on the post edit screen
 */
function page_title_metabox_script() {
	global $post;

	if (
		isset( $post ) &&
		'page' === $post->post_type &&
		! get_post_meta( $post->ID, '_page_title', true )
	) {

		wp_enqueue_script(
			'page_title_metabox_script_enqueue',
			get_theme_file_uri( 'dist/js/title-meta.js' ),
			array( 'jquery' ),
			true,
			true,
		);

	}

}

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function page_title_build_metabox( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'page_title_metabox_nonce' );

	?>
	<div class='page-title-meta'>
		<p>
			<input type="checkbox" id="page-title-checkbox" name="page-title" value="on" <?php checked( get_post_meta( $post->ID, '_page_title', true ), 1 ); ?> />
			<label for="page-title-checkbox"> Show page title on published page.</label><br>
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
function page_title_meta_box_data( $post_id ) {

	$page_title_metabox_nonce = filter_input( INPUT_POST, 'page_title_metabox_nonce', FILTER_SANITIZE_STRING );

	if ( ! $page_title_metabox_nonce || ! wp_verify_nonce( $page_title_metabox_nonce, basename( __FILE__ ) ) ) {

		return;

	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;

	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {

		return;

	}

	update_post_meta( $post_id, '_page_title', filter_input( INPUT_POST, 'page-title', FILTER_VALIDATE_BOOLEAN ) );

}
