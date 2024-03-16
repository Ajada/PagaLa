<template>
  <div>
    <PageTitleVue>
      Meu Perfil
    </PageTitleVue>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">

    <ContainerVue>
      <div class="profile-page">
        <section>
          <div class="container mx-auto px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-12">
              <div class="px-6">
                <div class="flex flex-wrap justify-center">

                  <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                    <div class="relative">
                      <img style="width: 150px; height: 150px;" width="800" height="800"
                        :src="
                          store.state.imgPath ? imgUrl + store.state.imgPath :
                          'https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg'
                        " class="shadow-xl rounded-full align-middle border-none absolute -m-10 -ml-20 lg:-ml-16 max-w-150-px">
                    </div>
                  </div>

                  <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                    <div class="py-6 px-3 mt-28 sm:mt-0">
                      <div class="px-2 py-2 flex justify-center md:justify-end">
                        <LinkButton :link="editUrl" :icon="'fa-solid fa-user-pen'" :label="'Editar'" />
                      </div>
                    </div>
                  </div>

                  <div class="w-full lg:w-4/12 px-4 lg:order-1 ">
                    <div class="flex justify-center py-4 lg:pt-4 pt-1">
                      <div class="mr-4 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                          22
                        </span>
                        <span class="text-sm text-blueGray-400">
                          Friends
                        </span>
                      </div>
                      <div class="mr-4 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                          10
                        </span>
                        <span class="text-sm text-blueGray-400">
                          Photos
                        </span>
                      </div>
                      <div class="lg:mr-4 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                          89
                        </span>
                        <span class="text-sm text-blueGray-400">
                          Comments
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center md:mt-10">
                  <h3 class="text-4xl font-semibold leading-normal mb-1 text-blueGray-700">
                    {{ store.state.user.name }}
                  </h3>
                  <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                    <i class="fa-solid fa-user-tie mr-2 text-lg text-blueGray-400"></i>
                    {{ store.state.user.function }}
                  </div>

                  <!-- <div class="text-align-block">
                    <div class="md:text-start md:w-1/3">
                      <div class="mb-2 text-blueGray-600 mt-10">
                        <p>
                          <i class="fa-solid fa-graduation-cap mr-2 text-lg text-blueGray-400"></i>
                          Solution Manager - Creative Tim Officer
                        </p>
                      </div>
                      <div class="mb-2 text-blueGray-600">
                        <p>
                          <i class="fa-solid fa-graduation-cap mr-2 text-lg text-blueGray-400"></i>
                          University of Computer Science
                        </p>
                      </div>
                    </div>
                  </div> -->
                </div>

                <div class="mt-5 border-t border-blueGray-200 text-center">
                  <div class="flex flex-wrap justify-center">
                    <div class="text-align-block w-full">
                      <div class="md:text-start md:w-1/3">
                        <div class="mb-2 text-blueGray-600 mt-4">
                          <p>
                            <i class="fa-solid fa-envelope mr-2 text-lg text-blueGray-400"></i>
                            {{ store.state.user.email }}
                          </p>
                        </div>
                        <div class="mb-4 text-blueGray-600">
                          <i class="fa-solid fa-square-phone mr-2 text-lg text-blueGray-400"></i>
                          {{ store.state.user.phone }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>
      </div>
    </ContainerVue>
  </div>
</template>

<script setup>
import PageTitleVue from '@/components/Titles/PageTitle.vue'
import ContainerVue from '@/components/Container.vue'
import LinkButton from '@/components/Buttons/Link.vue'
import { storeApp } from '@/store'
import { onMounted, ref } from 'vue'
import { dataUser } from './store'
import ProfileService from './services/profile.service'
import { useToast } from 'vue-toastification'

const appStore = storeApp
const store = dataUser
const toast = useToast()
const editUrl = '/profile/'.concat(appStore.state.accessToken.getItem('__uuid')).concat('/edit')

const imgUrl = ref(process.env.VUE_APP_IMAGE_SERVE.concat('storage/'))

onMounted(async () => {
  appStore.state.loading = true
  await getMeData()
  appStore.state.loading = false
})

async function getMeData () {
  appStore.loading = true
  await ProfileService.getMeProfile(appStore.state.accessToken.getItem('__uuid'))
    .then((res) => {
      store.state.user.name = res.data.name
      store.state.user.function = res.data.function
      store.state.user.role = res.data.roles_id
      store.state.user.email = res.data.email
      store.state.user.phone = res.data.phone
      store.state.user.password = res.data.password
      store.state.imgPath = res.data.image_profile

      appStore.state.loading = false
    })
    .catch((err) => {
      appStore.loading = false
      toast('Algo deu errado ao buscar dados!', {
        toastClassName: 'toast-error'
      })
    })
}

</script>

<style lang="scss" scoped>
.text-align-block {
  display: flex;
  justify-content: center;

  @media screen and (max-width: 768px) {
    text-align: left;
  }
}
</style>
