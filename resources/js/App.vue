<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">MyApp</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/login">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/register">Register</router-link>
        </li>
      </ul>
        <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <button class="nav-link btn btn-link" @click="logout">Logout</button>
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
