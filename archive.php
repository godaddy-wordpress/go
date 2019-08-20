<?php
/**
 * File: archive.php (for archives and blog landing).
 *
 * @package Maverick
 */

get_header(); ?>

	<header class="entry-header">
		<?php the_archive_title( '<h1 class="post__title max-w-base m-0 m-auto text-center">', '</h1>' ); ?>
	</header>

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
<?php
get_footer();
