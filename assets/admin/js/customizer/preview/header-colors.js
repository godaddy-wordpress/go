import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'maverick_header_variation_setting', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).attr( 'data-header', to );
		} );
	} );

	wp.customize( 'maverick_header_background_color_setting', ( value ) => {
		value.bind( ( to ) => {
			$( '.site-header' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'maverick_header_text_color_setting', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			document.querySelector( '.c-primary-menu' ).style.setProperty( '--theme-primary-menu-link-color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( '.site-branding' ).style.setProperty( '--theme-link-color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( '.site-branding' ).style.setProperty( '--theme-site-branding-text-color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
		} );
	} );
};
