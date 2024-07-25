<template>
  <div class="trip-item" v-if="delivery_status_id === 3">
      <span class="status px-10px py-5px">Completed</span>
      <div class="trip-header mt-2">
        <span class="type">{{ date }}</span>
      </div>
      <div class="trip-header mt-2">
        <span class="type"><i class="bi bi-geo-alt text-danger me-2"></i>{{ sender }}</span>
      </div>
      <div class="trip-header">
        <span class="type"><i class="bi bi-geo text-danger me-2"></i>{{ receiver }}</span>
        <div class="details d-flex">
          <div class="">
            <button class="bg-orange-500 hover:bg-orange-700" @click="showDetails">Detail</button>
          </div>
        </div>
      </div>
      <!-- Popup -->
      <div v-if="isPopupVisible" class="popup" @click.self="closePopup">
        <div class="popup-content text-dark">
          <header class="popup-header">
            <h3><strong>Information Details</strong></h3>
            <button class="close-button" @click="closePopup">&times;</button>
          </header>
          <section class="popup-body">
            <p><strong>Phone Receiver:</strong> {{ receiver_phone }}</p>
            <p><strong>Type:</strong> {{ type }}</p>
            <p><strong>Weight:</strong> {{ weight }} kg</p>
            <p><strong>Company:</strong> {{ companies }}</p>
            <p><strong>Total Price:</strong> {{ total_price }}Real</p>
          </section>
        </div>
      </div>
    </div>
</template>
  
<script>
export default {
  props: {
    delivery_status_id: Number,
    date: String,
    sender: String,
    receiver: String,
    phone_receiver: String,
    type: String,
    weight: Number,
    companies: String,
    total_price: Number
  },
  data() {
    return {
      isPopupVisible: false
    }
  },
  methods: {
    showDetails() {
      this.isPopupVisible = true
    },
    closePopup() {
      this.isPopupVisible = false
    }
  }
}
</script>
  
<style scoped>
.trip-item {
  border-bottom: 1px solid #ccc;
  padding: 10px 0;
}

.trip-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 5px;
}

.status {
  background: green;
  color: white;
  border-radius: 5px;
  font-weight: bold;
}

.type {
  color: #6c757d;
}

.details button {
  background-color: #e36a14;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  border-radius: 4px;
}

.popup {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.popup-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 90%;
  max-width: 500px;
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.close-button {
  background: transparent;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.popup-body {
  margin-top: 10px;
}
</style>
