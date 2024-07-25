<template>
  <DelivererLayout>
    <div v-if="loading">Loading...</div>
    <div v-if="error">{{ error }}</div>
    <div v-else class="">
      <div class="" v-for="(baggage, index) in baggages" :key="baggage.id">
        <DeliveryProcessingCard
          :item="baggage.baggage"
          :user="users[index]"
          @finish="ArrivedBranch"
          @comingSoon="ComingSoon"
        />
      </div>
    </div>
  </DelivererLayout>
</template>

<script lang="ts">
import { computed, onMounted, ref } from 'vue'
import { useBaggagesPickedUpStore } from '@/stores/baggages_picked_up'
import { usePostBaggageStore } from '@/stores/post_baggage-list'
import DelivererLayout from '@/Components/Layouts/DelivererLayout.vue'
import DeliveryProcessingCard from '@/Components/Card/DeliveryProcessingCard.vue'
import Swal from 'sweetalert2'

export default {
  components: {
    DelivererLayout,
    DeliveryProcessingCard
  },
  setup() {
    const store = useBaggagesPickedUpStore()
    const users = ref([])

    onMounted(async () => {
      await store.fetchBaggagesPickedUp()
      users.value = await store.fetchUsers()
    })

    return {
      baggages: computed(() => store.baggages),
      loading: computed(() => store.loading),
      error: computed(() => store.error),
      users
    }
  },
  methods: {
    async ArrivedBranch(baggage) {
      const store = usePostBaggageStore()
      const delivery_status_id = '3'
      try {
        await store.updateBaggageStatus(delivery_status_id, baggage.id)
        Swal.fire({
          icon: 'success',
          title: 'Delivered Successfully',
          text: 'You have delivered a baggage successfully!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          setTimeout(() => {
            location.href = '/history_deliverer'
          }, 100)
        })
      } catch (error) {
        console.warn(error)
      }
    },

    async ComingSoon(){
      Swal.fire({
        icon: 'warning',
        title: 'Coming Soon',
        text: 'This feature is coming soon!',
        timer: 3000,
        showConfirmButton: false
      })
    }
  }
}
</script>


<style scoped>
/* Add your styles here */
</style>
