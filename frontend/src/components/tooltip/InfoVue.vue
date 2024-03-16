<template>
  <div class="pr-2">
    <div class="group cursor-pointer relative inline-block text-center">
      <i class="fa-solid fa-circle-info text-green"></i>
      <div class="border border-gray-300 w-28 opacity-0 bg-white text-black font-bold text-center text-xs rounded-lg pt-2 absolute z-10 group-hover:opacity-100 bottom-full pointer-events-none">
        {{ label }}
        <svg class="text-black h-2 w-full left-0 top-full" x="0px" y="0px">
          <polygon class="fill-current" />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default ({
  props: {
    label: String
  }
})
</script>

<style lang="scss">
.text-green {
  color: #2cc514;
}
</style>
