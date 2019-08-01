<?php
/**
 * Woocommerce main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="content-area content-area--woocommerce m-auto m-w-full">
		<?php woocommerce_content(); ?>
	</div>

<?php
get_footer();
