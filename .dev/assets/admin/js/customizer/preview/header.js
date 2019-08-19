import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'header_variation', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).attr( 'data-header', to );
		} );
	} );

	wp.customize( 'header_background_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined ;
			document.querySelector( ':root' ).style.setProperty( '--theme-header--bg', setTo );

			// Add class if a background color is applied.
			if ( to ) {
				$( '.site-header' ).addClass( 'has-background' );
			} else {
				$( '.site-header' ).removeClass( 'has-background' );
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
