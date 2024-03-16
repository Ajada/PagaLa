import { createStore } from 'vuex'

export const storeApp = createStore({
  state: () => {
    return {
      accessToken: localStorage,
      loading: false,
      showMenu: false
    }
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
