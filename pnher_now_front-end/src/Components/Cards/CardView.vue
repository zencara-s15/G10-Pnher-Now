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
        <p>Number sender: {{ card.numberSender }}</p>
        <p>Send To: {{ card.sendTo }}</p>
        <p>Number receiver: {{ card.numberReceiver }}</p>
        <p>Location Receiver: {{ card.locationReceiver }}</p>
        <p>Type: {{ card.type }}</p>
        <p>weight: {{ card.weight }}</p>
      </div>
      <div class="card-footer">
        <p>{{ card.locationSender }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CardView',
  data() {
    return {
      cards: [
        {
          name: 'Sreyluch',
          image: 'https://tinypng.com/images/social/website.jpg',
          numberSender: '0887049868',
          sendTo: 'PS',
          numberReceiver: '088998018',
          locationReceiver: "P'sar Kravanh PS.",
          type: 'decying',
          weight: '2kg',
          locationSender: 'View Map'
        }
      ]
    };
  },
  mounted() {
    const loader = new Loader({
        apiKey: 'key',
        version: 'beta',
        libraries: ['marker'],
    });

    loader.load().then((google) => {
        this.googleMap = new google.maps.Map(this.$refs.map, this.mapOptions);
        // const googleMap = new google.maps.Map(this.$refs.map, this.mapOptions);
        // window.googleMap = new google.maps.Map(this.$refs.map, this.mapOptions);

        // Marker works fine
        new google.maps.Marker({
            map: this.googleMap,
            position: this.home.position,
        })

        // Works only with window.googleMap or const googleMap
        new google.maps.marker.AdvancedMarkerView({
            map: this.googleMap,
            position: this.home.position,
            content: this.buildContent(this.home),
            title: this.home.title
        });
    });
},
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 100vh;
  background-color: #d3d3d3;
}

.card {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  width: 350px;
  padding: 20px;
  text-align: left;
  margin: 10px;
}

.card-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
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
}

.card-footer {
  text-align: center;
  font-weight: bold;
  margin-top: 15px;
}
</style>
