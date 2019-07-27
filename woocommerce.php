<?php
/**
 * Woocommerce main template file
 *
 * @package Maverick
 */

get_header(); ?>

	<div class="content-area content-area--woocommerce u-ma-auto u-max-width-full">
		<?php woocommerce_content(); ?>
	</div><!-- .u-ma-auto .u-max-width-full -->

<?php
get_footer();
