/**
 *
 * @param {function} func Funtion to run against.
 * @param {integer}  wait Amount to wait
 * @param {boolean}  immediate Trigger on leading edge?
 */
const debounce = ( func, wait, immediate ) => {
	let timeout;

	return function() {
		const context = this, args = arguments;

		/**
		 * Later
		 */
		const later = () => {
			timeout = null;
			if ( !immediate ) func.apply( context, args );
		};

		const callNow = immediate && !timeout;

		clearTimeout( timeout );
		timeout = setTimeout( later, wait );
		if ( callNow ) func.apply( context, args );
	};
};

export default debounce;
