<template>
  <div class="min-h-screen flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
      <div
        class="absolute inset-0 bg-gradient-to-r from-green-300 to-green-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"
      ></div>
      <div
        class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20"
      >
        <div class="max-w-md mx-auto">
          <div>
            <h1 class="text-2xl font-semibold">Bem vindo</h1>
          </div>
          <div class="divide-y divide-gray-200">
            <div
              id="form-fields"
              class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7"
            >
              <div class="relative">
                <input
                  v-model="authStore.email"
                  id="email"
                  name="email"
                  type="text"
                  required
                  class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 p-2"
                  placeholder="Email"
                />
                <span name="email" class="text-red-600 text-sm" />

                <label
                  for="email"
                  class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                >
                  Email
                </label>
              </div>

              <div class="relative">
                <input
                  required
                  v-model="authStore.password"
                  name="password"
                  :type="inputType"
                  class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none p-2"
                  placeholder="Senha"
                  @keyup.enter="signin"
                />
                <span name="password" class="text-red-600 text-sm" />

                <label
                  for="password"
                  class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm"
                >
                  Senha
                </label>

                <span
                  @click="togglePasswordVisibility"
                  class="absolute right-0 top-2 cursor-pointer"
                >
                  <i v-if="showPassword" class="fas fa-eye text-gray-600"></i>
                  <i v-else class="fas fa-eye-slash text-gray-600"></i>
                </span>
              </div>

              <div class="justify-center flex">
                <CreateButton
                  @click="signin"
                  :icon="'fa-solid fa-arrow-right-to-bracket'"
                  :label="'Entrar'"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import CreateButton from '@/components/Buttons/Create.vue'
import AuthService from './services/auth.service'
import router from '@/router'
import * as yup from './../../validator'
import { ref, computed, onMounted } from 'vue'
import { storeApp } from '@/store'
import { dataAuth } from './store'
import { useToast } from 'vue-toastification'
import { senderServe } from '@/imageServe'
import { setFormFieldsError } from './../../helpers/formFieldsHandler'

const authStore = dataAuth.state
const appStore = storeApp.state
const toast = useToast()
const showPassword = ref(false)

const schema = yup.object().shape({
  email: yup.string().email().required().label('Email').max(35).min(11),
  password: yup.string().required().label('Senha').min(4)
})

const inputType = computed(() => (showPassword.value ? 'text' : 'password'))

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value
}

onMounted(() => {
  appStore.showMenu = false
})

async function signin () {
  appStore.loading = true;

  const errors = []
  await schema.validate(authStore, { abortEarly: false }).catch((err) => {
    err.inner.forEach((e) => {
      errors.push({
        name: e.path,
        msg: e.message
      })
    })
  })

  if (errors.length > 0) {
    appStore.loading = false
    setFormFieldsError(errors)
    return
  }

  await AuthService.login(authStore)
    .then((res) => {
      sendNotification();

      localStorage.__access = res.data.access_token;
      (localStorage.__uuid = res.data.user.id),
      (localStorage.__company = res.data.user.company_id),
      (appStore.accessToken = localStorage)
      appStore.showMenu = true
      appStore.loading = false
      toast('Bem vindo', {
        toastClassName: 'toast-success'
      })
      router.push('/')
    })
    .catch((err) => {
      if (err.response.status === 401) {
        appStore.loading = false
        return toast('Usuário ou senha incorretos!', { toastClassName: 'toast-warning' })
      }
    })
    .catch((err) => {
      appStore.loading = false
      appStore.showMenu = false
      console.log(err);
      return toast('Algo deu errado!', { toastClassName: 'toast-error' })
    })
}

const sendNotification = () => {
  AuthService.sendNotification();
  AuthService.sendAlertAndWarningNotification();
}

</script>

<style lang="scss" scoped>
.from-green-300 {
  --tw-gradient-from: #0b7037 var(--tw-gradient-from-position);
  --tw-gradient-to: rgb(147 197 253 / 0) var(--tw-gradient-to-position);
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-green-600 {
  --tw-gradient-to: #92cd24 var(--tw-gradient-to-position);
}
</style>
