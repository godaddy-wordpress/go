import { hexToHSL } from '../util';

const $ = jQuery; // eslint-disable-line

export default () => {
	let selectedDesignStyle;

	/**
	 * Set color
	 *
	 * @param {*} color
	 */
	const setColor = ( color, cssVar ) => {
		const hsl = hexToHSL( color );
		document.querySelector( ':root' ).style.setProperty( `${cssVar}`, `${hsl[ 0 ]}, ${hsl[ 1 ]}%, ${hsl[ 2 ]}%` );
	};

	/**
	 * Load the color schemes for the selected design style.
	 */
	const loadColorSchemes = ( colorScheme ) => {
		const designStyle = getDesignStyle( selectedDesignStyle );
		colorScheme = colorScheme.replace( `${selectedDesignStyle}-`, '' );

		if ( 'undefined' !== typeof designStyle.color_schemes[ colorScheme ] && 'undefined' !== typeof wp.customize.settings.controls ) {
			const colors = designStyle.color_schemes[ colorScheme ];
			toggleColorSchemes();

			Object.entries( wp.customize.settings.controls )
				.filter( ( [ _control, config ] ) => config.type === 'color' )
				.forEach( ( [ customizerControl, config ] ) => {
					const customizerSetting = wp.customize( config.settings.default );
					const color = colors[ config.settings.default.replace( '_color', '' ) ] || '';

					customizerSetting.set( color );

					wp.customize.control( customizerControl ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', color )
						.wpColorPicker( 'defaultColor', color )
						.trigger( 'change' );
				} );
		}
	};

	/**
	 * Control the visibility of the color schemes selections.
	 */
	const toggleColorSchemes = () => {
		$( 'label[for^=color_scheme_control]' ).hide();
		$( `label[for^=color_scheme_control-${selectedDesignStyle}-]` ).show();
	};

	/**
	 * Returns the design style array
	 *
	 * @param {*} designStyle
	 */
	const getDesignStyle = ( designStyle ) => {
		if (
			'undefined' !== typeof GoPreviewData['design_styles'] &&
			'undefined' !== GoPreviewData['design_styles'][ designStyle ]
		) {
			return GoPreviewData['design_styles'][ designStyle ];
		}

		return false;
	};

	wp.customize.bind( 'ready', () => toggleColorSchemes() );

	wp.customize( 'design_style', ( value ) => {
		selectedDesignStyle = value.get();
		value.bind( ( to ) => {
			selectedDesignStyle = to;
			loadColorSchemes( 'one' );
			$( `#color_scheme_control-${selectedDesignStyle}-one` ).prop( 'checked', true );
		} );
	} );

	wp.customize( 'color_scheme', ( value ) => {
		value.bind( ( colorScheme ) => loadColorSchemes( colorScheme ) );
	} );

	wp.customize( 'background_color', ( value ) => {
		value.bind( ( to ) => setColor( to, '--theme-color-body-bg' ) );
	} );

	wp.customize( 'primary_color', ( value ) => {
		value.bind( ( to ) => setColor( to, '--theme-color-primary' ) );
	} );

	wp.customize( 'secondary_color', ( value ) => {
		value.bind( ( to ) => setColor( to, '--theme-color-secondary' ) );
	} );

	wp.customize( 'tertiary_color', ( value ) => {
		value.bind( ( to ) => setColor( to, '--theme-color-tertiary' ) );
	} );
};
