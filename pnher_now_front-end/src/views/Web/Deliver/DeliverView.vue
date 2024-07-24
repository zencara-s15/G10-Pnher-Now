<template>
  <DelivererLayout></DelivererLayout>
  <div class="container">
    <div class="information-card pt-5">
      <div class="delivery-info">
        <div class="text-white d-flex justify-content-center p-2 bg-orange-600 radius1">
          <h1>Information</h1>
        </div>
        <div v-if="noCardsToShow" class="text-center p-3">
          <div class="mt-5 d-flex justify-content-center">
            <img src="/src/assets//Arrived/delivery_arrived.png" alt="Deliverer" width="300px" />
          </div>
        </div>
        <div
          v-else
          class="alert-card-body card-deliverer mb-5"
          v-for="(item, index) in baggage"
          :key="item.id"
        >
          <div class="information" v-if="item.delivery_status_id === 2">
            <div class="p-3">
              <p>
                Phone Receiver: <strong>{{ item.phone_receiver }}</strong>
              </p>
              <p>
                Sending Address: <strong>{{ item.sending_address }}</strong>
              </p>
              <p>
                Receiving Address: <strong>{{ item.receiving_address }}</strong>
              </p>
              <p>
                Baggage Type: <strong>{{ item.type }}</strong>
              </p>
              <p>
                Weight: <strong>{{ item.weight }} Kg</strong>
              </p>
              <p>
                Total Cost: <strong>{{ calculateTotalCost(item.weight) }} Real</strong>
              </p>
              <p>
                Company: <strong>{{ item.company }}</strong>
              </p>
            </div>
            <div class="p-3">
              <div>
                <img src="/src/assets/deliverying.png" alt="" width="150px" />
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
      <div class="google-map ml-5">
        <div class="text-white d-flex justify-content-center p-2 bg-orange-600 radius1">
          <h1>Tracking Map</h1>
        </div>
        <GoogleMap />
      </div>
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
    },
    noCardsToShow() {
      return (
        this.baggage.length === 0 || !this.baggage.some((item) => item.delivery_status_id === 2)
      )
    }
  },
  methods: {
    async fetchSenderDetails() {},
    async ArrivedBranch(baggage, index) {
      this.selectedBaggage = baggage
      this.isAlertVisible = true
      this.hideCardBody = false

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
  display: flex;
  width: 100%;
}
.information {
  width: 100%;
}
.google-map {
  border: 1px solid gray;
  border-radius: 10px 10px 10px 10px;
  width: 100%;
}
.delivery-info {
  border: 1px solid gray;
  border-radius: 10px 10px 10px 10px;
  width: 40%;
}
.radius1 {
  border-radius: 9px 9px 0px 0px;
}
</style>
