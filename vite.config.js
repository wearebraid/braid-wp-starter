import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
// import legacy from '@vitejs/plugin-legacy'
import liveReload from 'vite-plugin-live-reload'
const { resolve, basename } = require('path')

const themeDir = resolve(__dirname, './')
const themeUrl = `/wp-content/themes/${basename(__dirname)}`

export default defineConfig({
  plugins: [
    vue(),
    liveReload(themeDir+'/**/*.php')
  ],
  root: 'src',
  base: themeUrl + (process.env.NODE_ENV === 'production' ? '/dist/' : '/src/'),
  build: {
    // output dir for production build
    outDir: themeDir + '/dist',
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    rollupOptions: {
      input: '/app.js'
    }
  },
  server: {
    // required to load scripts from custom host
    cors: true,
    // we need a strict port to match on PHP side
    //
    strictPort: true,
    port: 3000
    // if changed match here /templates/html/vite.php
  },

  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js'
    }
  }
})
