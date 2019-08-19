<?php
/**
 * Partial: single.php
 * Display permalinks or full articles
 *
 * @package Maverick
 */

$post_thumbnail_class = ! has_post_thumbnail() ? ' post--no-thumbnail' : '';

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php

	while ( have_posts() ) :

		the_post();

		?>

		<article class="post post--single<?php echo esc_attr( $post_thumbnail_class ); ?>">
			<div class="post__hero">
				<div class="post__hero-inner">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post__thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
					<div class="post__summary">
						<h1 class="post__title"><?php the_title(); ?></h1>
						<span class="post__author"><?php esc_html_e( 'by', 'maverick' ); ?> <?php the_author_posts_link(); ?></span>
					</div>
				</div>
			</div>
			<div class="content-area">
				<?php the_content(); ?>
				<?php comments_template(); ?>
			</div>
		</article>

		<?php

	endwhile;

endif;

get_footer();
