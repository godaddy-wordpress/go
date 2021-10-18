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
	}
};
