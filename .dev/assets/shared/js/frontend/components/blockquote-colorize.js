/**
* @function blockquoteColorize
* Used to wrap all blockquotes without backgrounds in class identifier
* allowing each to inherit the main theme color.
*/
const blockquoteColorize = () =>  {
	// Only play design style applies
	if ( !document.body.classList.contains( 'is-play' ) ) return;

	// Cache blockquotes
	const blockquotes = document.getElementsByTagName( 'blockquote' );

	// Apply has-theme-background class to column parents only
	for( const el of blockquotes ) {
		const parent = el.parentElement;
		if( !parent.classList.contains( 'has-background' ) && parent.classList.contains( 'wp-block-coblocks-column__inner' ) ) {
			parent.classList.add( 'has-theme-background' );
		}
	}
};

export default blockquoteColorize;
