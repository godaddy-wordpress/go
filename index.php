<?php
/**
 * The main template file
 *
 * @package Maverick
 */

get_header();

Maverick\page_title();

if ( have_posts() ) {

	// Start the Loop.
	while ( have_posts() ) :
		the_post();
		get_template_part( 'partials/content' );
	endwhile;

	// Previous/next page navigation.
	the_posts_navigation();
} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'partials/content', 'none' );
}

get_footer();
