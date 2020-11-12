<?php
/**
 * WP Theme pluggable functions
 *
 * @package Go
 */

if ( ! function_exists( 'go_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own go_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param string $comment Comment text.
	 * @param array  $args    Array of arguments.
	 * @param int    $depth   Depth of comments to show.
	 */
	function go_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
		<li <?php comment_class(); ?> id="comment-<?php esc_attr( comment_ID() ); ?>">
		<p><?php esc_html_e( 'Pingback:', 'go' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'go' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default:
				// Proceed with normal comments.
				global $post;
				?>
		<li <?php comment_class(); ?> id="li-comment-<?php esc_attr( comment_ID() ); ?>">
		<article id="comment-<?php esc_attr( comment_ID() ); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf(
						'<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'go' ) . '</span>' : ''
					);
					printf(
						'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						esc_html( get_comment_time( 'c' ) ),
						/* translators: 1: date, 2: time */
						sprintf( esc_html__( '%1$s at %2$s', 'go' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) )
					);
				?>
				</header><!-- .comment-meta -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'go' ); ?></p>
			<?php endif; ?>

				<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'go' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->

				<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => __( 'Reply', 'go' ),
							'after'      => ' <span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						)
					)
				);
				?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
				<?php

		endswitch; // end comment_type check.
	}
endif;
