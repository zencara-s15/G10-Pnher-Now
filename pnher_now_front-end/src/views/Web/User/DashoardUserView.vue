<template>
  <WebLayout></WebLayout>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 part2 mb-3">
        <div class="search w-100 d-flex justify-content-center">
          <div class="input-group mb-3" style="max-width: 60%">
            <span class="input-group-text" id="basic-addon1">
              <i class="bi bi-search"></i>
            </span>
            <input
              type="text"
              class="form-control"
              placeholder="Search"
              aria-label="Search"
              aria-describedby="basic-addon1"
            />
          </div>
        </div>
        <div>
            <CardView></CardView>
        </div>
      </div>
      <div class="col-12 col-md-4 part3">
        <div class="partner-list p-3">
          <h2 class="text-center mb-3">List of Company</h2>
          <ul class="list-unstyled">
            <li
              v-for="(partner, index) in partners"
              :key="index"
              class="d-flex align-items-center mb-2"
            >
              <img
                :src="partner.image"
                :alt="`${partner.name} Logo`"
                class="partner-logo me-2"
              />
              {{ partner.name }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import CardView from '@/Components/Cards/CardView.vue'

const partners = ref([
  {
    name: 'J&T',
    image: 'https://asset-2.tstatic.net/tribunnewswiki/foto/bank/images/logo-jt-express.jpg'
  },
  {
    name: 'Cambodia express',
    image: 'https://pelprek.sgp1.digitaloceanspaces.com/logo/6564/small-156222885023908.jpg'
  },
  {
    name: 'Campital',
    image: 'https://media.licdn.com/dms/image/C4E0BAQHBIKulAp8BRQ/company-logo_200_200/0/1651693054138/capitalexpressus_logo?e=2147483647&v=beta&t=ghW9S5iogza2cKdUYSzD_sQOrfTGZkJBPxWznyBIUNI'
  },
  {
    name: 'Vireak Buntham',
    image: 'https://cambodia-logistics.com/wp-content/uploads/2021/06/%E0%B8%AA%E0%B9%88%E0%B8%87%E0%B8%AA%E0%B8%B4%E0%B8%99%E0%B8%84%E0%B9%89%E0%B8%B2%E0%B8%81%E0%B8%B1%E0%B8%A1%E0%B8%9E%E0%B8%B9%E0%B8%8A%E0%B8%B2223-1.jpg'
  }
])
</script>

<style scoped>
.part1,
.part2,
.part3 {
  padding: 20px;
  margin-bottom: 20px;
}
.part1 {
  background-color: #d0d0d0;
}
.part2 {
  background-color: #e0e0e0;
}
.part3 {
  background-color: #ffcccc;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.icon-container {
  width: 100%;
  border-radius: 5px;
  padding: 10px;
  justify-content: center;
  gap: 10px;
}

.icon-container i {
  font-size: 24px;
  color: #333;
}

.partner-list {
  width: 100%;
  background-color: rgba(248, 80, 87, 1);
  border-radius: 5px;
  padding: 20px;
}

.partner-logo {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
}

.container {
  background: pink;
  height: 100%;
  width: 100%;
}
input {
  background: rgba(208, 9, 17, 0.2);
}
span {
  background: rgba(208, 9, 17, 0.5);
}
</style>
