<?php
/**
 * WooCommerce main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="content-area content-area--woocommerce max-w-wide w-full m-auto">
		<?php woocommerce_content(); ?>
	</div>

<?php
get_footer();
