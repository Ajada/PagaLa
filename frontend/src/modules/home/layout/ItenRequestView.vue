<template>
  <div>
    <PageTitle> Nova tela </PageTitle>
    <ContainerVue>
      <div class="flex justify-start">
        <h1>Personalize esta tela para suas necessidades</h1>
      </div>
    </ContainerVue>
    <FloatBackPageVue />
  </div>
</template>

<script setup>
import ContainerVue from "@/components/Container.vue";
import PageTitle from "@/components/Titles/PageTitle.vue";
import FloatBackPageVue from "@/components/Buttons/FloatBackPage.vue";
import { dataHome } from "../store";
import { useToast } from "vue-toastification";
import { storeApp } from "@/store";
import { onMounted } from "vue";
import * as yup from "./../../../validator";

const appStore = storeApp;
const store = dataHome;
const toast = useToast();

onMounted(async () => {
  appStore.state.loading = true;
  // 
  appStore.state.loading = false;
});

</script>
