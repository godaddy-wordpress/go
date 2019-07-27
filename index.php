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

	<div class="content-area u-ma-auto">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- .u-ma-auto .u-max-width-full -->

<?php
get_footer();
