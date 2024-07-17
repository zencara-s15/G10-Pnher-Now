<template>
  <!-- <WebLayout></WebLayout> -->
  <DelivererLayout>
    <div class="container">
      <h3>Feedback From Customer</h3>
      <div v-for="feedbacks in feedbacks" :key="feedbacks.id" class="card">
        <div class="card-body">
          <div class="card-text">
            <img
              :src="getProfileImage(feedbacks.user.profile)"
              alt="User Profile"
              class="avatar-fluid rounded-circle"
            />

            <div class="user-info">
              <div class="name_date">
                <div class="name">
                  <p class="first_name ml-4">{{ feedbacks.user.first_name }}</p>
                  <p class="last_name ml-2">{{ feedbacks.user.last_name }}</p>
                </div>
                <p class="date ml-3">{{ feedbacks.create}}</p>
              </div>
              <div class="star-icon" id="one" v-if="feedbacks.rates > 0 && feedbacks.rates <= 2">
                <i class="fas fa-star" v-for="n in 1" :key="n"></i>
              </div>
              <div class="star-icon" id="two" v-if="feedbacks.rates > 2 && feedbacks.rates <= 4">
                <i class="fas fa-star" v-for="n in 2" :key="n"></i>
              </div>
              <div class="star-icon" id="tree" v-if="feedbacks.rates > 4 && feedbacks.rates <= 6">
                <i class="fas fa-star" v-for="n in 3" :key="n"></i>
              </div>
              <div class="star-icon" id="four" v-if="feedbacks.rates > 6 && feedbacks.rates <= 8">
                <i class="fas fa-star" v-for="n in 4" :key="n"></i>
              </div>
              <div class="star-icon" id="five" v-if="feedbacks.rates > 8">
                <i class="fas fa-star" v-for="n in 5" :key="n"></i>
              </div>
              <div class="star-icon" v-if="feedbacks.rates == 8">
                <i class="fas fa-star" v-for="n in 0" :key="n"></i>
              </div>
            </div>
          </div>
          <div class="des">
            <p class="descript mt-1"><b>Title :</b> {{ feedbacks.title }}</p>
          </div>
          <div class="des">
            <p class="descript mt-1"><b>Comment :</b> {{ feedbacks.comment }}</p>
          </div>
        </div>
      </div>
    </div>
  </DelivererLayout>
</template>

<script>
// import UserLayout from '@/Components/Layouts/UserLayout.vue'
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'

import '@fortawesome/fontawesome-free/css/all.css'
import axios from '@/plugins/axios'

export default {
  components: {
    DelivererLayout
  },
  name: 'FeedbackView',
  data() {
    return {
      feedbacks: []
    }
  },
  mounted() {
    // ================== get all feedback from customer ==================
    axios
      .get('http://127.0.0.1:8000/api/getFeedback')
      .then((response) => {
        this.feedbacks = response.data.getFeedbacks
        console.log(this.feedbacks[0].user.profile)
      })
      .catch((error) => {
        console.error(error)
      })
  },

  methods: {
    getProfileImage(profile) {
      if (profile) {
        return `http://127.0.0.1:8000/images/${profile}`
      }
      return 'default-profile-image-path' // Provide a default image path if needed
    }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 10px;
  /* margin-left: 50px; */
}

.card {
  display: flex;
  justify-content: center;
  flex-direction: column;
  margin-top: 5px;
  padding: 10px;
  border-radius: 5px;
  width: 100%;
}

.card-body {
  display: flex;
  flex-direction: column;
}

.card-text {
  display: flex;
  flex-direction: row;
}

.user-info {
  display: flex;
  margin-left: 10px;
}
.name {
  width: 120px;
  display: flex;
}
.first_name, .last_name {
  font-size: 20px;
}
.date{
  color: rgb(101, 101, 101);
  font-size: 13px;
}

.star-icon {
  display: flex;
  justify-content: end;
  width: 100px;
  color: gold;
  margin-left: 770px;
}

.avatar-fluid {
  width: 60px;
  height: 60px;
}
</style>
