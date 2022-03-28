/* eslint-disable sort-keys */
module.exports = {
	preset: '@wordpress/jest-preset-default',
	rootDir: '../../../',

	collectCoverageFrom: [
		'<rootDir>/.dev/assets/admin/js/*.js',
		'<rootDir>/.dev/assets/admin/js/**/*.js',
		'<rootDir>/.dev/assets/shared/js/**/*.js',
	],
	moduleDirectories: ['node_modules', '.'],
	moduleNameMapper: {
		'@godaddy-wordpress/coblocks-icons': require.resolve(
			'@wordpress/jest-preset-default/scripts/style-mock.js'
		),
		'^react(.*)$': '<rootDir>/node_modules/react$1'
	},
	setupFilesAfterEnv: [
		require.resolve( '@wordpress/jest-preset-default/scripts/setup-globals.js' ),
		'<rootDir>/.dev/tests/jest/setup-globals.js',
	],
	testMatch: [ '**/test/*.spec.js' ],
};
