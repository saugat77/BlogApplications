import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Login from '../pages/Auth/Login.vue'
import Register from '../pages/Auth/Register.vue'
import Dashboard from '../pages/Dashboard/Index.vue'
const routes = [
  { path: '/', name: 'home', component: Home,  meta: { guest: true } },
  { path: '/login', name: 'login', component: Login,  meta: { guest: true } },
  { path: '/register', name: 'register', component: Register,  meta: { guest: true } },
  { path: '/dashboard', name: 'dashboard', component: Dashboard, meta: { requiresAuth: true } },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
