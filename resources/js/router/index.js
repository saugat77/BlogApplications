import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Login from '../Auth/Login.vue'
import Register from '../Auth/Register.vue'
import Dashboard from '../pages/Dashboard/Index.vue'
import PostLists from '../pages/Post/PostList.vue'
import { auth } from '../Auth/auth'
import CategoryList from '../pages/Categories/CategoryList.vue'
import TagList from '../pages/Tags/TagList.vue'
import NotFound from '../pages/NotFound.vue'

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
  },
   {
    path: '/post_lists',
    name: 'PostLists',
    component: PostLists,
    meta: { requiresAuth: true }
  },
    {
    path: '/category_lists',
    name: 'CategoryLists',
    component: CategoryList,
    meta: { requiresAuth: true }
  },
    {
    path: '/tag_lists',
    name: 'TagLists',
    component: TagList,
    meta: { requiresAuth: true }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound,
    meta: { public: true }
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


  next()
})

export default router
