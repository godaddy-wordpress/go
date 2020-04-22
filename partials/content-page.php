<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Go
 */

?>

<?php if ( has_post_thumbnail() ) : ?>
	<figure class="post__thumbnail">
		<?php the_post_thumbnail(); ?>
	</figure>
<?php endif; ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php Go\page_title(); ?>

	<div class="<?php Go\content_wrapper_class( 'content-area__wrapper' ); ?>">
		<div class="content-area entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
	</div>

</article>
