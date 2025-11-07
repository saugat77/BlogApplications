import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Login from '../Auth/Login.vue'
import Register from '../Auth/Register.vue'
import Dashboard from '../pages/Dashboard/Index.vue'
import { auth } from '../Auth/auth'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: { public: true }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { guest: true }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: { guest: true }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
  if (!auth.user && localStorage.getItem('auth_token')) {
    try {
      await auth.fetchUser()
    } catch (err) {
      localStorage.removeItem('auth_token')
    }
  }

  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    return next('/login')
  }

  if (to.meta.guest && auth.isAuthenticated) {
    return next('/dashboard')
  }

  next()
})

export default router
