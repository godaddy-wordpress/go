<?php
/**
 * Partial: content-none.php
 * Displays content not found.
 *
 * @package Maverick
 */

?>

<h1 class="page__title"><?php esc_html_e( 'Nothing Found', 'maverick' ); ?></h1>

<div class="content-area m-auto">
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

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'maverick' ); ?></p>
		<?php
		get_template_part( 'partials/search' );

	else :
		?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'maverick' ); ?></p>
		<?php
		get_template_part( 'partials/search' );

	endif;
	?>
</div>
