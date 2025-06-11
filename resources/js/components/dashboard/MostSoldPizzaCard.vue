<template>
  <Card class="shadow-lg rounded-2xl">
    <template #title>Top 3 Pizzas</template>
    <template #content>
      <ul class="divide-y divide-gray-200">
        <li
          v-for="(pizza, index) in pizzas"
          :key="index"
          class="py-2 flex justify-between text-sm"
        >
          <span>{{ pizza.name }}</span>
          <span class="font-medium text-gray-700">x {{ pizza?.total_sold?.toLocaleString() }}</span>
        </li>
      </ul>
    </template>
  </Card>
</template>

<script setup>
import { defineProps, onMounted, ref } from 'vue'
import api from '@/axios'

const pizzas = ref()

onMounted(() => {
    fetchTopSellingPizzas()
})

const fetchTopSellingPizzas = () => {
    api.get('top-selling-pizzas')
    .then(res => {
        pizzas.value = res.data.data
    })
}
</script>

<style scoped>
</style>
