<template>
  <DelivererLayout />
  <div class="container">
    <div class="my-trips">
      <h1>Delivering History</h1>
      <DelivererHistory
        v-for="history in baggage"
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
</template>

<script>
import DelivererHistory from '@/Components/DeliverereComponet/DelivererHistory.vue'
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import { ref, onMounted } from 'vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'

export default {
  components: {
    DelivererHistory,
    DelivererLayout
  },
  setup() {
    const baggageStore = usePostBaggageStore()
    const baggage = ref([])

    onMounted(async () => {
      await baggageStore.fetchPostBaggage()
      baggage.value = baggageStore.post_baggage
      console.log(baggage.value)
    })
    const calculateTotalCost = (weight) => {
      return weight * 6000 // Assuming a rate of 6000 Real per Kg
    }

    return {
      baggage,
      calculateTotalCost,
      time: '24/07/05 08:28-08:57',

    }
  }
}
</script>

<style scoped>
.my-trips {
  padding: 20px;
}

h1 {
  font-size: 1.5em;
  margin-bottom: 20px;
}
</style>
