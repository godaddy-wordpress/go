module.exports = {
	parser: 'babel-eslint',
	extends: ['@10up/eslint-config'],
	env: {
		browser: true,
		es6: true,
	},
	globals: {
		window: true,
		document: true,
		wp: true,
		jQuery: true,
		GoPreviewData: true,
	}
};
