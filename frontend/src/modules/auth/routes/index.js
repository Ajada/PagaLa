import LoginView from './../LoginView.vue'

export const loginRoute = [
  {
    path: '/signin',
    name: 'login',
    alias: '/login',
    component: LoginView
  },
  {
    path: '/logout',
    name: 'logout',
    alias: '/logout'
  },

]
