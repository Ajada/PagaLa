<template>
  <div class="flex flex-col md:flex-row mt-1">
    <div class="w-full md:w-1/2 overflow-hidden md:mb-0">
      <div class="mb-1 text-left p-0 rounded-md border border-gray-300 overflow-auto min-h-[310px]">
        <slot name="first" />
      </div>
      <div class="mb-1 text-left rounded-md border border-gray-300 min-h-[310px]">
        <slot name="second" />
      </div>

      <div class="block md:hidden text-left rounded-md border border-gray-300 min-h-[500px] mb-1">
        <slot name="third" />
      </div>
    </div>
    <div class="hidden md:block w-full md:w-1/2 ml-0 md:ml-1 border border-gray-300 rounded-md">
      <div class="h-4/5 md:h-4/5 text-left">
        <slot name="third" />
      </div>
    </div>
  </div>
</template>
