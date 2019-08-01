import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	let selectedDesignStyle;
	let selectedColorScheme;

	/**
	 * Set primary color
	 *
	 * @param {*} color
	 */
	const setPrimaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--USER-PRIMARY-HUE', hsl[0] );
		document.documentElement.style.setProperty( '--USER-PRIMARY-SATURATION', hsl[1] );
		document.documentElement.style.setProperty( '--USER-PRIMARY-LIGHTNESS', hsl[2] );
		document.documentElement.style.setProperty( '--USER-COLOR-PRIMARY', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set secondary color
	 *
	 * @param {*} color
	 */
	const setSecondaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--USER-SECONDARY-HUE', hsl[0] );
		document.documentElement.style.setProperty( '--USER-SECONDARY-SATURATION', hsl[1] );
		document.documentElement.style.setProperty( '--USER-SECONDARY-LIGHTNESS', hsl[2] );
		document.documentElement.style.setProperty( '--USER-COLOR-SECONDARY', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set tertiary color
	 *
	 * @param {*} color
	 */
	const setTertiaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--USER-TERTIARY-HUE', hsl[0] );
		document.documentElement.style.setProperty( '--USER-TERTIARY-SATURATION', hsl[1] );
		document.documentElement.style.setProperty( '--USER-TERTIARY-LIGHTNESS', hsl[2] );
		document.documentElement.style.setProperty( '--USER-COLOR-TERTIARY', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set quaternary color
	 *
	 * @param {*} color
	 */
	const setQuaternaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--USER-QUATERNARY-HUE', hsl[0] );
		document.documentElement.style.setProperty( '--USER-QUATERNARY-SATURATION', hsl[1] );
		document.documentElement.style.setProperty( '--USER-QUATERNARY-LIGHTNESS', hsl[2] );
		document.documentElement.style.setProperty( '--USER-COLOR-QUATERNARY', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
	};

	/**
	 * Set quinary color
	 *
	 * @param {*} color
	 */
	const setQuinaryColor = ( color ) => {
		const hsl = hexToHSL( color );
		document.documentElement.style.setProperty( '--USER-QUINARY-HUE', hsl[0] );
		document.documentElement.style.setProperty( '--USER-QUINARY-SATURATION', hsl[1] );
		document.documentElement.style.setProperty( '--USER-QUINARY-LIGHTNESS', hsl[2] );
		document.documentElement.style.setProperty( '--USER-COLOR-QUINARY', `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%` );
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

	/**
	 * Set the colors
	 */
	const setColors = () => {
		const designStyle = getDesignStyle( selectedDesignStyle );
		const colors = designStyle.color_schemes[ selectedColorScheme ];

		setPrimaryColor( colors['primary_color'] );
		setSecondaryColor( colors[ 'secondary_color' ] );
		setTertiaryColor( colors[ 'tertiary_color' ] );
		setQuaternaryColor( colors[ 'quaternary_color' ] );
		setQuinaryColor( colors[ 'quinary_color' ] );
	};

	wp.customize( 'maverick_design_style', ( value ) => {
		selectedDesignStyle = value.get();
		value.bind( ( to ) => {
			selectedDesignStyle = to;
		} );
	} );

	wp.customize( 'maverick_color_schemes', ( value ) => {
		value.bind( ( colorScheme ) => {
			selectedColorScheme = colorScheme;
			setColors();
		} );
	} );

	wp.customize( 'maverick_custom_primary_color', ( value ) => {
		value.bind( ( to ) => {
			setPrimaryColor( to );
		} );
	} );

	wp.customize( 'maverick_custom_secondary_color', ( value ) => {
		value.bind( ( to ) => {
			setSecondaryColor( to );
		} );
	} );

	wp.customize( 'maverick_custom_tertiary_color', ( value ) => {
		value.bind( ( to ) => {
			setTertiaryColor( to );
		} );
	} );

	wp.customize( 'maverick_custom_quaternary_color', ( value ) => {
		value.bind( ( to ) => {
			setQuaternaryColor( to );
		} );
	} );

	wp.customize( 'maverick_custom_quinary_color', ( value ) => {
		value.bind( ( to ) => {
			setQuinaryColor( to );
		} );
	} );
};
