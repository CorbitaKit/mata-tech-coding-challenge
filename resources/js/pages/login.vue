<script setup>
import { ref } from 'vue'
import api from '@/axios'

const email = ref('')
const password = ref('')
const emailError = ref('')
const passwordError = ref('')

const handleLogin = () => {
    api.post('login')
}
</script>
<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>

      <p-input-text
        v-model="email"
        placeholder="Email"
        class="w-full mb-3"
        :invalid="!!emailError"
      />
      <small v-if="emailError" class="text-red-500">{{ emailError }}</small>

      <p-password
        v-model="password"
        placeholder="Password"
        toggleMask
        class="w-full mb-3"
        :feedback="false"
        :inputStyle="{ width: '100%' }"
        :invalid="!!passwordError"
      />
      <small v-if="passwordError" class="text-red-500">{{ passwordError }}</small>

      <p-button
        label="Login"
        class="w-full mt-4"
        @click="handleLogin"
      />
    </div>
  </div>
</template>
