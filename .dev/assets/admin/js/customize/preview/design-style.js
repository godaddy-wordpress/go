const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'design_style', ( value ) => {
		value.bind( ( to ) => {

			$( '#customize-preview' ).addClass( 'is-loading' );

			if (
				'undefined' !== typeof GoPreviewData['design_styles'] &&
				'undefined' !== GoPreviewData['design_styles'][ to ]
			) {

				setTimeout( function() {
					// wp.customize.previewer.refresh();
					const designStyle = GoPreviewData['design_styles'][ to ];
					$( 'link[id*="design-style"]' ).attr( 'href', designStyle['url'] );

					setTimeout( function() {
						$( '#customize-preview' ).removeClass( 'is-loading' );
					}, 500 );
				}, 500 ); // match the .02s transition time from core
			}
		} );
	} );
};
