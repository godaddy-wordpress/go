import { addMatchImageSnapshotCommand } from 'cypress-image-snapshot/command';

addMatchImageSnapshotCommand( {
    failureThreshold: 0.15,
    failureThresholdType: 'percent',
} );