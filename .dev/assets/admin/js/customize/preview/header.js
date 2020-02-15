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
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined ;
			document.querySelector( ':root' ).style.setProperty( '--go-header--color--background', setTo );

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
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined ;
			document.querySelector( ':root' ).style.setProperty( '--go-navigation--color--text', setTo );
			document.querySelector( ':root' ).style.setProperty( '--go-site-description--color--text', setTo );
			document.querySelector( ':root' ).style.setProperty( '--go-search-button--color--text', setTo );
			document.querySelector( ':root' ).style.setProperty( '--go-site-title--color--text', setTo );
		} );
	} );
};
