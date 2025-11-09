<template>
  <div class="d-flex flex-column align-items-center justify-content-center vh-100 bg-light text-center">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <h4 class="mb-3">Page Not Found</h4>
    <p class="text-muted mb-4">
      Sorry, the page you are looking for doesn’t exist or has been moved.
    </p>
    <router-link to="/" class="btn btn-primary">
      <i class="bi bi-house-door-fill me-2"></i> Go Back Home
    </router-link>
  </div>
</template>

<script setup>
// no logic needed here for a static 404 page
</script>

<style scoped>
/* Optional subtle animation */
h1 {
  animation: pulse 1.5s infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.6; transform: scale(1.05); }
}
</style>
