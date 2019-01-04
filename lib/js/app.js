import '../scss/style.scss' // WEBPACK BUILD STYLES
import Vue from 'vue'
import Vuex from 'vuex'
import store from './store'

// import Legacy from './script.js' // <=== THIS NEEDS TO BE PHASED OUT EVENTUALLY
// import Globals from './includes/globals'
// import AppFilters from './includes/filters'

import AppComponents from './includes/components'

window.siteData = siteData

var app = new Vue({
  el: '#page',
  store
})
