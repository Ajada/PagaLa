import { createRouter, createWebHistory } from 'vue-router'
import { homeRoute } from '@/modules/home/routes'
import { loginRoute } from '@/modules/auth/routes'
import { http } from '@/http'
import { useToast } from 'vue-toastification'
import { storeApp } from '@/store'
import { profileRoute } from '@/modules/profile/routes'

const toast = useToast()
const routes = [
  ...homeRoute,
  ...loginRoute,
  ...profileRoute
]

const router = createRouter({
  history: createWebHistory('#'),
  routes
})

router.beforeEach(async (to, from, next) => {
  storeApp.state.loading = true
  if (to.name !== 'login') {
    try {
      await http.get(process.env.VUE_APP_API_URL.concat('auth/me'))
      storeApp.state.loading = false
      next()
    } catch (error) {
      toast(
        'Sessão expirada!', {
          toastClassName: 'toast-error'
        })
      storeApp.state.loading = false
      next({ name: 'login' })
    }
  } else {
    storeApp.state.accessToken.clear()
    storeApp.state.loading = false
    next()
  }
})

export default router
