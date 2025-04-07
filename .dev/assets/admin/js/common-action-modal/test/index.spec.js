/**
 * @jest-environment jsdom
 */

/**
 * External dependencies
 */
import { act } from 'react-dom/test-utils';
import userEvent from '@testing-library/user-event';
import { render, screen, waitFor } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';

/**
 * Internal dependencies.
 */
import mockData from '../../../../../tests/cypress/fixtures/network/go_optout.json';
import Modal, { fetchData } from '../index';

import { enableFetchMocks } from 'jest-fetch-mock';
enableFetchMocks();

const mockClassList = ( returnValue ) => {
	return {
		classList: {
			contains: jest.fn().mockReturnValue( returnValue ),
		},
	};
};

const defaultEvent = {
	preventDefault: jest.fn(),
	target: {
		...mockClassList( true ),
		href: 'http://someHref',
	},
};

describe( 'go-deactivate-modal', () => {
	let wrapper;
	let events = {};

	const props = {
		apiUrl: 'https://wpnux.godaddy.com/v3/api/feedback/go-theme-optout',
		getParams: {
			domain: 'foo.com',
		},
		isEvent: () => true,
		pageData: {
			domain: 'foo.com',
			goThemeVersion: '1.0.0',
			hostname: 'test.server.net',
			wpOptions: {
				persona: 'persona',
				skill: 'skill',
			},
			wpVersion: '6.1',
		},
	};

	const setup = () => {
		const { container } = render(
			<div>
				<button className="activate">Activate</button>
				<Modal { ...props } />
			</div>
		);

		return container;
	};

	beforeEach( () => {
		fetch.resetMocks();
		fetch.mockResponse( JSON.stringify( mockData ) );

		events = {};
		window.addEventListener = jest.fn( ( event, callback ) => {
			events[ event ] = callback;
		} );
	} );

	afterEach( () => {
		jest.clearAllMocks();
	} );

	describe( 'closed state', () => {
		beforeEach( async () => {
			await act( async () => {
				wrapper = setup();
			} );
		} );

		test( 'should not display modal by default', () => {
			expect( wrapper.getElementsByClassName( 'go-deactivate-modal' ).length ).toBe( 0 );
		} );

		it( 'should not be displayed when opening condition is not met', async () => {
			events.click( {
				...defaultEvent,
				target: {
					...defaultEvent.target,
					...mockClassList( false ),
				},
			} );

			expect( wrapper.getElementsByClassName( 'go-deactivate-modal' ).length ).toBe( 0 );
		} );
	} );

	describe( 'opened state', () => {
		beforeEach( async () => {
			await act( async () => {
				wrapper = setup();
			} );
			events.click( defaultEvent );

			// Make sure that the modal is loaded
			await waitFor( () => {
				screen.getByRole( 'heading' );
			} );
		} );

		it( 'should show modal on click', async () => {
			expect( document.body.getElementsByClassName( 'go-deactivate-modal' ).length ).toBe( 1 );
		} );

		it( 'should call activate link on modal submit', () => {
			Object.defineProperty( window, 'location', {
				value: {
					href: defaultEvent.target.href,
				},
			} );

			const actionButton = wrapper.getElementsByClassName( 'go-deactivate-modal__button' )[ 0 ];
			userEvent.click( actionButton );

			expect( window.location.href ).toEqual( defaultEvent.target.href );
		} );
	} );
} );
