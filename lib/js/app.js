import '../scss/style.scss' // WEBPACK BUILD STYLES
import Vue from 'vue'
import Vuex from 'vuex'
import store from './store'
import Legacy from './script.js'

import Globals from './includes/globals'
import AppComponents from './includes/components'
import AppFilters from './includes/filters'

window.siteData = siteData

var app = new Vue({
  el: '#page',
  store
})




