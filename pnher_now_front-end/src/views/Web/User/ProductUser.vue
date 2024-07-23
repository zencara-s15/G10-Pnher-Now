<template>
  <UserLayout>
    <div class="container p-4 bg-gray-200">
      <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
        </div>
        <div class="col-auto">
          <div class="input-group search-group mr-50">
          </div>
        </div>
        <div class="col-auto">
          <button class="btn btn-danger me-2" @click="showModal = true">Send Baggage</button>
        </div>
      </div>

      <!-- Displaying Baggage List -->
      <div class="row">
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
    </transition>
  </UserLayout>
</template>

<script>
import { ref, onMounted, computed } from 'vue';
import { usePostBaggageStore } from '@/stores/post_baggage-list';
import UserLayout from '@/Components/Layouts/UserLayout.vue';
import BaggagePostCard from '@/Components/Card/BaggagePostCard.vue';

export default {
  components: {
    UserLayout,
    BaggagePostCard
  },
  setup() {
    const store = usePostBaggageStore();
    const showModal = ref(false);
    const baggage = ref([]);
    const user_baggage = ref([]);
    const searchQuery = ref('');
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
    });

    const addItem = async () => {
      try {
        const { longitude, latitude } = await store.getCurrentLocation();
        formData.value.latitude = latitude;
        formData.value.longitude = longitude;

        const newItem = {
          receiver_phone: formData.value.receiver_phone,
          sending_address: formData.value.sending_address,
          receiving_address: formData.value.receiving_address,
          type: formData.value.type,
          weight: formData.value.weight,
          company: formData.value.company,
          post_id: formData.value.post_id ? parseInt(formData.value.post_id) : null,
          delivery_status_id: formData.value.delivery_status_id ? parseInt(formData.value.delivery_status_id) : null,
          longitude: formData.value.longitude,
          latitude: formData.value.latitude
        };

        await store.addPostBaggage(newItem);
        await store.fetchPostBaggage();

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
        };
        showModal.value = false;
      } catch (error) {
        console.error('Error adding new baggage:', error);
      }
    };

    const deleteItem = async (itemId) => {
      try {
        await store.deletePostBaggage(itemId);
        await store.fetchPostBaggage();
      } catch (error) {
        console.error('Error deleting baggage:', error);
      }
    };

    const filteredBaggage = computed(() => {
      return store.post_baggage.filter((item) =>
        item.receiver_phone.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    onMounted(() => {
      store.fetchPostBaggage();
    });

    return {
      showModal,
      formData,
      addItem,
      deleteItem,
      searchQuery,
      filteredBaggage
    };
  }
};
</script>

<style scoped>
/* Add your styles here */
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
</style>
