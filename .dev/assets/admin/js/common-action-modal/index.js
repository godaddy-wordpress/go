/* global goThemeDeactivateData */

import PropTypes from 'prop-types';
import { safeHTML } from '@wordpress/dom';
import { Button, ButtonGroup, CheckboxControl, Modal, TextControl } from '@wordpress/components';
import { useCallback, useEffect, useState } from '@wordpress/element';

const language = document.documentElement.getAttribute( 'lang' ) || 'en-US';

const DeactivateModal = ( { apiUrl, isEvent, pageData } ) => {
	const [ href, setHref ] = useState( null );
	const [ isOpen, setOpen ] = useState( false );
	const [ formData, setFormData ] = useState( {} );

	useEffect( () => {
		const textFields = {};
		goThemeDeactivateData.choices.forEach( ( choice ) => {
			if ( !! choice.text_field ) {
				textFields[ choice.text_field ] = '';
			}
		} );

		window.addEventListener( 'click', clickHandler );

		setFormData( {
			choices: goThemeDeactivateData.choices,
			domain: pageData.domain,
			go_theme_version: pageData.goThemeVersion,
			hostname: pageData.hostname,
			language,
			wp_version: pageData.wpVersion,
			...textFields,
		} );
	}, [] );

	const clickHandler = useCallback( ( e ) => {
		if ( ! isEvent( e ) ) {
			return;
		}

		e.preventDefault();
		setOpen( true );
		setHref( e.target.href );
	} );

	const onCheckboxChange = ( isChecked, slug ) => {
		setFormData( ( prevFormData ) => {
			const choices = prevFormData.choices;
			if ( isChecked ) {
				choices.push( slug );
			} else {
				choices.splice( choices.indexOf( slug ), 1 );
			}
			return {
				...prevFormData,
				choices,
			};
		} );
	};

	const onTextChange = ( key, value ) => {
		setFormData( ( prevFormData ) => ( {
			...prevFormData,
			[ key ]: value,
		} ) );
	};

	const onAction = async ( submit = false ) => {
		if ( submit && formData.choices.length >= 0 ) {
			await fetch( apiUrl, {
				body: JSON.stringify( formData ),
				headers: {
					'Content-Type': 'application/json',
				},
				method: 'POST',
			} );
		}

		setOpen( false );
		window.location.href = href;
	};

	if ( ! isOpen ) {
		return null;
	}

	return (
		<Modal
			className="go-deactivate-modal"
			onRequestClose={ () => setOpen( false ) }
			title={ goThemeDeactivateData.labels.title }
		>
			<div className="go-deactivate-modal__checkbox">
				{ goThemeDeactivateData.choices.map( ( choice ) => {
					const isChecked = formData.choices.indexOf( choice.slug ) >= 0;
					if ( typeof choice !== 'object' ) {
						return null;
					}
					return (
						<div key={ choice.slug }>
							<CheckboxControl
								checked={ isChecked }
								label={ choice.label }
								onChange={ ( checked ) => onCheckboxChange( checked, choice.slug ) }
							/>
							{ !! choice.text_field && (
								<TextControl
									className={ `go-deactivate-modal__text ${
										isChecked ? 'show' : ''
									}` }
									onChange={ ( value ) => onTextChange( choice.text_field, value ) }
									value={ formData[ choice.text_field ] }
								/>
							) }
						</div>
					);
				} ) }
			</div>
			<ButtonGroup>
				<Button
					className="go-deactivate-modal__button"
					onClick={ () => onAction( true ) }
					variant="primary"
				>
					{ goThemeDeactivateData.labels.submit_deactivate }
				</Button>
				<Button
					className="go-deactivate-modal__button"
					onClick={ () => onAction( false ) }
					variant="link"
				>
					{ goThemeDeactivateData.labels.skip_deactivate }
				</Button>
			</ButtonGroup>

			<footer className="go-deactivate-modal__footer">
				<div
					dangerouslySetInnerHTML={ {
						__html: safeHTML( goThemeDeactivateData.labels.privacy_disclaimer ),
					} }
				/>
			</footer>
		</Modal>
	);
};

DeactivateModal.propTypes = {
	apiUrl: PropTypes.string.isRequired,
	isEvent: PropTypes.func.isRequired,
	pageData: PropTypes.object.isRequired,
};

export {
	DeactivateModal as default,
};
