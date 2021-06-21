import { createStore } from 'vuex';

/**
 * Import each vuex module individually
 */
import system from './modules/system'

/**
 * Import each vuex plugin individually
 */
// import plugin from './plugins/plugin-name'

export const store = createStore({
  modules: {
    system
  },
  plugins: []
})
