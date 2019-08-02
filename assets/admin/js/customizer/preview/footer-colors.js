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
			if ( to ) {
				document.querySelector( ':root' ).style.setProperty( '--theme-footer--bg', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
				$( '.site-footer' ).addClass( 'has-background' );
			} else {
				document.querySelector( ':root' ).style.setProperty( '--theme-footer--bg', undefined );
				$( '.site-footer' ).removeClass( 'has-background' );
			}
		} );
	} );

	wp.customize( 'footer_social_color', ( value ) => {
		value.bind( ( to ) => {
			$( '.social-icons__icon svg' ).css( 'fill', to );
		} );
	} );

	wp.customize( 'footer_text_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			document.querySelector( ':root' ).style.setProperty( '--theme-footer--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
		} );
	} );

	wp.customize( 'footer_heading_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			document.querySelector( ':root' ).style.setProperty( '--theme-footer-heading--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
		} );
	} );
};
