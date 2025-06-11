<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Total Quantity</template>
    <template #content>
      <div class="text-3xl font-bold text-blue-600">{{ value.toLocaleString() }}</div>
      <p class="text-sm text-gray-500 mt-1">Total pizzas sold</p>
    </template>
  </Card>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  value: {
    type: Number,
    required: true,
    default: 0
  }
})
</script>

<style scoped>
</style>
