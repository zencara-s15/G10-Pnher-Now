<!-- <template>
    <div class="alert-card" v-if="isVisible">
      <div class="alert-card-body card-deliverer mb-5">
        <div class="information">
          <div class="text-white d-flex justify-content-center p-2 bg-red radius1">
            <h2>Information</h2>
          </div>
          <div class="p-3">
            <p>Phone Receiver: {{ baggage.phone_receiver }}</p>
            <p>Sending Address: {{ baggage.sending_address }}</p>
            <p>Receiving Address: {{ baggage.receiving_address }}</p>
            <p>Baggage Type: {{ baggage.type }}</p>
            <p>Weight: {{ baggage.weight }} Kg</p>
            <p>Total Cost: {{ calculateTotalCost(baggage.weight) }} Real</p>
            <p>Company: {{ baggage.company }}</p>
          </div>
          <div class="d-flex justify-center image">
            <img src="/src/assets/deliverer.png" width="300px" />
          </div>
          <div class="mt-3 p-3 d-flex justify-between">
            <div>
              <button type="button" class="btn btn-outline-danger" @click="close">
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
            <GoogleMap />
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import GoogleMap from '@/Components/Layouts/GoogleMap.vue'
  
  export default {
    components: {
      GoogleMap
    },
    props: {
      baggage: Object,
      isVisible: Boolean
    },
    methods: {
      close() {
        this.$emit('close-alert')
      },
      acceptBaggage() {
        this.$emit('accept-baggage')
      },
      calculateTotalCost(weight) {
        return weight * 6000 // Assuming a rate of 6000 Real per Kg
      }
    }
  }
  </script>
  
  <style scoped>
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
   -->