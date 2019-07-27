/* global process, module, require */

const path = require( 'path' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );

const isProduction = 'production' === process.env.NODE_ENV;

// Config files.
const settings = require( './webpack.settings.js' );

/**
 * Configure entries.
 */
const configureEntries = () => {
	const entries = {};

	for ( const [ key, value ] of Object.entries( settings.entries ) ) {
		entries[ key ] = path.resolve( process.cwd(), value );
	}

	return entries;
};

module.exports = {
	entry: configureEntries(),
	output: {
		path: path.resolve( process.cwd(), settings.paths.dist.base ),
		filename: settings.filename.js,
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: settings.stats,

	// External objects.
	externals: {
		jquery: 'jQuery',
	},

	// Performance settings.
	performance: {
		maxAssetSize: settings.performance.maxAssetSize,
	},

	// Build rules to handle asset files.
	module: {
		rules: [
			// Lint JS.
			{
				test: /\.js$/,
				enforce: 'pre',
				loader: 'eslint-loader',
				options: {
					fix: true
				}
			},

			// Scripts.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [ '@babel/preset-env' ],
							cacheDirectory: true,
							sourceMap: ! isProduction,
						},
					},
				],
			},

			// Styles.
			{
				test: /\.css$/,
				include: [
					path.resolve( process.cwd(), settings.paths.src.sharedCss ),
					path.resolve( process.cwd(), settings.paths.src.modernCss ),
					// path.resolve( process.cwd(), settings.paths.src.traditionalCss ),
					// path.resolve( process.cwd(), settings.paths.src.trendyShopCss ),
					// path.resolve( process.cwd(), settings.paths.src.welcomingCss ),
					// path.resolve( process.cwd(), settings.paths.src.playCss ),
					path.resolve( process.cwd(), settings.paths.src.adminCss ),
				],
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
					},
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! isProduction,
							// We copy fonts etc. using CopyWebpackPlugin.
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
				],
			},
		],
	},

	plugins: [

		// Remove the extra JS files Webpack creates for CSS entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin( {
			silent: true,
		} ),

		// Clean the `dist` folder on build.
		new CleanWebpackPlugin( {
			cleanStaleWebpackAssets: false,
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: settings.filename.css,
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `dist` folder.
		new CopyWebpackPlugin( [
			{
				from: settings.copyWebpackConfig.from,
				to: settings.copyWebpackConfig.to,
				context: path.resolve( process.cwd(), settings.paths.src.base ),
			},
		] ),

		// Lint CSS.
		new StyleLintPlugin( {
			context: path.resolve( process.cwd(), settings.paths.src.base ),
			files: '**/*.css',
		} ),

		// Fancy WebpackBar.
		new WebpackBar(),
	],
};
