<?php
/**
 * WooCommerce main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="max-w-wide w-full m-auto px">
		<?php woocommerce_content(); ?>
	</div>

<?php
get_footer();
