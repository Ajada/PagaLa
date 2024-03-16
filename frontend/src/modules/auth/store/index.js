import { createStore } from 'vuex'

export const dataAuth = createStore({
  state: () => {
    return {
      email: undefined,
      password: undefined
    }
  }
})
