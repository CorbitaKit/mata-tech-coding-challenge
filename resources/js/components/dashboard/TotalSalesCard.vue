
<script setup>
import { defineProps, onMounted, ref } from 'vue'
import api from "@/axios";


const total_sales = ref()
onMounted(() => {
    fetchTotalSales()
})

const fetchTotalSales = () => {
    api.get('total-sales')
    .then(res => {
        total_sales.value = res.data.data
    })
}
</script>


<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Total Sales</template>
    <template #content>
      <div class="text-3xl font-bold text-green-600"> {{ total_sales?.toLocaleString() }}</div>
      <p class="text-sm text-gray-500 mt-1">Total revenue from all orders</p>
    </template>
  </Card>
</template>

<style scoped>
</style>
