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
			document.querySelector( ':root' ).style.setProperty( '--theme-header--bg', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
		} );
	} );

	wp.customize( 'maverick_header_text_color_setting', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			document.querySelector( '.c-primary-menu' ).style.setProperty( '--theme-site-nav--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( '.site-branding' ).style.setProperty( '--theme-link-color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( ':root' ).style.setProperty( '--theme-site-description--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( '.site-search__toggle' ).style.setProperty( '--theme-search-toggle--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
			document.querySelector( '.site-branding__title' ).style.setProperty( '--theme-site-title--color', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
		} );
	} );
};
