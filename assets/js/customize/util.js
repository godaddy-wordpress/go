/**
 * Functions to convert hex color to HSL
 * @param {*} H
 */
export function hexToHSL( H ) {
	// Convert hex to RGB first
	let r = 0,
		g = 0,
		b = 0;
	if ( 4 == H.length ) {
		r = `0x${  H[1]  }${H[1]}`;
		g = `0x${  H[2]  }${H[2]}`;
		b = `0x${  H[3]  }${H[3]}`;
	} else if ( 7 == H.length ) {
		r = `0x${  H[1]  }${H[2]}`;
		g = `0x${  H[3]  }${H[4]}`;
		b = `0x${  H[5]  }${H[6]}`;
	}

	// Then to HSL
	r /= 255;
	g /= 255;
	b /= 255;

	const cmin = Math.min( r, g, b ),
		cmax = Math.max( r, g, b ),
		delta = cmax - cmin;

	let h = 0;
	let	s = 0;
	let l = 0;


	if ( 0 == delta ) h = 0;
	else if ( cmax == r ) h = ( ( g - b ) / delta ) % 6;
	else if ( cmax == g ) h = ( b - r ) / delta + 2;
	else h = ( r - g ) / delta + 4;

	h = Math.round( h * 60 );

	if ( 0 > h ) h += 360;

	l = ( cmax + cmin ) / 2;
	s = 0 == delta ? 0 : delta / ( 1 - Math.abs( 2 * l - 1 ) );
	s = +( s * 100 ).toFixed();
	l = +( l * 100 ).toFixed();

	return [h, s, l];
}
