<?php
/**
 * The template for displaying the search form.
 *
 * @package Go
 */

?>
<div
id="js-site-search"
class="site-search"
itemscope
itemtype="http://schema.org/WebSite"
<?php if ( Go\AMP\is_amp() ) { ?>
	on="tap:AMP.setState( { searchModalActive: true } )"
<?php } ?>
>
	<form role="search" id="searchform" class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<meta itemprop="target" content="<?php echo esc_url( home_url( '/' ) ); ?>/?s={s}" />
		<label for="search-field">
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'go' ); ?></span>
		</label>
		<input itemprop="query-input" type="search" id="search-field" class="input input--search search-form__input" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'go' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-input__button">
			<span class="search-input__label"><?php echo esc_html_x( 'Submit', 'submit button', 'go' ); ?></span>
			<svg role="img" class="search-input__arrow-icon" width="30" height="28" viewBox="0 0 30 28" fill="inherit" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0)">
					<path d="M16.1279 0L29.9121 13.7842L16.1279 27.5684L14.8095 26.25L26.3378 14.7217H-6.10352e-05V12.8467H26.3378L14.8095 1.31844L16.1279 0Z" fill="inherit"/>
				</g>
				<defs>
					<clipPath id="clip0">
						<rect width="29.9121" height="27.5684" fill="white"/>
					</clipPath>
				</defs>
			</svg>
		</button>
	</form>
</div>
