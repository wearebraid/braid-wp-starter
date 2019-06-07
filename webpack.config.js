/**
 * DEPENDENCIES
 */

const webpack = require('webpack')
const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const ExtractCssChunks = require("extract-css-chunks-webpack-plugin")
const ManifestPlugin = require('webpack-manifest-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries")
const WriteFilePlugin = require('write-file-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
require('dotenv').config()

function currentDir () {
  const dir = __dirname.split('/')
  return dir[dir.length - 1]
}

function resolve (dir) {
  return path.join(__dirname, '..', dir)
}

/**
 * Local Parameters
 */

const localDomain = process.env.LOCAL_DOMAIN || 'localhost'
const secure = process.env.SECURE ? process.env.SECURE === 'true' : false
const protocol = secure ? 'https://' : 'http://'
const devPort = process.env.PORT || 5000
const buildPath = process.env.BUILD_PATH || 'dist'
const entryPoints = process.env.ENTRY_POINTS ?
  JSON.parse(process.env.ENTRY_POINTS) :
  { app: './lib/js/app.js' }

const publicPath = `/wp-content/themes/${currentDir()}/`
const localUrl = `${protocol}${localDomain}`

/**
 * You should not need to modify anything below here unless you need a custom build config
 */
module.exports = (env, argv) => ({
  entry: entryPoints,
  output: {
    path: path.resolve(__dirname, buildPath),
    filename: argv.mode !== 'production' ? '[name].js' : '[name].[chunkhash].js',
    chunkFilename: argv.mode !== 'production' ? '[name].js' : '[name].[chunkhash].js',
    publicPath: argv.mode !== 'production' ? `${protocol}${localDomain}:${devPort}${publicPath}${buildPath}/` : `${publicPath}${buildPath}/`
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': resolve('src')
    }
  },
  devServer: {
    port: devPort,
    public: `${localDomain}:${devPort}`,
    publicPath: `${protocol}${localDomain}:${devPort}${publicPath}${buildPath}/`,
    headers: { "Access-Control-Allow-Origin": "*" },
    https: secure,
    proxy: {
      '/': {
        target: localUrl,
        changeOrigin: true,
        autoRewrite: true,
        headers: {
          'X-ProxiedBy-Webpack': true,
        },
      },
    },
    overlay: {
      errors: true,
      warnings: false,
    },
  },
  devtool: argv.mode !== 'production' ? 'inline-source-map' : false,
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          ExtractCssChunks.loader,
          {
            loader: 'css-loader',
            options: { 
              sourceMap: true
            },
          },
          {
            loader: 'postcss-loader',
            options: { 
              sourceMap: true,
              plugins: () => [require('autoprefixer')({
                'browsers': ['> 1%', 'last 2 versions']
              })],
            },
          },
          {
            loader: 'sass-loader',
            options: { 
              sourceMap: true,
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
      },
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
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
    new WriteFilePlugin({ test: /^(?!.*(hot)).*/ }),
    new FixStyleOnlyEntriesPlugin(),
    new VueLoaderPlugin(),
    new ManifestPlugin({ publicPath: `${publicPath}${buildPath}/` }),
    new CleanWebpackPlugin(`./${buildPath}`, { root: __dirname, dry: false }),
    new ExtractCssChunks(
      {
        filename: "[name].css",
        chunkFilename: "[id].css",
      }
    ),
    new webpack.LoaderOptionsPlugin({
      minimize: argv.mode === 'production',
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      proxy: localUrl,
      files: [
        {
          match: [ '**/*.php' ],
          fn: function (event, file) {
            if (event === "change") {
              const bs = require('browser-sync').get('bs-webpack-plugin');
              bs.reload();
            }
          }
        }
      ]
    }, { injectCss: true, reload: false })
  ],
});
