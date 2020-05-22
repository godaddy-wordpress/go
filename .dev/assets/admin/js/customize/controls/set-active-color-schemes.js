( function ( $ ) {

	jQuery.wp.wpColorPicker.prototype.options.palettes = goCustomizerControls.activeColorScheme;

	wp.customize( 'color_scheme', ( value ) => {
		value.bind( ( to ) => {
			// 0: design style (eg: modern)
			// 1: color scheme (eg: one, two, three, four etc.)
			let colorSchemeData = to.split( '-' );
			if ( colorSchemeData.legnth < 2 || ! goCustomizerControls.availableDesignStyles.hasOwnProperty( colorSchemeData[0] ) || ! goCustomizerControls.availableDesignStyles[ colorSchemeData[0] ]['color_schemes'].hasOwnProperty( colorSchemeData[1] ) ) {
				return;
			}
			let colorScheme = goCustomizerControls.availableDesignStyles[ colorSchemeData[0] ]['color_schemes'][ colorSchemeData[1] ];
			if ( colorScheme.hasOwnProperty( 'label' ) ) {
				delete( colorScheme['label'] );
			}
			jQuery.wp.wpColorPicker.prototype.options.palettes = Object.values( colorScheme );
		} );
	} );

} )( jQuery );
