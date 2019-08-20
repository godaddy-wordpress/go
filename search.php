<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Maverick
 */

get_header(); ?>

<header class="entry-header">
	<h1 class="ppost__title max-w-base m-0 m-auto text-center">
		<?php
		/* translators: the search query */
		printf( esc_html__( 'Search for: %s', 'maverick' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
		?>
	</h1>
</header>

<div class="content-area">

	<?php
	if ( have_posts() ) {

		// Start the Loop.
		while ( have_posts() ) :
			the_post();
			get_template_part( 'partials/content', 'excerpt' );
		endwhile;

		// Previous/next page navigation.
		the_posts_navigation();

	} else {

		// If no content, include the "No posts found" template.
		get_template_part( 'partials/content', 'none' );
	}
	?>

</div>

<?php
get_footer();
