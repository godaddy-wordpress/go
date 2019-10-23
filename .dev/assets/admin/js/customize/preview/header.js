import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'header_variation', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).removeClass( 'has-header-1 has-header-2 has-header-3 has-header-4' )
           			   .addClass( 'has-' + to );
		} );
	} );

	wp.customize( 'header_background_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined ;
			document.querySelector( ':root' ).style.setProperty( '--theme-header--bg', setTo );

			// Add class if a background color is applied.
			if ( to ) {
				$( '.header' ).addClass( 'has-background' );
			} else {
				$( '.header' ).removeClass( 'has-background' );
			}
		} );
	} );

	wp.customize( 'header_text_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined ;
			document.querySelector( ':root' ).style.setProperty( '--theme-site-nav--color', setTo );
			document.querySelector( ':root' ).style.setProperty( '--theme-site-description--color', setTo );
			document.querySelector( ':root' ).style.setProperty( '--theme-search-toggle--color', setTo );
			document.querySelector( ':root' ).style.setProperty( '--theme-site-title--color', setTo );
		} );
	} );
};
