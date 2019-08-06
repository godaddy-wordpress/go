/**
 * Use pseudo-element content to get breakpoints.
 * See: shared/css/config/media-queries.css
 *
 * @param {string} sizeString
 */
const getScreenSize = ( sizeString ) => {
	const size = window.getComputedStyle( document.body, ':before' ).getPropertyValue( 'content' );

	if ( size && -1 !== size.indexOf( sizeString ) ) {
		return true;
	}
};

export default getScreenSize;
