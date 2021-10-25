module.exports = {
	extends: ['@godaddy-wordpress/eslint-config'],

	// Go config
	env: {
		browser: true,
		es6: true,
	},
	parser: 'babel-eslint',

	// Specific Globals used in Go
	globals: {
		jQuery: true,
		GoPreviewData: true,
		goCustomizerControls: true,
		GoBlockFilters: true,
	},

	rules: {
		'@wordpress/no-global-active-element': 0 // because we are not using React, no need for this
	}
};
