import { http } from '@/http'
import { imgServe } from '@/imageServe'

const PATH = 'app/profile/'

class ProfileService {
  async getMeProfile (meUuid) {
    return http.get(PATH.concat('me/').concat(meUuid))
  }

  async saveImage (newImg) {
    const headers = {
      headers: {
        BASE_PATH: process.env.VUE_APP_BASE_API_URL,
        __company: localStorage.getItem('__company')
      }
    }

    return imgServe.post('new-file', { file: newImg }, headers)
  }

  async editImage (newImg, imgPath) {
    const headers = {
      headers: {
        BASE_PATH: process.env.VUE_APP_BASE_API_URL,
        __company: localStorage.getItem('__company'),
        __company_path: imgPath
      }
    }

    return imgServe.post('replace-file', { file: newImg }, headers)
  }

  async updateMe (meUuid, meBody) {
    return http.patch(PATH.concat('me/').concat(meUuid).concat('/edit'), meBody)
  }
}

export default new ProfileService()
