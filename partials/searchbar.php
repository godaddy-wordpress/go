<?php
/**
 * Additional search bar template
 *
 * @package Maverick
 */

$search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_STRING );

?>
<form role="search" id="searchform" class="search-form search-bar mt-0" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<meta itemprop="target" content="<?php echo esc_url( home_url() ); ?>/?s={s}" />
	<label for="search-form__label">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'maverick' ); ?></span>
	</label>
	<input itemprop="query-input" autocomplete="off" type="search" id="search-field" class="input input--search search-form__input" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'maverick' ); ?>" name="s" value="<?php echo esc_attr( $search_term ); ?>" />
	<button type="submit" class="button--chromeless search-submit">
		<svg class="icon icon-search" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50" style="fill:#000000;">
			<g id="surface1">
				<path style=" " d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z "></path>
			</g>
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'maverick' ); ?></span>
	</button>
</form><!-- #searchform .search-form -->
