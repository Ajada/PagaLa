<template>
  <div id="app">
    <LoadingVue />
    <div v-if="storeApp.state.showMenu == false">
      <RouterView class="router-view" v-slot="{ Component }">
        <Transition mode="out-in">
          <component :is="Component" />
        </Transition>
      </RouterView>
    </div>
    <TheMenu v-if="storeApp.state.showMenu == true">
      <RouterView class="router-view" v-slot="{ Component }">
        <Transition mode="out-in">
          <component :is="Component" />
        </Transition>
      </RouterView>
    </TheMenu>
  </div>
</template>

<script setup>
import { RouterView } from "vue-router";
import TheMenu from "./components/Navigation/TheMenu.vue";
import LoadingVue from "@/components/Loading.vue";
import { onMounted } from "vue";
import router from "./router";
import { storeApp } from "./store/";

const accessToken = storeApp.state.accessToken;

onMounted(() => {
  if (!accessToken.getItem("__access")) {
    storeApp.state.showMenu = false;
    localStorage.clear();
    router.push("/login");
  }
  storeApp.state.showMenu = true;
});
</script>

<style lang="scss">
#app {
  font-family: Circular, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  ::-webkit-scrollbar {
    height: 4px;
  }

  ::-webkit-scrollbar-thumb {
    background-color: #888888ab;
    border-radius: 6px;
  }

  ::-webkit-scrollbar-track {
    background-color: #f1f1f1;
    border-radius: 6px;
  }
}
.v-enter-from,
.v-leave-to {
  transform: translate(50px);
  opacity: 0;
}

.v-enter-active,
.v-leave-active {
  transition: all 0.3s;
}
</style>
