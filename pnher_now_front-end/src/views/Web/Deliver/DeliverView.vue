<template>
  <DelivererLayout>
    <div class="delivers m-5">
      <nav
        class="form-delivers delivers-expand-lg flex-row"
        v-for="(item, index) in baggage"
        :key="item.id"
      >
        <div class="card">
          <div class="card-body" v-if="!hideCardBody">
            <div class="card-header">
              <div class="img">
                <img :src="`http://127.0.0.1:8000/images/${item.post_id?.profile}`"/>
              </div>
              <div class="card-title">
                <p class="name">
                  Name: {{ users[index]?.first_name + ' ' + users[index]?.last_name }}
                </p>
              </div>
            </div>
            <div class="card-actions">
              <button type="button" class="btn btn-info" @click="acceptDelivery(item, index)">
                Accept
              </button>
              <button type="button" class="btn btn-warning" @click="toggleCardBody">Cancel</button>
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
              <p>Phone Receiver: {{ selectedBaggage.phone_receiver }}</p>
              <p>Sending Address: {{ selectedBaggage.sending_address }}</p>
              <p>Receiving Address: {{ selectedBaggage.receiving_address }}</p>
              <p>Baggage Type: {{ selectedBaggage.type }}</p>
              <p>Weight: {{ selectedBaggage.weight }} Kg</p>
              <p>Total Cost: {{ calculateTotalCost(selectedBaggage.weight) }} Real</p>
              <p>Company: {{ selectedBaggage.company }}</p>
            </div>
            <div class="d-flex justify-center image">
              <img src="/src/assets/deliverer.png" width="300px" />
            </div>
            <div class="mt-3 p-3 d-flex justify-between">
              <div>
                <button type="button" class="btn btn-outline-danger" @click="closeAlert">
                  Back
                </button>
              </div>
              <div>
                <button type="button" class="btn btn-success" @click="acceptBaggage">
                  Arrived
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
    async fetchSenderDetails() {
      try {
        const response = await fetch(`https://reqres.in/api/users/${this.senderId}`)
        const data = await response.json()
        this.senderDetail = {
          name: data.data.first_name + ' ' + data.data.last_name,
          items: data.data.items || 'Default item details',
          location: data.data.location || 'Default location',
          phone_number: data.data.phone_number || '0987654321',
          map:
            data.data.map ||
            'https://www.google.com/maps/place/Borey+solar+37D/@11.5516697,104.881452,17z/data=!3m1!4b1!4m6!3m5!1s0x310951f4b03f93d9:0xb1ffdc1cb14a8e74!8m2!3d11.5516645!4d104.8840269!16s%2Fg%2F11fqb0xscv?entry=ttu'
        }
      } catch (error) {
        console.error('Failed to fetch sender details:', error)
      }
    },
    async acceptDelivery(baggage, index) {
      this.selectedBaggage = baggage
      this.isAlertVisible = true
      this.hideCardBody = false

      this.baggageStore = usePostBaggageStore()
      this.delivery_status_id = '2'
      try {
        await this.baggageStore.updateBaggageStatus(this.delivery_status_id, baggage.id)
        console.log(this.baggageStore.responseMessage)
      } catch (error) {
        console.warn(error)
      }
    },
    async acceptBaggage() {
      this.delivery_status_id = '3'
      try {
        await this.baggageStore.updateBaggageStatus(this.delivery_status_id, this.selectedBaggage.id)
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
  gap: 10px;
}
.card {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 250px; /* Set width and height to make the card square */
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
</style>
