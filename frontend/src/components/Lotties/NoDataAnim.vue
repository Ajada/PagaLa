<template>
  <div class="block text-center">
    <lottie
      :options="animationOptions"
      :width="width"
      :height="height"
    />
    <h2 class="-mt-8">
      Nenhum registro encontrado
    </h2>
  </div>
</template>

<script>
export default {
  props: {
    width: { Number, default: 200 },
    height: { Number, default: 200 }
  },
  data () {
    return {
      animationOptions: {
        animationData: require('@/assets/lotties/no-data.json'),
        loop: false,
        autoplay: true
      }
    }
  }
}
</script>

<style scoped lang="scss">
h2 {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  color: #4a4a4a;
}
</style>
