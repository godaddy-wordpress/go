<?php
/**
 * The main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<?php Maverick\page_title(); ?>

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
