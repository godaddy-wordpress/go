import './customize/controls/range-control';

/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

( function() {

	wp.customize.bind( 'ready', function () {

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizerOptionDisplay( parentSetting, affectedControl, values, speed = 100 ) {
			wp.customize( parentSetting, function( setting ) {
				wp.customize.control( affectedControl, function ( control ) {
					/**
					 * Toggle the visibility of a control.
					 */
					const visibility = function() {
						if ( values.includes( setting.get() ) ) {
							control.container.slideDown( speed );
						} else {
							control.container.slideUp( speed );
						}
					};

					visibility();
					setting.bind( visibility );
				} );
			} );
		}

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizerImageOptionDisplay( parentSetting, affectedControl, speed = 100 ) {
			wp.customize( parentSetting, function( setting ) {
				wp.customize.control( affectedControl, function ( control ) {
					/**
					 * Toggle the visibility of a control.
					 */
					const visibility = function() {
						if ( setting.get() && 'none' !== setting.get() && '0' !== setting.get() ) {
							control.container.slideDown( speed );
						} else {
							control.container.slideUp( speed );
						}
					};

					visibility();
					setting.bind( visibility );
				} );
			} );
		}

		// Only show the Footer Header Color selector, if the footer variation is 2 or 4.
		customizerOptionDisplay( 'footer_variation', 'footer_heading_color', [ 'footer-3', 'footer-4' ] );

		// Footer nav locations #2 and #3 are only available on Footer Variation #3 and #4.
		customizerOptionDisplay( 'footer_variation', 'nav_menu_locations[footer-2]', [ 'footer-3', 'footer-4' ] );
		customizerOptionDisplay( 'footer_variation', 'nav_menu_locations[footer-3]', [ 'footer-3', 'footer-4' ] );

		// Only show the following options, if a logo is uploaded.
		customizerImageOptionDisplay( 'custom_logo', 'logo_width' );
		customizerImageOptionDisplay( 'custom_logo', 'logo_width_mobile' );
	} );

} )( jQuery );
