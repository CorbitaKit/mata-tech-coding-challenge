<script setup>
import { defineProps, onMounted, ref } from 'vue'
import api from '@/axios'
const ingredients = ref()

onMounted(() => {
    fetchTopSellingIngredients()
})

const fetchTopSellingIngredients = () => {
    api.get('top-selling-ingredients')
    .then(res => {
       ingredients.value = res.data.data
    })
}
</script>
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
          <span class="font-medium text-gray-700">x {{ ingredient.total_used.toLocaleString() }}</span>
        </li>
      </ul>
    </template>
  </Card>
</template>

<style scoped>
</style>
