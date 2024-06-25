<template>
  <WebLayout></WebLayout>
  <div class="container mt-4 bg-dark p-4">
    <div class="row justify-content-between align-items-center mb-5">
      <div class="col-auto">
        <h1 class="fw-bolder text-white">List of User Product</h1>
      </div>
      <div class="col-auto">
        <div class="input-group search-group mr-50">
          <span class="input-group-text bg-danger text-white">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" class="form-control" placeholder="Search..." />
        </div>
      </div>
      <div class="col-auto">
        <button class="btn btn-warning me-2" @click="showModal = true">Add</button>
        <button class="btn btn-light text-danger">
          <i class="bi bi-bell"></i>
        </button>
      </div>
    </div>

    <!-- Card Section -->
    <div class="row">
      <div class="col-md-4 mb-3" v-for="(item, index) in user_create" :key="index">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sender: {{ item.sender }}</h5>
            <p class="card-text">Receiver: {{ item.receiver }}</p>
            <p class="card-text">From: {{ item.from }}</p>
            <p class="card-text">To: {{ item.to }}</p>
            <p class="card-text">Category: {{ item.category }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Form -->
  <div v-if="showModal" class="modal fade show" style="display: block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-orange">
        <div class="modal-header d-flex justify-content-between align-items-center">
          <h5 class="modal-title">Add Your Product</h5>
          <button
            type="button"
            class="close btn bg-danger"
            @click="showModal = false"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="addItem">
            <div class="form-group">
              <label for="sender">Sender</label>
              <input type="text" v-model="sender" class="form-control" id="sender" required />
            </div>
            <div class="form-group">
              <label for="receiver">Receiver</label>
              <input type="text" v-model="receiver" class="form-control" id="receiver" required />
            </div>
            <div>
              <div class="form-group">
                <label for="from">From</label>
                <select v-model="from" class="form-control" id="from" required>
                  <option value="" disabled>Select your location</option>
                  <option v-for="province in provinces" :key="province" :value="province">
                    {{ province }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="to">To</label>
                <select v-model="to" class="form-control" id="to" required>
                  <option value="" disabled>Select your goal</option>
                  <option v-for="province in provinces" :key="province" :value="province">
                    {{ province }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select v-model="category" class="form-control" id="category" required>
                <option value="" disabled>Select category</option>
                <option v-for="category in categories" :key="category" :value="category">
                  {{ category }}
                </option>
              </select>
            </div>
            <div>
              <div class="flex gap-30">
                <button type="submit" class="btn btn-primary mt-4">Pay By Sender</button>
                <button type="submit" class="btn btn-primary mt-4">Pay BY Receiver</button>
              </div>
            </div>
            <div>
              <button type="submit" class="btn bg-white mt-4">Choose Company</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue'
export default {
  components: {
    WebLayout
  },

  data() {
    return {
      showModal: false,
      sender: '',
      receiver: '',
      from: '',
      to: '',
      category: '',

      user_create: [
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Kampot'
        },
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Takaw'
        }
      ],
      categories: ['food', 'drink', 'electronics', 'clothing', 'other'],
      from: '',
      to: '',
      provinces: [
        'Banteay Meanchey',
        'Battambang',
        'Kampong Cham',
        'Kampong Chhnang',
        'Kampong Speu',
        'Kampong Thom',
        'Kampot',
        'Kandal',
        'Koh Kong',
        'Kratie',
        'Mondulkiri',
        'Phnom Penh',
        'Preah Vihear',
        'Prey Veng',
        'Pursat',
        'Ratanakiri',
        'Siem Reap',
        'Preah Sihanouk',
        'Stung Treng',
        'Svay Rieng',
        'Takeo',
        'Oddar Meanchey',
        'Kep',
        'Pailin',
        'Tbong Khmum'
      ]
    }
  },

  methods: {
    addItem() {
      this.user_create.push({
        sender: this.sender,
        receiver: this.receiver,
        from: this.from,
        to: this.to,
        category: this.category
      })
      this.sender = ''
      this.receiver = ''
      this.from = ''
      this.to = ''
      this.category = ''
      this.showModal = false
    }
  }
}
</script>

<style scoped>
.container {
  width: 1500px;
  height: 80vh;
  border-radius: 10px;
}

.card {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Modal styles */
.modal {
  transition: opacity 0.15s linear;
}

.modal .modal-dialog {
  transform: translate(0, -25%);
  transition: transform 0.15s ease-out;
}

.modal.show .modal-dialog {
  transform: translate(0, 0);
}
</style>
