import 'vite/dynamic-import-polyfill'
import { createApp } from 'vue'

import './app.scss'
import './js/script'

import Sample from './js/components/Sample.vue'

const el = document.getElementById('page')
const siteData = window.siteData

createApp({
  template: el.innerHTML,
  components: {
    Sample
  }
}).mount(el)
