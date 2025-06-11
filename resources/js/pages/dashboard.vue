<template>
  <div>
    <Header />
    <div class="p-6 space-y-6">
      <!-- Grid for Statistic Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <TotalSalesCard :value="dummy.totalSales" />
        <TotalQuantityCard :value="dummy.total_quantity" />
        <TopPizzasCard :pizzas="dummy.topPizzas" />
        <TopIngredients :ingredients="dummy.topIngredients" />
      </div>

      <!-- Unified Chart Component -->
      <SalesChart :salesData="dummy.salesData" />
    </div>
  </div>
</template>

<script setup>
import Header from '@/components/Header.vue'
import TotalSalesCard from '@/components/dashboard/TotalSalesCard.vue'
import TopPizzasCard from '@/components/dashboard/MostSoldPizzaCard.vue'
import TopIngredients from '@/components/dashboard/TopIngredientCard.vue'
import TotalQuantityCard from '@/components/dashboard/TotalQuantityCard.vue'
import SalesChart from '@/components/dashboard/SalesChart.vue'

// Dummy data as before
const dummy = {
  totalSales: 150000,
  total_quantity: 230,
  topPizzas: [
    { name: 'Margherita', count: 120 },
    { name: 'Pepperoni', count: 100 },
    { name: 'Hawaiian', count: 90 }
  ],
  topIngredients: [
    { name: 'Cheese', count: 300 },
    { name: 'Tomato Sauce', count: 280 },
    { name: 'Pepperoni', count: 250 }
  ],
  salesData: {
    weekly: [
      { day: 'Mon', total: 1200, date: '2024-06-03' },
      { day: 'Tue', total: 1500, date: '2024-06-04' },
      { day: 'Wed', total: 1300, date: '2024-06-05' },
      { day: 'Thu', total: 1600, date: '2024-06-06' },
      { day: 'Fri', total: 2000, date: '2024-06-07' },
      { day: 'Sat', total: 2500, date: '2024-06-08' },
      { day: 'Sun', total: 2200, date: '2024-06-09' }
    ],
    monthly: [
      { month: 'Jan', total: 10000, date: '2024-01-01' },
      { month: 'Feb', total: 12000, date: '2024-02-01' },
      { month: 'Mar', total: 15000, date: '2024-03-01' },
      { month: 'Apr', total: 17000, date: '2024-04-01' },
      { month: 'May', total: 14000, date: '2024-05-01' },
      { month: 'Jun', total: 16000, date: '2024-06-01' }
    ],
    yearly: [
      { year: '2021', total: 80000, date: '2021-01-01' },
      { year: '2022', total: 100000, date: '2022-01-01' },
      { year: '2023', total: 120000, date: '2023-01-01' },
      { year: '2024', total: 150000, date: '2024-01-01' }
    ]
  }
}
</script>
