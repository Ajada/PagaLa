import HomeView from './../HomeView.vue'
import RequestView from './../layout/ItenRequestView.vue'

export const homeRoute = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/new-request',
    name: 'new-request',
    component: RequestView
  }
]
