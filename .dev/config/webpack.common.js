/* global process, module, require */

/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const path = require( 'path' );
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );
const isProduction = 'production' === process.env.NODE_ENV;
const settings = require( './webpack.settings.js' );
const ESLintPlugin = require('eslint-webpack-plugin');

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
	...defaultConfig,
	entry: configureEntries(),
	output: {
		...defaultConfig.output,
		path: path.resolve( process.cwd(), settings.paths.dist.base ),
		filename: isProduction ? 'js/[name].min.js' : 'js/[name].js',
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: settings.stats,

	// External objects.
	externals: {
		jquery: 'jQuery',
		react: "React",
		reactDom: "ReactDOM",
	},

	// Performance settings.
	performance: {
		maxAssetSize: settings.performance.maxAssetSize,
	},

	// Build rules to handle asset files.
	module: {
		rules: [
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
				test: /\.(sc|sa|c)ss$/,
				include: [
					path.resolve( process.cwd(), settings.paths.src.sharedCss ),
					path.resolve( process.cwd(), settings.paths.src.modernCss ),
					path.resolve( process.cwd(), settings.paths.src.traditionalCss ),
					path.resolve( process.cwd(), settings.paths.src.trendyCss ),
					path.resolve( process.cwd(), settings.paths.src.welcomingCss ),
					path.resolve( process.cwd(), settings.paths.src.playfulCss ),
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
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
				],
			},
		],
	},

	plugins: [
		...defaultConfig.plugins,

		// Clean the `dist` folder on build.
		new CleanWebpackPlugin( {
			cleanStaleWebpackAssets: false,
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: isProduction ? 'css/[name].min.css' : 'css/[name].css',
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `dist` folder.
		new CopyWebpackPlugin( {
			patterns:[{
				from: settings.copyWebpackConfig.from,
				to: settings.copyWebpackConfig.to,
			}]
		} ),

		new ESLintPlugin(),

		// Lint SCSS.
		// new StyleLintPlugin( {
		// 	context: path.resolve( process.cwd(), settings.paths.src.base ),
		// 	files: '**/*.scss',
		// } ),

		// Fancy WebpackBar.
		new WebpackBar( {
			name: isProduction ? 'Building Go...' : 'Starting Go...',
			color: '#08757a',
		}),
	],
};
