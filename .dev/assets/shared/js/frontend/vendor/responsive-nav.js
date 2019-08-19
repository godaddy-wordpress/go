/********************************

	Name: WordPress Accessible Responsive Navigation Menu
	Usage:

	TenUp.build_menu({

		'target'		:	'#primary-nav',      // the selector of the nav menu <ul>
		'toggle'		:	'#js-menu-toggle',   // the ID of the link you're using to open/close the small screen menu
		'sub_menu_open'	:	'hover'              // "click" is the other option

	}, function() {

		console.log('Amazing callback function!');

	});

********************************/
/* eslint-disable */
( function() {

	'use strict';

	// Define global TenUp object if it doesn't exist
	if ( 'object' !== typeof window.TenUp ) {
		window.TenUp = {};
	}

	/*
		Cache and define some variables
	*/

	// init function
	TenUp.navigation = function( options, callback ) {

		var defaults = {
			'target'		:	'#primary-nav',
			'toggle'		:	'#js-menu-toggle',
			'sub_menu_open'	:	'hover'
		};
		var opt;

		// Map all default settings to user defined options if they exist
		for ( opt = 0; opt < defaults.length; opt = opt + 1 ) {

			if( typeof options[opt] === 'undefined' ) {
				options[opt] = defaults[opt];
			}

		}

		var menu = document.querySelector( options.target );

		// Bail out if there's no menu
		if ( ! menu ) { return; }

		var menu_id = menu.getAttribute( 'id' );
		var menu_toggle = document.querySelector( options.toggle );
		var aria_controls = menu_toggle.getAttribute( 'aria-controls' );
		var sub_menu_acion = options.sub_menu_open;
		var current_menu_item = menu.querySelector( '.current-menu-item' );
		var menu_items_with_children = menu.querySelectorAll( '.menu-item-has-children' );
		var menu_items_with_children_count = menu_items_with_children.length;
		var currentTarget;
		var target;
		var i;

		// Listener for the menu open/close action
		function listener_menu( e ) {

			// Stop links from firing
			e.preventDefault();

			if ( document.body.classList.contains( 'menu-is-open' ) ) {
				// Close the menu
				menu.setAttribute( 'aria-hidden', 'true' );
				menu_toggle.setAttribute( 'aria-expanded', 'false' );

				// Bubble to the document
				document.body.classList.remove( 'menu-is-open' );
			} else {
				// Open the menu
				menu.setAttribute( 'aria-hidden', 'false' );
				menu_toggle.setAttribute( 'aria-expanded', 'true' );

				// Set focus to the first link
				menu.querySelectorAll( 'a' )[0].focus();

				// Bubble to the document
				document.body.classList.add( 'menu-is-open' );
			}

		}; // listener_menu()

		// Listener for submenu on click
		function listener_submenu_click( e ) {

			currentTarget = e.currentTarget;
			target = e.target;

			if ( target.tagName === 'svg' || target.tagName === 'path' ) {
				target = currentTarget.closest( '.menu-item > a' );
			}

			if ( target.getAttribute( 'aria-haspopup' ) ) {
				// Stop links from firing
				e.preventDefault();

				// Stop events from bubbling up to parent elements
				e.stopPropagation();

				var parent_menu = target.parentNode;
				var sub_menu = parent_menu.querySelector( '.sub-menu' );
				var all_open_menus = menu.querySelectorAll( '.child-has-focus' );
				var all_open_menus_count = all_open_menus.length;
				var all_open_menu_triggers = menu.querySelectorAll( '.child-has-focus > a.submenu-is-open' );
				var all_open_menu_triggers_count = all_open_menu_triggers.length;
				var t;

				if ( get_screen_size( 'has-full-nav' ) ) {
					if ( all_open_menu_triggers_count > 0 ) {
						// Make sure only 1 menu item can be opened at a time
						for ( t = 0; t < all_open_menu_triggers_count; t = t + 1 ) {

							// Check if the open menu is top-level, if so, close it
							if ( parent_menu.parentNode === menu ) {
								menu_sub_close( all_open_menu_triggers[t] );
							}
						} // for
					} // if
				} // if

				if ( ( e.target.nodeName === 'A' || target.tagName === 'A' ) && target.classList.contains( 'submenu-is-open' ) ) {
					// The menu is already open, so this should be a close action
					menu_sub_close( target );
				} else {
					// The menu is closed, so this click should open it
					menu_sub_open( target );

					// Reset the focus
					sub_menu.querySelectorAll('a')[0].focus();
				}
			}
		}; // listener_submenu_click()

		// When "hover", this is how focus should act
		function listener_submenu_focus( e ) {

			var currentTarget = e.currentTarget;
			var target = e.target;
			var parent_menu = target.parentNode;
			var sub_menu = parent_menu.querySelector( '.sub-menu' );
			var all_open_menu_triggers = menu.querySelectorAll( '.child-has-focus > a.submenu-is-open' );
			var all_open_menu_triggers_count = all_open_menu_triggers.length;
			var t;

			if ( get_screen_size( 'has-full-nav' ) ) {
				if ( all_open_menu_triggers_count > 0 ) {
					// Make sure only 1 menu item can be opened at a time
					for ( t = 0; t < all_open_menu_triggers_count; t = t + 1 ) {
						// Check if the open menu is top-level, if so, close it
						if ( parent_menu.parentNode === menu ) {
							menu_sub_close( all_open_menu_triggers[t] );
						}
					}
				}
			}
			menu_sub_open( target );
		};

		// Listener for the window resize
		var listener_window = debounce( function( e ) {
			if( get_screen_size( 'has-offscreen-nav' ) ) {
				menu_create();
			} else {
				menu_destroy();
			}
		}, 100 ); // listener_window()

		// Close the menu if you click somewhere else
		function listener_close_open_menus( e ) {

			var open_menus = menu.querySelectorAll('.submenu-is-open');
			var open_menus_count = open_menus.length;
			var opn;

			// if the event is keyup and it was the ESC key
			if ( e.type === 'keyup' && e.keyCode == 27 ) {

				// We were getting some errors, so let's add in a checkpoint
				if ( open_menus_count ) {

					// Loop through all the open menus and close them
					for ( opn = 0; opn < open_menus.length; opn = opn + 1 ) {

						menu_sub_close( open_menus[opn] );

					} // for

					// Return focus to the first open menu
					if ( sub_menu_acion === 'click' ) {
						open_menus[0].focus();
					}

				} // if

			// If the event was a mouseup
			} else if ( e.type === 'mouseup' ) {

				if ( ! menu.contains( e.target ) && menu.querySelector( '.submenu-is-open' ) ) {
					// We were getting some error, so let's add in a second checkpoint
					if ( open_menus_count ) {
						for( opn = 0; opn < open_menus.length; opn = opn + 1 ) {
							menu_sub_close( open_menus[opn] );
						} // for
					}
				} // if
			}
		}; // listener_close_open_menus()

		function menu_sub_close( open_item ) {
			open_item.classList.remove('submenu-is-open');
			open_item.parentNode.classList.remove('child-has-focus');

			if ( open_item.parentNode.querySelector( '.sub-menu' ) ) {
				open_item.parentNode.querySelector( '.sub-menu' ).setAttribute( 'aria-hidden', 'true' );
			}
		}; // menu_sub_close()

		function menu_sub_open( closed_item ) {
			closed_item.classList.add( 'submenu-is-open' );
			closed_item.parentNode.classList.add( 'child-has-focus' );

			if ( closed_item.parentNode.querySelector( '.sub-menu' ) ) {
				closed_item.parentNode.querySelector( '.sub-menu' ).setAttribute( 'aria-hidden', 'false' );
			}
		}; // menu_sub_open()

		// Method to create the small screen menu
		function menu_create() {

			if ( ! document.body.classList.contains( 'has-offscreen-nav' ) ) {

				if ( ! document.body.classList.contains( 'menu-is-open' ) ) {
					menu.setAttribute( 'aria-hidden', 'true' );
					menu_toggle.setAttribute( 'aria-expanded', 'false' );
				} else {
					menu.setAttribute( 'aria-hidden', 'false' );
					menu_toggle.setAttribute( 'aria-expanded', 'true' );
				}

				// Loop through all submenus and bind events when needed
				for ( i = 0; i < menu_items_with_children_count; i = i + 1 ) {
					if ( sub_menu_acion !== 'click' ) {
						menu_items_with_children[i].addEventListener( 'click', listener_submenu_click );
						menu_items_with_children[i].removeEventListener( 'focusin', listener_submenu_focus );
						menu.classList.add( 'uses-click' );
					}
				} // for

				// Bind the event
				menu_toggle.addEventListener( 'click', listener_menu );

				// Add the body class to prevent this from running again
				document.body.classList.add( 'has-offscreen-nav' );
				document.body.classList.remove( 'has-full-nav' );
			}
		}; // menu_create()

		// Method to destroy the small screen menu
		function menu_destroy() {

			var tmp_open
			var tmp_open_count
			var t;

			if ( ! document.body.classList.contains( 'has-full-nav' ) ) {
				// Remove aria-hidden, because we don't need it.
				menu.removeAttribute( 'aria-hidden' );

				// Loop through all submenus and bind events when needed
				for ( i = 0; i < menu_items_with_children_count; i = i + 1 ) {
					if ( sub_menu_acion !== 'click' ) {
						menu_items_with_children[i].removeEventListener( 'click', listener_submenu_click );
						menu_items_with_children[i].addEventListener( 'focusin', listener_submenu_focus );
						menu.classList.remove('uses-click');
					}
				}

				// If we're not using click, the open menus need to be reset
				if ( sub_menu_acion !== 'click' ) {
					tmp_open = document.querySelectorAll('.child-has-focus');
					tmp_open_count = tmp_open.length;

					for ( t = 0; t < tmp_open_count; t = t + 1 ) {
						tmp_open[t].classList.remove( 'child-has-focus' );
						tmp_open[t].querySelector( '.submenu-is-open' ).classList.remove( 'submenu-is-open' );
						tmp_open[t].querySelector( '.sub-menu' ).setAttribute( 'aria-hidden', 'true' );
					}
				}

				// Unbind the event
				menu_toggle.removeEventListener( 'click', listener_menu );

				// Add the body class to prevent this from running again
				document.body.classList.add( 'has-full-nav' );
				document.body.classList.remove( 'has-offscreen-nav' );
			}
		};

		// Check init menu state
		if ( get_screen_size( 'has-offscreen-nav' ) ) {
			menu_create();
		}

		// If aria-controls isn't set, set it
		if ( ! aria_controls ) {
			menu_toggle.setAttribute( 'aria-controls', menu_id );
		}

		if ( current_menu_item ) {
			current_menu_item.querySelector( 'a' ).setAttribute( 'aria-current', 'page' );
		}

		/*
			Events
		*/

		// Debounced resize event to create and destroy the small screen menu options
		window.addEventListener( 'resize', listener_window );

		// Close the submenus by clicking off of them or hitting ESC
		document.addEventListener( 'mouseup', listener_close_open_menus );
		document.addEventListener( 'keyup', listener_close_open_menus );

		/*
			Hiding and showing submenus (click, focus, hover)
		*/

		// Loop through all items with sub menus and bind focus to them for tabbing
		for ( i = 0; i < menu_items_with_children_count; i = i + 1 ) {

			// Let a screen reader know this menu has a submenu by hooking into the first link
			menu_items_with_children[i].querySelector( 'a' ).setAttribute( 'aria-haspopup', 'true' );

			// Hide and label each sub menu
			menu_items_with_children[i].querySelector( '.sub-menu' ).setAttribute( 'aria-hidden', 'true' );
			menu_items_with_children[i].querySelector( '.sub-menu' ).setAttribute( 'aria-label', 'Submenu' );

			// If the screen is small or the action is set to click
			if ( get_screen_size( 'has-offscreen-nav' ) || sub_menu_acion === 'click' ) {
				menu_items_with_children[i].addEventListener( 'click', listener_submenu_click );

				var svgElements = menu_items_with_children[i].querySelectorAll( 'svg' );

				for ( var z = 0; z < svgElements.length; z = z + 1 ) {

					svgElements[z].addEventListener( 'click', listener_submenu_click );

				}

				menu.classList.add( 'uses-click' );
			} else if ( sub_menu_acion !== 'click' ) {
				if ( get_screen_size( 'has-full-nav' ) ) {
					menu_items_with_children[i].addEventListener( 'focusin', listener_submenu_focus );
				} // if
			} // if
		} // for

		// Execute the callback function
		if ( typeof callback === 'function' ) {
			callback.call();
		}
	}; // build_menu()

	/*
		Helper functions
	*/

	// Get screen size from getComputedStyle (so we don't have to define each breakpoint twice) -- Values are set in CSS --
	function get_screen_size( sizeString ) {
		var size = window.getComputedStyle( document.body,':before' ).getPropertyValue( 'content' );

		if ( size && size.indexOf( sizeString ) !== -1 ) {
			return true;
		}
	};

	// Debounce
	function debounce( func, wait, immediate ) {
		var timeout;

		return function() {
			var context = this, args = arguments;

			var later = function() {
				timeout = null;
				if ( ! immediate ) func.apply( context, args );
			};

			var callNow = immediate && !timeout;

			clearTimeout( timeout );
			timeout = setTimeout( later, wait );
			if ( callNow ) func.apply( context, args );
		};
	};

} )();
