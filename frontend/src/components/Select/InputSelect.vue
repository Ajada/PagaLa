<template>
  <div class="px-1 py-2 appearance-none outline-none text-gray-800">
    <Combobox v-model="selected">
      <div class="relative">
        <div
          class="relative w-full cursor-default overflow-hidden text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
        >
          <ComboboxInput
            class="outline-none w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 bg-transparent focus:border-"
            :displayValue="(person) => person.label ?? person "
            @input="handleInput"
          />
          <ComboboxButton
            class="absolute inset-y-0 right-0 flex items-center pr-2"
          >
            <ChevronUpDownIcon
              class="h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
          </ComboboxButton>
        </div>
        <TransitionRoot
          leave="transition ease-in duration-100"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
          @after-leave="query = ''"
        >
          <ComboboxOptions
            class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white z-50 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
          >
            <ComboboxOption v-if="queryPerson" :value="queryPerson">
              Período: {{ query }} dias
            </ComboboxOption>

            <ComboboxOption
              v-for="person in filteredPeople"
              :key="person.id"
              :value="person"
              v-slot="{ selected, active }"
            >
              <li
                class="relative cursor-default select-none py-2 pl-10 pr-4"
                :class="{
                  'bg-teal-600 text-white': active,
                  'text-gray-900': !active,
                }"
              >
                <span
                  class="block truncate"
                  :class="{ 'font-medium': selected, 'font-normal': !selected }"
                >
                  {{ person.label }}
                </span>
                <span
                  v-if="selected"
                  class="absolute inset-y-0 left-0 flex items-center pl-3"
                  :class="{ 'text-white': active, 'text-teal-600': !active }"
                >
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />

                </span>
              </li>
            </ComboboxOption>
          </ComboboxOptions>
        </TransitionRoot>
      </div>
    </Combobox>
  </div>
</template>

<script setup>
import { ref, computed, defineProps, watch } from "vue";
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
  data: [Array, Object],
});

const selected = ref(props.data[6] ?? props.data[0]);
const query = ref("");

const queryPerson = computed(() => {
  return query.value === "" ? null : query.value;
});

const filteredPeople = computed(() => {
  return query.value === "" ? props.data : props.data.includes(query.value);
});

watch(selected, (newValue) => {
  emit(
    "selectedData",
    typeof newValue == "object"
      ? newValue
      : { label: `Periodo de ${newValue} dias`, value: newValue }
  );
});

const emit = defineEmits({
  selectedData(value) {
    return Object.assign(
      {},
      { label: `Periodo de ${value.value} dias`, value: Number(value.value) }
    );
  },
});

const handleInput = (event) => {
  selected.value = Number(event.target.value)
};
</script>
