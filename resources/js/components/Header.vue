<template>
  <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Pizza Dashboard</h1>
    <nav class="space-x-4">
      <RouterLink to="/" class="text-gray-600 hover:text-black font-medium">Dashboard</RouterLink>
      <RouterLink to="/orders" class="text-gray-600 hover:text-black font-medium">Orders</RouterLink>
      <RouterLink to="/inventory" class="text-gray-600 hover:text-black font-medium">Inventory</RouterLink>
      <RouterLink to="/settings" class="text-gray-600 hover:text-black font-medium">Settings</RouterLink>
    </nav>
  </header>
</template>

<script setup>
// Nothing needed here for now
</script>
