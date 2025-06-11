<script setup>
import { ref } from 'vue'
import api from '@/axios'
import { useToast } from "primevue/usetoast";
const toast = useToast();

const show = () => {
    toast.add({ severity: 'error', summary: 'Error Message', detail: 'Invalid Credentials', life: 3000 });
};
const email = ref('')
const password = ref('')
const errors = ref()

const handleLogin = () => {

    api.post('login', {
        email: email.value,
        password: password.value
    })
    .then(res => {
        const token = res.data.access_token
         api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }).catch(err => {
       if (err.status == 422) {
         errors.value = err.response.data.errors
       } else {
        show()
       }
    })
}
</script>
<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <p-toast />
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>

      <p-input-text
        v-model="email"
        placeholder="Email"
        class="w-full mb-3"
        :invalid="errors?.email"
      />
      <small v-if="errors?.email" class="text-red-500">{{ errors.email[0] }}</small>

      <p-password
        v-model="password"
        placeholder="Password"
        toggleMask
        class="w-full mb-3"
        :feedback="false"
        :inputStyle="{ width: '100%' }"
        :invalid="errors?.password"
      />
      <small v-if="errors?.password" class="text-red-500">{{ errors.password[0] }}</small>

      <p-button
        label="Login"
        class="w-full mt-4"
        @click="handleLogin"
      />
    </div>
  </div>
</template>
