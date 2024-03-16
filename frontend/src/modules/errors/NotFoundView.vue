<template>
  <lottie
  :options="animationOptions"
  :width="500"
  :height="500"
  />
  <h1>
    Página não encontrada
  </h1>
</template>

<script>
export default {
  data () {
    return {
      animationOptions: {
        animationData: require('@/assets/lotties/404.json'),
        loop: false,
        autoplay: true
      }
    }
  }
}
</script>

<style>

</style>
