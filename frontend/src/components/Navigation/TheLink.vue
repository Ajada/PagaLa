<template>
  <div>
    <div v-if="dataRoute.subMenu">
      <div class="-ml-8">
        <p @click="toggleSubMenu" class="text-lg p-2 flex bg-gray-50 rounded-md text-[#2c3e50] font-semibol">
          {{ dataRoute.title }}
          <span class="text-end w-full pr-3">
            <i class="fa-solid fa-chevron-up" :class="rotateClass"></i>
          </span>
        </p>
        <Transition mode="out-in">
          <div v-if="isSubMenuVisible" key="sub-menu">
            <span v-for="(item, index) in dataRoute.subMenu" :key="index">
              <router-link :to="item.route" class="router-link-exact-active">
                <p class="font-light ml-5 mb-4">
                  <i class="mr-3" :class="item.icon"></i>
                  {{ item.label }}
                </p>
              </router-link>
            </span>
          </div>
        </Transition>
      </div>
    </div>
    <div v-else>
      <router-link :to="dataRoute.route">
        <p class="-ml-3 mb-3">
          <i class="mr-3" :class="dataRoute.icon"></i>
          {{ dataRoute.label }}
        </p>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dataRoute: {
      Object
    }
  },
  data () {
    return {
      isSubMenuVisible: true
    }
  },
  computed: {
    rotateClass () {
      return this.isSubMenuVisible ? 'rotate-icon-up' : 'rotate-icon-down'
    }
  },
  methods: {
    toggleSubMenu () {
      this.isSubMenuVisible = !this.isSubMenuVisible
    }
  }
}
</script>

<style scoped lang="scss">
a {
  color: #2c3e50;

  p {
    text-decoration: none;
    transform: translate3d(-5px, -50%, 0);
    transition: all 0.15s ease-in-out;

    &:hover {
      opacity: 1;
      color: #177835;
      text-shadow: 5px 5px 15px #ccc;
      transform: translate3d(0px, -50%, 0);
    }
  }

  &.router-link-active {
    color: #177835 !important;
  }
}

p {
  transform: translate3d(-5px, -50%, 0);
  transition: all 0.15s ease-in-out;
  font-weight: bold;
}

.rotate-icon-up {
  transform: rotate(180deg);
  transition: transform 0.3s ease;
}

.rotate-icon-down {
  transform: rotate(0deg);
  transition: transform 0.3s ease;
}
</style>
