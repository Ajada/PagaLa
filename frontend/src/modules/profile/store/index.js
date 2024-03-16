import { createStore } from 'vuex'

export const dataUser = createStore({
  state: () => {
    return {
      user: {
        name: undefined,
        function: undefined,
        role: undefined,
        email: undefined,
        phone: undefined,
        password: undefined,
        image_profile: undefined,
        company_id: localStorage.getItem('__company')
      },
      imgPath: undefined
    }
  },
  mutations: {
    reset (state) {
      state.user.name = undefined
      state.user.function = undefined
      state.user.role = undefined
      state.user.email = undefined
      state.user.phone = undefined
      state.user.password = undefined
      state.user.image_profile = undefined
      state.imgPath = undefined
    }
  }
})
