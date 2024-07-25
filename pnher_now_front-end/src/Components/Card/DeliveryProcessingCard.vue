<template>
  <div class="card">
    <div class="card-body" v-if="!hideCardBody">
      <MapView
        class="map"
        :latitude="item.latitude"
        :longitude="item.longitude"
        @marker-click="handleMarkerClick"
      ></MapView>
      <div class="card-title">
        <div class="location-info">
          <i class="bi bi-geo-alt text-danger me-2"></i>
          <p class="card-text m-0">
            From: <strong>{{ item.sending_address }}</strong>
          </p>
        </div>
        <div class="location-info">
          <i class="bi bi-geo text-success me-2"></i>
          <p class="card-text m-0">
            To: <strong>{{ item.receiving_address }}</strong>
          </p>
        </div>
      </div>
      <div class="card-actions">
        <button class="btn btn-danger" @click="finishNow"><i class="bi bi-check-circle me-1"></i>Finish Now</button>
        <button class="btn btn-primary" @click="ComingSoon"><i class="bi bi-chat-dots me-1"></i> Chat</button>
        <button class="btn btn-success" @click="ComingSoon"><i class="bi bi-telephone me-1"></i> Call</button>
        <button
          class="btn bg-orange-500 text-white hover:bg-orange-600"
          @click="showPostDetails(item)"
        >
          <i class="bi bi-info-circle me-1"></i> Details
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import MapView from '@/Components/Map/GoogleMap.vue'

export default {
  components: {
    MapView
  },
  name: 'DeliveryProcessingCard',
  props: {
    item: Object,
    user: Object
  },
  data() {
    return {
      hideCardBody: false
    }
  },
  methods: {
    showPostDetails(item) {
      this.$emit('show-details', item);
    },
    handleMarkerClick({ longitude, latitude }) {
      console.log('Marker clicked:', longitude, latitude);
    },
    finishNow() {
      this.$emit('finish', this.item);
    },
    ComingSoon() {
      // Call coming soon component here
      this.$emit('comingSoon');
    }
  }
}
</script>

<style scoped>
.card {
  border: 1px solid #ccc;
  width: 100%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  overflow: hidden;
}

.card-body {
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  border-radius: 10px;
  text-align: center;
  height: 100%;
  width: 100%;
  background: rgb(215, 212, 212);
}

.map {
  height: 67.5vh;
  width: 100%;
}

.card-title {
  display: flex;
  flex-direction: column;
  align-items: start;
  padding: 10px 0px 0px 50px;
}

.location-info {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}

.card-actions {
  display: flex;
  gap: 10px;
  justify-content: space-around;
  width: 100%;
  padding: 0px 50px 20px 50px;
}

.card-actions .btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  flex: 1;
}

.btn {
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-danger {
  background-color: #dc3545;
  color: white;
}

.btn-danger:hover {
  background-color: #c82333;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.bg-orange-500 {
  background-color: #e36a14;
}

.bg-orange-600 {
  background-color: #d1590d;
}
</style>