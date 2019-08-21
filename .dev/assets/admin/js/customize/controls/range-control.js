( function ( $, api ) {

	api.bind( 'ready', function () {
		$( '.range_control__reset' ).on( 'click', function () {
			const rangeContainer = $( this ).parent();

			const rangeInput   = rangeContainer.find( 'input[data-input-type="range"]' );
			const controlValue = rangeContainer.find( '.range_control__value' );

			const defaultValue = rangeInput.data( 'default-value' );

			rangeInput.val( defaultValue );
			controlValue.find( 'span' ).html( defaultValue );
			controlValue.find( 'input' ).val( defaultValue );

			const customizeSetting = controlValue.find( 'input' ).data( 'customize-setting-link' );
			wp.customize.control( customizeSetting ).setting.set( defaultValue );
		} );
	} );

} )( jQuery, wp.customize );
