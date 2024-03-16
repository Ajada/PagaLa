import App from './App.vue'
import router from './router'
import Toast from 'vue-toastification'
import { createApp } from 'vue'
import { storeApp } from './store'
import './registerServiceWorker'
import 'vue-toastification/dist/index.css'
import './styles/toasts.scss'
import { mask } from 'vue-the-mask'
import Lottie from 'vue-lottie'
import VueGoodTablePlugin from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css'

const toastConfig = {
  position: 'top-right',
  timeout: 5000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: false,
  closeButton: 'button',
  icon: true,
  rtl: false
}
const app = createApp(App)

app.config.productionTip = false

app
  .directive('mask', mask)
  .component('lottie', Lottie)
  .use(Toast, toastConfig)
  .use(VueGoodTablePlugin)
  .use(router)
  .use(storeApp)
  .mount('#app')
