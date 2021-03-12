import Vue from 'vue'
import Vuex from 'vuex'

/**
 * Import each vuex module individually
 */
import system from './modules/system'

/**
 * Import each vuex plugin individually
 */

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    system
  },
  plugins: []
})
