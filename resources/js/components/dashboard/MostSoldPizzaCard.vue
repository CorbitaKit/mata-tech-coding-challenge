<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Top 5 Pizzas</template>
    <template #content>
      <ul class="divide-y divide-gray-200">
        <li
          v-for="(pizza, index) in pizzas"
          :key="index"
          class="py-2 flex justify-between text-sm"
        >
          <span>{{ pizza.name }}</span>
          <span class="font-medium text-gray-700">x{{ pizza.quantity }}</span>
        </li>
      </ul>
    </template>
  </Card>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  pizzas: {
    type: Array,
    required: true,
    default: () => []
  }
})
</script>

<style scoped>
</style>
