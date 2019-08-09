const $ = jQuery; // eslint-disable-line

export default () => {
	wp.customize( 'design_style', ( value ) => {
		value.bind( ( to ) => {

			if (
				'undefined' !== typeof MaverickPreviewData['design_styles'] &&
				'undefined' !== MaverickPreviewData['design_styles'][ to ]
			) {
				const designStyle = MaverickPreviewData['design_styles'][ to ];
				$( 'link#design-style-css' ).attr( 'href', designStyle['url'] );
			}
		} );
	} );
};
