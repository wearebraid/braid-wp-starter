import '../scss/style.scss' // WEBPACK BUILD STYLES
import Vue from 'vue'
import Vuex from 'vuex'
import store from './store'

// import Legacy from './script.js' // <=== THIS NEEDS TO BE PHASED OUT EVENTUALLY
// import Globals from './includes/globals'
// import AppFilters from './includes/filters'

import AppComponents from './includes/components'

window.siteData = siteData

// GRAVITY FORMS SAFARI FIX
const gformsAjax = document.querySelectorAll("iframe[name^='gform_ajax_frame_']")
gformsAjax.forEach(i => {
  const cln = i.cloneNode(true)
  i.remove()
  document.getElementsByTagName('body')[0].appendChild(cln)
})

var app = new Vue({
  el: '#page',
  store
})
