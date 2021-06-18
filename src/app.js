import 'vite/dynamic-import-polyfill'
import { createApp } from 'vue'
import { store } from './js/store/index'

import './app.scss'

// UNCOMMENT THE SCRIPT BELOW IF YOU NEED jQUERY SCRIPTING
import './js/includes/globals'
// import './js/script'

import Components from './js/includes/components'

const el = document.getElementById('page')
const siteData = window.siteData

// Create App
const app = createApp({
  template: el.innerHTML
})

// Use Globals
Components(app)
app.use(store)

// Mount App
app.mount(el)
