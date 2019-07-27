<?php
/**
 * content.php
 * Displays each post with an thumb and excerpt.
 *
 * @package Maverick
 */

// Get the excerpt for class wrapping
$excerpt = get_the_excerpt();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'alignwide' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post__thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="post__summary">
		<div class="post__meta">
			<span class="post__categories"><?php the_category( ' | ' ); ?></span>
			<span class="post__author"> • <?php esc_html_e( 'by', 'maverick' ); ?> <?php the_author(); ?></span>
		</div>
		<h2 class="h3 entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p class="post__excerpt">
			<?php echo wp_kses_post( $excerpt ); ?>
		</p>
	</div>
</article>

