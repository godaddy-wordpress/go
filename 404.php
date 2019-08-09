<?php
/**
 * The 404 template file
 *
 * @package Maverick
 */

get_header();

?>

<div class="error-404 not-found max-w-base w-full m-auto">
	<header class="entry-header">
		<h1 class="page-title"><?php esc_html_e( 'That page can’t be found.', 'maverick' ); ?></h1>
	</header>
	<div class="page-content">
		<?php get_search_form(); ?>
	</div>
</div>

<?php

get_footer();
