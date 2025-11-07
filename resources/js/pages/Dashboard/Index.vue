<template>
  <div>
    <h1 class="text-2xl font-bold">🏠 Home Page</h1>
    <p>WelcomeTo Dashboard</p>
  </div>
</template>
<script setup>
import { onMounted } from 'vue';

onMounted(() => {
  const token = localStorage.getItem('auth_token');
  if (token) {
    auth.fetchUser()

  }
});

</script>
