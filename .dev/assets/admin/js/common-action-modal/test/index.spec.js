/**
 * @jest-environment jsdom
 */

/**
 * External dependencies
 */
import { act } from 'react-dom/test-utils';
import { mount } from 'enzyme';
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
			wpVersion: '5.9',
		},
	};

	const setup = () => {
		return mount(
			<div>
				<button className="activate">Activate</button>
				<Modal { ...props } />
			</div>
		);
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

	describe( 'fetchData', () => {
		test( 'should return feedback data', async () => {
			const response = await fetchData( 'foo.com' );
			expect( response ).toEqual( mockData );
		} );

		test( 'should call the fetch api', async () => {
			const fetchMock = jest.spyOn( global, 'fetch' );

			await act( async () => {
				wrapper = setup();
			} );

			expect( fetchMock ).toHaveBeenCalledWith( 'https://wpnux.godaddy.com/v3/api/feedback/go-theme-optout?domain=foo.com&language=en-US&random=1' );
		} );
	} );

	describe( 'closed state', () => {
		beforeEach( async () => {
			await act( async () => {
				wrapper = setup();
			} );
		} );

		test( 'should not display modal by default', () => {
			expect( wrapper.find( '.go-deactivate-modal' ) ).toHaveLength( 0 );
		} );

		it( 'should not be displayed when opening condition is not met', async () => {
			events.click( {
				...defaultEvent,
				target: {
					...defaultEvent.target,
					...mockClassList( false ),
				},
			} );

			expect( wrapper.find( '.go-deactivate-modal' ) ).toHaveLength( 0 );
		} );
	} );

	describe( 'opened state', () => {
		beforeEach( async () => {
			await act( async () => {
				wrapper = setup();
			} );
			events.click( defaultEvent );
			wrapper.update();
		} );

		it( 'should show modal on click', () => {
			expect( wrapper.find( '.go-deactivate-modal' ) ).toHaveLength( 2 );
		} );

		it( 'should call activate link on modal submit', () => {
			Object.defineProperty( window, 'location', {
				value: {
					href: defaultEvent.target.href,
				},
			} );

			const actionButton = wrapper.find( '.go-deactivate-modal__button' ).first();
			actionButton.invoke( 'onClick' )();
			expect( window.location.href ).toEqual( defaultEvent.target.href );
		} );
	} );
} );
