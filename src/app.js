import 'vite/dynamic-import-polyfill'
import { createApp } from 'vue'

import './app.scss'

// UNCOMMENT THE SCRIPT BELOW IF YOU NEED jQUERY SCRIPTING
// import './js/script'

import Sample from './js/components/Sample.vue'
import { VueGriddle } from '@braid/griddle'

const el = document.getElementById('page')
const siteData = window.siteData

createApp({
  template: el.innerHTML,
  components: {
    Sample,
    Griddle: VueGriddle
  }
}).mount(el)
