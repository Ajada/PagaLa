<template>
  <th class="text-sm font-semibold text-gray-900 min-w-[10rem] sm:pl-0 py-2" :class="{ 'text-left': textCenter }">
    <span class="mb-1.5 pl-2 pr-2 ">
      <slot />
    </span>
  </th>
</template>

<script>
export default {
  props: {
    textCenter: { Boolean, default: true }
  }
}
</script>
