<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maverick
 */

?>

<?php if ( has_post_thumbnail() ) : ?>
	<figure class="post__thumbnail">
		<?php the_post_thumbnail(); ?>
	</figure>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php Maverick\page_title(); ?>

	<div class="content-area">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>

</article>
