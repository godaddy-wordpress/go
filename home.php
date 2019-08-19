<?php
/**
 * Blog landing page template
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="content-area">

		<?php single_post_title( '<h1 class="page-title">', '</h1>' ); ?>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'partials/content' ); ?>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>
		<?php endif; ?>
	</div>

<?php
get_footer();
