<script setup lang="ts">
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import GoogleMap from '@/Components/Layouts/GoogleMap.vue'
</script>
<template>
  <DelivererLayout>
  </DelivererLayout>
  <div class="container mt-5">
    <div class="information">
      <h1>Welcome to the Deliverer's App</h1>
      <p>This is the home page for the Deliverer's App.</p>
    </div>  
    <GoogleMap />
  </div>
</template>
<style scoped>
.container {
  display: flex;
  width: 100%;
  justify-content: space-between;
  /* align-items: center; */
  /* height: 100vh; */
  /* padding: 20px; */
}
</style>