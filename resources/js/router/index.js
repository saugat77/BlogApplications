import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Login from '../Auth/Login.vue'
import Register from '../Auth/Register.vue'
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

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('auth_token') // or use Pinia/Vuex if you have

  if (to.meta.requiresAuth && !isAuthenticated) {
    // Not logged in → redirect to login
    next({ name: 'login' })
  } else if (to.meta.guest && isAuthenticated) {
    // Already logged in → redirect to dashboard
    next({ name: 'dashboard' })
  } else {
    next()
  }
})

export default router
