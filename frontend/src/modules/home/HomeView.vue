<template>
  <div>
    <PageTitleVue> Comece seu app </PageTitleVue>

    <ContainerVue>
      
    </ContainerVue>

    <FloatCreateVue :link="'new-request'" :icon="'fas fa-plus'" />
  </div>
</template>

<script setup>
import Welcome from "../Welcome.vue";
import PageTitleVue from "@/components/Titles/PageTitle.vue";
import FloatCreateVue from "@/components/Buttons/FloatCreate.vue";
import ContainerVue from "@/components/Container.vue";
import NoDataAnim from "@/components/Lotties/NoDataAnim.vue";
import { storeApp } from "@/store";
import { dataHome } from "./store";
</script>

<style></style>
