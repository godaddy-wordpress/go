import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	let selectedDesignStyle;

	/**
	 * Set primary color
	 *
	 * @param {*} color
	 */
	const setPrimaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--theme-color-primary', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set secondary color
	 *
	 * @param {*} color
	 */
	const setSecondaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--theme-color-secondary', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set tertiary color
	 *
	 * @param {*} color
	 */
	const setTertiaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--theme-color-tertiary', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Returns the design style array
	 *
	 * @param {*} designStyle
	 */
	const getDesignStyle = ( designStyle ) => {
		if (
			'undefined' !== typeof MaverickPreviewData['design_styles'] &&
			'undefined' !== MaverickPreviewData['design_styles'][ designStyle ]
		) {
			return MaverickPreviewData['design_styles'][ designStyle ];
		}

		return false;
	};

	wp.customize( 'maverick_design_style', ( value ) => {
		selectedDesignStyle = value.get();
		value.bind( ( to ) => {
			selectedDesignStyle = to;
		} );
	} );

	wp.customize( 'color_scheme', ( value ) => {
		value.bind( ( colorScheme ) => {
			const designStyle = getDesignStyle( selectedDesignStyle );

			if ( 'undefined' !== typeof designStyle.color_schemes[ colorScheme ] ) {
				const colors = designStyle.color_schemes[ colorScheme ];

				Object.entries( colors ).forEach( function ( [ setting, color ] ) {
					const customizerSetting = wp.customize( `${setting}` );

					if ( 'label' === setting || 'undefined' === typeof customizerSetting || 'undefined' === typeof wp.customize.control ) {
						return;
					}

					customizerSetting.set( color );

					wp.customize.control( `${setting}_control` ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color );
				} );
			}
		} );
	} );

	wp.customize( 'primary_color', ( value ) => {
		value.bind( ( to ) => setPrimaryColor( to ) );
	} );

	wp.customize( 'secondary_color', ( value ) => {
		value.bind( ( to ) => setSecondaryColor( to ) );
	} );

	wp.customize( 'tertiary_color', ( value ) => {
		value.bind( ( to ) => setTertiaryColor( to ) );
	} );
};
