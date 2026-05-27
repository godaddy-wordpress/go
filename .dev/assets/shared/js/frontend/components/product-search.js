/**
 * Live product search component for the Go theme.
 *
 * Watches any element matching `.js-go-product-search` and renders a
 * dropdown of product suggestions returned by the
 * `/wp-json/go/v1/product-search` REST endpoint.
 *
 * Markup expected on the page:
 *
 *   <div class="go-product-search">
 *     <input type="search" class="js-go-product-search" />
 *   </div>
 *
 * The component creates the suggestion list lazily, debounces requests,
 * and aborts in-flight requests when the user keeps typing.
 */

import debounce from '../utility/debounce';

const INPUT_SELECTOR = '.js-go-product-search';
const ROOT_CLASS = 'go-product-search';
const RESULTS_CLASS = 'go-product-search__results';
const ITEM_CLASS = 'go-product-search__item';

/**
 * Resolve the REST namespace base for this site. WordPress exposes it on
 * `window.wpApiSettings` whenever any block-editor script enqueued it,
 * but a classic-theme frontend cannot rely on it, so we fall back to
 * the well-known `/wp-json/` prefix that's enabled by default.
 *
 * @returns {string}
 */
function getEndpoint() {
	const root =
		( window.wpApiSettings && window.wpApiSettings.root ) ||
		`${ window.location.origin }/wp-json/`;

	return `${ root.replace( /\/$/, '' ) }/go/v1/product-search`;
}

/**
 * Build the suggestion container that sits below the input.
 *
 * @returns {HTMLElement}
 */
function buildResultsContainer() {
	const list = document.createElement( 'ul' );

	list.className = RESULTS_CLASS;
	list.setAttribute( 'role', 'listbox' );
	list.hidden = true;

	return list;
}

/**
 * Render a single product hit into the results list.
 *
 * @param {Object} product Product payload from the REST endpoint.
 * @returns {HTMLElement}
 */
function renderItem( product ) {
	const item = document.createElement( 'li' );

	item.className = ITEM_CLASS;
	item.setAttribute( 'role', 'option' );

	const link = document.createElement( 'a' );
	link.href = product.url;
	link.className = `${ ITEM_CLASS }-link`;

	if ( product.thumbnail ) {
		const img = document.createElement( 'img' );
		img.src = product.thumbnail;
		img.alt = '';
		img.loading = 'lazy';
		img.className = `${ ITEM_CLASS }-thumb`;
		link.appendChild( img );
	}

	const body = document.createElement( 'span' );
	body.className = `${ ITEM_CLASS }-body`;

	const title = document.createElement( 'span' );
	title.className = `${ ITEM_CLASS }-title`;
	title.textContent = product.title;
	body.appendChild( title );

	if ( product.price_html ) {
		const price = document.createElement( 'span' );
		price.className = `${ ITEM_CLASS }-price`;
		price.innerHTML = product.price_html;
		body.appendChild( price );
	}

	if ( ! product.in_stock ) {
		const stock = document.createElement( 'span' );
		stock.className = `${ ITEM_CLASS }-stock`;
		stock.textContent = ( window.wp && window.wp.i18n && window.wp.i18n.__ )
			? window.wp.i18n.__( 'Out of stock', 'go' )
			: 'Out of stock';
		body.appendChild( stock );
	}

	link.appendChild( body );
	item.appendChild( link );

	return item;
}

/**
 * Render the dropdown contents.
 *
 * @param {HTMLUListElement} list    Suggestions container.
 * @param {Object[]}         results Result payload.
 */
function renderResults( list, results ) {
	list.innerHTML = '';

	if ( ! results.length ) {
		const empty = document.createElement( 'li' );
		empty.className = `${ ITEM_CLASS } ${ ITEM_CLASS }--empty`;
		empty.setAttribute( 'role', 'option' );
		empty.textContent = ( window.wp && window.wp.i18n && window.wp.i18n.__ )
			? window.wp.i18n.__( 'No products match.', 'go' )
			: 'No products match.';
		list.appendChild( empty );
		list.hidden = false;
		return;
	}

	results.forEach( ( product ) => {
		list.appendChild( renderItem( product ) );
	} );

	list.hidden = false;
}

/**
 * Bind a single input to the live search behaviour.
 *
 * @param {HTMLInputElement} input Target input.
 */
function bindInput( input ) {
	const wrapper = input.closest( `.${ ROOT_CLASS }` ) || input.parentNode;
	const list = buildResultsContainer();
	wrapper.appendChild( list );

	let controller = null;

	const run = debounce( async ( query ) => {

		if ( controller ) {
			controller.abort();
		}

		controller = new AbortController();

		try {
			const url = `${ getEndpoint() }?q=${ encodeURIComponent( query ) }`;
			const response = await fetch( url, { signal: controller.signal } );

			if ( ! response.ok ) {
				return;
			}

			const payload = await response.json();
			renderResults( list, payload.results || [] );
		} catch ( error ) {
			if ( 'AbortError' !== error.name ) {
				// Swallow network errors; the input still functions as a regular search box.
			}
		}
	}, 220 );

	input.addEventListener( 'input', () => {
		const query = input.value.trim();

		if ( 2 > query.length ) {
			list.hidden = true;
			list.innerHTML = '';
			return;
		}

		run( query );
	} );

	input.addEventListener( 'blur', () => {
		// Delay so a click on a result can still register before the list hides.
		window.setTimeout( () => {
			list.hidden = true;
		}, 150 );
	} );

	input.addEventListener( 'keydown', ( event ) => {
		if ( 'Escape' === event.key ) {
			list.hidden = true;
		}
	} );
}

/**
 * Initialise the component.
 */
export default function productSearch() {
	const inputs = document.querySelectorAll( INPUT_SELECTOR );

	if ( ! inputs.length ) {
		return;
	}

	inputs.forEach( bindInput );
}
