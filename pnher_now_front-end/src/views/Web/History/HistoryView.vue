<template>
  <DelivererLayout />
  <div class="container">
    <div class="my-trips mt-3 mx-35px">
      <div class="flex flex-row justify-between">
        <div class="w-30% text-gray-900">
          <span class="text-2xl font-bold w-18% text-dark border-b-2 border-red-500 pb-1">
            History
          </span>
          <p class="mt-5px">See all history with clear information.</p>
        </div>
        <div class="w-40% search-container">
          <i class="bi bi-search search-icon text-dark"></i>
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search here..."
            class="search-input text-dark"
          />
        </div>

        <div class="w-30% filter-container">
          <button class="filter-button">
            <i class="bi bi-funnel"></i>
            All
            <i class="bi bi-chevron-down"></i>
          </button>
        </div>
      </div>

      <div class="mt-40px">
        <DelivererHistory
          v-for="history in filteredBaggage"
          :key="history.id"
          :date="time"
          :delivery_status_id="history.delivery_status_id"
          :sender="history.sending_address"
          :receiver="history.receiving_address"
          :phone_receiver="history.phone_receiver"
          :type="history.type"
          :weight="history.weight"
          :companies="history.company"
          :total_price="calculateTotalCost(history.weight)"
        />
      </div>
    </div>
  </div>
</template>

<script>
import DelivererHistory from '@/Components/DeliverereComponet/DelivererHistory.vue'
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import { ref, onMounted, computed } from 'vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'

export default {
  components: {
    DelivererHistory,
    DelivererLayout
  },
  setup() {
    const baggageStore = usePostBaggageStore()
    const baggage = ref([])
    const searchQuery = ref('')

    onMounted(async () => {
      await baggageStore.fetchPostBaggage()
      baggage.value = baggageStore.post_baggage
      console.log(baggage.value)
    })

    const calculateTotalCost = (weight) => {
      return weight * 6000 // Assuming a rate of 6000 Real per Kg
    }

    const filteredBaggage = computed(() => {
      if (!searchQuery.value) {
        return baggage.value
      }
      return baggage.value.filter(
        (history) =>
          history.sending_address.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
          history.receiving_address.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
          history.phone_receiver.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
          history.type.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
          history.company.toLowerCase().includes(searchQuery.value.toLowerCase())
      )
    })

    return {
      baggage,
      searchQuery,
      filteredBaggage,
      calculateTotalCost,
      time: '24/07/05 08:28-08:57'
    }
  }
}
</script>


<style scoped>
.my-trips {
  padding: 10px;
}

h1 {
  font-size: 1.5em;
  margin-bottom: 20px;
}

.search-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding: 7px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
  width: 50%;
}

.search-icon {
  margin-right: 10px;
  font-size: 1.3em;
  color: #bb5110;
}

.search-input {
  flex: 1;
  border: none;
  outline: none;
  padding: 3px;
  font-size: 1em;
  background-color: transparent;
}

.search-input::placeholder {
  color: #aaa;
}
</style>
