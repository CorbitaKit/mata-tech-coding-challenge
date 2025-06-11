<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Top 5 Ingredients</template>
    <template #content>
      <ul class="divide-y divide-gray-200">
        <li
          v-for="(ingredient, index) in ingredients"
          :key="index"
          class="py-2 flex justify-between text-sm"
        >
          <span>{{ ingredient.name }}</span>
          <span class="font-medium text-gray-700">x{{ ingredient.usage_count }}</span>
        </li>
      </ul>
    </template>
  </Card>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  ingredients: {
    type: Array,
    required: true,
    default: () => []
  }
})
</script>

<style scoped>
</style>
