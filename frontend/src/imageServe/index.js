import axios from 'axios'

const imgServe = axios.create({
  baseURL: process.env.VUE_APP_IMAGE_SERVE + 'api/v1/',
  headers: {
    'Content-Type': 'multipart/form-data'
  }
})

imgServe.interceptors.request.use(
  (config) => {
    const jwt = localStorage.getItem('__access')
    if (jwt) { config.headers.authorization = `Bearer ${jwt}` }
    return config
  },
  (error) => {
    console.log(error)
    // Promise.reject(error)
  }
)

const senderServe = axios.create({
  baseURL: process.env.VUE_APP_SENDER_SERVE + 'api/v1/',
  headers: {
    'Content-Type': 'application/json'
  }
})

senderServe.interceptors.request.use(
  (res) => {
    const jwt = localStorage.getItem('__access')
    if (jwt) { res.headers.authorization = `Bearer ${jwt}` }
    return res
  },
  (error) => {
    console.log(error)
    // Promise.reject(error)
  }
)

export { imgServe, senderServe }
