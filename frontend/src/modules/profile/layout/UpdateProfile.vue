<template>
  <div>
    <PageTitleVue> Meus dados </PageTitleVue>
    <ContainerVue>
      <Form :description-title="'Editar perfil'">
        <CreateButton @click="editMe" :icon="'fa-solid fa-check'" :label="'Salvar'" />
      </Form>
    </ContainerVue>
    <FloatBackPage />
  </div>
</template>

<script setup>
import FloatBackPage from '@/components/Buttons/FloatBackPage.vue'
import PageTitleVue from '@/components/Titles/PageTitle.vue'
import Form from './Form.vue'
import ContainerVue from '@/components/Container.vue'
import CreateButton from '@/components/Buttons/Create.vue'
import { onMounted } from 'vue'
import { dataUser } from '../store'
import ProfileService from '../services/profile.service'
import { storeApp } from '@/store'
import { useRoute } from 'vue-router'
import { useToast } from 'vue-toastification'
import * as yup from './../../../validator'
import { setFormFieldsError } from '@/helpers/formFieldsHandler'

const store = dataUser
const appStore = storeApp.state
const meUuid = useRoute()
const toast = useToast()

const schema = yup.object().shape({
  user: yup.object().shape({
    name: yup.string().label('Nome').required().min(3),
    email: yup.string().email().label('Email').required().min(10)
  })
})

onMounted(async () => {
  store.commit('reset')
  await getMeData()
})

async function getMeData () {
  appStore.loading = true
  await ProfileService.getMeProfile(meUuid.params.id)
    .then((res) => {
      store.state.user.name = res.data.name
      store.state.user.function = res.data.function
      store.state.user.role = res.data.roles_id
      store.state.user.email = res.data.email
      store.state.user.phone = res.data.phone
      store.state.user.password = res.data.password
      store.state.imgPath = res.data.image_profile

      appStore.loading = false
    })
    .catch((err) => {
      appStore.loading = false
      toast('Algo deu errado ao buscar dados!', {
        toastClassName: 'toast-error'
      })
    })
}

async function editMe () {
  appStore.loading = true

  const errors = []
  await schema.validate(store.state, { abortEarly: false }).catch((err) => {
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

  if (store.state.user.image_profile && typeof (store.state.user.image_profile) === 'object' && typeof (store.state.imgPath) === 'string') {
    await ProfileService.editImage(store.state.user.image_profile, store.state.imgPath).then(res => {
      store.state.imgPath = res.data
      store.state.user.image_profile = res.data
    }).catch(err => {
      toast('Algo deu errado ao subir arquivo!', { toastClassName: 'toast-warning' })
    })
  } else if (store.state.user.image_profile && typeof (store.state.user.image_profile) !== 'string') {
    await ProfileService.saveImage(store.state.user.image_profile).then(res => {
      store.state.imgPath = res.data
      store.state.user.image_profile = res.data
    }).catch(err => {
      toast('Algo deu errado ao subir arquivo!', { toastClassName: 'toast-warning' })
    })
  } else { store.state.user.image_profile = store.state.imgPath }

  await ProfileService.updateMe(meUuid.params.id, store.state.user)
    .then((res) => {
      if (res.data.success) {
        toast('Dados atualizados com sucesso!', {
          toastClassName: 'toast-success'
        })
      }
      appStore.loading = false
    })
    .catch((err) => {
      toast('Algo deu errado ao atualizar item!', {
        toastClassName: 'toast-error'
      })
      appStore.loading = false
    })
}

</script>

<style></style>
