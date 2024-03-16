<template>
  <router-link :to="link" class="create-btn">
    <span class="icon">
      <i :class="!icon ? 'fas fa-plus' : icon"></i>
    </span>
    <p class="text">
      {{ label }}
    </p>
  </router-link>
</template>

<script>
export default {
  name: 'LinkVue',
  props: {
    link: {
      String,
      require: true
    },
    icon: {
      String,
      default: 'fas fa-plus'
    },
    label: {
      String,
      default: 'Adicionar',
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.create-btn {
  color: white;
  min-width: 160px;
  // width: 140px;
  height: 40px;
  border-radius: 5px;
  border: none;
  background-image: linear-gradient(to right, #0b7037, #92cd24);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition-duration: .5s;
  overflow: hidden;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.103);
  position: relative;

  &:active {
    border: 1px solid white;
    transform: scale(0.95);
    transition-duration: .5s;
  }

  .icon {
    position: absolute;
    left: -50px;
    width: 30px;
    height: 30px;
    background-color: transparent;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    z-index: 2;
    transition-duration: .5s;
  }

  .text {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    z-index: 1;
    transition-duration: .5s;
    font-size: 1.04em;
    font-weight: 600;
  }
}

.create-btn {
  &:hover .icon {
    transform: translateX(58px);
    border-radius: 40px;
    transition-duration: 0.3s;
  }

  &:active .icon {
    transform: translateX(58px);
    border-radius: 40px;
    transition-duration: 0.3s;
  }

  &:focus .icon {
    transform: translateX(58px);
    border-radius: 40px;
    transition-duration: 0.3s;
  }
}

.create-btn {
  &:hover .text {
    transform: translate(10px, 0px);
    transition-duration: .5s;
  }

  &:active .text {
    transform: translate(10px, 0px);
    transition-duration: .5s;
  }

  &:focus .text {
    transform: translate(10px, 0px);
    transition-duration: .5s;
  }
}
</style>
