 var path = require('path');
 var webpack = require('webpack');

 const { VueLoaderPlugin } = require('vue-loader')

 module.exports = {
     watch: true,
     entry: path.resolve(__dirname, 'resources/assets/js/app.js'),
     output: {
         path: path.resolve(__dirname, 'public/js'),
         filename: 'app.js',
         publicPath: '/public'
     },
     module: {
         rules: [
             {
                 test: /\.js$/,
                 use: {
                     loader: "babel-loader",
                     options: {
                         presets: ["es2015", 'stage-2']
                     }
                 },
                 exclude: /node_modules/
             },
             {
                 test: /\.vue$/,
                 use: 'vue-loader',
                 exclude: /node_modules/
             }
         ]
     },
     plugins: [
         new webpack.ProvidePlugin({
             $: 'jquery',
             jQuery: 'jquery'
         }),
         new VueLoaderPlugin()
     ]
 };
