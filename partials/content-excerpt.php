<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Go
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_singular() && has_post_thumbnail() ) : ?>
		<div class="post__thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header max-w-base m-auto px">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', esc_html_x( 'Featured', 'post', 'go' ) );
		}

		the_title( sprintf( '<h2 class="entry-title h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>

		<?php if ( ! is_search() ) { ?>

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

		<?php } ?>

	</header>

	<div class="content-area">
		<?php the_excerpt(); ?>
	</div>

</article>
