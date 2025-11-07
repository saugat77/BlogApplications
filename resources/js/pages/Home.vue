<template>
  <div>
    <h1 class="text-2xl font-bold">🏠 Home Page</h1>
    <p>Welcome to your Vue + Laravel app!</p>
  </div>
</template>
<script setup>
 import { auth } from '../Auth/auth';
 auth.fetchUser();
</script>
<style scoped>
nav a.router-link-active {
    font-weight: bold;
    text-decoration: underline;
}
</style>
