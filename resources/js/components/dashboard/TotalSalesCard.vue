<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Total Sales</template>
    <template #content>
      <div class="text-3xl font-bold text-green-600">DKK {{ value.toLocaleString() }}</div>
      <p class="text-sm text-gray-500 mt-1">Total revenue from all orders</p>
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
