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

	wp.customize( 'footer_social_facebook', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-facebook' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-facebook' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'footer_social_twitter', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-twitter' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-twitter' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'footer_social_instagram', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-instagram' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-instagram' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'footer_social_linkedin', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-linkedin' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-linkedin' ).addClass( 'display-none' );
			}
		} );
	} );

	wp.customize( 'footer_social_pinterest', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '.social-icon-pinterest' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-pinterest' ).addClass( 'display-none' );
			}
		} );
	} );
};
