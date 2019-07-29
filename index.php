<?php
/**
 * The main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<?php if ( ! is_front_page() ) { ?>

		<header class="entry-header">
			<?php the_title( '<h1 class="post__title">', '</h1>' ); ?>
		</header>

	<?php } ?>

	<div id="content" class="content-area">
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
