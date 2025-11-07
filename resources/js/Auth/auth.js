import { reactive } from 'vue'
import axios from 'axios' // your axios instance with Bearer token

export const auth = reactive({
  user: null,
  async fetchUser() {
    try {
      const response = await axios.get('/api/user')
      this.user = response.data
    } catch (err) {
        console.error('Failed to fetch user', err)
    }
  },
})
