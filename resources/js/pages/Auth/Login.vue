<template>
  <div class="row justify-content-center mt-5">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title text-center mb-3">Login</h3>
          <form @submit.prevent="login">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" v-model="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" v-model="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" :disabled="loading">
              {{ loading ? 'Logging in...' : 'Login' }}
            </button>
            <div v-if="error" class="alert alert-danger mt-2">{{ error }}</div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import {  ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'


const email = ref('')
const password = ref('')
const error = ref('')
const loading = ref(false)
const router = useRouter()

const login = async () => {
  loading.value = true
  error.value = ''
    console.log(`/api/login`);
  try {
    const response = await axios.post(`/api/login`, {
      email: email.value,
      password: password.value
    })
    console.log(response.data);
    localStorage.setItem('auth_token', response.data.access_token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;
    router.push('/dashboard')
  } catch (err) {
    error.value = err.response?.data?.message || 'Something went wrong'
  } finally {
    loading.value = false
  }
}
</script>
