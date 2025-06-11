import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '@/pages/login.vue'
// import DashboardPage from './views/DashboardPage.vue'

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: LoginPage },
//   { path: '/dashboard', component: DashboardPage }
]

export const router = createRouter({
  history: createWebHistory(),
  routes
})
