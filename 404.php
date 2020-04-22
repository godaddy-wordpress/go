<?php
/**
 * The 404 template file
 *
 * @package Go
 */

get_header();

Go\page_title();
?>

<div class="content-area__wrapper">
	<div class="content-area entry-content not-found w-full m-auto p-x">
		<?php get_search_form(); ?>
	</div>
</div>

<?php
get_footer();
