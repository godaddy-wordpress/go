<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Maverick
 */

get_header(); ?>

	<?php Maverick\maverick_page_title(); ?>

	<div class="content-area">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
				wp_link_pages();
			endwhile;
			?>
		<?php endif; ?>
	</div>

<?php
get_footer();
