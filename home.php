<?php
/**
 * Blog landing page template
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="content-area">

		<h1 class="page-title"><?php single_post_title(); ?></h1>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'partials/content' ); ?>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>
		<?php endif; ?>
	</div><!-- .u-ma-auto .u-max-width-full -->

<?php
get_footer();
