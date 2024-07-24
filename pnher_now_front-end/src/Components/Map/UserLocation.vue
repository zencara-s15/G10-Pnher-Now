<template>
  <div id="map" class="map w-100 h-100"></div>
</template>
  
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import mapboxgl from 'mapbox-gl'

// Mapbox access token
mapboxgl.accessToken =
  'pk.eyJ1Ijoic2llbWNob3ViMTExMSIsImEiOiJjbHg3bDRrdGowaW1kMmxweG50MHdpazMzIn0.cAYH_6kwxhwH43FM46qmOg'

const initMap = (center: [number, number]) => {
  const map = new mapboxgl.Map({
    container: 'map', // ID of the element where the map will be rendered
    style: 'mapbox://styles/mapbox/streets-v11', // Map style
    center: center, // Starting position [lng, lat]
    zoom: 13 // Starting zoom level set to 13
  })

  // Add a marker for the user's current location
  new mapboxgl.Marker({ color: 'red' })
    .setLngLat(center)
    .setPopup(new mapboxgl.Popup().setHTML(`<b>Your Location</b>`))
    .addTo(map)
}

const getCurrentLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const { latitude, longitude } = position.coords
        initMap([longitude, latitude])
      },
      (error) => {
        console.error('Error getting location:', error)
        // Default to Los Angeles if location access is denied
        initMap([-118.2437, 34.0522])
      }
    )
  } else {
    console.error('Geolocation is not supported by this browser.')
    // Default to Los Angeles if geolocation is not supported
    initMap([-118.2437, 34.0522])
  }
}

onMounted(() => {
  getCurrentLocation()
})
</script>
  
  <style>
#map {
  width: 100%;
  height: 100%;
}
</style>
  