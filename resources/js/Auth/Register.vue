<template>
  <div class="d-flex align-items-center justify-content-center vh-100 bg-gradient">
    <div class="card shadow-lg p-4 register-card">
      <h3 class="text-center mb-4 fw-bold text-primary">Create Account</h3>

      <form @submit.prevent="handleRegister">
        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label fw-semibold">Name</label>
          <input
            type="text"
            v-model="name"
            id="name"
            class="form-control"
            placeholder="Your full name"
            required
          />
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email</label>
          <input
            type="email"
            v-model="email"
            id="email"
            class="form-control"
            placeholder="you@example.com"
            required
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password</label>
          <div class="input-group">
            <input
              :type="showPassword ? 'text' : 'password'"
              v-model="password"
              id="password"
              class="form-control"
              placeholder="••••••••"
              required
            />
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="showPassword = !showPassword"
            >
              <i :class="[showPassword ? 'bi bi-eye-slash' : 'bi bi-eye', 'fs-6']"></i>
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
          <input
            type="password"
            v-model="password_confirmation"
            id="password_confirmation"
            class="form-control"
            placeholder="••••••••"
            required
          />
        </div>

        <!-- Error message -->
        <p v-if="error" class="text-danger small text-center">{{ error }}</p>

        <!-- Submit -->
        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-primary" :disabled="loading">
            <span v-if="loading">
              <span class="spinner-border spinner-border-sm me-2"></span>Registering...
            </span>
            <span v-else>Register</span>
          </button>
        </div>
      </form>

      <div class="text-center mt-3">
        <small class="text-muted">
          Already have an account?
          <router-link to="/login" class="text-primary text-decoration-none">Login</router-link>
        </small>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from '@/axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const name = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')
const showPassword = ref(false)
const loading = ref(false)
const error = ref('')

const handleRegister = async () => {
  loading.value = true
  error.value = ''

  if (password.value !== password_confirmation.value) {
    error.value = 'Passwords do not match'
    loading.value = false
    return
  }

  try {
    const response = await axios.post('/api/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value
    })

    // Store token if your API returns one
    if (response.data.access_token) {
      localStorage.setItem('auth_token', response.data.access_token)
    }

    router.push('/post_lists')
  } catch (err) {
    if (err.response && err.response.data && err.response.data.message) {
      error.value = err.response.data.message
    } else {
      error.value = 'Registration failed. Please try again.'
    }
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.bg-gradient {
  background: linear-gradient(135deg, #4f46e5, #9333ea);
}

.register-card {
  width: 100%;
  max-width: 420px;
  border-radius: 1rem;
  backdrop-filter: blur(10px);
  background-color: rgba(255, 255, 255, 0.9);
}
</style>
