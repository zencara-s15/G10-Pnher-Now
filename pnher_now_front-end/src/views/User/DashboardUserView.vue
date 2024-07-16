<template>
  <UserLayout>
    <div class="bg-[var(--background)] text-[var(--foreground)] pb-8">
      <div class="bg-gradient-to-l from-orange-400 to-red-500 text-white p-8">
        <div class="flex flex-col md:flex-row items-center">
          <div class="ml-7 md:w-1/2">
            <h1 class="text-5xl mb-4">
              <span class=" font-bold text-yellow-400">Baggages</span><Span> delivery in </Span><Span class="font-bold">Cambodia</Span>
            </h1>
            <p class="mb-6 text-2xl">
              Product delivery is a courier service in which a store or independent delivery company
              delivers products to a customer.
            </p>
            <button class="bg-yellow-400 text-black py-2 px-4 rounded-lg hover:bg-yellow-500">
              Full Map
            </button>
          </div>
          <div class="md:w-1/2 mt-8 md:mt-0 ">
            <!-- <img
              src="https://placehold.co/400x300?text=Delivery+Scooter"
              alt="Delivery Scooter"
              class="w-full h-auto rounded-lg shadow-lg "
            /> -->
            <img
              src="../../../src/assets/dalivery-service-worker-riding-vintage-scooter-vector-removebg-preview.png"
              alt="Delivery Scooter"
              class="w-full h-79vh"
            />
          </div>
        </div>
      </div>
      <div class="m-8">
        <h2 class="text-2xl font-bold text-dark mb-4">
          Recently Post 
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Loop through last three baggages -->
          <div v-for="baggage in lastThreeBaggages" :key="baggage.id">
            <BaggagePostCard :item="baggage" @delete="deleteItem"></BaggagePostCard>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import UserLayout from '@/Components/Layouts/UserLayout.vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'
import BaggagePostCard from '@/Components/Card/BaggagePostCard.vue'

export default {
  components: {
    UserLayout,
    BaggagePostCard
  },
  setup() {
    const store = usePostBaggageStore()
    const baggages = ref([])

    onMounted(async () => {
      await store.fetchPostBaggage() // Fetch initial baggage list on component mount
      baggages.value = store.post_baggage
    })

    const deleteItem = (id) => {
      // Logic to delete an item
      store.deletePostBaggage(id)
      baggages.value = baggages.value.filter(baggage => baggage.id !== id)
    }

    const lastThreeBaggages = computed(() => {
      return baggages.value.slice(-3).reverse()
    })

    return {
      baggages,
      deleteItem,
      lastThreeBaggages
    }
  }
}
</script>
