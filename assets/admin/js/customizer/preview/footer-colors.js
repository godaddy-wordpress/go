const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'footer_variation', ( value ) => {
		value.bind( ( to ) => {
			$( 'body' ).attr( 'data-footer', to );
		} );
	} );

	wp.customize( 'footer_background_color', ( value ) => {
		value.bind( ( to ) => {
			$( '.site-footer' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'footer_text_color', ( value ) => {
		value.bind( ( to ) => {
			$( '.site-footer, .site-footer a, .site-footer .footer-navigation a, .site-info ' ).css( 'color', to );
		} );
	} );

	wp.customize( 'footer_social_color', ( value ) => {
		value.bind( ( to ) => {
			$( '.social-icons__icon svg' ).css( 'fill', to );
		} );
	} );
};
