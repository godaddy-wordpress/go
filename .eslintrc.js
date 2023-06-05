module.exports = {

	// Go config
	env: {
		browser: true,
		es6: true,
	},

	extends: [ '@godaddy-wordpress/eslint-config' ],

	globals: {
		GoBlockFilters: true,
		GoPreviewData: true,
		goCustomizerControls: true,
		jQuery: true,
		'react-dom': true,
	},

	parser: '@babel/eslint-parser',
	parserOptions: {
		babelOptions: {
			babelrc: false,
			configFile: false,
			// your babel options
			presets: [
				'@babel/preset-env',
				'@wordpress/babel-preset-default',
			],
		},
		requireConfigFile: false,
	},

	rules: {
		'@wordpress/no-global-active-element': 0, // because we are not using React, no need for this
		'jsdoc/check-tag-names': [ 2, {
			definedTags: [ 'jest-environment' ],
		} ],
	},
};
