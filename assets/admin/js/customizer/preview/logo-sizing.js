export default () => {
	/**
	 * Set Logo width.
	 *
	 * @param {*} width
	 */
	const setLogoWidth = ( width ) => {
		document.documentElement.style.setProperty( '--theme-site-logo--width', width ? `${width}px` : 'none' );
	};

	/**
	 * Set Logo mobile width.
	 *
	 * @param {*} width
	 */
	const setLogoMobileWidth = ( width ) => {
		document.documentElement.style.setProperty( '--theme-site-logo--width-mobile', width ? `${width}px` : 'none' );
	};

	wp.customize( 'logo_width', ( value ) => {
		value.bind( ( to ) => setLogoWidth( to ) );
	} );

	wp.customize( 'logo_width_mobile', ( value ) => {
		value.bind( ( to ) => setLogoMobileWidth( to ) );
	} );
};
