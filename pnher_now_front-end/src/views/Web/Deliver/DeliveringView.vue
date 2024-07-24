<!-- src/components/Dashboard.vue -->
<template>
  <DelivererLayout>
    <h1 class="text-dark ">COMING SOON</h1>
    <!-- <div v-if="loading">Loading...</div>
    <div v-if="error">{{ error }}</div>
    <div v-else>
      <div v-for="baggage in baggages" :key="baggage.id">
        <h1 class="text-dark">{{ baggage.id }}</h1>
      </div>
    </div> -->
  </DelivererLayout>
</template>

<script lang="ts">
import { computed, onMounted } from 'vue';
import { useBaggagesPickedUpStore } from '@/stores/baggages_picked_up';
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue';
import DeliveryManCard from '@/Components/Card/DeliveryManCard.vue';

export default {
  components: {
    DelivererLayout,
    DeliveryManCard,
  },
  setup() {
    const store = useBaggagesPickedUpStore();

    // Fetch baggages when the component is mounted
    onMounted(() => {
      store.fetchBaggagesPickedUp();
    });

    return {
      baggages: computed(() => store.baggages),
      loading: computed(() => store.loading),
      error: computed(() => store.error),
    };
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
