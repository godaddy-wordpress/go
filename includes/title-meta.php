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

	add_action( 'add_meta_boxes', $n( 'page_titles_add_meta_boxes' ) );
	add_action( 'admin_enqueue_scripts', $n( 'page_titles_metabox_script' ) );
	add_action( 'save_post', $n( 'page_titles_meta_box_data' ) );
}

/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function page_titles_add_meta_boxes( $post ) {
	add_meta_box(
		'page_title_metabox',
		__( 'Enable page titles', 'go' ),
		'page_title_build_metabox',
		'post',
		'side',
		'high'
	);

}


/**
 * Enqueue the metaboxes script on the post edit screen
 */
function page_titles_metabox_script() {
	global $post_type;

	if ( 'post' !== $post_type ) {

		return;

	}

	wp_enqueue_script(
		'page_titles_metabox_script_enqueue',
		get_stylesheet_directory_uri() . '/includes/title-meta.js',
		array(),
		true,
		true,
	);

}

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function page_title_build_metabox( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'page_titles_metabox_nonce' );

	?>
	<div class='inside'>

		<h3><?php esc_html_e( 'Page titles', 'go' ); ?></h3>
		<p>
			<input type="url" name="page_titles" value="<?php sanitize_text_field( get_post_meta( $post->ID, '_page_titles', true ) ); ?>" />
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
function page_titles_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['page_titles_metabox_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['page_titles_metabox_nonce'], basename( __FILE__ ) ) ) ) ) {

		return;

	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;

	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {

		return;

	}

	if ( isset( $_REQUEST['page_titles'] ) && isset( $_POST['page_titles'] ) ) {

		update_post_meta( $post_id, '_page_titles', sanitize_text_field( wp_unslash( $_POST['page_titles'] ) ) );

	}

}
