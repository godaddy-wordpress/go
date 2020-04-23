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
	add_filter( 'go_page_title_args', $n( 'hide_page_title' ) );
}

/**
 * Hide page title box
 *
 * @param title_data $title_data The title data.
 * @return title_data $title_data Filtered title data.
 */
function hide_page_title( $title_data ) {
	if ( ! is_singular( 'page' ) || ! get_post_meta( get_the_ID(), '_page_title', true ) ) {
		return $title_data;
	} else {
		$title_data['title'] = '';
		return $title_data;
	}
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
		__( 'Hide page title', 'go' ),
		'Go\TitleMeta\\page_title_build_metabox',
		'page',
		'side',
		'high'
	);

}

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function page_title_build_metabox( $post ) {
	$label = __( 'Hide page title when published.', 'go' );
	wp_nonce_field( basename( __FILE__ ), 'page_title_metabox_nonce' );

	?>
	<div class='page-title-meta'>
		<p>
			<input type="checkbox" id="page-title-checkbox" name="page-title" value="on" <?php checked( get_post_meta( $post->ID, '_page_title', true ), 1 ); ?> />
			<label for="page-title-checkbox"> <?php echo( esc_html( $label ) ); ?> </label><br>
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
