<template>
  <div class="map-wrap">
    <div class="map" ref="mapContainer"></div>
    <button class="btn bg-orange-500" @click="getCurrentLocation">Get Direction</button>
    <div v-if="distance !== null" class="distance">
      Distance: {{ distance.toFixed(2) }} km
    </div>
  </div>
</template>

<script setup>
import mapboxgl from 'mapbox-gl';
import { shallowRef, onMounted, onUnmounted, watch } from 'vue';
import 'mapbox-gl/dist/mapbox-gl.css';

const props = defineProps({
  latitude: {
    type: Number,
    required: true,
  },
  longitude: {
    type: Number,
    required: true,
  }
});

const mapContainer = shallowRef(null);
const map = shallowRef(null);
const marker = shallowRef(null);
const currentLocationMarker = shallowRef(null); // Marker for current location
const currentLocation = shallowRef({ lat: null, lng: null }); // Store current location
const distance = shallowRef(null);

const toRadians = (degrees) => degrees * (Math.PI / 180);

const calculateDistance = (lat1, lon1, lat2, lon2) => {
  const R = 6371; // Radius of the Earth in km
  const dLat = toRadians(lat2 - lat1);
  const dLon = toRadians(lon2 - lon1);
  const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c; // Distance in km
};

const getCurrentLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      const { latitude, longitude } = position.coords;
      currentLocation.value = { lat: latitude, lng: longitude };
      console.log(`Current Location: Longitude: ${longitude}, Latitude: ${latitude}`);

      // Add or update current location marker
      if (currentLocationMarker.value) {
        currentLocationMarker.value.setLngLat([longitude, latitude]);
      } else {
        currentLocationMarker.value = new mapboxgl.Marker({ color: 'red' }) // Different color for current location marker
          .setLngLat([longitude, latitude])
          .addTo(map.value);
      }

      // Optionally center the map on current location
      if (map.value) {
        map.value.setCenter([longitude, latitude]);
      }

      // Calculate the distance
      distance.value = calculateDistance(latitude, longitude, props.latitude, props.longitude);

    }, error => {
      console.error('Error getting location:', error);
    });
  } else {
    console.error('Geolocation is not supported by this browser.');
  }
};

const getDirections = () => {
  if (!currentLocation.value.lat || !currentLocation.value.lng) {
    console.error('Current location is not available.');
    return;
  }

  const start = [currentLocation.value.lng, currentLocation.value.lat];
  const end = [props.longitude, props.latitude];
  
  fetch(`https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`)
    .then(response => response.json())
    .then(data => {
      if (data.routes && data.routes.length > 0) {
        const route = data.routes[0].geometry.coordinates;
        const geojson = {
          type: 'Feature',
          properties: {},
          geometry: {
            type: 'LineString',
            coordinates: route
          }
        };

        if (map.value.getSource('route')) {
          map.value.getSource('route').setData(geojson);
        } else {
          map.value.addLayer({
            id: 'route',
            type: 'line',
            source: {
              type: 'geojson',
              data: geojson
            },
            layout: {
              'line-join': 'round',
              'line-cap': 'round'
            },
            paint: {
              'line-color': '#3887be',
              'line-width': 5,
              'line-opacity': 0.75
            }
          });
        }

        // Fit map bounds to the route
        const bounds = new mapboxgl.LngLatBounds();
        route.forEach(coord => bounds.extend(coord));
        map.value.fitBounds(bounds, { padding: 50 });
      } else {
        console.error('No routes found.');
      }
    })
    .catch(error => {
      console.error('Error fetching directions:', error);
    });
};

onMounted(() => {
  mapboxgl.accessToken = 'pk.eyJ1Ijoic2llbWNob3ViMTExMSIsImEiOiJjbHg3bDRrdGowaW1kMmxweG50MHdpazMzIn0.cAYH_6kwxhwH43FM46qmOg';

  map.value = new mapboxgl.Map({
    container: mapContainer.value,
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [props.longitude, props.latitude],
    zoom: 14
  });

  marker.value = new mapboxgl.Marker()
    .setLngLat([props.longitude, props.latitude])
    .addTo(map.value);

  marker.value.getElement().addEventListener('click', () => {
    const lngLat = marker.value.getLngLat();
    console.log(`Longitude: ${lngLat.lng}, Latitude: ${lngLat.lat}`);
    emit('marker-click', { longitude: lngLat.lng, latitude: lngLat.lat });
  });

  map.value.on('load', () => {
    map.value.addSource('route', {
      type: 'geojson',
      data: {
        type: 'Feature',
        properties: {},
        geometry: {
          type: 'LineString',
          coordinates: []
        }
      }
    });

    map.value.addLayer({
      id: 'route',
      type: 'line',
      source: 'route',
      layout: {
        'line-join': 'round',
        'line-cap': 'round'
      },
      paint: {
        'line-color': '#3887be',
        'line-width': 5,
        'line-opacity': 0.75
      }
    });
  });
});

onUnmounted(() => {
  if (map.value) {
    map.value.remove();
  }
});

watch([() => props.latitude, () => props.longitude], ([newLat, newLng]) => {
  if (marker.value) {
    marker.value.setLngLat([newLng, newLat]);
  }
  if (map.value) {
    map.value.setCenter([newLng, newLat]);
  }
});

// Watch for changes in current location and update directions automatically
watch(() => currentLocation.value, () => {
  getDirections();
});
</script>

<style scoped>
.map-wrap {
  width: 100%;
  height: calc(60vh - 50px);
  position: relative;
}

.map {
  width: 100%;
  height: 100%;
}

button {
  position: absolute;
  top: -30px; /* Adjusted from 10px to 20px */
  right: 10px;
  padding: 10px 20px;
  /* background-color: #007bff; */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  z-index: 1;
  margin-top: 40px;
}

button:hover {
  background-color: #e00404;
  color: white;
}

.distance {
  position: absolute;
  top: 10px;
  left: 10px;
  padding: 10px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  z-index: 1;
}
</style>
