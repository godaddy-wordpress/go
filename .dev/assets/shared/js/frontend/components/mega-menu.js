/**
 * Toggle behaviour for the mega-menu walker.
 *
 * Trigger links are produced by the Go\Mega_Menu walker with the
 * attribute `data-go-mega="trigger"`. Panels are the wrapping divs the
 * walker emits with `data-go-mega="panel"`. This module:
 *
 *  - Opens the panel on hover or keyboard focus of the trigger.
 *  - Closes it on Escape and on click/focus outside the menu item.
 *  - Keeps `aria-expanded` in sync.
 */

const TRIGGER_SELECTOR = '[data-go-mega="trigger"]';
const PANEL_SELECTOR = '[data-go-mega="panel"]';
const OPEN_CLASS = 'is-go-mega-open';

/**
 * Find the panel that lives inside the same menu-item as the trigger.
 *
 * @param {HTMLElement} trigger Trigger link.
 * @returns {HTMLElement | null}
 */
function findPanel( trigger ) {
	const item = trigger.closest( 'li' );
	return item ? item.querySelector( PANEL_SELECTOR ) : null;
}

/**
 * Open a panel.
 *
 * @param {HTMLElement} trigger Trigger link.
 * @param {HTMLElement} panel   Associated panel element.
 */
function open( trigger, panel ) {
	panel.hidden = false;
	panel.classList.add( OPEN_CLASS );
	trigger.setAttribute( 'aria-expanded', 'true' );
}

/**
 * Close a panel.
 *
 * @param {HTMLElement} trigger Trigger link.
 * @param {HTMLElement} panel   Associated panel element.
 */
function close( trigger, panel ) {
	panel.hidden = true;
	panel.classList.remove( OPEN_CLASS );
	trigger.setAttribute( 'aria-expanded', 'false' );
}

/**
 * Close every open mega panel on the page.
 */
function closeAll() {
	const triggers = document.querySelectorAll( TRIGGER_SELECTOR );

	triggers.forEach( ( trigger ) => {
		const panel = findPanel( trigger );

		if ( panel ) {
			close( trigger, panel );
		}
	} );
}

/**
 * Wire up the mega-menu behaviour.
 */
export default function megaMenu() {
	const triggers = document.querySelectorAll( TRIGGER_SELECTOR );

	if ( ! triggers.length ) {
		return;
	}

	triggers.forEach( ( trigger ) => {
		const panel = findPanel( trigger );

		if ( ! panel ) {
			return;
		}

		const item = trigger.closest( 'li' );

		item.addEventListener( 'mouseenter', () => open( trigger, panel ) );
		item.addEventListener( 'mouseleave', () => close( trigger, panel ) );

		trigger.addEventListener( 'focus', () => open( trigger, panel ) );

		item.addEventListener( 'keydown', ( event ) => {
			if ( 'Escape' === event.key ) {
				close( trigger, panel );
				trigger.focus();
			}
		} );

		item.addEventListener( 'focusout', ( event ) => {
			if ( ! item.contains( event.relatedTarget ) ) {
				close( trigger, panel );
			}
		} );
	} );

	document.addEventListener( 'click', ( event ) => {
		if ( ! event.target.closest( '.menu-item-has-mega' ) ) {
			closeAll();
		}
	} );
}
