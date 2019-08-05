/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

( function() {

	wp.customize.bind( 'ready', function() {

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizerOptionDisplay( parentSetting, affectedControl, value, valueAlt = null, speed ) {
			wp.customize( parentSetting, function( setting ) {
				wp.customize.control( affectedControl, function ( control ) {
					/**
					 * Toggle the visibility of a control.
					 */
					const visibility = function() {
						if ( value == setting.get() ) {
							control.container.slideDown( speed );
						} else if( valueAlt == setting.get() )  {
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
		// function customizerImageOptionDisplay( parentSetting, affectedControl, speed ) {
		// 	wp.customize( parentSetting, function( setting ) {
		// 		wp.customize.control( affectedControl, function ( control ) {
		// 			/**
		// 			 * Toggle the visibility of a control.
		// 			 */
		// 			const visibility = function() {
		// 				if ( setting.get() && 'none' !== setting.get() && '0' !== setting.get() ) {
		// 					control.container.slideDown( speed );
		// 				} else {
		// 					control.container.slideUp( speed );
		// 				}
		// 			};

		// 			visibility();
		// 			setting.bind( visibility );
		// 		} );
		// 	} );
		// }

		// Only show the Footer Header Color selector, if the footer variation is 2 or 4.
		customizerOptionDisplay( 'footer_variation', 'footer_heading_color', 'footer-2', 'footer-4', 100 );

		// Only show the following options, if a logo is uploaded. @todo, bake these in with the future Custom Logo width controls
		// customizerImageOptionDisplay( 'custom_logo', 'custom_logo_max_width', 100 );
		// customizerImageOptionDisplay( 'custom_logo', 'custom_logo_mobile_max_width', 100 );
	} );

} )( jQuery );
