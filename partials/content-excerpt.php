<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maverick
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post__thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header max-w-base m-auto px">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', esc_html_x( 'Featured', 'post', 'maverick' ) );
		}

		the_title( sprintf( '<h2 class="entry-title h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
	</header>

	<div class="content-area">
		<?php the_excerpt(); ?>
	</div>

</article>
