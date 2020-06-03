import { addMatchImageSnapshotCommand } from 'cypress-image-snapshot/command';

addMatchImageSnapshotCommand( {
    failureThreshold: 0.25,
    failureThresholdType: 'percent',
} );