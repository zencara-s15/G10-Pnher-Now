<template>
  <div class="map-wrap">
    <div class="map" ref="mapContainer"></div>
  </div>
</template>

<script setup>
import { Map, MapStyle, config } from '@maptiler/sdk';
import { shallowRef, onMounted, onUnmounted, markRaw } from 'vue';
import '@maptiler/sdk/dist/maptiler-sdk.css';

const mapContainer = shallowRef(null);
const map = shallowRef(null);

onMounted(() => {
  config.apiKey = 'fZSNtpgb8N73PwrIUuMq';

  const initialState = {
  "lng": 104.8830406846566,
  "lat": 11.551364353871305,
  "zoom": 14
}

  map.value = markRaw(new Map({
    container: mapContainer.value,
    style: MapStyle.STREETS,
    center: [initialState.lng, initialState.lat],
    zoom: initialState.zoom
  }));

}),
onUnmounted(() => {
  map.value?.remove();
})
</script>

<style scoped>
.map-wrap {
  position: relative;
  width: 100%;
  height: calc(100vh - 77px); /* calculate height of the screen minus the heading */
}

.map {
  /* position: absolute; */
  width: 100%;
  height: 75vh;
}
</style>