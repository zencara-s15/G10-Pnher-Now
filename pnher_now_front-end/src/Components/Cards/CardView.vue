<template>
  <div class="container">
    <div v-for="card in cards" :key="card.numberSender" class="card">
      <div class="card-header">
        <img :src="card.image" alt="Sreyluch" class="avatar" />
        <div class="sender-info">
          <p>{{ card.name }}</p>
        </div>
      </div>
      <div class="card-body">
         <p>Type: {{ card.type }}</p>
        <p>Weight: {{ card.weight }}</p>
        <p>Number receiver: {{ card.numberReceiver }}</p>
        <p>Company: {{card.company}}</p>
        <p>Address Receiver: {{card.receiver_address}}</p>
      </div>
      <div class="card-footer">
        <p @click="showMap(card)">View Map</p>
      </div>
    </div>

    <div v-if="showMapModal" class="map-modal">
      <div class="map-container" ref="mapContainer"></div>
      <button @click="closeMap">Close Map</button>
    </div>
  </div>
</template>

<script>
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
export default {
  name: 'CardView',
  data() {
    return {
      cards: [
        {
          name: 'KaKa',
          image: 'https://tinypng.com/images/social/website.jpg',
          type: 'decying',
          weight: '2kg',
          numberReceiver: '088998018',
          company: 'J&T',
          receiver_address: "P'sar Kravanh PS.",
          locationSender: 'View Map',
          coordinates: [11.55104, 104.88353] 
        },
        {
          name: 'King',
          image: 'https://tinypng.com/images/social/website.jpg',
          type: 'decying',
          weight: '2kg',
          numberReceiver: '088998018',
          company: 'J&T',
          receiver_address: "P'sar Kravanh PS.",
          locationSender: 'View Map',
          coordinates: [11.55104, 104.88353] 
        }
        
      ],
      showMapModal: false,
      selectedCoordinates: null,
      map: null
    };
  },
  methods: {
    showMap(card) {
      this.selectedCoordinates = card.coordinates;
      this.showMapModal = true;
      this.$nextTick(this.initMap);
    },
    closeMap() {
      this.showMapModal = false;
      this.selectedCoordinates = null;
      if (this.map) {
        this.map.remove();
        this.map = null;
      }
    },
    initMap() {
      if (!this.selectedCoordinates) return;
      if (this.map) {
        this.map.remove();
      }
      this.map = L.map(this.$refs.mapContainer).setView(this.selectedCoordinates, 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(this.map);
      L.marker(this.selectedCoordinates).addTo(this.map)
        .bindPopup('Location Sender')
        .openPopup();
      this.map.invalidateSize();
    }
  }
};
</script>

<style scoped>
.container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.card {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  width: 350px;
  padding: 30px;
  margin: 10px;
  text-align: left;
}

.card-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding: 10px;
}

.avatar {
  border-radius: 50%;
  width: 80px;
  height: 80px;
  margin-right: 15px;
}

.sender-info {
  font-size: 18px;
  font-weight: bold;
}

.card-body p,
.card-footer p {
  font-size: 18px;
  margin: 10px 0;
  cursor: pointer;
}

.card-footer {
  text-align: center;
  font-weight: bold;
  margin-top: 15px;
}

.map-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.map-container {
  width: 80%;
  height: 80%;
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

.map-modal button {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 10px;
  background: red;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>
