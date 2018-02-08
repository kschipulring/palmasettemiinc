'use strict';

//webpack.config.js
var path = require('path');
var nodeModulesPath = path.resolve(__dirname, 'node_modules');

//everything else here is pointless without this
var webpack = require('webpack');

//minify the final javascript if in production mode
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const HtmlWebpackPlugin = require('html-webpack-plugin');

//copy stuff
const CopyWebpackPlugin = require('copy-webpack-plugin');


//source folders where the development css and js come from
var srcDir = "./src/";
var srcTSdir = srcDir + "ts/app/";

//dist folders where the rendered css and js files go
var distDir = "./dist/";
var distJSdir = distDir + "js/";


//html handling. The 2 defined properties are optional. If no template param is provided, then a default html structure will be generated in the output file.
var htmlPlugin = new HtmlWebpackPlugin({
					filename: 'index.html',
					template: 'src/index.html'
				});

//just plain copy machine for the css file
var copyPlugin = new CopyWebpackPlugin(
	[
		{ from: 'src/app' }
	],
	{
            ignore: [
                // Doesn't copy any files with a ts extension    
                '*.ts'
            ]
 	}
 	);


//default settting for whether build or buildprod.  If it is buildprod, then css and javascript will be minified/uglified
var ENV = "build";

//get the way this was launched, dev vs prod.  **NOTE:** Will only occur if launched from an NPM run-script, typically, by command line.
if( process.env.hasOwnProperty("npm_lifecycle_event") ){
	ENV = process.env.npm_lifecycle_event;
}

console.log('env is:', ENV);

//determine whether this is a production environment
const isProd = ( ENV.indexOf("prod") > -1 )? true : false;


//webpack plugin list.  These defaults are always present for this wp theme
var pluginOptions = [extractPlugin, htmlPlugin, copyPlugin];

//'isProd' itself is used below for determining whether or not uglifyJs should be called, based on whether or not it is production mode.
if( isProd === true ){
	pluginOptions.push( new UglifyJsPlugin() );
}


//where webpack does its thing
var moduleExporter = module.exports = {
	entry: {
		maints: srcTSdir + 'main.ts'
	},
	output: {
		path: path.resolve(__dirname, distDir),
		filename: 'bundle.js'
	},
	devtool: 'inline-source-map',
	resolve: {
		// Add '.ts' and '.tsx' as resolvable extensions.
		extensions: [".ts", ".tsx", ".js", ".jsx", ".json"]
	},
	node: {
		fs: 'empty'
	},
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: ['es2015']
						}
					}
				],
				'exclude': [/node_modules/, nodeModulesPath]
			},
			{
				test: /\.tsx?$/,
				use: [
					{
						loader: 'ts-loader'
					}
				]
			}
		]
	},
	plugins: pluginOptions
};