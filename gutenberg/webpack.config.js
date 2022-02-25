/**
 * Resource: https://imranhsayed.medium.com/set-up-webpack-and-babel-for-your-wordpress-theme-4ab56a00c873
 */

const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const JS_DIR = path.resolve(__dirname, './');
const BUILD_DIR = path.resolve(__dirname, 'dist');

const entry = JS_DIR + '/app.js';
const output = {
	path: BUILD_DIR,
	filename: 'bundle.js'
};

/**
 * Note: argv.mode will return 'development' or 'production'.
 */
const plugins = (argv) => [
	new CleanWebpackPlugin({
		// Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
		cleanStaleWebpackAssets: argv.mode === 'production'
	})
];
const rules = [
	{
		test: /\.js$/,
		include: [JS_DIR],
		exclude: /node_modules/,
		use: 'babel-loader'
	}
];

module.exports = (env, argv) => ({
	mode: 'development',
	entry: entry,
	output: output,
	module: {
		rules: rules
	},
	optimization: {
		minimizer: [
			new UglifyJsPlugin({
				cache: false,
				parallel: true,
				sourceMap: true
			})
		]
	},

	plugins: plugins(argv)
});
