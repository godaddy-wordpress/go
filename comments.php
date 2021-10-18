<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to go_comment() which is
 * located in the functions.php file.
 *
 * @package Go
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

<div class="comments-area__wrapper">
	<div id="comments" class="comments-area max-w-base m-auto">

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
				if ( 1 === get_comments_number() ) {
					printf(
						/* translators: %s: The post title. */
						esc_html__( 'One thought on &ldquo;%s&rdquo;', 'go' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				} else {
					printf(
						esc_attr(
							/* translators: %1$s: The number of comments. %2$s: The post title. */
							_n( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'go' )
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
						'callback' => 'go_comment',
						'style'    => 'ol',
					)
				);
				?>
			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h4 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'go' ); ?></h4>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'go' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'go' ) ); ?></div>
			</nav>
			<?php endif; ?>

			<?php
			/*
			 * If there are no comments and comments are closed, let's leave a note.
			 * But we only want the note on posts and pages that had comments in the first place.
			 */
			if ( ! comments_open() && get_comments_number() ) :
				?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'go' ); ?></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php comment_form(); ?>

	</div>
</div>
