const {
	addMatchImageSnapshotPlugin,
} = require('cypress-image-snapshot/plugin');

module.exports = (on, config) => {
	addMatchImageSnapshotPlugin(on, config);

	on( 'before:browser:launch', ( browser, launchOptions ) => {
		if ( ! browser.isHeadless ) {
			return;
		}

		if ( browser.family === 'chromium' && browser.name !== 'electron' ) {
			launchOptions.args.push( '--window-size=1920,1080' );
		}

		if ( browser.name === 'firefox' ) {
			launchOptions.args.push('--width=1920')
			launchOptions.args.push('--height=1080')
		}

		return launchOptions;
	} );
};
