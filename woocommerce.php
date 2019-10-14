<?php
/**
 * WooCommerce main template file
 *
 * @package Go
 */

get_header(); ?>

	<div class="max-w-wide w-full m-auto px content-area--woocommerce">
		<?php woocommerce_content(); ?>
	</div>

<?php
get_footer();
