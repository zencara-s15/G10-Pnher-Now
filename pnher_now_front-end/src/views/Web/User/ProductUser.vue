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
        <button class="btn btn-danger me-2" @click="showModal = true">Booking Now</button>
      </div>
    </div>
    <!-- Card Section -->
    <div class="row">
      <div class="col-md-4 mb-3" v-for="(item, index) in user_create" :key="index">
        <div class="card">
          <div class="d-flex justify-content-center bg-danger text-white border p-2">
            <h3>New Booking</h3>
          </div>
          <div class="d-flex">
            <div class="card-body">
              <div class="d-flex">
                <h3>Sender</h3>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-telephone-forward-fill"></i> -->
                <p class="card-title">Sender: {{ item.sender }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-geo-alt-fill"></i> -->
                <p class="card-text">To: {{ item.to }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-geo-alt-fill"></i> -->
                <p class="card-text">District: {{ item.toDistrict }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-map-fill"></i> -->
                <p class="card-text">ToCommune: {{ item.toCommune }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-shop"></i> -->
                <p class="card-text">ToBranch: {{ item.toBranch }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-bag-fill"></i> -->
                <p class="card-text">Type: {{ item.product_type }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-buildings"></i> -->
                <p class="card-text">Company: {{ item.company }}</p>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <h3>Receiver</h3>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-telephone-inbound-fill"></i> -->
                <p class="card-text">Receiver: {{ item.receiver }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-geo-alt-fill"></i> -->
                <p class="card-text">From: {{ item.from }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-geo-alt-fill"></i> -->
                <p class="card-text">District: {{ item.fromDistrict }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-map-fill"></i> -->
                <p class="card-text">fromCommune: {{ item.fromCommune }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-shop"></i> -->
                <p class="card-text">fromBranch: {{ item.fromBranch }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-bag-fill"></i> -->
                <p class="card-text">Type: {{ item.product_type }}</p>
              </div>
              <div class="d-flex gap-1">
                <!-- <i class="bi bi-buildings"></i> -->
                <p class="card-text">Company: {{ item.company }}</p>
              </div>
            </div>
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
            <div class="row">
              <!-- Sender Information -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="sender" class="text-danger">Phone Sender</label>
                  <input type="text" v-model="sender" class="form-control" id="sender" required />
                </div>
                <div class="form-group">
                  <label for="from" class="text-danger">From</label>
                  <select v-model="from" class="form-control" id="from">
                    <option value="" disabled>Select your location</option>
                    <option v-for="province in provinces" :key="province" :value="province">
                      {{ province }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fromDistrict" class="text-danger">From District</label>
                  <select v-model="fromDistrict" class="form-control" id="fromDistrict">
                    <option value="" disabled>Select your district</option>
                    <option v-for="district in districts" :key="district" :value="district">
                      {{ district }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fromCommune" class="text-danger">From Commune</label>
                  <select v-model="fromCommune" class="form-control" id="fromCommune" required>
                    <option value="" disabled>Select your commune</option>
                    <option v-for="commune in communes" :key="commune" :value="commune">
                      {{ commune }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="fromBranch" class="text-danger">From Branch</label>
                  <select v-model="fromBranch" class="form-control" id="fromBranch" required>
                    <option value="" disabled>Select your branch</option>
                    <option v-for="branch in branches" :key="branch" :value="branch">
                      {{ branch }}
                    </option>
                  </select>
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
              </div>
              <!-- Receiver Information -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="receiver" class="text-danger">Phone Receiver</label>
                  <input
                    type="text"
                    v-model="receiver"
                    class="form-control"
                    id="receiver"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="to" class="text-danger">To</label>
                  <select v-model="to" class="form-control" id="to">
                    <option value="" disabled>Select your goal</option>
                    <option v-for="province in provinces" :key="province" :value="province">
                      {{ province }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="toDistrict" class="text-danger">To District</label>
                  <select v-model="toDistrict" class="form-control" id="toDistrict">
                    <option value="" disabled>Select your district</option>
                    <option v-for="district in districts" :key="district" :value="district">
                      {{ district }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="toCommune" class="text-danger">To Commune</label>
                  <select v-model="toCommune" class="form-control" id="toCommune" required>
                    <option value="" disabled>Select your commune</option>
                    <option v-for="commune in communes" :key="commune" :value="commune">
                      {{ commune }}
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="toBranch" class="text-danger">To Branch</label>
                  <select v-model="toBranch" class="form-control" id="toBranch" required>
                    <option value="" disabled>Select your branch</option>
                    <option v-for="branch in branches" :key="branch" :value="branch">
                      {{ branch }}
                    </option>
                  </select>
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
              </div>
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn bg-white">Pay By Sender</button>
                <button type="submit" class="btn bg-white">Pay By Receiver</button>
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
      fromDistrict: '',
      fromCommune: '',
      fromBranch: '',
      to: '',
      toDistrict: '',
      toCommune: '',
      toBranch: '',
      product_type: '',
      company: '',

      user_create: [
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Kampot',
          product_type: 'decaying',
          company: 'VRk Buntham'
        },
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Takeaw',
          product_type: 'not decaying',
          company: 'VRK Buntham'
        },
        {
          sender: '088739393',
          receiver: '088343434',
          from: 'PP',
          to: 'Takeaw',
          product_type: 'not decaying',
          company: 'VRK Buntham'
        }
      ],
      product_types: ['decaying', 'not decaying'],
      companies: ['Vireak Buntham', 'Capitol', 'J&T express', 'ZTO express', 'other'],
      communes: ['Khom1', 'Khom2', 'khom3', 'khom4', 'khom5', 'khom6'],
      districts: ['District1', 'District2', 'District3', 'District4', 'District5', 'District6'],
      branches: ['branch1', 'branch2', 'branch3', 'branch4', 'branch5', 'branch5'],
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
        toCommune: this.toCommune,
        fromCommune: this.fromCommune,
        toDistrict: this.toDistrict,
        fromDistrict: this.fromDistrict,
        fromBranch: this.fromBranch,
        toBranch: this.toBranch,
        company: this.company
      })
      this.sender = ''
      this.receiver = ''
      this.from = ''
      this.to = ''
      this.product_type = ''
      this.company = ''
      this.commune = ''
      this.district = ''
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
.notification {
  position: fixed;
  top: 120px;
  right: 37px;
}
.norma_user {
  width: 228px;
  border-left: 1px solid black;
  /* display: flex;
  justify-content: center;
  align-items: center; */
}
.border {
  border-radius: 5px 5px 0px 0px;
}
</style>
