<template>
  <div
    class="ml-1 mt-2 p-2 border border-gray-200 rounded bg-gray-50 inline-block"
  >
    {{ item }}
  </div>
  <button
    class="flex items-center justify-center bg-red-500 text-white p-2 rounded-full -ml-4 -mt-1 h-5 w-5 "
    @click="removeItem"
  >
    <i class="fas fa-times"></i>
  </button>
</template>

<script>
export default {
  props: {
    item: String
  },
  methods: {
    removeItem() {
      this.$emit('removeItem')
    },
  },
  emits: ['removeItem']
};
</script>

<style scoped></style>
