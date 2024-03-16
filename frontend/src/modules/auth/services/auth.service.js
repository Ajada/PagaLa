import { http } from '@/http'
import { senderServe } from '@/imageServe'
import router from '@/router'
import { storeApp } from '@/store'

const PATH = 'auth/'

class AuthService {
  async login(request) {
    return http.post(PATH.concat('signin'), request)
  }

  async logout() {
    await http.post(PATH.concat('logout'))
    storeApp.state.accessToken.clear()

    return router.push('/login')
  }

  async sendNotification() {
    senderServe.get('info')
      .catch(err => {
        // slack
        console.log('Notificações - 409');
      })
  }

  async sendAlertAndWarningNotification() {
    senderServe.get('check-expiration')
      .catch(err => {
        // slack
        console.log('Notificações de aviso - 409');
      })
  }

}

export default new AuthService()
