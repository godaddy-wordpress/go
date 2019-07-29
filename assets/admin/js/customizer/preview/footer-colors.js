const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'maverick_footer_background_color_setting', ( value ) => {
		value.bind( ( to ) => {
			$( '#colophon' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'maverick_footer_text_color_setting', ( value ) => {
		value.bind( ( to ) => {
			$( '#colophon, #colophon a' ).css( 'color', to );
		} );
	} );

	wp.customize( 'footer_social_icons_color_setting', ( value ) => {
		value.bind( ( to ) => {
			$( '#colophon .social-icons a' ).css( 'color', to );
		} );
	} );
};
