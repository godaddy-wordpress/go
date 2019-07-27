<?php
/**
 * single.php (for permalinks or full articles)
 *
 * @package Maverick
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="post post--single<?php if ( ! has_post_thumbnail() ) { ?> post--no-thumbnail<?php } ?>">
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
			<div class="content-area u-ma-auto u-max-width-base">
				<?php the_content(); ?>
				<?php comments_template(); ?>
			</div><!-- .u-ma-auto .u-max-width-full -->
		</article>
	<?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
