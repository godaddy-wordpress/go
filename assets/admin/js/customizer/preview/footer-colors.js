import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'footer_variation', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).attr( 'data-footer', to );
		} );
	} );

	wp.customize( 'footer_background_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined;
			document.querySelector( ':root' ).style.setProperty( '--theme-footer--bg', setTo );

			// Add class if a background color is applied.
			if ( to ) {
				$( '.site-footer' ).addClass( 'has-background' );
			} else {
				$( '.site-footer' ).removeClass( 'has-background' );
			}
		} );
	} );

	wp.customize( 'footer_social_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined;
			document.querySelector( ':root' ).style.setProperty( '--theme-social--color', setTo );
		} );
	} );

	wp.customize( 'footer_text_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined;
			document.querySelector( ':root' ).style.setProperty( '--theme-footer--color', setTo );
		} );
	} );

	wp.customize( 'footer_heading_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : null;
			document.querySelector( ':root' ).style.setProperty( '--theme-footer-heading--color', setTo );
		} );
	} );
};
