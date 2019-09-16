<?php
/**
 * Partial: single.php
 * Display permalinks or full articles
 *
 * @package Go
 */

get_header();

// Start the Loop.
while ( have_posts() ) :
	the_post();
	get_template_part( 'partials/content' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile;

get_footer();
