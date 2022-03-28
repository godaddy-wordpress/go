/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// JS.
		'frontend': './.dev/assets/shared/js/frontend/frontend.js',

		// CSS.
		'style-editor': './.dev/assets/shared/css/style-editor.scss',
		'style-shared': './.dev/assets/shared/css/style-shared.scss',

		// Design Style CSS.
		'design-styles/style-modern': './.dev/assets/design-styles/modern/css/style-modern.scss',
		'design-styles/style-modern-editor': './.dev/assets/design-styles/modern/css/style-modern-editor.scss',
		'design-styles/style-traditional': './.dev/assets/design-styles/traditional/css/style-traditional.scss',
		'design-styles/style-traditional-editor': './.dev/assets/design-styles/traditional/css/style-traditional-editor.scss',
		'design-styles/style-trendy': './.dev/assets/design-styles/trendy/css/style-trendy.scss',
		'design-styles/style-trendy-editor': './.dev/assets/design-styles/trendy/css/style-trendy-editor.scss',
		'design-styles/style-welcoming': './.dev/assets/design-styles/welcoming/css/style-welcoming.scss',
		'design-styles/style-welcoming-editor': './.dev/assets/design-styles/welcoming/css/style-welcoming-editor.scss',
		'design-styles/style-playful': './.dev/assets/design-styles/playful/css/style-playful.scss',
		'design-styles/style-playful-editor': './.dev/assets/design-styles/playful/css/style-playful-editor.scss',

		// Admin JS.
		'admin/customize-controls': './.dev/assets/admin/js/customize-controls.js',
		'admin/customize-preview': './.dev/assets/admin/js/customize-preview.js',
		'admin/block-filters': './.dev/assets/admin/js/block-filters.js',
		'admin/go-theme-deactivation': './.dev/assets/admin/js/go-deactivate-modal.js',

		// Admin CSS.
		'admin/style-customize': './.dev/assets/admin/css/style-customize.scss',
		'admin/style-go-theme-deactivation': './.dev/assets/admin/css/style-deactivate-modal.scss',
	},
	paths: {
		src: {
			base: './.dev/assets/',
			sharedBase: './.dev/assets/shared/',
			sharedCss: './.dev/assets/shared/css/',
			sharedJs: './.dev/assets/shared/js/',
			adminCss: './.dev/assets/admin/css',
			modernBase: './.dev/assets/design-styles/modern/',
			modernCss: './.dev/assets/design-styles/modern/css/',
			traditionalBase: './.dev/assets/design-styles/traditional/',
			traditionalCss: './.dev/assets/design-styles/traditional/css/',
			trendyBase: './.dev/assets/design-styles/trendy/',
			trendyCss: './.dev/assets/design-styles/trendy/css/',
			welcomingBase: '/.dev/assets/design-styles/welcoming/',
			welcomingCss: './.dev/assets/design-styles/welcoming/css/',
			playfulBase: './.dev/assets/design-styles/playful/',
			playfulCss: './.dev/assets/design-styles/playful/css/'
		},
		dist: {
			base: './dist/',
			clean: ['./images', './css', './js']
		},
	},
	stats: {
		all: false,
		errors: true,
		modules: true,
		warnings: true,
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2|ttf)$/i,
		moduleTrace: true,
		performance: true
	},
	copyWebpackConfig: {
		from: '.dev/assets/**/*.{jpg,jpeg,png,gif,svg}',
		to({ context, absoluteFilename }) {
			// Remove everything before .dev/assets/, remove images/, remove shared/
			return 'images/' + absoluteFilename.replace( /^.*(\.dev\/assets\/)/g, '' ).replace( 'images/', '' ).replace( 'shared/', '' );
		},
	},
	BrowserSyncConfig: {
		host: 'localhost',
		port: 3000,
		proxy: 'https://go.test',
		open: false,
		files: [
			'**/*.php',
			'dist/js/**/*.js',
			'dist/css/**/*.css',
			'dist/images/**/*.{jpg,jpeg,png,gif,svg}'
		]
	},
	performance: {
		maxAssetSize: 100000
	},
	manifestConfig: {
		basePath: ''
	},
};
