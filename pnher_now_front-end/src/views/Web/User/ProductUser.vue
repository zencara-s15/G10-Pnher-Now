<template>
  <UserLayout>
    <div class="container p-4 bg-gray-600">
      <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
          <h3 class="fw-bolder text-dark">List of User Products</h3>
        </div>
        <div class="col-auto">
          <div class="input-group search-group mr-50">
            <span class="input-group-text bg-danger text-white">
              <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search..." v-model="searchQuery" />
          </div>
        </div>
        <div class="col-auto">
          <button class="btn btn-danger me-2" @click="showModal = true">Send Baggage</button>
        </div>
      </div>

      <!-- Displaying Baggage List -->
      <div class="row">
        <div class="col-md-4 mb-3" v-for="item in filteredBaggage" :key="item.id">
          <BaggagePostCard :item="item" @delete="deleteItem" />
        </div>
      </div>
    </div>

    <!-- Modal for Adding New Baggage -->
    <div
      v-if="showModal"
      class="modal fade show"
      style="display: block"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content my-15 h-80vh">
          <div class="modal-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-white">Add New Baggage</h5>
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
            <form @submit.prevent="addItem" class="">
              <div class="row">
                <!-- Form inputs for adding a new baggage -->
                <div class="col-md-20 flex flex-col gap-10px">
                  <div class="form-group">
                    <label for="receiver_phone" class="text-dark">Receiver Phone</label>
                    <input
                      type="text"
                      v-model="formData.receiver_phone"
                      class="form-control"
                      id="receiver_phone"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="sending_address" class="text-dark">Sending Address</label>
                    <input
                      type="text"
                      v-model="formData.sending_address"
                      class="form-control"
                      id="sending_address"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="receiving_address" class="text-dark">Receiving Address</label>
                    <input
                      type="text"
                      v-model="formData.receiving_address"
                      class="form-control"
                      id="receiving_address"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="type" class="text-dark">Type</label>
                    <input
                      type="text"
                      v-model="formData.type"
                      class="form-control"
                      id="type"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="weight" class="text-dark">Weight</label>
                    <input
                      type="number"
                      v-model="formData.weight"
                      class="form-control"
                      id="weight"
                      required
                      @input="updateTotalCost"
                    />
                  </div>
                  <div class="form-group">
                    <label for="company" class="text-dark">Company</label>
                    <input
                      type="text"
                      v-model="formData.company"
                      class="form-control"
                      id="company"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mt-4">
                  <button type="submit" class="btn bg-primary text-white">Confirm</button>
                  <button type="button" class="btn bg-danger text-white" @click="showModal = false">
                    Cancel
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import { usePostBaggageStore } from '@/stores/post_baggage-list'
import UserLayout from '@/Components/Layouts/UserLayout.vue'
import BaggagePostCard from '@/Components/Card/BaggagePostCard.vue'

export default {
  components: {
    UserLayout,
    BaggagePostCard
  },
  setup() {
    const store = usePostBaggageStore()
    const showModal = ref(false)
    const baggage = ref([])
    const searchQuery = ref('')
    const formData = ref({
      receiver_phone: '',
      sending_address: '',
      receiving_address: '',
      type: '',
      weight: '',
      company: '',
      post_id: '',
      delivery_status_id: '',
      lat: '',
      lng: ''
    })

    const addItem = async () => {
      // Get current location
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async (position) => {
          const lat = position.coords.latitude
          const lng = position.coords.longitude
          formData.value.lat = lat
          formData.value.lng = lng

          showModal.value = false
          const newItem = {
            receiver_phone: formData.value.receiver_phone,
            sending_address: formData.value.sending_address,
            receiving_address: formData.value.receiving_address,
            type: formData.value.type,
            weight: formData.value.weight,
            company: formData.value.company,
            post_id: formData.value.post_id !== '' ? parseInt(formData.value.post_id) : null,
            delivery_status_id:
              formData.value.delivery_status_id !== ''
                ? parseInt(formData.value.delivery_status_id)
                : null,
            lat: formData.value.lat,
            lng: formData.value.lng
          }

          try {
            await store.addPostBaggage(newItem) // Call the addPostBaggage action
            await store.fetchPostBaggage() // Fetch updated baggage list
            // Clear form data
            formData.value = {
              receiver_phone: '',
              sending_address: '',
              receiving_address: '',
              type: '',
              weight: '',
              company: '',
              post_id: '',
              delivery_status_id: '',
              lat: '',
              lng: ''
            }
          } catch (error) {
            console.error('Error adding new baggage item:', error)
            // Handle error as needed
          }
          location.reload()
        })
      } else {
        alert('Geolocation is not supported by this browser.')
      }
    }

    const deleteItem = async (itemId) => {
      try {
        await store.deletePostBaggage(itemId)
        await store.fetchPostBaggage()
        baggage.value = store.post_baggage
      } catch (error) {
        console.error('Error deleting baggage item:', error)
        // Handle error as needed
      }
      location.reload()
    }

    const filteredBaggage = computed(() => {
      return baggage.value.filter((item) =>
        item.receiver_phone.toLowerCase().includes(searchQuery.value.toLowerCase())
      )
    })

    onMounted(async () => {
      await store.fetchPostBaggage() // Fetch initial baggage list on component mount
      baggage.value = store.post_baggage
    })

    return {
      showModal,
      formData,
      addItem,
      baggage,
      deleteItem,
      searchQuery,
      filteredBaggage,
      store // Expose store to access state in template
    }
  }
}
</script>

<style scoped>
.container {
  background-color: #f8f9fa;
}

.card {
  border: none;
  border-radius: 12px;
  overflow: hidden;
  transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  transform: scale(1.05);
}

.card-body {
  padding: 20px;
  background-color: white;
}

.card-body .card-title {
  font-size: 1rem;
  font-weight: bold;
}

.card-body .card-text {
  font-size: 0.875rem;
  color: #6c757d;
}

.search-group {
  border-radius: 20px;
  overflow: hidden;
}

.search-group .input-group-text {
  border: none;
}

.search-group .form-control {
  border: none;
  box-shadow: none;
}

.btn {
  border-radius: 5px;
}

.btn-danger:hover {
  background-color: #c82333;
  border-color: #bd2130;
}

.modal-content {
  border-radius: 10px;
  overflow: hidden;
}

.modal-header {
  background-color: #343a40;
  color: white;
}

.modal-header .close {
  color: white;
}

.modal-header .close:hover {
  color: #ccc;
}

.modal-body {
  padding: 20px;
}
</style>
