<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Go
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_singular() && has_post_thumbnail() ) : ?>
		<div class="post__thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header max-w-base m-auto px">

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="post__title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="post__title h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>

		<div class="post__meta">

			<span class="post__categories"><?php the_category( ' | ' ); ?></span>

			<span class="post__author"><?php esc_html_e( 'by', 'go' ); ?> <?php the_author(); ?></span>

			<?php
			if ( is_singular() && get_the_tag_list() ) {
				the_tags(
					sprintf(
						'<span class="post__tags"><span class="screen-reader-text">%s</span> ',
						esc_html_e( 'Tags:', 'go' )
					),
					', ',
					'</span>'
				);
			}
			?>

		</div>

	</header>

	<div class="content-area">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'go' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages();
		?>
	</div>

</article>
