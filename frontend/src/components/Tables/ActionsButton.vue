<template>
  <div class="rounded-md w-fit mb-1">
    <router-link :to="link" title="Editar dados"
      class="bg-yellow-200 transition-all hover:bg-yellow-500 text-yellow-700 font-bold py-2 px-3 rounded-tl-md rounded-bl-md">
      <i class="text-lg fas fa-edit"></i>
    </router-link>

    <router-link to="#" @click="deleteEvent" title="Excluir"
      class="bg-red-200 transition-all hover:bg-red-500 text-red-700 font-bold py-2 px-3">
      <i class="text-lg fas fa-trash-alt"></i>
    </router-link>

    <router-link to="#" title="Relatório"
      class="bg-green-200 transition-all hover:bg-green-500 text-green-700 font-bold py-2 px-3 rounded-tr-md rounded-br-md"
      @click="redirectToReport">
      <i class="text-lg fa-solid fa-file-invoice"></i>
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    link: [
      Object,
      String
    ]
  },
  methods: {
    deleteEvent () {
      this.$emit('delete')
    },
    redirectToReport () {
      this.$emit('getReport')
    }
  }
}
</script>

<style></style>
