<!-- DeliveryManCard.vue -->
<template>
  <div class="card">
    <div class="card-body" v-if="!hideCardBody">
      <MapView :latitude="item.latitude" :longitude="item.longitude" @marker-click="handleMarkerClick"></MapView>
      <div class="card-title flex flex-start">
        <div class="d-flex gap-1 mb-2 align-items-center">
          <i class="bi bi-geo-alt text-danger me-2"></i>
          <p class="card-text m-0">
            From: <strong>{{ item.sending_address }}</strong>
          </p>
        </div>
        <div class="d-flex gap-1 mb-2 align-items-center">
          <i class="bi bi-geo text-success me-2"></i>
          <p class="card-text m-0">
            To: <strong>{{ item.receiving_address }}</strong>
          </p>
        </div>
      </div>
      <div class="card-actions">
        <button type="button" class="btn bg-orange-500 w-100% text-white hover:bg-orange-600 " @click="showPostDetails(item)">Detail</button>
      </div>
    </div>
  </div>
</template>

<script>
import MapView from '@/Components/Map/GoogleMap.vue';

export default {
  components: {
    MapView
  },
  name: 'DeliveryManCard',
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
      this.$emit('show-details', item)
    },
    handleMarkerClick({ longitude, latitude }) {
      console.log('Marker clicked:', longitude, latitude);
      // Handle the received coordinates here
    }
  }
}
</script>

<style scoped>
.card {
  background-color: #e2dddd;
  border: 1px solid #ccc;
  border-radius: 10px;
  width: 100%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
}

.card-body {
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  border-radius: 10px 10px;
  text-align: center;
  height: 100%;
  width: 100%;
  background: rgb(215, 212, 212);
}

.card-title {
  display: flex;
  flex-direction: column;
  align-items: start;
  padding: 10px 10px 0px 10px;
}

.card-actions {
  display: flex;
  justify-content: center;
  width: 100%;
  padding: 0px 10px 10px 10px;
}
</style>
