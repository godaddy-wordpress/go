const { merge } = require( 'webpack-merge' );
const common = require( './.dev/config/webpack.common.js' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );
const RtlCssPlugin = require( 'rtlcss-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const settings = require( './.dev/config/webpack.settings.js' );
const isProduction = 'production' === process.env.NODE_ENV;

if ( isProduction ) {
	module.exports = merge( common, {
		mode: 'production',

		optimization: {
			minimize: true,
		},
	} );

	return;
}

const config = merge(
	common,
	{
		devtool: 'inline-cheap-module-source-map',
		mode: 'development',
		optimization: {
			minimizer: [
				`...`,
				new CssMinimizerPlugin(),
			],
		},
		plugins: [
			new BrowserSyncPlugin(
				{
					files: settings.BrowserSyncConfig.files,
					host: settings.BrowserSyncConfig.host,
					open: settings.BrowserSyncConfig.open,
					port: settings.BrowserSyncConfig.port,
					proxy: settings.BrowserSyncConfig.proxy,
				},
				{
					injectCss: true,
					reload: false,
				}
			),
		],
	}
);

let flags = [];

if ( undefined !== process.argv[ 5 ] ) {
	flags = process.argv[ 5 ].replace( '--', '' ).split( ',' );
}

// Generate the RTL files when running `npm run start` and a --rtl flag is set
if ( flags.includes( 'rtl' ) ) {
	config.plugins.push(
		new RtlCssPlugin( { filename: 'css/[name]-rtl.css' } ),
	);

	if ( flags.includes( 'min' ) ) {
		config.plugins.push(
			new MiniCssExtractPlugin( {
				chunkFilename: '[id].css',
				filename: 'css/[name]-rtl.min.css',
			} ),
		);
	}
}

// Minify both the standard .css file and the -rtl.css files when running `npm run start` and a --min flag is set
if ( flags.includes( 'min' ) ) {
	config.plugins.push(
		new MiniCssExtractPlugin( {
			chunkFilename: '[id].css',
			filename: 'css/[name].min.css',
		} ),
	);
}

module.exports = config;
