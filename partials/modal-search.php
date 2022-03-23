<?php
/**
 * Displays the search icon and modal
 *
 * @package Go
 */

if ( get_theme_mod( 'remove_search', false ) ) {

	return;

}

?>

<div
	class="search-modal"
	data-modal-target-string=".search-modal"
	aria-expanded="false"
	<?php if ( Go\AMP\is_amp() ) { ?>
		[class]="'search-modal' + ( searchModalActive ? ' show-modal active' : '' )"
		on="tap:AMP.setState( { searchModalActive: false } )"
	<?php } ?>
>

	<div class="search-modal-inner">

		<?php get_search_form(); ?>

	</div><!-- .search-modal-inner -->

</div><!-- .search-modal -->
