/* global GoText */
import getScreenSize from '../utility/get-screen-size.js';
import _throttle from 'lodash/throttle'; // we need an aliast for throttle otherwise it conflicts with customizer

/* Determine if binding established for click, gate additional clicks */
let initialized = false;
let navigation;

/**
 * Site search toggling.
 */
const searchToggle = () => {
	initialized = false;
	navigation = document.querySelector( '.primary-menu' );

	const searchToggle = document.getElementById( 'header__search-toggle' );

	if ( ! searchToggle ) {
		return;
	}

	const searchForm = searchToggle.nextElementSibling;

	const focusableElementsString = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex="0"], [contenteditable]';
	const {body} = document;

	if ( getScreenSize( 'has-search-toggle' ) ) {
		createToggle( searchForm, searchToggle, focusableElementsString );
		body.classList.add( 'has-search-toggle' );
	}

	// Resize listener.
	window.addEventListener( 'resize', _throttle( () => {
		if ( getScreenSize( 'has-search-toggle' ) ) {
			createToggle( searchForm, searchToggle, focusableElementsString );
			searchForm.setAttribute( 'aria-hidden', 'true' );
			body.classList.add( 'has-search-toggle' );
		} else {
			if ( searchToggle.hasAttribute( 'aria-haspopup' ) ) {
				resetToggle( searchForm, searchToggle );
				searchForm.setAttribute( 'aria-hidden', 'false' );
				body.classList.remove( 'has-search-toggle' );

			}
		}
	}, 200 ) );

	// If user clicks outside of form. Let's close it.
	document.addEventListener( 'click', _throttle( ( event ) => {
		let targetElement = event.target;

		do {
			if ( targetElement === searchForm || targetElement === searchToggle || ! searchForm.classList.contains( 'is-open' ) ) {
				return;
			}
			// Traverse the DOM
			targetElement = targetElement.parentNode;
		} while ( targetElement );
		resetToggle( searchForm, searchToggle );
	}, 200 ) );
};

/**
 * Hook up search toggling.
 *
 * @param {string} searchForm Class of search form wrapper.
 * @param {string} searchToggle Class of search form toggle button.
 * @param {string} focusableElementsString Class or attribute list of focusable elements.
 */
const createToggle = ( searchForm, searchToggle, focusableElementsString ) => {
	searchToggle.setAttribute( 'aria-label', GoText.searchLabel );
	searchToggle.setAttribute( 'aria-expanded', 'false' );
	searchToggle.setAttribute( 'aria-haspopup', 'true' );

	searchForm.querySelector( '.search-form__input' ).setAttribute( 'tabindex', '-1' );
	searchForm.querySelector( '.search-input__button' ).setAttribute( 'tabindex', '-1' );

	/* Check initialized gate */
	if ( ! initialized ) {
		searchToggle.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			toggleAriaAttribute( searchForm, 'hidden' );
			toggleAriaAttribute( searchToggle, 'expanded' );
			toggleSearch( searchForm, searchToggle, focusableElementsString );
		} );

		initialized = true;
	}
};

/**
 * Reset all search toggling.
 *
 * @param {string} searchForm Class of search form wrapper.
 * @param {string} searchToggle Class of search form toggle button.
 */
const resetToggle = ( searchForm, searchToggle ) => {
	searchToggle.setAttribute( 'aria-expanded', 'false' );
	searchForm.classList.remove( 'is-open' );
	searchForm.setAttribute( 'aria-hidden', 'true' );

	searchForm.querySelector( '.search-form__input' ).setAttribute( 'tabindex', '-1' );
	searchForm.querySelector( '.search-input__button' ).setAttribute( 'tabindex', '-1' );

	navigation.classList.remove( 'primary-menu--hide-medium' );
};

/**
 * Opens the site search modal and traps keyboard focus
 *
 * @param {string} searchForm Class of search form wrapper.
 * @param {string} searchToggle Class of search form toggle button.
 * @param {string} focusableElementsString Class or attribute list of focusable elements.
 */
const toggleSearch = ( searchForm, searchToggle, focusableElementsString ) => {

	const focusedElementBeforeNav = document.activeElement;

	// Display search block element
	searchForm.classList.toggle( 'is-open' );

	if ( searchForm.classList.contains( 'is-open' ) ) {
		navigation.classList.add( 'primary-menu--hide-medium' );
		searchForm.querySelector( '.search-form__input' ).removeAttribute( 'tabindex' );
		searchForm.querySelector( '.search-input__button' ).removeAttribute( 'tabindex' );
	} else {
		navigation.classList.remove( 'primary-menu--hide-medium' );
		searchForm.querySelector( '.search-form__input' ).setAttribute( 'tabindex', '-1' );
		searchForm.querySelector( '.search-input__button' ).setAttribute( 'tabindex', '-1' );
	}

	// Find all focusable children
	let focusableElements = searchForm.querySelectorAll( focusableElementsString );

	// Trap function
	searchForm.addEventListener( 'keydown', trapTabKey );

	// Convert nodeList to Array
	focusableElements = Array.prototype.slice.call( focusableElements );

	const [firstTabStop] = focusableElements;
	const lastTabStop = focusableElements[focusableElements.length -1];

	firstTabStop.focus();

	/**
	 * @param {event} event The keydown event.
	 */
	function trapTabKey( event ) {
		if ( 9 === event.keyCode ) {
			if ( event.shiftKey ) {
				if ( document.activeElement === searchToggle ) {
					event.preventDefault();
					firstTabStop.focus();
				}
			} else {
				if ( document.activeElement === lastTabStop ) {
					event.preventDefault();
					searchToggle.focus();
				}
			}
		}

		// 'ESC' key
		if ( 27 === event.keyCode ) {
			closeSearchBox();
		}
	}

	/**
	 * Close search box.
	 */
	function closeSearchBox() {
		focusedElementBeforeNav.focus();
	}
};

/**
 * Toggles an element's aria expanded attribute. This is meant to toggle
 * Aria attributes that have boolean values.
 *
 * @param {string} element Associated element.
 * @param {string} attribute Associate Aria attribute.
 */
const toggleAriaAttribute = ( element, attribute ) => {
	const ariaAttribute = `aria-${attribute}`;

	// Check current selector.
	const elementCheck = element.getAttribute( ariaAttribute );

	if ( 'false' === elementCheck ) {
		element.setAttribute( ariaAttribute, 'true' );
	} else {
		element.setAttribute( ariaAttribute, 'false' );
	}
};

export default searchToggle;
