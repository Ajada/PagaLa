<template>
  <div class="w-full px-2 sm:px-0">
    <TabGroup>
      <TabList class="flex space-x-1 rounded-xl bg-gray-100 p-1">
        <Tab as="template" v-slot="{ selected }">
          <button
            :class="[
              'w-full rounded-lg py-2.5 text-sm font-medium leading-5 color-app',
              'ring-white/60 ring-offset-2 ring-offset-green-app focus:outline-none focus:ring-2',
              selected
                ? 'bg-white active-tab shadow'
                : 'text-blue-100 hover:text-[#177835]',
            ]"
          >
            <div class="flex items-center justify-center">
              <span>
                <i class="fa-regular fa-address-card"></i>
              </span>
              <h2 class="ml-1">Nova Retirada</h2>
            </div>
          </button>
        </Tab>

        <Tab as="template" v-slot="{ selected }">
          <button
            :class="[
              'w-full rounded-lg py-2.5 text-sm font-medium leading-5 color-app',
              'ring-white/60 ring-offset-2 ring-offset-green-app focus:outline-none focus:ring-2',
              selected
                ? 'bg-white active-tab shadow'
                : 'text-blue-100 hover:text-[#177835]',
            ]"
          >
            <div class="flex items-center justify-center">
              <span>
                <i class="fa-solid fa-file-invoice"></i>
              </span>
              <h2 class="ml-1">Relatórios</h2>
            </div>
          </button>
        </Tab>

        <Tab as="template" v-slot="{ selected }">
          <button
            :class="[
              'w-full rounded-lg py-2.5 text-sm font-medium leading-5 color-app',
              'ring-white/60 ring-offset-2 ring-offset-green-app focus:outline-none focus:ring-2',
              selected
                ? 'bg-white active-tab shadow'
                : 'text-blue-100 hover:text-[#177835]',
            ]"
          >
            <div class="flex items-center justify-center">
              <span>
                <i class="fa-solid fa-clock-rotate-left"></i>
              </span>
              <h2 class="ml-1">Histórico</h2>
            </div>
          </button>
        </Tab>
      </TabList>

      <TabPanels class="mt-2">
        <TabPanel
          :class="[
            'rounded-xl bg-white p-3',
            'ring-white/60 ring-offset-2 focus:outline-none focus:ring-2',
          ]"
        >
          <slot name="firstTab" />
        </TabPanel>

        <TabPanel
          :class="[
            'rounded-xl bg-white p-3',
            'ring-white/60 ring-offset-2 focus:outline-none focus:ring-2',
          ]"
        >
          <slot name="secondTab" />
        </TabPanel>

        <TabPanel
          :class="[
            'rounded-xl bg-white p-3',
            'ring-white/60 ring-offset-2 focus:outline-none focus:ring-2',
          ]"
        >
          <slot name="thirdTab" />
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </div>
</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
</script>

<style lang="scss" scoped>
.ring-offset-green-app {
  --tw-ring-offset-color: #91cb25;
}
.color-app {
  color: #2c3e50;
  font-weight: bold;
}
.active-tab {
  color: #177835;
  text-shadow: 5px 5px 15px #ccc;
}
</style>
