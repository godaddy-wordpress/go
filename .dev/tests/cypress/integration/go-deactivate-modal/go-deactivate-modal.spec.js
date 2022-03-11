import { loginToSite } from '../../helpers';

describe( 'Component: Go Deactivate Modal', () => {

	before( () => {
		loginToSite();
	} );

	beforeEach( () => {
		cy.intercept(
			'GET',
			'https://wpnux.godaddy.com/v3/api/feedback/go-theme-optout*',
			{ fixture: '../fixtures/network/go_optout.json' }
		);

		cy.visit( Cypress.env( 'localTestURL' ) + '/wp-admin/themes.php' );

		cy.get( 'body' ).then( ( $body ) => {
			if ( $body.find( '[aria-label="Customize Go"]' ).length === 0 ) {
				cy.get(`[aria-label="Activate Go"]`).click();
			}
		} );

		cy.get( '[aria-label="Activate Twenty Twenty"]' ).should( 'exist' );
	} );

	afterEach( () => {
		cy.get(`[aria-label="Activate Go"]`).should( 'exist' );

		cy.get(`[aria-label="Activate Go"]`).click();
	} );

	it( 'open modal and submit feedback', function() {
		cy.get( '[aria-label="Activate Twenty Twenty"]' ).click();
		cy.get( '.components-checkbox-control__input' ).eq( 0 ).check();
		cy.get( '.components-checkbox-control__input' ).eq( 2 ).check();
		cy.get( '.components-text-control__input' ).eq( 0 ).type( 'need more palette options' );

		cy.intercept( 'POST', 'https://wpnux.godaddy.com/v3/api/feedback/go-theme-optout', {
			statusCode: 201,
		} );

		cy.get( '.components-button-group .is-primary' ).click();
	} );

	it( 'open modal and skip feedback', function() {
		cy.get( '[aria-label="Activate Twenty Twenty"]' ).click();
		cy.get( '.components-button-group .is-link' ).click();
	} );
} );
