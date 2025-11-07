<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <div class="navbar-brand">MyApp</div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="nav-item" v-if="!$auth.isAuthenticated">
          <router-link class="nav-link" to="/login">Login</router-link>
        </li>
        <li class="nav-item"  v-if="!$auth.isAuthenticated">
          <router-link class="nav-link" to="/register">Register</router-link>
        </li>
      </ul>
           <ul class="navbar-nav ms-auto" v-if="$auth.isAuthenticated">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle d-flex align-items-center"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
            <img
                src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png"
                alt="Profile"
                class="rounded-circle me-2"
                width="35"
                height="35"
                />
              <span class="d-none d-lg-inline fw-semibold">{{ $auth.user?.name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
              <li>
                <router-link class="dropdown-item" to="/dashboard">Dashboard</router-link>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <button class="dropdown-item text-danger" @click="logout">Logout</button>
              </li>
            </ul>
          </li>
        </ul>
    </div>
  </div>
</nav>
<router-view></router-view>
</template>

<script setup>
import axios from 'axios'


const logout = async () => {
    try {
        const token = localStorage.getItem('auth_token')
        console.log(token)
        const response = await axios.post(`/api/logout`)


     } catch (err) {
        console.error('Logout failed', err)
  } finally {
        localStorage.removeItem('auth_token');
        delete axios.defaults.headers.common['Authorization'];
        router.push('/login')
  }
}
</script>

<style scoped>
nav a.router-link-active {
  font-weight: bold;
  text-decoration: underline;
}
</style>
