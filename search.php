<?php
/**
 * The template for displaying search results pages.
 *
 * @package Maverick
 */

get_header(); ?>

<header class="entry-header">
	<h1 class="post__title">
	<?php
	/* translators: the search query */
	printf( esc_html__( 'Search for: %s', 'tenup' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
	?>
	</h1>
</header>

<div class="content-area m-auto">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'partials/content', 'search' ); ?>
		<?php endwhile; ?>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<?php get_template_part( 'partials/content', 'none' ); ?>
	<?php endif; ?>

</div>

<?php
get_footer();
