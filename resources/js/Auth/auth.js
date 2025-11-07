// src/middleware/auth.js
import { reactive } from 'vue'
import axios from 'axios'

export const auth = reactive({
  user: null,
  loading: false,

  get isAuthenticated() {
    return !!this.user
  },

  async fetchUser() {
    this.loading = true
    try {
      const res = await axios.get('/api/user')
      this.user = res.data
    } catch (err) {
      this.user = null
      localStorage.removeItem('auth_token')
    } finally {
      this.loading = false
    }
  },

  logout() {
    this.user = null
    localStorage.removeItem('auth_token')
  }
})
