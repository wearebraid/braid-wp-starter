/**
 * Local Parameters
 */

const localDomain = 'local.braidwpstarter.com'
const secure = false
const entryPoints = {
  app: './lib/js/app.js',
  // external_use: './lib/scss/external_use.scss', // EXAMPLE OF A SEPARATE SCSS COMPILED OUTPUT
}

/**
 * You should not need to modify anything below here unless you need a custom build config
 */

const webpack = require('webpack')
const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const ExtractCssChunks = require("extract-css-chunks-webpack-plugin")
const ManifestPlugin = require('webpack-manifest-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries")
const WriteFilePlugin = require('write-file-webpack-plugin')

function currentDir () {
  const dir = __dirname.split('/')
  return dir[dir.length - 1]
}

function resolve (dir) {
  return path.join(__dirname, '..', dir)
}

const protocol = secure ? 'https://' : 'http://'
const publicPath = `/wp-content/themes/${currentDir()}/`
const buildPath = 'dist'
const localUrl = `${protocol}${localDomain}`
const devPort = 5000

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
    proxy: {
      '/': {
        target: localUrl,
        secure: false,
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
  ],
});
