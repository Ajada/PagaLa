import axios from 'axios'

const fingger = axios.create()

fingger.interceptors.request.use(
  (config) => {
    // const jwt = localStorage.getItem('__access')
    // if (jwt) { config.headers.authorization = `Bearer ${jwt}` }
    return config
  },
  (error) => {
    console.log(error)
    // Promise.reject(error)
  }
)

export { fingger }
