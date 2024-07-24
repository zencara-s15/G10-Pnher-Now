<template>
  <UserLayout>
    <div class="container p-4 px-35px bg-gray-200">
      <div class="flex flex-row justify-between px-35px">
        <div class="w-30% text-gray-900">
          <span class="text-2xl font-bold w-40% text-dark border-b-2 border-red-500 pb-1">
            My Baggages
          </span>
          <p class="mt-5px">See all your baggage.</p>
        </div>

        <div class="w-40% search-container">
          <div class="radio-inputs">
            <label class="radio">
              <input type="radio" name="radio" value="" v-model="selectedStatus" />
              <span class="name">All</span>
            </label>
            <label class="radio">
              <input type="radio" name="radio" value="1" v-model="selectedStatus" />
              <span class="name">Pending</span>
            </label>
            <label class="radio">
              <input type="radio" name="radio" value="2" v-model="selectedStatus" />
              <span class="name">Picked Up</span>
            </label>
            <label class="radio">
              <input type="radio" name="radio" value="3" v-model="selectedStatus" />
              <span class="name">In Stock</span>
            </label>
            <label class="radio">
              <input type="radio" name="radio" value="4" v-model="selectedStatus" />
              <span class="name">In Progress</span>
            </label>
            <label class="radio">
              <input type="radio" name="radio" value="5" v-model="selectedStatus" />
              <span class="name">Delivered</span>
            </label>
          </div>
        </div>

        <div class="w-30% filter-container gap-20px">
          <button class="btn bg-red-500 hover:bg-red-600 text-white me-2" @click="showModal = true">
            Add Baggage
          </button>
        </div>
      </div>

      <!-- Displaying Baggage List -->
      <div class="row mt-20px px-35px">
        <div class="col-md-4 mb-6" v-for="item in filteredBaggage" :key="item.id">
          <BaggagePostCard :item="item" @delete="deleteItem" />
        </div>
      </div>
    </div>

    <!-- Modal for Adding New Baggage -->
    <transition name="modal">
      <div v-if="showModal" class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">
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
              <form @submit.prevent="addItem">
                <div class="row">
                  <!-- Form inputs for adding a new baggage -->
                  <div class="col-md-12 flex flex-col gap-10px">
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
                    <button
                      type="button"
                      class="btn bg-danger text-white"
                      @click="showModal = false"
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </transition>
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
    const user_baggage = ref([])
    const searchQuery = ref('')
    const selectedStatus = ref('') // Bind to radio buttons
    const formData = ref({
      receiver_phone: '',
      sending_address: '',
      receiving_address: '',
      type: '',
      weight: '',
      company: '',
      post_id: '',
      delivery_status_id: '',
      latitude: '',
      longitude: ''
    })

    const deliveryStatuses = ref([
      { id: 1, name: 'Pending' },
      { id: 2, name: 'Picked Up' },
      { id: 3, name: 'In Stock' },
      { id: 4, name: 'In Progress' },
      { id: 5, name: 'Delivered' }
    ])

    const addItem = async () => {
      try {
        const { longitude, latitude } = await store.getCurrentLocation()
        formData.value.latitude = latitude
        formData.value.longitude = longitude

        const newItem = {
          receiver_phone: formData.value.receiver_phone,
          sending_address: formData.value.sending_address,
          receiving_address: formData.value.receiving_address,
          type: formData.value.type,
          weight: formData.value.weight,
          company: formData.value.company,
          post_id: formData.value.post_id ? parseInt(formData.value.post_id) : null,
          delivery_status_id: formData.value.delivery_status_id
            ? parseInt(formData.value.delivery_status_id)
            : null,
          longitude: formData.value.longitude,
          latitude: formData.value.latitude
        }

        await store.addPostBaggage(newItem)
        await store.fetchPostBaggage()

        // Reset form and close modal
        formData.value = {
          receiver_phone: '',
          sending_address: '',
          receiving_address: '',
          type: '',
          weight: '',
          company: '',
          post_id: '',
          delivery_status_id: '',
          latitude: '',
          longitude: ''
        }
        showModal.value = false
      } catch (error) {
        console.error('Error adding new baggage:', error)
      }
    }

    const deleteItem = async (itemId) => {
      try {
        await store.deletePostBaggage(itemId)
        await store.fetchPostBaggage()
      } catch (error) {
        console.error('Error deleting baggage:', error)
      }
    }

    const filteredBaggage = computed(() => {
      return store.post_baggage.filter((item) => {
        const matchesSearch = item.receiver_phone
          .toLowerCase()
          .includes(searchQuery.value.toLowerCase())
        const matchesStatus = selectedStatus.value
          ? item.delivery_status_id === parseInt(selectedStatus.value)
          : true
        return matchesSearch && matchesStatus
      })
    })

    onMounted(() => {
      store.fetchPostBaggage()
    })

    return {
      showModal,
      formData,
      addItem,
      deleteItem,
      searchQuery,
      selectedStatus, // Make it available for radio buttons
      filteredBaggage,
      deliveryStatuses
    }
  }
}
</script>


<style scoped>
/* Add your styles here */
.flex {
  display: flex;
  align-items: center;
}

.justify-between {
  justify-content: space-between;
}

.text-gray-900 {
  color: #1a202c;
}

.search-container {
  position: relative;
}

.search-icon {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
}

.search-input {
  width: 100%;
  padding: 10px 10px 10px 40px;
  border: 1px solid #ccc;
  border-radius: 10px;
}

.filter-container {
  display: flex;
  justify-content: flex-end;
}

.filter-button {
  display: flex;
  align-items: center;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
  color: #1a202c;
  cursor: pointer;
}

.filter-button i {
  margin: 0 5px;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-container {
  background: white;
  border-radius: 8px;
  width: 600px;
  /* max-width: 100%; */
  padding: 20px;
}

/* tab  */
.radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 100%;
  font-size: 14px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}

</style>
