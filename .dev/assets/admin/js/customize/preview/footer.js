import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'footer_variation', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).removeClass( 'has-footer-1 has-footer-2 has-footer-3 has-footer-4' )
           			   .addClass( 'has-' + to );
		} );
	} );

	wp.customize( 'copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright' ).html( to );
		} );
	} );

	wp.customize( 'footer_background_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : undefined;
			document.querySelector( ':root' ).style.setProperty( '--theme-footer--bg', setTo );

			// Add class if a background color is applied.
			if ( to ) {
				$( 'body' ).addClass( 'has-footer-background' );
				$( '.site-footer' ).addClass( 'has-background' );
			} else {
				$( 'body' ).removeClass( 'has-footer-background' );
				$( '.site-footer' ).removeClass( 'has-background' );
			}
		} );
	} );

	wp.customize( 'social_icon_color', ( value ) => {
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
			document.querySelector( ':root' ).style.setProperty( '--theme-footer-nav--color', setTo );
		} );
	} );

	wp.customize( 'footer_heading_color', ( value ) => {
		value.bind( ( to ) => {
			const hsl = hexToHSL( to );
			const setTo = to ? `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` : null;
			document.querySelector( ':root' ).style.setProperty( '--theme-footer-heading--color', setTo );
		} );
	} );

	wp.customize( 'social_icon_facebook', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-facebook' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-facebook' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'social_icon_twitter', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-twitter' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-twitter' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'social_icon_instagram', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-instagram' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-instagram' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'social_icon_linkedin', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-linkedin' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-linkedin' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'social_icon_pinterest', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-pinterest' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-pinterest' ).addClass( 'display-none' );
			}
		} );
	} );
};
