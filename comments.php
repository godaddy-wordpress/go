<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to maverick_comment() which is
 * located in the functions.php file.
 *
 * @package maverick
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			if ( 1 === get_comments_number() ) {
				printf(
					/* translators: %s: The post title. */
					esc_html__( 'One thought on &ldquo;%s&rdquo;', 'maverick' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					esc_attr(
						/* translators: %1$s: The number of comments. %2$s: The post title. */
						_n( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'maverick' )
					),
					esc_html( number_format_i18n( get_comments_number() ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="commentlist">
			<?php
			wp_list_comments(
				array(
					'callback' => 'maverick_comment',
					'style'    => 'ol',
				)
			);
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'maverick' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html_e( '&larr; Older Comments', 'maverick' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html_e( 'Newer Comments &rarr;', 'maverick' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation. ?>

		<?php

		/*
		 * If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) :
			?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'maverick' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments(). ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->
