<script setup>
import { defineProps, onMounted, ref } from 'vue'
import api from '@/axios'


const total_orders = ref()
onMounted(() => {
    fetchTotalOrders()
})


const fetchTotalOrders = () => {
    api.get('total-orders')
    .then(res => {
        total_orders.value = res.data.data
    })
}
</script>

<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Total Quantity</template>
    <template #content>
      <div class="text-3xl font-bold text-blue-600">{{ total_orders?.toLocaleString() }}</div>
      <p class="text-sm text-gray-500 mt-1">Total pizzas sold</p>
    </template>
  </Card>
</template>

<style scoped>
</style>
