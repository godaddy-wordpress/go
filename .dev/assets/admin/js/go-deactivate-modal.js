/* global goThemeDeactivateData */

/**
 * WordPress Dependencies
 */
import domReady from '@wordpress/dom-ready';
import { render } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import DeactivateModal from './common-action-modal';
import '../css/style-deactivate-modal.scss';

const API_BASE_URL = 'https://wpnux.godaddy.com/v3/api';

const GoDeactivateModal = () => {
	const apiUrl = `${ API_BASE_URL }/feedback/go-theme-optout`;
	const domain = goThemeDeactivateData.domain;

	const isEvent = ( e ) => e.target.classList.contains( 'activate' );

	if ( ! goThemeDeactivateData || ! domain ) {
		return null;
	}

	return (
		<DeactivateModal
			apiUrl={ apiUrl }
			isEvent={ isEvent }
			pageData={ goThemeDeactivateData }
		/>
	);
};

function initializeGoThemeDeactivateModal() {
	render(
		<GoDeactivateModal />,
		document.getElementById( goThemeDeactivateData.containerId )
	);
}

domReady( initializeGoThemeDeactivateModal );
