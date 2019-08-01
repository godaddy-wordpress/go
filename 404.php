<?php
/**
 * The 404 template file
 *
 * @package Maverick
 */

get_header(); ?>

	<div id="content" class="content-area">
		<section class="error-404 not-found center-align">
			<header class="entry-header">
				<h1 class="post__title"><?php esc_html_e( '404', 'maverick' ); ?></h1>
				<h2 class="h2"><?php esc_html_e( 'This isn’t what you’re looking for.', 'maverick' ); ?></h2>
			</header>
			<div class="page-content container--sml">
				<?php get_search_form(); ?>
			</div>
		</section>
	</div>

<?php
get_footer();
