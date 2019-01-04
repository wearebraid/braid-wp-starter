const webpack = require('webpack')
const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries")

const localUrl = 'http://local.braidwpstarter.com/'
const publicPath = '/wp-content/themes/braid-wp-starter/'

function resolve (dir) {
  return path.join(__dirname, '..', dir)
}

module.exports = (env, argv) => ({
  entry: {
    app: './lib/js/app.js',
    // external_use: './lib/scss/external_use.scss', // EXAMPLE OF A SEPARATE SCSS COMPILED OUTPUT
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: argv.mode !== 'production' ? '[name].js' : '[name].[chunkhash].js',
    chunkFilename: argv.mode !== 'production' ? '[name].js' : '[name].[chunkhash].js',
    publicPath: publicPath
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': resolve('src')
    }
  },
  devtool: argv.mode !== 'production' ? 'source-map' : false,
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { 
              sourceMap: argv.mode !== 'production'
            },
          },
          {
            loader: 'postcss-loader',
            options: { 
              sourceMap: argv.mode !== 'production',
              plugins: () => [require('autoprefixer')({
                'browsers': ['> 1%', 'last 2 versions']
              })],
            },
          },
          {
            loader: 'sass-loader',
            options: { 
              sourceMap: argv.mode !== 'production',
              plugins: () => [require('autoprefixer')({
                'browsers': ['> 1%', 'last 2 versions']
              })],
            },
          },
          {
            loader: 'sass-resources-loader',
            options: {
              resources: [
                './lib/scss/utilities/_variables.scss',
                './lib/scss/utilities/_custom-mixins.scss'
              ],
            },
          },
        ],
      },
      {
        test: /\.(png|jpg|gif|svg|eot|ttf|woff|woff2)$/,
        loader: 'url-loader',
        options: {
          limit: 1000
        }
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      }
    ]
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendors: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendor',
          chunks: 'all',
        }
      },
    }
  },
  plugins: [
    new FixStyleOnlyEntriesPlugin(),
    new VueLoaderPlugin(),
    new ManifestPlugin({ publicPath: `${publicPath}dist/` }),
    new CleanWebpackPlugin('./dist', { root: __dirname, dry: false }),
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[name].css',
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      proxy: localUrl,
      files: ['**/*.php']
    }, { injectCss: true } )
  ],
});
