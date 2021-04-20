import 'vite/dynamic-import-polyfill'
import { createApp } from 'vue'

import './app.scss'

// UNCOMMENT THE SCRIPT BELOW IF YOU NEED jQUERY SCRIPTING
// import './js/script'

import Components from './js/includes/components'

const el = document.getElementById('page')
const siteData = window.siteData

// Create App
const app = createApp({
  template: el.innerHTML
})

// Use Global Components
Components(app)

// Mount App
app.mount(el)
