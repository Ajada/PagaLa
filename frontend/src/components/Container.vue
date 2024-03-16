<template>
  <div class="border w-full max-w-[100%] overflow-x-auto border-gray-300 p-1 mt-1 rounded-md">
    <div class="md:w-full overflow-x-auto">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: "ContainerVue",
};
</script>