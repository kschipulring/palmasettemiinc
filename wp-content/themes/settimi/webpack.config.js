'use strict';

//webpack.config.js
var path = require('path');
var nodeModulesPath = path.resolve(__dirname, 'node_modules');

//kill a directory, no questions asked
const rimraf = require('rimraf');

//directory killer with promise
const rimrafPromise = require('rimraf-promise');

//everything else here is pointless without this
var webpack = require('webpack');

//this is major, it creates the new files and places their respective content types in them.  By default, WebPack usuaully outputs inline.
const ExtractTextPlugin = require("extract-text-webpack-plugin");

//minify the final javascript
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

//file handling
var fs = require('fs');

//post processing
var LastCallWebpackPlugin = require('last-call-webpack-plugin');

//csso
var csso = require('csso');

const CssoWebpackPlugin = require('csso-webpack-plugin').default;


//source folders where the development css and js come from
var srcDir = "./src/";
var srcCSSdir = srcDir + "css/";
//var srcCSSdir = srcDir;
var srcJSdir = srcDir + "js/";
var srcTSdir = srcDir + "ts/";

//dist folders where the rendered css and js files go
var distDir = "./dist/";
//const distCSSdir = distDir + "css/";
//var distCSSdir = "/css/";
var distCSSdir = "../";
var distJSdir = distDir + "js/";


//part of the hack to have a correct relative path css final file, alone with relative paths
const cssOutFinalName = "style.css";

//includes the folder with the file name
const cssOutFinalPath = distCSSdir + cssOutFinalName;

//this does the actual work of generating the final css and js files
var extractPlugin = new ExtractTextPlugin({
	filename: '../' + cssOutFinalPath,
	publicPath: distDir
});


//default settting for whether build or buildprod.  If it is buildprod, then css and javascript will be minified/uglified
var ENV = "build";

//get the way this was launched, dev vs prod.  **NOTE:** Will only occur if launched from an NPM run-script, typically, by command line.
if( process.env.hasOwnProperty("npm_lifecycle_event") ){
	ENV = process.env.npm_lifecycle_event;
}

console.log('env is:', ENV);

//determine whether this is a production environment
const isProd = ( ENV.indexOf("prod") > -1 )? true : false;

//this is a great technique to custom post process css, js or whatever else ascii based.  Here this is being used
var lastCaller = new LastCallWebpackPlugin({
	assetProcessors: [{
		regExp: /\.css$/,
		processor: function(assetName, asset) {
			var pattern = "/wp-content/themes/[a-zA-Z0-9\\-\\_]+";
			var re = new RegExp(pattern, "g");

			//create a new version of the css content with a more absolute path.
			//var cssContentCorrected = asset.source().replace( re, "../.." );
			var cssContentCorrected = asset.source();

			//final write to the master css file.  If this is production, then do the css nano thing, aka, super minify
			return Promise.resolve( cssContentCorrected );
		}
	},
	],
	onStart: () => console.log('Starting to process assets.'),
	//onEnd: (err) => console.log(err ? 'Error: ' + err : 'Finished processing assets.'),
	onEnd: function(err) {
		var outStr = 'Finished processing assets.';

		if(err){
			outStr = 'Error: ', err, "; error details: \n";

			for(var i in err ){
				outStr += " , err["+i+"] = ", err[i];
			}
		}

		console.log(outStr);
	},
	canPrint: true
});


//webpack plugin list.  These defaults are always present for this wp theme
//var pluginOptions = [lastCaller, extractPlugin];
var pluginOptions = [extractPlugin];

//'isProd' itself is used below for determining whether or not uglifyJs should be called, based on whether or not it is production mode.
if( isProd === true ){
	pluginOptions.push( new UglifyJsPlugin() );
	pluginOptions.push( new CssoWebpackPlugin() );
}

//where webpack does its thing
var moduleExporter = module.exports = {
	entry: {
		mainjs: srcJSdir + 'main.js',
		//maints: srcTSdir + 'main.ts'
	},
	output: {
		path: path.resolve(__dirname, distJSdir),
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
			},
			{
				test: /\.css$/,
				exclude: /node_modules/,
				use: extractPlugin.extract({
					//'isProd', aka is production determines whether this is production mode.  If so, then minify.
					use: [{ loader: 'raw-loader', options: { minimize: isProd }}]
				})
			},

			{
				test: /\.scss$/,
				use: extractPlugin.extract({
					use: [{ loader: 'raw-loader', options: { minimize: isProd }}, 'sass-loader']
				})
			}
		]
	},
	plugins: pluginOptions
};
