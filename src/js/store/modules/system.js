/**
 * Setup the initial state for module.
 */
const state = () => ({
  lockScroll: false,
  gridIsVisible: false
})

/**
 * Setup getters, use these like computed properties for the store module.
 */
const getters = {
  lockScroll (state) {
    return state.lockScroll
  },
  gridIsVisible (state) {
    return state.gridIsVisible
  }
}

/**
 * Setup actions. Use these for any and all async or complex logic
 */
const actions = {
}

/**
 * Setup mutations. These should be simple and directly manipulate the store with
 * _no side effects_.
 */
const mutations = {
  setLockScroll (state, value) {
    state.lockScroll = value
  },
  setGridIsVisible (state, payload) {
    state.gridIsVisible = payload
  }
}

/**
 * Finally export our completed vuex module.
 */
export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
