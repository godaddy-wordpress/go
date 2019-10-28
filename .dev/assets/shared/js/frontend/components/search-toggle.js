const searchToggle = () => {
	const searchToggle = document.getElementById( 'header__search-toggle' );

	if ( ! searchToggle ) {
		return;
	}

	const performToggle = ( element ) => {
		const toggle = element;
		const target = document.querySelector( toggle.dataset.toggleTarget );

		if ( target.classList.contains( 'show-modal' ) ) {
			// Hide the modal.
			target.classList.remove( 'active' );

			setTimeout( () => {
				target.classList.remove( 'show-modal' );
				toggle.focus();
			}, 250 );
		} else {
			// Show the modal.
			target.classList.add( 'show-modal' );

			setTimeout( () => {
				target.classList.add( 'active' );

				if ( toggle.dataset.setFocus ) {
					const focusElement = document.querySelector( toggle.dataset.setFocus );

					if ( focusElement ) {
						var searchTerm = focusElement.value;
						focusElement.value = '';
						focusElement.focus();
						focusElement.value = searchTerm;
					}
				}
			}, 10 );
		}
	};

	document.querySelectorAll( '*[data-toggle-target]' ).forEach( element => {
		element.addEventListener( 'click', event => {
			event.preventDefault();
			performToggle( element );
		} );
	} );

	// Close modal on escape key press.
	document.addEventListener( 'keyup', event => {
		if ( event.keyCode === 27 ) {
			event.preventDefault();
			document.querySelectorAll( '.search-modal.active' ).forEach( element => {
				performToggle(
					document.querySelector( '*[data-toggle-target="' + element.dataset.modalTargetString + '"]' )
				);
			} );
		}
	} );

	// Close modal on outside click.
	document.addEventListener( 'click', event => {
		const target = event.target;
		const modal = document.querySelector( '.search-modal.active' );

		if ( target === modal ) {
			performToggle(
				document.querySelector( '*[data-toggle-target="' + modal.dataset.modalTargetString + '"]' )
			);
		}
	} );
};

export default searchToggle;
