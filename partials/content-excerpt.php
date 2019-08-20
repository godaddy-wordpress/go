<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maverick
 */

?>

<article itemscope itemtype="https://schema.org/Thing" class="post post--archive">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post__thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="post__summary">
		<h2 class="h3 post__title">
			<span itemprop="name">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</span>
		</h2>
		<div class="content-area">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
