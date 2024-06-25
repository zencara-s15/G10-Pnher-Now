<template>
  <WebLayout></WebLayout>
  <div class="container mt-4 p-4">
    <div class="row justify-content-between align-items-center mb-5">
      <div class="col-auto">
        <h3 class="fw-bolder text-dark">List of User Product</h3>
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
          <div class="d-flex justify-content-center mt-2">
            <h3>Product</h3>
          </div>
          <div class="card-body">
            <p class="card-title">Sender: {{ item.sender }}</p>
            <p class="card-text">Receiver: {{ item.receiver }}</p>
            <p class="card-text">From: {{ item.from }}</p>
            <p class="card-text">To: {{ item.to }}</p>
            <p class="card-text">Product Type: {{ item.product_type }}</p>
            <p class="card-text">Company: {{ item.company }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Form -->
  <div v-if="showModal" class="modal fade show" style="display: block" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content mt-20">
        <div class="modal-header d-flex justify-content-between align-items-center">
          <h5 class="modal-title text-white">Add Your Product</h5>
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
              <label for="sender" class="text-danger">Phone Sender</label>
              <input type="text" v-model="sender" class="form-control" id="sender" required />
            </div>
            <div class="form-group">
              <label for="receiver" class="text-danger">Phone Receiver</label>
              <input type="text" v-model="receiver" class="form-control" id="receiver" required />
            </div>
            <div>
              <div class="form-group">
                <label for="from" class="text-danger">From</label>
                <select v-model="from" class="form-control" id="from" required>
                  <option value="" disabled>Select your location</option>
                  <option v-for="province in provinces" :key="province" :value="province">
                    {{ province }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="to" class="text-danger">To</label>
                <select v-model="to" class="form-control" id="to" required>
                  <option value="" disabled>Select your goal</option>
                  <option v-for="province in provinces" :key="province" :value="province">
                    {{ province }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="product_type" class="text-danger">Product Type</label>
              <select v-model="product_type" class="form-control" id="product_type" required>
                <option value="" disabled>Select type of Product</option>
                <option
                  v-for="product_type in product_types"
                  :key="product_type"
                  :value="product_type"
                >
                  {{ product_type }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="company" class="text-danger">Choose Company</label>
              <select v-model="company" class="form-control" id="company" required>
                <option value="" disabled>Select Company</option>
                <option v-for="company in companies" :key="company" :value="company">
                  {{ company }}
                </option>
              </select>
            </div>
            <div>
              <div class="flex gap-53">
                <button type="submit" class="btn bg-white mt-4">Pay By Sender</button>
                <button type="submit" class="btn bg-white mt-4">Pay BY Receiver</button>
              </div>
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
      product_type: '',
      company: '',

      user_create: [
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Kampot',
          product_type: 'decaying',
          company: 'Vireak Buntham'
        },
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Takeaw',
          product_type: 'not decaying',
          company: 'Vireak Buntham'
        }
      ],
      product_types: ['decaying', 'not decaying'],
      companies: ['Vireak Buntham', 'Capitol', 'J&T express', 'ZTO express', 'other'],
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
        product_type: this.product_type,
        company: this.company
      })
      this.sender = ''
      this.receiver = ''
      this.from = ''
      this.to = ''
      this.product_type = ''
      this.company = ''
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
.modal-content {
  background: #2a2726;
}
</style>
