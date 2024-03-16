import axios from 'axios'

const http = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

http.interceptors.request.use(
  (config) => {
  const jwt = localStorage.getItem('__access')
    if (jwt) {
      config.headers.authorization = `Bearer ${jwt}`
      config.headers.__company_id = localStorage.getItem('__company')
    }

    return config
  },
  (error) => {
    console.log(`Erro: ${error}`)
    // Promise.reject(error)
  }
)

export { http }
