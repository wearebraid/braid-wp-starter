import 'vite/dynamic-import-polyfill'
import 'intersection-observer'
import ObserverDirective from './js/includes/ObserverDirective'
import Components from './js/includes/components'
import { registerComponents } from './js/includes/RegisterComponents'
import { createApp } from 'vue'
import { store } from './js/store/index'

import './app.scss'

// UNCOMMENT THE SCRIPT BELOW IF YOU NEED jQUERY SCRIPTING
import './js/includes/globals'
// import './js/script'

const el = document.getElementById('page')
const siteData = window.siteData

// Create App
const app = createApp({
  template: el.innerHTML
})

// Use Globals
Components(app)
registerComponents(app)
app.use(store)
app.directive('observe', ObserverDirective)

// Mount App
app.mount(el)
