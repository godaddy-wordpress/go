import { addMatchImageSnapshotCommand } from 'cypress-image-snapshot/command';

addMatchImageSnapshotCommand( {
    failureThreshold: 0.25,
    failureThresholdType: 'percent',
} );

/**
 * Starting in Cypress 8.1.0 Unhandled Exceptions now cause tests to fail.
 * Sometimes unhandled exceptions occur in Core that do not effect the UX created by CoBlocks.
 * We discard unhandled exceptions and pass the test as long as assertions continue expectedly.
 */
 Cypress.on( 'uncaught:exception', () => {
	// returning false here prevents Cypress from failing the test.
	return false;
} );
