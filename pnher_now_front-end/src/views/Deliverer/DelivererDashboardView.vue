<template>
  <DelivererLayout>
    <div class="delivers mt-5 ">
      <nav
        class="form-delivers delivers-expand-lg flex-row"
        v-for="(item, index) in baggage"
        :key="item.id"
      >
        <div class="card" v-if="item.delivery_status_id === 1">
          <div class="card-body" v-if="!hideCardBody">
            <div class="card-header">
              <div class="img">
                <img :src="`http://127.0.0.1:8000/images/${item.post_id?.profile}`" />
              </div>
              <div class="card-title">
                <p class="name">
                  Name: {{ users[index]?.first_name + ' ' + users[index]?.last_name }}
                </p>
              </div>
            </div>
            <div class="card-actions">
              <button type="button" class="btn btn-info" @click="showPostDetails(item)">
                Detail
              </button>
            </div>
          </div>
        </div>
      </nav>
      <div v-if="isAlertVisible" class="alert-card">
        <div class="alert-card-body card-deliverer mb-5">
          <div class="information">
            <div class="text-white d-flex justify-content-center p-2 bg-red radius1">
              <h2>Information</h2>
            </div>
            <div class="p-3">
              <p>
                Phone Receiver: <strong>{{ selectedBaggage.phone_receiver }}</strong>
              </p>
              <p>
                Sending Address: <strong>{{ selectedBaggage.sending_address }}</strong>
              </p>
              <p>
                Receiving Address: <strong>{{ selectedBaggage.receiving_address }}</strong>
              </p>
              <p>
                Baggage Type: <strong>{{ selectedBaggage.type }}</strong>
              </p>
              <p>
                Weight: <strong>{{ selectedBaggage.weight }} Kg</strong>
              </p>
              <p>
                Total Cost: <strong>{{ calculateTotalCost(selectedBaggage.weight) }} Real</strong>
              </p>
              <p>
                Company: <strong>{{ selectedBaggage.company }}</strong>
              </p>
            </div>
            <div class="mt-2 d-flex justify-content-center">
              <img src="/src/assets/deliverer.png" alt="Deliverer" width="200px" />
            </div>
            <div class="p-3 d-flex justify-between click">
              <div>
                <button type="button" class="btn btn-outline-danger" @click="closeAlert">
                  Back
                  <i class="bi bi-arrow-left-square-fill"></i>
                </button>
              </div>
              <div>
                <button
                  type="button"
                  class="btn btn-success"
                  @click="acceptDelivery(selectedBaggage, index)"
                >
                  Pick Up
                </button>
              </div>
            </div>
          </div>
          <div class="Map">
            <div class="text-white d-flex justify-content-center p-2 radius2">
              <h2>Map</h2>
            </div>
            <div class="google-map">
              <!-- Map component goes here -->
              <GoogleMap />
            </div>
          </div>
        </div>
      </div>
    </div>
  </DelivererLayout>
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
  name: 'Deliverer',
  setup() {
    const baggageStore = usePostBaggageStore()
    const baggage = ref([])
    const users = ref([])

    onMounted(async () => {
      await baggageStore.fetchPostBaggage()
      users.value = baggageStore.user_baggage
      baggage.value = baggageStore.post_baggage
      console.log(baggage)
    })

    const calculateTotalCost = (weight) => {
      // Replace with your actual logic to calculate total cost based on weight
      return weight * 6000 // Assuming a rate of 6000 Real per Kg
    }

    return {
      baggage,
      users,
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
      selectedBaggage: ref(null),
      isAlertVisible: false,
      hideCardBody: false,
      delivery_status_id: ref(null)
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
    async showPostDetails(baggage) {
      this.selectedBaggage = baggage
      console.log(baggage)
      this.isAlertVisible = true
      this.hideCardBody = false

      this.baggageStore = usePostBaggageStore()
      this.delivery_status_id = '1'
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
        window.location.href = '/deliverer'
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
    toggleCardBody() {
      this.hideCardBody = !this.hideCardBody
    },
    closeAlert() {
      this.isAlertVisible = false
    }
  },
  created() {
    this.fetchSenderDetails()
  }
}
</script>

<style scoped>
.delivers {
  display: flex;
  flex-wrap: wrap;
  /* width: 100%; */
  /* gap: 10px; */
}

.card {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 250px; 
  height: 250px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
}

.card-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  height: 100%;
  justify-content: space-between;
}

.card-header {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 10px;
}

.card-header img {
  width: 80px;
  height: 80px;
  border-radius: 10px;
  margin-bottom: 10px;
}

.card-title {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card-content {
  margin-bottom: 10px;
}

.card-actions {
  display: flex;
  justify-content: center;
  gap: 30px;
}

.alert-card {
  display: flex;
  align-content: center;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  width: 100%;
  background: #000000;
  height: 100%;
}

.alert-card-body {
  margin: auto;
  display: flex;
  flex-direction: column;
  gap: 5px;
  box-shadow: 0 4px 8px rgb(6, 1, 1);
  background-color: white;
  border: 1px solid #ccc;
  text-align: left;
  width: 100%;
}

.alert-card h5 {
  margin-bottom: 10px;
}

.card-deliverer {
  display: flex;
  flex-direction: row;
  width: 80%;
  height: 70vh;
  border-radius: 10px 10px 10px;
}
.information,
.Map {
  width: 100%;
  height: 100%;
}
.radius1 {
  background: #d23202;
  border-radius: 10px 0px 0px 0px;
}
.radius2 {
  background: #d23202;
  border-radius: 0px 10px 0px 0px;
}
.image {
  width: 450px;
  height: 300px;
  margin-bottom: -90px;
}
.google-map {
  width: 100%;
  height: 94%;
}
.click {
  margin-top: 40px;
}
</style>
