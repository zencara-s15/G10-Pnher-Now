<template>
  <WebLayout></WebLayout>
  <div class="delivers m-5">
    <nav class="form-delivers delivers-expand-lg flex-row">
      <div class="card" style="width: 60%;">
        <div class="card-body row">
          <div class="card-row">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVnkosCvGvXkhEeRBdluicMJgG1wJq7rbBiw&s">
            <div class="card-text col">
              <p class="name" id="name">{{ senderDetail.name }}</p>
              <p class="items" id="items">{{ senderDetail.items }}</p>
              <p class="location" id="location">{{ senderDetail.location }}</p>
            </div>
            <div class="btn-group">
              <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                @click="acceptDelivery">Detail</button>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div v-if="isAlertVisible" class="alert-card">
    <div class="alert-card-body">
      <h5>Detail</h5>
      <p>Name: {{ senderDetail.name }}</p>
      <p>Items: {{ senderDetail.items }}</p>
      <p>Location: {{ senderDetail.location }}</p>
      <p>Phone Number: {{ senderDetail.phone_number }}</p>
      <!-- <button type="button" class="btn btn-outline-secondary" @click="openMap">Open Map</button> -->
      <button type="button" class="btn btn-outline-success" @click="accept">Accept</button>
    </div>
  </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
export default {
  components: {
    WebLayout,
  },
  name: 'DeliverView',
  data() {
    return {
      senderDetail: {
        name: "",
        items: "",
        location: "",
        phone_number: "",
        // map: "",
      },
      isAlertVisible: false,
    };
  },
  computed: {
    senderId() {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get('sender') || Math.floor(Math.random() * 10) + 1;
    },
  },
  methods: {
    async fetchSenderDetails() {
      try {
        const response = await fetch(`https://reqres.in/api/users/${this.senderId}`);
        const data = await response.json();
        this.senderDetail = {
          name: data.data.first_name + ' ' + data.data.last_name,
          items: data.data.items || "Default item details", 
          location: data.data.location || "Default location", 
          phone_number: data.data.phone_number || "0987654321", 
          // map: data.data.map || "https://www.google.com/maps/place/Borey+solar+37D/@11.5516697,104.881452,17z/data=!3m1!4b1!4m6!3m5!1s0x310951f4b03f93d9:0xb1ffdc1cb14a8e74!8m2!3d11.5516645!4d104.8840269!16s%2Fg%2F11fqb0xscv?entry=ttu" // Replace with actual data if available
        };
      } catch (error) {
        console.error("Failed to fetch sender details:", error);
      }
    },
    acceptDelivery() {
      this.$emit('accept-delivery', this.senderDetail);
      this.showAlert();
    },
    showAlert() {
      this.isAlertVisible = true;
    },
    toggleCardBody() {
      this.hideCardBody = !this.hideCardBody;
    },
    // openMap() {
    //   window.open(this.senderDetail.map, '_blank');
    // },
    accept() {
      this.isAlertVisible = false;
    },
  },
  created() {
    this.fetchSenderDetails();
  },
};
</script>

<style scoped>
.card {
  flex-direction: row;
  display: flex;
  width: 100vh;
}

.card-row {
  display: flex;
  align-items: center;
}

.card-text {
  display: flex;
  flex-direction: row;
  margin-left: 10px;
  gap: 40px;
}

.form-delivers {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.alert-card {
  position: fixed;
  top: 54%;
  left: 65%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 25%;
}

.alert-card-body {
  display: flex;
  flex-direction: column;
  gap: 5px;
  text-align: left;
}

.alert-card h5 {
  margin-bottom: 10px;
}

h5 {
  text-align: center;
  background: grey;
}

img {
  width: 38px;
  height: 38px;
  border-radius: 50%;
}
</style>
