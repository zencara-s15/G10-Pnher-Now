<!-- Dashboard.vue -->
<template>
  <DelivererLayout>
    <div class="row m-4">
      <div class="col-md-4 mb-4" v-for="(item, index) in pendingBaggages" :key="item.id">
        <DeliveryManCard :item="item" :user="users[index]" @show-details="showPostDetails" />
      </div>

      <div v-if="isAlertVisible" class="alert-card">
        <div class="alert-card-body card-deliverer mb-5">
          <div class="information">
            <div class="text-white d-flex justify-content-center p-0 m-0 rounded-t-lg bg-red-500 radius1">
              <h2 class="p-10px">Information</h2>
            </div>
            <div class="card-body flex flex-col text-dark p-20px">
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-building text-danger me-2"></i>
                <p class="card-text m-0">
                  Company: <strong>{{ selectedBaggage.company }}</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-phone text-danger me-2"></i>
                <p class="card-text m-0">
                  Receiver Phone: <strong>{{ selectedBaggage.receiver_phone }}</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-geo-alt text-danger me-2"></i>
                <p class="card-text m-0">
                  Sending Address: <strong>{{ selectedBaggage.sending_address }}</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-geo text-danger me-2"></i>
                <p class="card-text m-0">
                  Receiving Address: <strong>{{ selectedBaggage.receiving_address }}</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-box-seam text-danger me-2"></i>
                <p class="card-text m-0">
                  Type: <strong>{{ selectedBaggage.type }}</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-cart text-danger me-2"></i>
                <p class="card-text m-0">
                  Weight: <strong>{{ selectedBaggage.weight }} Kg</strong>
                </p>
              </div>
              <div class="d-flex gap-1 mb-2 align-items-center">
                <i class="bi bi-currency-exchange text-success me-2"></i>
                <p class="card-text m-0">
                  Total Price: <strong>{{ calculateTotalCost(selectedBaggage.weight) }} Real</strong>
                </p>
              </div>
              <div class="d-flex gap-20px justify-between mt-10px">
                <button type="button" class="btn btn-outline-danger" @click="closeAlert">
                  Back
                </button>
                <button
                  type="button"
                  class="btn btn-success"
                  @click="acceptDelivery(selectedBaggage, selectedBaggageIndex)"
                >
                  Accept
                </button>
              </div>
            </div>
            <!-- <div class="p-3 text-dark">
              <p>Phone Receiver: {{ selectedBaggage.receiver_phone }}</p>
              <p>Sending Address: {{ selectedBaggage.sending_address }}</p>
              <p>Receiving Address: {{ selectedBaggage.receiving_address }}</p>
              <p>Baggage Type: {{ selectedBaggage.type }}</p>
              <p>Weight: {{ selectedBaggage.weight }}Kg</p>
              <p>Total Cost: {{ calculateTotalCost(selectedBaggage.weight) }} Real</p>
              <p>Company: {{ selectedBaggage.company }}</p>
            </div> -->

           
          </div>
        </div>
      </div>
    </div>
  </DelivererLayout>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import DeliveryManCard from '@/Components/Card/DeliveryManCard.vue'

export default {
  components: {
    DelivererLayout,
    DeliveryManCard
  },
  setup() {
    const baggageStore = usePostBaggageStore()
    const baggage = ref([])
    const users = ref([])
    const currentLocation = ref({ latitude: null, longitude: null })

    onMounted(async () => {
      await baggageStore.fetchPostBaggage()
      users.value = baggageStore.user_baggage
      baggage.value = baggageStore.post_baggage

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            currentLocation.value.latitude = position.coords.latitude
            currentLocation.value.longitude = position.coords.longitude
          },
          (error) => {
            console.error('Error getting location:', error)
          }
        )
      } else {
        console.error('Geolocation is not supported by this browser.')
      }
    })

    const calculateTotalCost = (weight) => {
      return weight * 6000
    }

    const pendingBaggages = computed(() => {
      return baggage.value.filter((item) => item.delivery_status_id === 1)
    })

    return {
      baggage,
      users,
      currentLocation,
      calculateTotalCost,
      pendingBaggages
    }
  },
  data() {
    return {
      selectedBaggage: null,
      selectedBaggageIndex: null,
      isAlertVisible: false,
      hideCardBody: false,
      delivery_status_id: null
    }
  },
  methods: {
    async showPostDetails(baggage, index) {
      this.selectedBaggage = baggage
      this.selectedBaggageIndex = index
      this.isAlertVisible = true
      this.hideCardBody = false

      this.baggageStore = usePostBaggageStore()
      this.delivery_status_id = 1
    },
    async acceptDelivery(baggage, index) {
      this.selectedBaggage = baggage
      this.isAlertVisible = true
      this.hideCardBody = false
      console.log(baggage)
      console.log(index)

      this.baggageStore = usePostBaggageStore()
      this.delivery_status_id = '2'
      try {
        await this.baggageStore.updateBaggageStatus(this.delivery_status_id, baggage.id)
        window.location.href = '/delivering'
        console.log(this.baggageStore.responseMessage)
      } catch (error) {
        console.warn(error)
      }
    },
    async acceptBaggage() {
      this.delivery_status_id = '3'
      try {
        await this.baggageStore.updateBaggageStatus(
          this.delivery_status_id,
          this.selectedBaggage.id
        )
        this.closeAlert()
        console.log(this.baggageStore.responseMessage)
      } catch (error) {
        console.warn(error)
      }
    },
    closeAlert() {
      this.isAlertVisible = false
      this.selectedBaggage = null
    }
  }
}
</script>

<style scoped>
.alert-card {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.alert-card-body {
  width: 30%;
  background-color: white;
  /* padding: 20px; */
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
