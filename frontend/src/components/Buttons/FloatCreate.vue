<template>
  <router-link :to="{ name: link }">
    <button class="floating-button" :title="title">
      <i :class="!icon ? 'fas fa-plus' : icon"></i>
    </button>
  </router-link>
</template>

<script>
export default {
  name: 'FloatCreate',
  props: {
    icon: String,
    link: { type: String, nullable: false },
    title: { String, default: 'Adicionar' }
  }
}
</script>

<style lang="scss">
.floating-button {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background-image: linear-gradient(to right ,#93CD24, #0B7036);
  border: none;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  transition: 0.3s;
  i {
    color: #fff;
    font-size: 30px;
  }

  &:hover {
    background-image: linear-gradient(to right ,#93CD24, #0B7036);
    transform: translateY(-5px);
  }

  &:focus {
    box-shadow: 0px 0px 0px 2px rgba(11, 112, 54, 0.5);
    outline: none;
  }
}
</style>
