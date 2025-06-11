<script setup>
import Header from '@/components/Header.vue'
import TotalSalesCard from '@/components/dashboard/TotalSalesCard.vue'
import TopPizzasCard from '@/components/dashboard/MostSoldPizzaCard.vue'
import TopIngredients from '@/components/dashboard/TopIngredientCard.vue'
import TotalQuantityCard from '@/components/dashboard/TotalQuantityCard.vue'
import SalesChart from '@/components/dashboard/SalesChart.vue'
import LatestOrders from '@/components/dashboard/LatestOrders.vue'
import { ref, onMounted } from 'vue'
import api from '@/axios'
const sales_summary = ref()

onMounted(() => {
    fetchSalesSummary()
})


const fetchSalesSummary = () => {
    api.get('sales-summary')
    .then(res => {
        console.log(res.data.data)
        sales_summary.value = res.data.data
    })
}


</script>

<template>
  <div>
    <Header />
    <div class="p-6 space-y-6">
      <!-- Grid for Statistic Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <TotalSalesCard />
        <TotalQuantityCard />
        <TopPizzasCard  />
        <TopIngredients />
      </div>

        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2 mb-4">
                <SalesChart :weekly="sales_summary?.daily" :monthly="sales_summary?.weekly" :yearly="sales_summary?.monthly" />
            </div>

            <div class="w-full md:w-1/2 px-2 mb-4">
                <LatestOrders />
            </div>
        </div>

    </div>
  </div>
</template>

