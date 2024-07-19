<template>
  <DelivererLayout></DelivererLayout>
  <div class="information-card">
    <div class="delivery-info">
      <div class="text-white d-flex justify-content-center p-2 bg-dark radius1 mt-3">
        <h1>Information</h1>
      </div>
      <div
        class="alert-card-body card-deliverer mb-5"
        v-for="(item, index) in baggage"
        :key="item.id"
      >
        <div class="information" v-if="item.delivery_status_id === 2">
          <div class="p-3">
            <p>Phone Receiver: {{ item.phone_receiver }}</p>
            <p>Sending Address: {{ item.sending_address }}</p>
            <p>Receiving Address: {{ item.receiving_address }}</p>
            <p>Baggage Type: {{ item.type }}</p>
            <p>Weight: {{ item.weight }} Kg</p>
            <p>Total Cost: {{ calculateTotalCost(item.weight) }} Real</p>
            <p>Company: {{ item.company }}</p>
          </div>
          <div class="p-3">
            <div>
              <img src="/src/assets/deliverer.png" alt="" width="100px" />
            </div>
            <div class="pt-5">
              <button
                type="button"
                class="btn btn-warning bg-orange-600 text-white"
                @click="ArrivedBranch(item, index)"
              >
                Arrived
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="google-map mt-3 ml-5">
      <div class="text-white d-flex justify-content-center p-2 bg-dark radius1">
        <h1>Tracking Map</h1>
      </div>
      <GoogleMap />
    </div>
  </div>
</template>

<script>
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import { ref, onMounted } from 'vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'
import GoogleMap from '@/Components/Layouts/GoogleMap.vue'

export default {
  components: {
    DelivererLayout,
    GoogleMap
  },
  setup() {
    const baggageStore = usePostBaggageStore()
    const baggage = ref([])

    onMounted(async () => {
      await baggageStore.fetchPostBaggage()
      baggage.value = baggageStore.post_baggage
      console.log(baggage)
    })

    const calculateTotalCost = (weight) => {
      return weight * 6000 // Assuming a rate of 6000 Real per Kg
    }

    return {
      baggage,
      calculateTotalCost
    }
  },
  data() {
    return {
      senderDetail: {
        name: '',
        items: '',
        location: '',
        phone_number: '',
        map: ''
      },
      selectedBaggage: null,
      isAlertVisible: false,
      hideCardBody: false,
      delivery_status_id: null
    }
  },
  computed: {
    senderId() {
      const urlParams = new URLSearchParams(window.location.search)
      return urlParams.get('sender') || Math.floor(Math.random() * 10) + 1
    }
  },
  methods: {
    async fetchSenderDetails() {},
    async ArrivedBranch(baggage, index) {
      this.selectedBaggage = baggage
      this.isAlertVisible = true
      this.hideCardBody = false
      // console.log(baggage)
      // console.log(index)

      this.baggageStore = usePostBaggageStore()
      this.delivery_status_id = '3'
      try {
        await this.baggageStore.updateBaggageStatus(this.delivery_status_id, baggage.id)
        window.location.href = '/deliverer_dashboard'
        console.log(this.baggageStore.responseMessage)
      } catch (error) {
        console.warn(error)
      }
    }
  }
}
</script>

<style scoped>
.information-card {
  /* background: #000000; */
  display: flex;
  width: 100%;
  /* height: 100vh; */
}
.information {
  /* background-color: #c92626; */
  width: 100%;
  /* height: 78.3%; */
}
.google-map {
  /* background: #c81313; */
  width: 100%;
}
.delivery-info {
  width: 40%;
}
</style>
