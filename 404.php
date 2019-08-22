<?php
/**
 * The 404 template file
 *
 * @package Maverick
 */

get_header();

?>

<div class="error-404 not-found max-w-base w-full m-auto p-x">

	<?php Maverick\page_title(); ?>

	<div class="page-content">
		<?php get_search_form(); ?>
	</div>

</div>

<?php

get_footer();
