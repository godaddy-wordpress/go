<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maverick
 */

?>

<header class="entry-header">
	<h1 class="post__title max-w-base m-0 m-auto text-center"><?php esc_html_e( 'Nothing Found', 'maverick' ); ?></h1>
</header>

<div class="content-area no-results not-found">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) :

		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'maverick' ),
				[
					'a' => [
						'href' => [],
					],
				]
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);

	elseif ( is_search() ) :
		?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try searching again with some different keywords.', 'maverick' ); ?></p>
		<?php
		get_search_form();

	else :
		?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help you out.', 'maverick' ); ?></p>
		<?php
		get_search_form();

	endif;
	?>
</div>
