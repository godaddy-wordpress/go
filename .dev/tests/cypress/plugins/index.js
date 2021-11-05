const {
	addMatchImageSnapshotPlugin,
} = require('cypress-image-snapshot/plugin');

module.exports = (on, config) => {
	addMatchImageSnapshotPlugin(on, config);

	on( 'before:browser:launch', ( browser, launchOptions ) => {
		if ( ! browser.isHeadless ) {
			return launchOptions;
		}

		switch (browser.name) {
			case 'chrome': {
				launchOptions.args.push('--window-size=1920,1080');
				// force screen to be non-retina (1920 size)
				launchOptions.args.push('--force-device-scale-factor=1');
				break;
			}
			case 'electron': {
				launchOptions.preferences.width = 1920;
				launchOptions.preferences.height = 1080;
				break;
			}
			case 'firefox': {
				launchOptions.args.push('--width=1920');
				launchOptions.args.push('--height=1080');
				break;
			}
		}

		return launchOptions;
	} );
};
