<template>
  <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
    <!-- Sales Overview Card -->
    <Card class="shadow-lg rounded-2xl col-span-1 xl:col-span-2">
      <template #title>
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between">
          <h2 class="text-lg font-semibold">Sales Overview</h2>
          <div class="flex flex-wrap items-center gap-4 mt-3 xl:mt-0">
            <Dropdown
  v-model="viewType"
  :options="viewOptions"
  optionLabel="label"
  optionValue="value"
  class="w-50"
/>
            <Calendar v-model="selectedDate" view="month" dateFormat="yy-mm-dd" class="w-100" />
            <div class="flex gap-2">
              <p-button icon="pi pi-chevron-left" @click="navigateDate('prev')" />
              <p-button icon="pi pi-chevron-right" @click="navigateDate('next')" />
            </div>
          </div>
        </div>
      </template>
      <template #content>
        <Chart :type="chartType" :data="chartData" :options="chartOptions" class="w-full" />
      </template>
    </Card>

    <!-- Orders List Card -->
    <Card class="shadow-lg rounded-2xl col-span-1">
      <template #title>
        <h2 class="text-lg font-semibold">Recent Orders</h2>
      </template>
      <template #content>
        <ul class="divide-y divide-gray-200">
          <li v-for="order in orders" :key="order.id" class="py-2">
            <div class="flex justify-between">
              <span class="font-medium">#{{ order.id }}</span>
              <span class="text-sm text-gray-500">{{ order.date }}</span>
            </div>
            <div class="text-sm text-gray-600">{{ order.customer }}</div>
            <div class="text-sm font-semibold text-green-600">DKK {{ order.total }}</div>
          </li>
        </ul>
      </template>
    </Card>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { format, parseISO, startOfWeek, endOfWeek, getMonth, getYear } from 'date-fns'

import dayjs from 'dayjs'

const props = defineProps({
  salesData: {
    type: Object,
    required: true
  }
})


const viewOptions = [
  { label: 'Weekly', value: 'weekly' },
  { label: 'Monthly', value: 'monthly' },
  { label: 'Yearly', value: 'yearly' }
]

const viewType = ref('weekly')
const selectedDate = ref(new Date())
const chartType = ref('bar')
const chartData = ref({})
const chartOptions = ref({})

const orders = ref([
  { id: 101, date: '2025-06-01', customer: 'John Doe', total: 1200 },
  { id: 102, date: '2025-06-02', customer: 'Jane Smith', total: 890 },
  { id: 103, date: '2025-06-03', customer: 'Alice Johnson', total: 1500 },
  { id: 104, date: '2025-06-04', customer: 'Bob Williams', total: 740 }
])

const generateChartData = () => {
  const currentViewData = props.salesData[viewType.value] || []

  let labels = []
  let data = []

  if (viewType.value === 'weekly') {
    labels = currentViewData.map(entry => entry.day)
    data = currentViewData.map(entry => entry.total)
  } else if (viewType.value === 'monthly') {
    labels = currentViewData.map(entry => entry.month)
    data = currentViewData.map(entry => entry.total)
  } else if (viewType.value === 'yearly') {
    labels = currentViewData.map(entry => entry.year)
    data = currentViewData.map(entry => entry.total)
  }

  chartData.value = {
    labels,
    datasets: [
      {
        label: 'Sales (DKK)',
        backgroundColor: viewType.value === 'yearly' ? '#f59e0b' : viewType.value === 'monthly' ? '#10b981' : '#3b82f6',
        borderColor: '#10b981',
        fill: false,
        tension: 0.4,
        data
      }
    ]
  }

  chartType.value = viewType.value === 'monthly' ? 'line' : 'bar'
  chartOptions.value = {
    responsive: true,
    plugins: {
      legend: { display: true }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: value => 'DKK ' + value
        }
      }
    }
  }
}

const navigateDate = (direction) => {
  const current = dayjs(selectedDate.value)
  if (viewType.value === 'weekly') {
    selectedDate.value = current[direction === 'next' ? 'add' : 'subtract'](1, 'week').toDate()
  } else if (viewType.value === 'monthly') {
    selectedDate.value = current[direction === 'next' ? 'add' : 'subtract'](1, 'month').toDate()
  } else {
    selectedDate.value = current[direction === 'next' ? 'add' : 'subtract'](1, 'year').toDate()
  }
}

watch([viewType, selectedDate], generateChartData, { immediate: true })
</script>

<style scoped>
</style>
