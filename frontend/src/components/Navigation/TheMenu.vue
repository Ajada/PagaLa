<template>
  <div class="wrapper">
    <nav class="menu" tabindex="0">
      <div class="smartphone-menu-trigger"></div>
      <header class="avatar">
        <div class="img"></div>
      </header>
      <ul>
        <li
          v-for="(item, index) in links"
          :key="index"
          class="icon-dashboard ml-12 mb-2"
        >
          <Link :dataRoute="item" />
        </li>
      </ul>
      <div class="absolute bottom-0 text-left w-full">
        <ul>
          <li
            @click="logout"
            class="icon-dashboard ml-12 mb-2"
            @mouseenter="exit.icon = 'fa-solid fa-door-open'"
            @mouseleave="exit.icon = 'fa-solid fa-door-closed'"
          >
            <Link :dataRoute="exit" />
          </li>
        </ul>
      </div>
    </nav>
    <main class="content">
      <div class="helper">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import { storeApp } from "@/store";
import Link from "./TheLink.vue";
import { onMounted, ref } from "vue";
import AuthService from "@/modules/auth/services/auth.service";
import { useToast } from "vue-toastification";

const toast = useToast();
const exit = ref({
  label: "Sair",
  route: "/logout",
  icon: "fa-solid fa-door-closed",
});
const links = ref([
  {
    label: "Inicio",
    route: "/",
    icon: "fa-solid fa-house-chimney",
  },
  {
    title: "Cadastros",
    icon: "fa-solid fa-users",
    subMenu: [
      {
        label: "Novo menu",
        route: "/##",
        icon: "fa-solid fa-user",
      },
    ],
  },
  {
    title: "Configurações",
    icon: "fa-solid fa-users",
    subMenu: [
      {
        label: "Meu perfil",
        route: "/profile",
        icon: "fa-solid fa-user",
      },
    ],
  },
]);

onMounted(() => {
  storeApp.state.showMenu = true;
});

async function logout() {
  AuthService.logout()
    .then((res) => {
      toast("Até logo!", { toastClassName: "toast-success" });
    })
    .catch((err) => {
      console.log(err);
      toast("Algo deu errado!", { toastClassName: "toast-error" });
    });
}
</script>

<style lang="scss" scoped>
.wrapper {
  .content {
    flex: 1;

    @media screen and (min-width: 900px) {
      margin-left: 240px;
    }
  }
}

.menu-header {
  @media screen and (min-width: 901px) {
    position: fixed;
    top: 0;
    left: 240px;
    width: calc(100% - 240px);
    background-color: #cb0000;
    z-index: 10;
  }
}

main {
  position: relative;
  height: 100vh;

  .helper {
    // width: 100%;
    height: 100vh;
    top: 25%;
    left: 50%;
    padding: 0.5em;
    text-align: center;
    border-radius: 5px;
  }
}

.menu {
  height: 100vh;
  background-color: white;
  border-right: 1px solid #ccc;
  border-radius: 5px;
  width: 240px;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 5;
  outline: none;

  .avatar {
    padding: 1px;

    .img {
      background-image: url(~@/assets/logo/app.png);
      background-position: center;
      background-size: contain;
      background-repeat: no-repeat;
      width: 100%;
      height: 7em;
      overflow: hidden;
    }
  }

  ul {
    list-style: none;
    margin-top: 3em;

    li {
      font-size: 1em;
      transition: all 0.15s linear;
      text-align: left;
      cursor: pointer;

      p {
        padding: 1px;
        top: 50%;
        left: 80px;
        transform: translate3d(-5px, -50%, 0);
        transition: all 0.15s ease-in-out;
      }

      &:hover p {
        opacity: 1;
        color: #177835;
        text-shadow: 5px 5px 15px #ccc;
        transform: translate3d(0px, -50%, 0);
      }
    }
  }
}

@media screen and (max-width: 900px) {
  .menu {
    width: 230px;
    box-shadow: 0 0 0 100em rgba(0, 0, 0, 0);
    transform: translate3d(-230px, 0, 0);
    transition: all 0.3s ease-in-out;

    .smartphone-menu-trigger {
      width: 40px;
      height: 40px;
      position: absolute;
      left: 100%;
      background: #fff;
      margin: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;

      &:before,
      &:after {
        content: "";
        width: 60%;
        height: 2px;
        background: #91cb25;
        border-radius: 10px;
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate3d(-50%, -50%, 0);
      }

      &:after {
        top: 55%;
        transform: translate3d(-50%, -50%, 0);
      }
    }

    &:focus {
      transform: translate3d(0, 0, 0);
      box-shadow: 0 0 0 100em rgba(0, 0, 0, 0.6);
    }

    &:focus .smartphone-menu-trigger {
      pointer-events: none;
    }
  }
}
</style>
