<template>
    <div class="d-flex align-items-center justify-content-center vh-80 bg-gradient">
        <div class="card shadow-lg p-4 login-card">
            <h3 class="text-center mb-4 fw-bold text-primary">Login</h3>

            <form @submit.prevent="login">
                <div v-if="error" class="mb-3">
                      <!-- <p v-if="error" class="text-danger small text-center">{{ error }}</p> -->
                <div v-if="error" class="alert alert-danger mt-2">{{ error }}</div>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" v-model="email" id="email" class="form-control" placeholder="you@example.com"
                        required />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <input :type="showPassword ? 'text' : 'password'" v-model="password" id="password"
                            class="form-control" placeholder="••••••••" required />
                        <button type="button" class="btn btn-outline-secondary" @click="showPassword = !showPassword">
                            <i :class="[showPassword ? 'bi bi-eye-slash' : 'bi bi-eye', 'fs-6']"></i>
                        </button>
                    </div>
                </div>
                <!-- Submit -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <span v-if="loading">
                            <span class="spinner-border spinner-border-sm me-2"></span>Logging in...
                        </span>
                        <span v-else>Login</span>
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Don’t have an account?
                    <router-link to="/register" class="text-primary text-decoration-none">Sign up</router-link>
                </small>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'


const email = ref('')
const password = ref('')
const error = ref('')
const loading = ref(false)
const showPassword = ref(false);
const router = useRouter()

const login = async () => {
    loading.value = true
    error.value = ''
    try {
        const response = await axios.post(`/api/login`, {
            email: email.value,
            password: password.value
        })
        console.log(response.data);
        localStorage.setItem('auth_token', response.data.access_token)
        router.push('/dashboard')
    } catch (err) {
        error.value = err.response?.data?.message || 'Something went wrong'
    } finally {
        loading.value = false
    }
}
</script>
