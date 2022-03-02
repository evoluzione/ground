const path = require('path');
const WebpackBuildNotifierPlugin = require('webpack-build-notifier');

var config = {
	// The point or points where to start the application bundling process.
	entry: {
		main: {
			import: './assets/js/app.js', 
			filename: 'scripts.min.js',
		},
		gutenberg: {
			import: './assets/js/gutenberg/app.js', 
			filename: 'ground-gutenberg.min.js',
		}
	},

	output: {
		chunkFilename: '[name].bundle.js',
		path: path.resolve(__dirname, 'dist/js'),
	},

	// This option controls if and how source maps are generated.
	devtool: 'source-map',

	// Turn on watch mode.
	// This means that after the initial build, webpack will continue to watch for changes in any of the resolved files.
	watch: true,

	watchOptions: {
		ignored: '**/node_modules',
	},

	plugins: [
		// Display OS-level notifications for Webpack build errors and warnings.
		new WebpackBuildNotifierPlugin({
			// title: 'Ground',
			// message: 'Hello, there!',
			sound: false,
			failureSound: 'Bottle',
			logo: path.join(__dirname, 'assets/img/icon.png'),
			contentImage: path.join(__dirname, 'assets/img/icon.png'),
		}),
	],

	module: {
		rules: [
			{
				test: /\.m?js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader',
				},
			},
		],
	},
};

module.exports = ( env, argv ) => {

	if (argv.mode === 'production') {
		config.watch = false;
	}

	return config;

};