<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Maverick
 */

get_header();

Maverick\page_title();

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

get_footer();
