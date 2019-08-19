<?php
/**
 * Partial: content-search.php
 * Displays each search result with an thumb and excerpt.
 *
 * @package Maverick
 */

// Get the excerpt for class wrapping.
$excerpt              = get_the_excerpt();
$post_thumbnail_class = ! has_post_thumbnail() ? ' post--no-thumbnail' : '';

?>

<article itemscope itemtype="https://schema.org/Thing" class="post post--archive<?php echo esc_attr( $post_thumbnail_class ); ?>">
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
		<p class="post__excerpt">
			<?php echo wp_kses_post( $excerpt ); ?>
		</p>
	</div>
</article>
