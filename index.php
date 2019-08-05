<?php
/**
 * The main template file
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
			endwhile;
			?>
		<?php endif; ?>
	</div>

<?php
get_footer();
