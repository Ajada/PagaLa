<template>
<!-- <h1 class="w-full flex justify-center" v-show="!dataTable[0]">
  <span class="flex">
    Não há registros
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
    </svg>
  </span>
</h1> -->

<div v-if="dataTable" class="w-full overflow-x-auto py-2 sm:px-6 lg:px-2 rounded-md">
  <table class="w-full">
    <thead>
      <tr>
        <th v-for="(column, index) in dataTable" :key="index" scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
          <a href="#" class="group inline-flex pl-2">
            {{ Object.keys(column)[index] }}
          </a>
        </th>
        <th class="py-1 pl-4 pr-2 text-center text-sm font-semibold text-gray-900 sm:pl-0">
          <span class="mb-1.5"> Ações </span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(row, indexBody) in dataTable" :key="indexBody" class="hover:shadow-lg hover:-translate-y-1 hover:-translate-x-1 transition-all z-9" :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'">
        <td v-for="(column, indexColumn) in row" :key="indexColumn" class="text-left whitespace-nowrap pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 cursor-pointer min-w-[200px]">
          <span class="pl-2" v-if="column">
            {{ column }}
          </span>
          <span class="font-light" v-else>
            <i>Não informado</i>
          </span>
        </td>
        <td class="flex justify-center whitespace-nowrap py-1 pr-2 text-sm font-medium text-gray-900 sm:pl-0">
          <ActionsButtonVue
            :link="{name: 'employees-update' } + dataTable[indexBody].id "
          />
        </td>
      </tr>
    </tbody>
  </table>
</div>
<!-- <Modal :show="modalOpen" :closeable="true" :title="title" @close="closeModal">
  <ReportVue
    :fields="modalFields"
    :title="title"
    @close="closeModal"
/>
</Modal> -->
</template>

<script>
import ActionsButtonVue from './ActionsButton.vue'

export default {
  components: {
    ActionsButtonVue
  },
  props: {
    dataTable: [Object, Array]
  }
}
</script>

<style>

</style>
