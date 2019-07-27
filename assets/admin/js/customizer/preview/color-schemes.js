import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	let useAlternativeColors;
	let useColorsOverride;
	let selectedPrimaryColor;
	let selectedSecondaryColor;
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
		if ( ! useAlternativeColors ) {
			document.documentElement.style.removeProperty( '--USER-PRIMARY-HUE' );
			document.documentElement.style.removeProperty( '--USER-PRIMARY-SATURATION' );
			document.documentElement.style.removeProperty( '--USER-PRIMARY-LIGHTNESS' );
			document.documentElement.style.removeProperty( '--USER-COLOR-PRIMARY' );

			document.documentElement.style.removeProperty( '--USER-SECONDARY-HUE' );
			document.documentElement.style.removeProperty( '--USER-SECONDARY-SATURATION' );
			document.documentElement.style.removeProperty( '--USER-SECONDARY-LIGHTNESS' );
			document.documentElement.style.removeProperty( '--USER-COLOR-SECONDARY' );
			return false;
		}

		if ( useColorsOverride ) {
			setPrimaryColor( selectedPrimaryColor );
			setSecondaryColor( selectedSecondaryColor );
		} else {
			const designStyle = getDesignStyle( selectedDesignStyle );
			const colors = designStyle.color_schemes[ selectedColorScheme ];
			setPrimaryColor( colors['primary_color'] );
			setSecondaryColor( colors['secondary_color'] );
		}
	};

	wp.customize( 'maverick_alternative_colors', ( value ) => {
		useAlternativeColors = value.get();

		value.bind( ( to ) => {
			useAlternativeColors = to;

			setColors();
		} );
	} );

	wp.customize( 'maverick_design_style', ( value ) => {
		selectedDesignStyle = value.get();

		value.bind( ( to ) => {
			selectedDesignStyle = to;
		} );
	} );

	wp.customize( 'maverick_color_schemes', ( value ) => {
		selectedColorScheme = value.get();
		value.bind( ( colorScheme ) => {
			selectedColorScheme = colorScheme;
			const designStyle = getDesignStyle( selectedDesignStyle );

			if ( useColorsOverride || ! useAlternativeColors ) {
				return;
			}

			if ( 'undefined' !== typeof designStyle.color_schemes[ colorScheme ] ) {
				const colors = designStyle.color_schemes[ colorScheme ];
				setPrimaryColor( colors['primary_color'] );
				setSecondaryColor( colors['secondary_color'] );
			}
		} );
	} );

	wp.customize( 'maverick_color_schemes_override', ( checkbox ) => {
		useColorsOverride = checkbox.get();

		checkbox.bind( ( to ) => {
			useColorsOverride = to;

			setColors();

		} );
	} );

	wp.customize( 'maverick_custom_primary_color', ( value ) => {
		selectedPrimaryColor = value.get();

		value.bind( ( to ) => {
			selectedPrimaryColor = to;

			if ( ! useColorsOverride || ! useAlternativeColors ) {
				return;
			}

			setPrimaryColor( to );
		} );
	} );

	wp.customize( 'maverick_custom_secondary_color', ( value ) => {
		selectedSecondaryColor = value.get();
		value.bind( ( to ) => {
			selectedSecondaryColor = to;

			if ( ! useColorsOverride || ! useAlternativeColors  ) {
				return;
			}
			setSecondaryColor( to );
		} );
	} );
};
