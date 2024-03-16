<template>
  <div class="p-6 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
      <div>
        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-left hidden md:block">
              <p class="mb-4 font-medium text-lg text-gray-800">
                {{ descriptionTitle }}
              </p>
              <p class="text-gray-500">
                Campos com <span class="text-red-500">*</span> são obrigatórios
              </p>
              <div class="flex justify-center">
                <img
                  v-if="selectedFileUrl || store.state.imgPath"
                  :src="selectedFileUrl ?? fileUrl + store.state.imgPath"
                  alt="Usuario"
                  class="mt-14 mb-auto rounded-md w-60 max-h-60 hidden md:block"
                />
              </div>
            </div>

            <div id="form-fields" class="lg:col-span-2">
              <div
                class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5"
              >
                <div class="md:col-span-5">
                  <label class="text-left flex pl-1" for="name">
                    Nome de usuario <a class="text-red-600 ml-1">*</a>
                  </label>
                  <div
                    class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1"
                  >
                    <input
                      v-model="store.state.user.name"
                      type="text"
                      name="name"
                      class="px-1 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    />
                    <CleanInputButton
                      @click="store.state.user.name = undefined"
                    />
                  </div>

                  <span name="user.name" class="text-red-600 text-sm" />
                </div>

                <div class="md:col-span-2">
                  <label class="text-left flex pl-1" for="rg">Cargo</label>
                  <div
                    class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1"
                  >
                    <input
                      v-model="store.state.user.function"
                      name="user.function"
                      class="px-1 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    />
                    <CleanInputButton
                      @click="store.state.user.function = undefined"
                    />
                  </div>
                </div>

                <div class="md:col-span-2">
                  <label class="text-left flex pl-1" for="user.email">
                    <Info :label="'Seu e-mail de acesso ao Protege'" /> Email
                    <a class="text-red-600 ml-1">*</a>
                  </label>
                  <div
                    class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1"
                  >
                    <input
                      v-model="store.state.user.email"
                      name="user.email"
                      type="email"
                      class="px-1 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    />
                    <CleanInputButton
                      @click="store.state.user.email = undefined"
                    />
                  </div>

                  <span name="user.email" class="text-red-600 text-sm" />
                </div>

                <div class="md:col-span-1">
                  <label class="text-left flex pl-1" for="cnh">Celular</label>
                  <div
                    class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1"
                  >
                    <input
                      v-mask="'(##) # ####-####'"
                      v-model="store.state.user.phone"
                      type="text"
                      name="cnh"
                      class="px-1 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    />
                    <CleanInputButton
                      @click="store.state.user.phone = undefined"
                    />
                  </div>
                </div>

                <div class="flex justify-center">
                  <img
                    v-if="selectedFileUrl || store.state.imgPath"
                    :src="selectedFileUrl ?? fileUrl + store.state.imgPath"
                    alt="Usuario"
                    class="mt-2 rounded-md w-60 max-h-60 block md:hidden"
                  />
                </div>

                <div class="md:col-span-5 flex h-10">
                  <label
                    class="cursor-pointer bg-gray-100 hover:bg-gray-300 transition-all min-w-[8rem] pt-2.5 h-10 rounded-l-md rounded-r-none"
                  >
                    <i class="fa-solid fa-user mr-1"></i>
                    Foto do Perfil
                    <input
                      type="file"
                      class="hidden"
                      @change="handleFileChange"
                    />
                  </label>
                  <input
                    type="text"
                    style="padding-left: 10px !important"
                    class="border rounded w-full h-10 rounded-r-md rounded-l-none"
                    :value="selectedFileName"
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-center mt-8">
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CleanInputButton from './../component/CleanInputButton.vue'
import { dataUser } from '../store/'
import { useToast } from 'vue-toastification'
import Info from './../../../components/tooltip/InfoVue.vue'

export default {
  components: {
    CleanInputButton,
    Info
  },
  props: {
    descriptionTitle: String
  },
  data () {
    const fileUrl = process.env.VUE_APP_IMAGE_SERVE + 'storage/'
    const store = dataUser
    const toast = useToast()
    return {
      store,
      toast,
      fileUrl,
      selectedFileName: undefined,
      selectedFileUrl: undefined
    }
  },
  mounted () {
    console.log(this.store.state)
  },
  methods: {
    handleFileChange (event) {
      const file = event.target.files[0]
      if (file) {
        const allowedExtensions = ['webp', 'png', 'gif', 'jpeg', 'jpg']
        const fileExtension = file.name.split('.').pop().toLowerCase()

        if (allowedExtensions.includes(fileExtension)) {
          this.selectedFileName = file.name
          this.selectedFileUrl = URL.createObjectURL(file)
          this.store.state.user.image_profile = file
        } else {
          this.selectedFileUrl = undefined
          this.selectedFileName = undefined
          this.store.state.user.image_profile = undefined
          return this.toast('Tipo de arquivo não é válido !', {
            toastClassName: 'toast-error'
          })
        }
      }
    }
  }
}
</script>
